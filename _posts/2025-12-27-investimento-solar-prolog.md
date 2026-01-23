---
title: Calculando um retorno de investimento com Prolog
date: 2025-12-27
excerpt: "Aprenda a calcular juros com prolog"
---

## Introdução

Começo desejando a todos os meus súditos boas festas de fim de ano.

Relato aqui um curioso caso de tomada de decisão sobre investimentos, usando a
linguagem Prolog. Eu usei o interpretador online 
[SWISH](https://swish.swi-prolog.org/), que foi de grande ajuda.

## O problema

Eu tenho R$6000,00 para investir, e preciso escolher entre aplicar no Tesouro
Direto, a juros prefixados, ou instalar painéis solares para não pagar mais
energia elétrica.

O investimento no Tesouro me daria um retorno fixo, conhecido, bastante líquido
e eu poderia sacar sempre algum valor mais alto que o montante inicial, ou pelo
menos próximo disso. Eu vou estimar a taxa de juros em 1% ao mês.

Pagar pela instalação dos painéis solares iria consumir todo o montante inicial,
mas me pouparia de pagar uma média de R$275 por mês em energia elétrica. Eu
suponho que irei investir todo o dinheiro poupado no tesouro direto, de forma
que é preciso levar em conta também os juros desse valor poupado e acumulado.

## A solução

Eu saberia programar em diversas linguagens alguma forma de calcular qual dos
investimentos é melhor, mas optei por usar prolog para ver se seria uma boa
linguagem para resolver esse problema real, e de forma legível.

O código que resolveu o problema ficou assim:

```prolog

valores(Mes, Dsolar, Dtesouro, (Mes, Dsolar, Dtesouro)) :- 
    Dsolar < Dtesouro.
valores(Mes0, Dsolar0, Dtesouro0, V) :- 
    Dsolar0 < Dtesouro0, 
    succ(Mes0, Mes1), 
    Dsolar1 is (Dsolar0+275.0)*1.01,
    Dtesouro1 is Dtesouro0*1.01,
    valores(Mes1, Dsolar1, Dtesouro1, V).
```

Pode-se obter os valores mensais com:

```prolog
valores(0, 0, 6000, V).
```

## Observações

Foi extraordinariamente difícil chegar até essa forma do código. É difícil pra
mim explicar em palavras o funcionamento dele, e eu estou insatisfeito com sua
forma atual. Mas foi uma boa experiência.
