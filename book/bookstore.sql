
create database if not exists bookstore;
use bookstore;
drop table if exists books;
create table books(
	id int not null auto_increment,
	bookname char(50) not null default '',
	publisher char(80) not null default '',
	author char(30) not null default '',
	price double not null default 0.00,
	ptime int not null default 0,
	pic char(40) not null default '',
	detail text,
	primary key(id)
);