# /pages/

é o diretório onde estarão as páginas que o usuário acessar. Contém a maioria do html do código

# /public/

diretório que disponibiliza outros tipos de arquivos para usar no frontend, como imagens, css, etc

# /src/

diretório que contém a parte lógica do backend, com códigos que não retornarão nenhum html como resposta.
a maioria dos códigos desse diretório servem para serem importados por outros arquivos php

# /uploads/

pasta que contém os arquivos de imagem que os usuários enviam para sua empresa

# /src/config/

arquivos de configurações gerais, como banco de dados, provedores, etc

# /src/forms/

arquivos que serão alvos de requisições via formulário.
quando o usuário estiver numa página e enviar um formulário, ele vai enviar para algum arquivo dessa pasta, que vai tratar os dados e redirecionar o usuário.
ele geralmente redireciona para dois lugares diferentes
