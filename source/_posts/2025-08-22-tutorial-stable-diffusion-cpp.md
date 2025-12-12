---
title: Tutorial básico de stable-diffusion.cpp
img: stable-diffusion-cpp-tutorial-result.png
coverimg: stable-diffusion-cpp-tutorial-result.jpg
date: '2025-08-22'
---

Ensinarei aqui como usar o [stable-diffusion.cpp](https://github.com/leejet/stable-diffusion.cpp) para gerar imagens de IA generativa por linha de comando.

## Introdução

Requisitos:
- Conhecimento em Linux, Bash e compilação de programas com C++ e CUDA.
- Um computador com 8GB de RAM e uma GPU NVIDIA com pelo menos 4GB de VRAM.
- Linux instalado, com os drivers da NVIDIA e CUDA.
- Ferramentas de desenvolvimento: git, g++, make, cmake, etc.

Os comandos desse tutorial foram testados em uma máquina com Fedora 42 e uma GPU GeForce RTX 2050.
Eu vou supor que o leitor não entende nada de IA generativa, mas que tem uma base sólida em computação.

## Baixando um modelo

O site [CivitAI](https://civitai.com) é focado em modelos generativos. O leitor pode navegar lá e escolher um de sua preferência.
Escolher o modelo não é uma tarefa tão simples quanto parece para um iniciante, por causa da torrente
de informações desconexas, rótulos estranhos, e opções indistinguíveis. É assim mesmo.

Para esse tutorial, será utilizado o modelo [WAI-NSFW-illustrious-SDXL, versão 12](https://civitai.com/models/827184?modelVersionId=1490781).
É um modelo destinado a geração de imagens no estilo anime, gratuito, sem censura, baseado no modelo Illustrious.
Na página dele do CivitAI, há um link para download um pouco escondido, logo abaixo da tabela de detalhes do modelo.
O leitor pode então baixar o arquivo *waiNSFWIllustrious_v120.safetensors*, de quase 6,5GB.

Baseado no que é dito na página do modelo, pode-se usar as seguintes opções recomendadas:

```bash
MODEL_OPTS="--steps 30 --cfg-scale 6.0 --sampling-method euler"
MODEL_POSPROMPT="masterpiece,best quality,amazing quality,"
MODEL_NEGPROMPT="bad quality,worst quality,worst detail,sketch,censor,"

```

O significado dessas opções foge do escopo desse tutorial, mas é importante entender que todo modelo tem suas opções específicas
e que elas podem ser encaixadas em argumentos do programa.

## Compilando o programa

As instruções oficiais para compilação estão na página do github do stable-diffusion.cpp. 
Vou transcrever as instruções da versão atual aqui.

```bash
#baixa o código
git clone --recursive https://github.com/leejet/stable-diffusion.cpp
cd stable-diffusion.cpp

#modifique para sua configuração de cuda
CUDA=...
PATH=$PATH:$CUDA/bin
LD_LIBRARY_PATH=$CUDA/lib64

#compila
mkdir build
cd build
cmake .. -DSD_CUDA=ON
cmake --build . --config Release

SD=$PWD/bin/sd
```

Daqui pra frente, vou supor que a variável `$SD` diz o caminho absoluto do binário sd.

## Lidando com poucos recursos 

É perfeitamente possível gerar imagens usando apenas CPU. Isso significa aguardar 20min até 45min pra ver um resultado pronto.
Eu não irei ensinar como fazer isso aqui, mas digo que é um bom exercício de paciência.

Se você tiver uma GPU com 8GB ou mais de memória, o modelo deve caber inteiro na placa e nenhum outro arquivo ou configuração especial é necessária.

Mas se você, como eu, tiver apenas à disposição uma GPU de 4GB, então você precisa quantizar o modelo, ou seja, reduzir o tamanho (e qualidade) do 
arquivo para permitir que pelo menos uma parte dele seja alocada na GPU.
Além disso, será preciso passar alguns argumentos especiais para o programa limitar quais partes do modelo ficam na GPU.

O código a seguir mostra como fazer quantização do arquivo baixado para *q4_K*:

```bash
GGUF=waiNSFWIllustrious_v120_q4_k.gguf
$SD -M convert -m waiNSFWIllustrious_v120.safetensors -o $GGUF  -v --type q4_K
MODEL=$PWD/$GGUF
```

Daqui pra frente irei supor que a variável `$MODEL` tem o filename absoluto do modelo, seja ele safetensors ou gguf.
As seguintes opções dizem para rodar algumas partes do modelo em CPU, e não em GPU:

```bash
PERF_OPTIONS="--vae-on-cpu --clip-on-cpu --control-net-cpu"
#ajuste para o número de threads de cpu da sua máquina
THREADS=8
```

Essas opções causam uma penalidade de performance, porque rodar em CPU é mais lento do que em GPU.
Sem elas, no entanto, o programa irá falhar ao rodar com esse modelo em uma GPU com 4GB.

## Gerando uma imagem

Se tudo deu certo até aqui, você já deverá ser capaz de gerar imagens.

O código a seguir irá gerar a imagem de abertura desse tutorial:

```bash
PROMPT="Happy high school girl blushes while eating a colorful icecream."
OUTPUT="{{page.img}}"
$SD -m "$MODEL" $MODEL_OPTS -o "$OUTPUT" -H 1024 -W 1024 --seed 69 -p "$PROMPT $MODEL_POSPROMPT" -n "$MODEL_NEGPROMPT"  -t $THREADS  $PERF_OPTIONS
```

O significado dos argumentos é: usar o modelo com as opções del para gerar uma imagem com o nome passado, de altura 1024, largura 1024, semente aleatória 69 (altere para ter resultados diferentes),
com o prompt textual e prompt negativo passados, usando o número de threads passadas e as demais opções já comentadas.  


