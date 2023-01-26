# TESTE PARA VAGA DE DESENVOLVEDOR PHP

### Back-end feito com laravel

### Arquitetura 

- PHP 8.1.14
- Laravel 9.48.0
- Composer 2.4.4

### Instalação - WINDOWS
```sh
git clone https://github.com/eduardohor/list-products-back.git
```

```sh
cd list-products-back
```

- Instalar as dependências

```sh
composer install
```

- Duplicar o arquivo **.env.example** e renomear a copia para **.env**
```sh
  cp .env.example .env
```

- Alterar os dados de banco no arquivo .env para os referente ao seu banco local

- Logo depois execute o comando abaixo para gerar uma nova chave
```PHP
php artisan key:generate
```
- Criar as tabelas no banco

```sh
php artisan migrate
```

- Criar link simbólico para upload e visualização de imagens 

```sh
php artisan storage:link
```

- Subir o servidor

```sh
php artisan serve
```

 Verificar se a aplicação está online acessando [http://localhost:8000](http://localhost:8000)





