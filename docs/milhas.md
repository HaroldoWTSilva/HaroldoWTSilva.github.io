---
not_in_nav: true
---

# Super Milha Otimizator

<div class="container" markdown>

O Super Milha Otimizeitor é uma aplicação que lhe permite encontrar a mais
barata combinação de milhas e dinheiro para sua viagem.

Aplicativos de milhas (ex. Smiles) propõem ao usuário diferentes alternativas
de como gastar milhas e dinheiro para um mesmo trecho de uma viagem. Além
disso, normalmente o usuário já tem algumas milhas e pode comprar mais pelo
aplicativo, o que torna a decisão de qual opção escolher não-trivial.

<div class="mb-3 row">
  <label for="nmilhas">Seu saldo de milhas atual</label>
  <input type="text" id="nmilhas">
</div>

<div class="mb-3 row">
  <label for="preco-milha">Preço por milha</label>
  <input type="text" id="preco-milha">
</div>

<button type="button" id="adicionar_etapa">Adicionar opção de etapa</button>

<table id="etapas">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Etapa</th>
      <th scope="col">Custo milhas</th>
      <th scope="col">Custo dinheiro</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>

</div>

<script src="/js/milhas-otimizator.js"></script>
