---
title: "Embedding tipográfico"
---

Uma sugestão de converter caracteres para vetores (*embedding*) pode ser usar 
uma dimensão para cada tecla necessária para gerar o caractere. Seriam vetores
esparsos.

Digamos que seja adotado o teclado QWERTY. Cada tecla do teclado que pode 
gerar um caractere visível corresponde a uma dimensão, incluindo Shift 
e acentos. 

O caractere `a`, então teria um único valor na dimensão
correspondente à tecla "a", e zero nas demais dimensões. 

O caractere `A` teria um valor na dimensão da tecla "a" e um
valor na dimensão da tecla *Shift*.

O caractere `Â` teria valores em três dimensões: um para 
