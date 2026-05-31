#!/bin/bash

# Criar volume primeiro (se não existir)
podman volume create blog_gems

# Executar o container
podman run -d \
  --name blog \
  -p 4000:4000 \
  -v .:/srv/jekyll:Z \
  -v blog_gems:/usr/local/bundle:Z \
  -e JEKYLL_ROOTLESS=1 \
  docker.io/jekyll/jekyll \
  jekyll serve --drafts
