---
title: Tutorial de compressão de vídeo com FFMPEG
---

Explicarei aqui como comprimir um vídeo por linha de comando com
o programa ffmpeg.

## Introdução

Nesse post irei registrar meu conhecimento sobre compressão de vídeo com ffmpeg.

Os comandos aqui foram testados no linux, mas, com as adaptações necessárias, 
podem funcionar também no Windows, mesmo no terminal CMD.

## Sobre o FFMPEG

O programa ffmpeg é um utilitário para análise, conversão e edição de vídeos
em linha de comando. Diversos programas com interface gráfica, inclusive pagos,
usam o ffmpeg por baixo dos panos.

Ele é "open source e gratuito", em aspas bem suspeitas.
O núcleo do programa é realmente open source, mas parte do código usada
para a manipulação de vídeos (os codecs) nem sempre é, e há algumas dificuldades para se obter
o programa em sua forma 100% funcional. Como consequência, muitas distros linux
disponibilizam por padrão apenas uma versão limitada do programa nos 
gerenciadores de pacotes.

Para seguir esse tutorial, no mínimo, a instalação tem que ter
os codecs *h264*, *mp3* e *mpeg4*. Pode-se listar os codecs com o comando:

```
ffmpeg -codecs
```

Caso sua instalação do ffmeg não tenha o necessário, por favor, baixe o ffmpeg da 
[página oficial](https://www.ffmpeg.org/download.html).

## Um objetivo de exemplo

O objetivo deste tutorial é transformar um arquivo de vídeo chamado *entrada.mkv*, 
de 249MB, em um arquivo de saída chamado *saida.mp4*, de no máximo 38MB, utilizando somente
o programa ffmpeg e a linha de comando do terminal. 
O arquivo de saída, obviamente, será em formato *MP4* e deverá ter a melhor 
qualidade de áudio e vídeo, dentro do possível para o tamanho.
Além disso, o arquivo de saída deverá ser apto a ser reproduzido em navegadores web.

## Análise do arquivo de entrada

Durante a escrita desse tutorial, estou testando com um arquivo de vídeo real
baixado da internet. Talvez você tenha intenção de usar um vídeo similar. Nesse caso, não
é o usuário quem determina quais são as trilhas do arquivo de entrada. Mas certamente
pode-se determinar quais são as trilhas de som e vídeo do arquivo de saída.

O comando `ffmpeg -i entrada.mkv` irá despejar uma abundância de  informações 
do arquivo de entrada, incluindo informação sobre as trilhas, que aparecerão assim:

```
Stream #0:0: Video: hevc (Main 10), yuv420p10le(tv, bt709), 1920x1080, SAR 1:1 DAR 16:9, 23.98 fps, 23.98 tbr, 1k tbn (default)
      Metadata:
        BPS             : 869405
        DURATION        : 00:23:56.102000000
...
Stream #0:2(jpn): Audio: aac (LC), 48000 Hz, stereo, fltp
      Metadata:
        title           : Japanese
        BPS             : 107742
        DURATION        : 00:23:56.095000000
...
Stream #0:4(eng): Subtitle: ass (ssa)
      Metadata:
        title           : English [Astral]
        BPS             : 55858
        DURATION        : 00:23:31.040000000

```

As trilhas acima são as que me interessam ter no arquivo de saída. Há várias
 outras trilhas, incluindo áudio em inglês, outra trilha de legenda e trilhas
 de fontes, que serão descartadas.

## FFMPEG e h264

Para obter o máximo de compressão, iremos usar a conversão em dois passes de h264.
Explicações mais detalhadas [aqui](https://trac.ffmpeg.org/wiki/Encode/H.264).
Para usar essa técnica, precisamos antes determinar qual será a taxa de bits do vídeo
e do áudio.

Nosso objetivo é gerar um arquivo de vídeo com 36MB. Isso significa que a soma
do tamanho da única trilha de vídeo da saída e da única trilha de áudio da 
saída deve ser 36MB.

Seguindo as instruções da página, podemos começar a escrever o script de conversão:

```bash
#duração do video em minutos
DUR=24
#tamanho esperado da saída, em MiB
TAM_SAIDA=35
#audio bitrate, em kbits/s
AUDIOBR=48

TOTALBR=$((TAM_SAIDA*8388608/(DUR*60*1000) ))
VIDEOBR=$((TOTALBR-AUDIOBR))
```

A taxa de áudio é questão de preferência. A taxa de vídeo (videobr) no exemplo 
ficou (arredondada) 161. 
A determinação do tamanho de saída em MiB exige tentativa e erro. Nos meus testes,
usar `TAM_SAIDA=36` gerou arquivos com mais de 39MB, o que não é aceitável aqui.
É preciso filtrar o vídeo para reduzir a resolução e engravar as legendas:

```bash
FILTRO="scale=-2:960,subtitles=entrada.mkv:si=1"
```

Significa: a saída terá altura 960 e largura mantendo
a proporção, que seja múltiplo de 2. Após reescalar a imagem, será
engravada a segunda legenda que está nesse vídeo.

Vamos agora juntar em um vetor argumentos que serão usados em ambos os passes:

```bash
COMUM=(-i entrada.mkv -map 0:0 -c:v libx264 -vf $FILTRO -b:v ${VIDEOBR}k -preset veryslow -tune animation -movflags +faststart -pix_fmt yuv420p)
```

Estamos usando `preset veryslow` para ter a melhor compressão possível, ainda que custando muito tempo.
O `faststart` é importante para facilitar o carregamento de vídeos web.
O arquivo de exemplo usado no teste era um desenho animado e, por isso, 
`-tune animation` como dica para o programa.
Forçamos o formato `yuv420p`, porque é amplamente aceito entre os navegadores.

A execução em dois passes exige chamar o ffmpeg duas vezes:

```bash
ffmpeg -y ${COMUM[@]} -pass 1 -an -f null /dev/null

ffmpeg -y ${COMUM[@]} -map 0:2 -c:a libopus -ac 1 -b:a ${AUDIOBR}k -pass 2 saida.mp4
```

**Atenção:** estamos usando `-y` para sempre sobrescrever a saída.
No primeiro passe, não é preciso processar o áudio e a saída pode ser ignorada. O que
vai importar são um arquivo .mbtree e um arquivo .log que serão gerados e usados no 
segundo passe.
O segundo passe é notavelmente mais demorado que o primeiro.
O áudio está sendo forçado a ser mono (um canal). Se preferir stereo, atente-se ao
bitrate do audio e refaça os cálculos de acordo. 

Ao final do processo, deverá surgir o arquivo saída.mp4. É preciso assistir para
garantir que tenha as qualidades desejadas de áudio e vídeo. Se não estiver, é preciso
manipular os argumentos para tentar balancear, por exemplo, reduzindo a qualidade do 
áudio para melhorar o vídeo. Claro que há limites para o que pode ser obtido,
por causa das fortes restrições impostas.

## Resultados

Nos testes realizados, o arquivo final ficou com qualidade aceitável.
A imagem apresenta alguns borrões e artefatos ocasionais, mais perceptíveis
quando o vídeo está pausado, mas que não são tão desagradáveis ao ponto
de arruinar a experiência de assistir.
O áudio ficou bom o bastante.
Considerando o objetivo de poder compartilhar um vídeo em um navegador,
parece-me ter sido atingido.

## Conclusão

O processo aqui descrito é uma demonstração do poder da compressão de vídeo
com o formato h264, da utilidade do programa ffmpeg.
É uma prova de que é possível reduzir um vídeo de um desenho animado
para um tamanho pequeno o suficiente para ser compartilhado na internet,
em fóruns ou redes sociais.

## Trabalhos futuros

Testar o formato WEBM/VP9, ver as diferenças de qualidade e tempo de compressão.
