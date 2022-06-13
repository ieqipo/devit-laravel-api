##[DevIt test task: PHP Backend Developer Laravel](https://sharing.clickup.com/t/h/22wbymp/M6SS32JBY1TDNDM)

##How to use

This project was developed on linux ubuntu.

Clone this project to your folder on linux: 
```sh
git clone https://github.com/ieqipo/devit-laravel-api.git
```
Go to cloned root directory:
```sh
cd devit-laravel-api
```
Run composer:
```sh
composer install --ignore-platform-reqs
```
Run sail. This is like a wrapper for docker-compose:
```sh
./vendor/bin/sail up -d
```
Generate key:
```sh
./vendor/bin/sail artisan key:generate
```
Make migration to run datebase:
```sh
./vendor/bin/sail artisan migrate
```
If you get an error during migration, try to repeat command above once more. 

##RSS parser
Run command to parse xml rss:
```sh
./vendor/bin/sail artisan parse:rss
```
To make worker that runs 
