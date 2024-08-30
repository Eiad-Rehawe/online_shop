<?php 

// create database
$sql = "Create DataBase If Not Exist Online_Shop";

// create products table 
$sql = "Create table products (
            product_id int primary key AUTO_INCREMENT,
            product_name varchar(100) not null,
            product_description text,
            product_price decimal not null,
            product_image varchar(50) not null
        )";

// create users table
$sql = "Create table users (
            id int primary key AUTO_INCREMENT,
            first_name varchar (20) not null,
            last_name varchar (20) not null,
            birth_date date not null,
            email varchar (100) not null UNIQUE,
            password varchar (200) not null,
            created_at date DEFAULT CURRENT_TIMESTAMP
        )";
