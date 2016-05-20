========================
NITH Freshmen Guide
========================

This is a repository to store the website that is intended to be used by a fresher at NITH.
The website is under construction and will soon reach a alpha phase.


[![Join the chat at https://gitter.im/Nithmr/FreshmanGuide](https://badges.gitter.im/Nithmr/FreshmanGuide.svg)](https://gitter.im/Nithmr/FreshmanGuide?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
=======
To setup the development environment for the project, follow the instructions given below.

First of all, you need to install [Laravel](https://laravel.com) to run this project on your localhost.

Installation of Laravel
------------------------

* **First get PHP and all its extension laravel depends on**

> PHP >= 5.5.9, OpenSSL PHP Extension, PDO PHP Extension, Mbstring PHP, Extension, Tokenizer PHP Extension

On Ubuntu you can get them by using,
```
sudo apt-add-repository ppa:ondrej/php
sudo apt-get update
sudo apt-get install php php-mysql php-mcrypt php-curl php-mbstring php-gettext php-zip
```

* **Then install Composer (PHP's dependencies manager). Depending on you OS you can get it from [Donwload Composer](https://getcomposer.org/download/)**

On Ubuntu the best way to gloabally install composer is,
```
php -r "readfile('https://getcomposer.org/installer');" | php
sudo mv composer.phar /usr/local/bin/composer
```
or if you want to use curl,
```
curl -sS https://getcomposer.org/installer | sudo php -- --install-dir=/usr/local/bin --filename=composer
```
Now `composer` will be availabe to you as a command.

* **Clone this repository, enter the project's directory and install all dependencies using composer**
```
composer install
```

* **Generate the key**

Before running the project, you need to generate an application key for your clone of the project. Rename .env.example file to .env and then generate the key by running the following commands:
```
cp .env.example .env
php artisan key:generate
```

* **Now, you are ready to run the website on your localhost**
```
php artisan serve
```
Visit [http://localhost:8000](http://localhost:8000) to confirm.

> In case of any problems, feel free to share them with us in the gitter chat room. Keep contributing!
