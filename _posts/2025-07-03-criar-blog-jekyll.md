---
title: "Criando um blog com Jekyll"
---

Editar um blog em Jekyll é fácil. Construir um, no entanto, não é. O processo de instalar, do zero, as dependências necessárias
é um show de horrores. 

A seguir estão um conjunto de instruções que funcionam no Fedora 41. 

```
# Instalar dependências que são necessárias para construir as gems

dnf install make gcc gcc-c++ ruby-devel rubygem-jekyll rubygem-bundler

#se for gerar um blog completamente novo
jekyll new meubloguinho
cd meubloguinho
```

Se for hostear no github pages, tem que substituir o jekyll pela gem do gh-pages.
Ou seja, no Gemfile, onde tem `gem 'jekyll'` ou algo assim, substituir por 

```
gem "github-pages", "~> 232", group: :jekyll_plugins
```

A versão exata da gem varia, e o valor correto pode ser checado na [lista de dependências do github pages](https://pages.github.com/versions).

Para minimizar dor de cabeça, instalar as gems localmente na pasta vendor:

```
#Instalar as gems do blog na pasta do proprio blog

bundle config --deployment yes
bundle install --deployment

#Testar e torcer
bundle exec jekyll serve
``` 
