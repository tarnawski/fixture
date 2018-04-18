FROM php:7.1-apache

MAINTAINER Tomasz Tarnawski <tarnawski27@gmail.com>

RUN docker-php-ext-install pdo pdo_mysql
RUN a2enmod rewrite