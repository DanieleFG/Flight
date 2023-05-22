# Criando container banco de Dados 

```
docker run --name my_maria -e MYSQL_ROOT_PASSWORD=123456 -e MYSQL_DATABASE=my_database -e MYSQL_USER=MYSQL_USER -p 3307:3306 -d mariadb:latest

```

```
    docker run --name myadmin -d --link my_maria:db -e PMA_PORT=3600 -p 8081:80 phpmyadmin
```

utilizador :root
senha : 123456

composer init

composer require mikecao/flight

docker start CONTAINER ID

php -S 0.0.0.0:8888


Vue
npm init vue@latest

 cd <your-project-name>
 npm install
 npm run dev
