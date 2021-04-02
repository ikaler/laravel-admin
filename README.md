# Secure Laravel app as a Docker container

## Laravel setup include
- Admin Authentication  
- Admin Panel  
- User Authentication  
- API versioning (eg: api/v1)  
- API authentication using Sanctum  
- VSCODE settings for Xdebug

### For SSL you need to generate certificate files
Certificate files should be inside `docker/apache/ssl` folder.


## Setup LAMP environment using Docker
Custom docker images for PHP/MySQL Applications  
- apache  
- php (7.4)  
- mysql (5.7)  


### Build custom images

Go inside `docker` folder
```
cd docker
```

Execute these commands to build custom php and mysql images
```
$ docker image build --no-cache -f php74.Dockerfile -t php74-apache-ssl-dev .
$ docker image build --no-cache -f mysql57.Dockerfile -t mysql57-dev .
```

### Config all settings for `docker-compose.yml`
Copy `.env.example` file in the root folder to `.env`
Change settings in `.env` for as required

### Start/Stop all services in containers:

Move out of `docker` directory
```
cd ..
```

Execute the following command to Start
```
$ docker-compose up -d 
```

Execute the following command to Stop
```
$ docker-compose down
```

### Run composer inside php service
```
docker-compose exec php composer --version
```

### Run php artisan inside php service
```
docker-compose exec php php artisan env
```

### Run npm commands inside npm service
```
docker-compose run --rm npm npm install
docker-compose run --rm npm npm run dev
```

### To browse website
Add following entry in `/etc/hosts` file 
```
127.0.0.1       website.local
```
For HTTP access use `http://website.local:8080`  
For HTTPS access use `https://website.local:8443`
For HTTP access use `https://website.local:8080/admin`
For HTTPS access use `https://website.local:8443/admin`
For PhpMyAdmin access use `https://website.local:8081`


### VSCODE Xdebug Config settings
```
{
    "name": "Listen for XDebug on Docker",
    "type": "php",
    "request": "launch",
    "port": 9000,
    "log": true,
    "externalConsole": false,
    "stopOnEntry": false,
    "pathMappings": {
        "/var/www": "${workspaceFolder}/src"
    },
}
```