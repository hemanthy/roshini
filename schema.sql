drop database testdb;
create database testdb;
use testdb;



create table user (
  id bigint(8) NOT NULL AUTO_INCREMENT,
  name varchar(30) NOT NULL,
  email varchar(60) NOT NULL UNIQUE,
  password varchar(40) NOT NULL,
  user_reference_code long,
  active bool default false,
  PRIMARY KEY (id));

Insert into user (name,email,password,user_reference_code,active) values ('Hemanth','ad@a.com','a',435,true);
Insert into user (name,email,password,user_reference_code,active) values ('Hemanth2','add@a.com','a',589,true);
Insert into user (name,email,password,user_reference_code,active) values ('hemanthroshini','hemanthroshini@gmail.com','be70992f04a63bc7d731a0ba36b94c5e',435,true);

select * from user;

SELECT * from user;

create table store ( id bigint(8) NOT NULL AUTO_INCREMENT,store_name varchar(30) NOT NULL,description text,category_name varchar(25),store_url text, store_img text,max_cashback float,PRIMARY KEY (id));

insert into store(store_name,description,category_name,store_url) values
  ('hi','You can add store description goes here.','free','https://dl.flipkart.com/dl/?affid=affname&affExtParam1=userreferencecode');


-- drop table user_orders_history;

create table user_report_details (id bigint not null auto_increment,order_date TIMESTAMP,store_name varchar(20),cashback float,status varchar(20),user_reference_code long,affiliate_order_id varchar(20) unique ,user_id bigint,store_id bigint,primary key (id),foreign key (user_id) references user(id),foreign key (store_id) references store(id));
select * from user_report_details;
-- Insert into user_report_details (order_date,store_name,cashback,status,user_reference_code,affiliate_order_id,user_id,store_id) values ('2026-10-23 00:36:03','Hi',32,'pending',32342,39152393,1,1);

create table user_store_order_details(id bigint NOT NULL AUTO_INCREMENT,category varchar(50),title varchar(100),productId varchar(20),quantity int,price int,sales_amount int,status_type varchar(20),affiliate_order_id varchar(20) UNIQUE,order_date TIMESTAMP,commission_rate float,tentative_commission_amount float,aff_ext_param1 int,aff_ext_param2 int,sales_channel varchar(20),customer_type varchar(20),created_date TIMESTAMP,primary key(id),store_id bigint,foreign key (store_id) references store(id));
select * from user_store_order_details;

create table user_transaction_details (id bigint not null auto_increment,payment_requested_amount float,available_amount float,pending_amount float,redemption_amount float,payment_request_status varchar(20),payment_requested_date TIMESTAMP,payment_approved_date TIMESTAMP,user_id bigint,primary key(id),foreign key (user_id) references user(id));
-- drop table user_store_feedback;
create table user_store_feedback ( id bigint(8) NOT NULL AUTO_INCREMENT, feedback text,email varchar(30),PRIMARY KEY (id),user_id BIGINT, store_id bigint,foreign key (store_id) references store(id),foreign key (user_id) references user(id));


create table user_store_visits (id bigint not null auto_increment,visited_time TIMESTAMP,redirect_store_url text,user_id bigint,store_id bigint,primary key (id),foreign key (user_id) references user(id),foreign key (store_id) references store(id));

create table category ( id bigint(8) NOT NULL AUTO_INCREMENT,category_name text NOT NULL,category_type varchar(60) NOT NULL,store_id bigint not null,cashback_percent float,start_day TIMESTAMP,end_day timestamp,updated_date timestamp,foreign key (store_id) references store(id), PRIMARY KEY (id));

insert into category (category_name, category_type, store_id, cashback_percent) VALUES ('hi','ecommerce',1,9.5);
insert into category (category_name, category_type, store_id, cashback_percent) VALUES ('flipkart','ecommerc3',1,8.5);

select * from store s, category c where s.id=1 and c.store_id =1;
select * from user;
select * from store;
select * from user_transaction_details;
select * from user_report_details;
select * from user_store_order_details;
select * from user_store_feedback;
select * from user_store_visits;

select * from user where email ='hemanthroshini@gmail.com';

update user_store_order_details set aff_ext_param1 = 577 where id > 2;
update user set password = 'be70992f04a63bc7d731a0ba36b94c5e' where email = 'adasddd@a.com';
select * from user_report_details as urd where urd.user_id =4;

show tables;