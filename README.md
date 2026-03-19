## Compose ciga-formation application
### PHP application with ngnix

[![Repo](https://img.shields.io/badge/Docker-Repo-007EC6?labelColor-555555&color-007EC6&logo=docker&logoColor=fff&style=flat-square)](https://hub.docker.com/r/rssni/ciga-formation)
[![Version](https://img.shields.io/docker/v/rssni/ciga-formation/latest?labelColor-555555&color-007EC6&style=flat-square)](https://hub.docker.com/r/rssni/ciga-formation)
[![Size](https://img.shields.io/docker/image-size/rssni/ciga-formation/latest?sort=semver&labelColor-555555&color-007EC6&style=flat-square)](https://hub.docker.com/r/rssni/ciga-formation)
[![Pulls](https://img.shields.io/docker/pulls/rssni/ciga-formation?labelColor-555555&color-007EC6&style=flat-square)](https://hub.docker.com/r/rssni/ciga-formation)

Project structure:
```
.
├── docker-compose.yml
├── public
    └── storage
└── .env

```

## Docker-compose.yml
```
services:
    ####################################################################################################
    # PHP
    ####################################################################################################
    appciga:
        image: rssni/ciga-formation:latest
        restart: unless-stopped
        volumes:
            - .env:/var/www/.env
            - ./public/storage:/var/www/public/storage:cached
        networks:
            - cigaformation
        deploy:
            resources:
                limits:
                    cpus: 0.2
                    memory: 80M
    ####################################################################################################
    # Nginx
    ####################################################################################################
    proxyciga:
        image: nginx
        container_name: proxy-ciga
        restart: unless-stopped
        ports:
            - '8000:80'

        volumes:
            - .docker/nginx/default.conf:/etc/nginx/conf.d/default.conf
        networks:
            - cigaformation
        deploy:
            resources:
                limits:
                    cpus: 0.1
                    memory: 6M

    ####################################################################################################
    # DATABASE (MySQL)
    ####################################################################################################
    dbciga:
        image: mysql:5.7
        restart: unless-stopped
        expose:
            - '3306'
        volumes:
            - ./.docker/mysql/dump/ciga.sql:/docker-entrypoint-initdb.d/ciga.sql
            - ciga_db:/var/lib/mysql
        environment:
            MYSQL_DATABASE: ${DB_DATABASE}
            MYSQL_ROOT_PASSWORD: ${DB_PASSWORD}
            MYSQL_PASSWORD: ${DB_PASSWORD}
            MYSQL_USER: ${DB_USERNAME}
            MYSQL_ALLOW_EMPTY_PASSWORD: false
            SERVICE_TAGS: dev
            SERVICE_NAME: mysql
        networks:
            - cigaformation
        deploy:
            resources:
                limits:
                    cpus: 0.1
                    memory: 256M
    
    adminer:
        image: adminer
        restart: always
        ports:
            - 8080:8080
        networks:
            - cigaformation

volumes:
    ciga_db:

networks:
    cigaformation:
        name: cigaformation
        external: true
```
## Environement variables
```
APP_NAME="ciga-formation.com"
APP_ENV=production
APP_KEY="base64:hsdfsdfsdfjshfhssdfd=="
APP_DEBUG=true
APP_LOG_LEVEL=debug
APP_URL="https://ciga-formation.com"


LOG_CHANNEL=stack
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=dbciga
DB_PORT=3306
DB_DATABASE=database
DB_USERNAME=username
DB_PASSWORD=secret


PREFIX_ADMIN=administrator

BROADCAST_DRIVER=redis
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_DRIVER=database
QUEUE_CONNECTION=sync
SESSION_LIFETIME=120

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379


MAIL_DRIVER=smtp
MAIL_HOST=mail34.lwspanel.com
MAIL_PORT=465
MAIL_FROM_ADDRESS=contact@ciga-formation.com
MAIL_USERNAME=contact@ciga-formation.com
MAIL_PASSWORD=
MAIL_ENCRYPTION=tls


JWT_SECRET=secret


AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
```

## Deploy with docker compose

```
$ docker compose up -d
[+] Running 5/5
 ✔ Volume "ciga-formationcom_ciga_db"     Created                                                                                                                                               0.0s 
 ✔ Container ciga-formationcom-appciga-1  Started                                                                                                                                               0.6s 
 ✔ Container ciga-formationcom-adminer-1  Started                                                                                                                                               0.6s 
 ✔ Container ciga-formationcom-dbciga-1   Started                                                                                                                                               1.2s 
 ✔ Container proxy-ciga                   Started    
```

## Expected result

Listing containers must show one container running and the port mapping as below:
```
$ docker compose ps
NAME                          IMAGE                         COMMAND                  SERVICE     CREATED         STATUS         PORTS
ciga-formationcom-adminer-1   adminer                       "entrypoint.sh php -…"   adminer     3 minutes ago   Up 3 minutes   0.0.0.0:8080->8080/tcp, :::8080->8080/tcp
ciga-formationcom-appciga-1   rssni/ciga-formation:latest   "docker-php-entrypoi…"   appciga     3 minutes ago   Up 3 minutes   9000/tcp
ciga-formationcom-dbciga-1    mysql:5.7                     "docker-entrypoint.s…"   dbciga      3 minutes ago   Up 3 minutes   3306/tcp, 33060/tcp
proxy-ciga                    nginx                         "/docker-entrypoint.…"   proxyciga   3 minutes ago   Up 3 minutes   80/tcp
```

After the application starts, navigate to `http://localhost:8000` in your web browser or run:
```
$ curl localhost:8000

```

Stop and remove the containers
```
$ docker compose down
```