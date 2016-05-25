CREATE DATABASE information;
USE information;
DROP TABLE IF EXISTS USERSDATA ;
CREATE TABLE USERSDATA
( id integer, username varchar(30), password varchar(30), status varchar(30)
);
INSERT INTO USERSDATA VALUES("1","Friend1","password1","offline");
INSERT INTO USERSDATA VALUES("2","Friend2","password2","offline");
INSERT INTO USERSDATA VALUES("3","Friend3","password3","offline");
INSERT INTO USERSDATA VALUES("4","Friend4","password4","offline");
INSERT INTO USERSDATA VALUES("5","Friend5","password5","offline");