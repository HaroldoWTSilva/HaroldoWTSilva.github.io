# A Palavra de Haroldo Watson

Blog construído com [MkDocs](https://www.mkdocs.org) (tema
[Material](https://squidfunk.github.io/mkdocs-material/)) e publicado no
GitHub Pages em <https://haroldowtsilva.github.io>.

## Estrutura

- `mkdocs.yml` — configuração do site (blog, tags, RSS, busca, temas claro/escuro,
  redirecionamentos das URLs antigas do Jekyll, minificação, datas de revisão via git e
  lightbox de imagens)
- `overrides/` — templates customizados do tema (ex.: página 404)
- `docs/` — páginas estáticas (páginas com `not_in_nav: true` ficam fora do menu, acessíveis só pelo link)
- `docs/posts/` — postagens do blog, listadas na página inicial (rascunhos usam `draft: true`)
- `docs/img/`, `docs/js/`, `docs/assets/` — arquivos estáticos

## Desenvolvimento local

```bash
python3 -m venv .venv
source .venv/bin/activate
pip install -r requirements.txt
mkdocs serve
```

Para gerar o site em `site/`:

```bash
mkdocs build
```

O deploy no GitHub Pages é feito automaticamente pelo workflow
`.github/workflows/mkdocs.yml` a cada push na branch `main`.
