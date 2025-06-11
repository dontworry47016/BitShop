# BitShop
BitShop (Eckmar V3)

Download and extract to /var/www/market

sudo apt-add-repository ppa:ondrej/php

sudo apt-get update

sudo apt remove Apache2*

sudo apt-get install nginx mysql-server unzip nodejs npm redis-server apt-transport-https openjdk-8-jre-headless curl tor php8.2-fpm php8.2-mysql php8.2-mbstring php8.2-xml php8.2-xmlrpc php8.2-gmp php8.2-curl php8.2-gd -y

sudo ufw allow 'Nginx HTTP'

#dont ask why we specifically download v1 to update to v2

curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer --1

composer self-update 2.0.7

mysql_secure_installation

mysql -u root -p

CREATE DATABASE marketplace DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;

CREATE USER 'market'@'localhost' IDENTIFIED BY 'password';

GRANT CREATE, ALTER, DROP, INSERT, UPDATE, DELETE, SELECT, REFERENCES, RELOAD on *.* TO 'market'@'localhost' WITH GRANT OPTION;

exit

sudo nano /etc/php/8.2/fpm/php.ini

#"Uncomment the line cgi.fix_pathinfo=1 and set the value to cgi.fix_pathinfo=0

sudo systemctl restart php8.2-fpm

#ONLY CHOOSE 1 OR 2

========1========

wget -qO - https://artifacts.elastic.co/GPG-KEY-elasticsearch | sudo apt-key add -

echo "deb https://artifacts.elastic.co/packages/6.x/apt stable main" | sudo tee /etc/apt/sources.list.d/elastic-6.x.list

sudo apt-get update && sudo apt-get install elasticsearch

========2=========

wget https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-6.0.1-amd64.deb

wget https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-6.0.1-amd64.deb.sha512

shasum -a 512 -c elasticsearch-6.0.1-amd64.deb.sha512 

sudo dpkg -i elasticsearch-6.0.1-amd64.deb

========post==========

sudo /bin/systemctl daemon-reload

sudo /bin/systemctl enable elasticsearch.service

sudo systemctl start elasticsearch.service

sudo systemctl status elasticsearch.service

curl -X GET "localhost:9200?pretty"

sudo nano /etc/redis/redis.conf

#"Change supervised from no to systemd. Reload Redis:"

sudo systemctl restart redis.service

sudo chown -R www-data:www-data /var/www/market/public

sudo chmod 755 /var/www

sudo chmod -R 755 /var/www/market/bootstrap/cache

sudo chmod -R 755 /var/www/market/storage

sudo chown -R $USER:www-data /var/www/market/storage

sudo chown -R $USER:www-data /var/www/market/bootstrap/cache

sudo chmod -R 775 /var/www/market/storage

sudo chmod -R 775 /var/www/market/bootstrap/cache

sudo chmod -R 755 /var/www/market/storage/public/products

sudo chgrp -R www-data /var/www/market/storage/public/products

sudo chmod -R ug+rwx /var/www/market/storage/public/products

sudo nano /etc/nginx/sites-available/default

#replace entire file

server {
    client_max_body_size 10M;

    listen 80;
    listen [::]:80;
    listen 443;
    listen [::]:443;
    root /var/www/market/public;
    index index.php index.html index.htm index.nginx-debian.html;
    server_name domain.com;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass unix:/run/php/php8.2-fpm.sock;
        fastcgi_index index.php;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        include fastcgi_params;
    }
}

sudo nginx -t

cd /var/www/market

composer install

npm install

npm audit fix

npm run prod

cp .env.example .env

php artisan key:generate

sudo nano .env

#adjust these values

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=marketplace
DB_USERNAME=market
DB_PASSWORD=password

CACHE_DRIVER=redis


php artisan migrate
php artisan storage:link
sudo service nginx restart

#Upgrades from eckmar V1/V2 whatever is floating around now:
Floating values corrected for btc to currency
