---
title: Acessando o IRC com Weechat
date: 2025-10-19
---

Como acessar o IRC pelo terminal.

Este é um guia rápido do uso do programa [Weechat](https://weechat.org) 
para acessar a rede IRC pelo terminal do Linux. 

## Sobre o IRC

É uma rede de chat que era muito popular
no Brasil nos anos 2000. De lá pra cá caiu muito em número de usuários
brasileiros, que migraram para as redes sociais, e aplicativos de mensagem
instantânea. Mas ainda é usada ao redor do mundo e também para compartilhamento
de arquivos.

## O estado atual dos programas IRC no Linux

Para Gnome, existe o programa "oficial" de IRC que é o Polari.
Também pode-se usar o HexChat.
Eu tive problemas com ambos. O Weechat é o único que não me desapontou.

## Guia de uso

Após instalar e iniciar o Weechat, você estará diante de uma aplicação
de terminal que é controlada principalmente por comandos digitados no prompt.

Há vários servidores aos quais o usuário pode se conectar.
Vamos começar adicionando o servidor Rizon:

```bash
/server add rizon irc.rizon.net/6697
``` 

Agora setar os nicks, em ordem de preferência:

```bash
/set irc.server.rizon.nicks "PrincesaDaDisney,ChipChip,NhecoNheco"
```

Setar um nome falso, porque não é bom revelar dados pessoais para desconhecidos:

```bash
/set irc.server.rizon.realname "Cleobaldo Paiva"
```

Determinar a pasta de downloads, porque o padrão é tosco:

```bash
/set xfer.file.download_path "~/Downloads"
```

Por fim, conectar-se à rede:

```bash
/connect rizon
```

E entrar em um canal amigável:

```bash
/join #cisco
```
