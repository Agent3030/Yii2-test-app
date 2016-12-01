# REST_test
app for testing Yii2 REST server and AngularJS(1.xx) frontend

****Contents****
* Setup *
* Run *


**Setup**
ATTENTION. Application created and tested in Linux Ubuntu 16.04 LTS.

Download all files in one directory.

For simlicity of local deployment, I'm using docker technology  [Docker](www.docker.com) и [Docker-compose](https://github.com/docker/compose).

To run application, setup docker and docker-compose and run in project root directory
    $ docker-compose up -d
    
After will run a local web server with LEMP stack: php7-fpm, nginx and postgres. 
   
You have to run migrations to get working application.
In root directory apply:
    $ docker exec -it testapp_fpm_1 bash 
You will get a access to fpm container. 
In container apply:
    $ /var/www/test-app
    $ php yii migrate/up 
    $ php yii migrate --migrationPath=@yii/rbac/migrations/
    $ php yii rbac/init
    
This migrations will make a db with user table and three users:
  admin password:admin
  moderator password: moderator
  user password: user
and       
DB RBAC tables with user rules.     

**Run**
After setup, application will available on address:


    http://localhost:8093
    

Thanks for your attention and comments.
    
    
    



 
 

