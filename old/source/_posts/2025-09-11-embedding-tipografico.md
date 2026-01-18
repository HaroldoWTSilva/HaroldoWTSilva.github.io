---
title: "Embedding tipográfico"
date: 2025-09-11
---

Uma sugestão de converter caracteres para vetores (*embedding*) pode ser usar 
uma dimensão para cada tecla necessária para gerar o caractere. Seriam vetores
esparsos. A ideia é que o *embedding* de uma palavra estaria relacionado à
forma como a palavra é digitada em um teclado normal.

Digamos que seja adotado o teclado ABNT2. Cada tecla do teclado que pode 
gerar um caractere visível corresponde a uma dimensão, incluindo Shift 
e acentos. 

O caractere `a`, então teria o valor 1 na dimensão
correspondente à tecla "a", e zero nas demais dimensões. 

O caractere `A` teria 1 na dimensão da tecla "a" e um
valor na dimensão da tecla *Shift*.

O caractere `Â` seria na verdade quebrado em dois caracteres: primeiro o
`^`, que teria 1 na dimensão do *Shift* e 1 na dimensão da tecla à direita 
do `ç`, que tem `^` e `~`.

Uma alternativa seria usar a posição em coordenadas 2D das teclas do teclado.
Por exemplo, no teclado ABNT2, a tecla G está mais próxima espacialmente das teclas
R,T,Y,F,H,V,B e N. Ela está notavelmente mais distante da tecla P. Então a tecla G deveria
corresponder a um vetor 2D que está a uma distância menor da tecla N do que da tecla P.

Uma vantagem dessas formas de representação é que palavras tipograficamente parecidas
seriam mapeadas para sequências de vetores tipograficamente parecidos também.

Não é do meu conhecimento se alguém já publicou algo parecido.
