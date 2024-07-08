#run php fpm & nginx server and open port 8080 for public access
docker run --name nginx-php -p 8080:80 -v ./:/data/wwwroot  -d jetsung/nginx-php
