CREATE DATABASE `testdb`;
USE `testdb`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;


insert into store (store_name,category_store) VALUES('flipkart','ecommerce');


create table store (id int not null AUTO_INCREMENT,store_name varchar(20),category_store varchar(20),PRIMARY KEY (id));

create table store_order_details(id INT NOT NULL AUTO_INCREMENT,category varchar(50),title varchar(100),productId varchar(20),quantity int,price int,sales_amount int,status_type

varchar(10),affiliate_order_id varchar(20) UNIQUE,order_date TIMESTAMP,commission_rate float,tentative_commission_amount float,aff_ext_param1 int,aff_ext_param2 int,sales_channel

varchar(10),customer_type varchar(10),created_date TIMESTAMP,primary key(id),store_id int,foreign key (store_id) references store(id));