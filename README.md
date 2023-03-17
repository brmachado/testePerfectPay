
### Passo a passo
Clone Repositório
```sh
git clone https://github.com/brmachado/testePerfectPay.git my-project
```
```sh
cd my-project/
```


Alterne para a branch laravel 9.x
```sh
git checkout laravel-9-com-php-8
```


Remova o versionamento (opcional)
```sh
rm -rf .git/
```


Crie o Arquivo .env
```sh
cp .env.example .env
```


Atualize as variáveis de ambiente do arquivo .env
```dosini
APP_NAME="Teste Perfect Pay"
APP_URL=http://localhost:8989

MP_KEY=TEST-2da1a4b3-6ce6-4044-b610-00718add9291
MP_TOKEN=TEST-4419922878215203-082012-36ec5caa5e9cbabe09114a78cd8fccda-343999868

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=nome_que_desejar_db
DB_USERNAME=root
DB_PASSWORD=root

CACHE_DRIVER=redis
QUEUE_CONNECTION=redis
SESSION_DRIVER=redis

REDIS_HOST=redis
REDIS_PASSWORD=null
REDIS_PORT=6379
```


Suba os containers do projeto
```sh
docker-compose up -d
```


Acesse o container app com o bash
```sh
docker-compose exec app bash
```


Instale as dependências do projeto
```sh
composer install
```


Gere a key do projeto Laravel
```sh
php artisan key:generate
```


Acesse o projeto
[http://localhost:8989](http://localhost:8989)
