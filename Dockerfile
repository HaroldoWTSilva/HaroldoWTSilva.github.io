# Dockerfile para rodar o servidor de desenvolvimento do Jigsaw (modo de teste)
# Base: imagem oficial do PHP
FROM php:8.4-cli

# Copia o binário do composer a partir da imagem oficial do Composer
COPY --from=docker.io/composer/composer:latest-bin /composer /usr/bin/composer

# Diretório de trabalho
WORKDIR /app

COPY . .

EXPOSE 8000

CMD ["./vendor/bin/jigsaw", "serve", "--host=0.0.0.0"]