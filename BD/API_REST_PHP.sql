drop database if exists API_REST_Frameworks;
create database API_REST_Frameworks;
USE API_REST_Frameworks;
CREATE TABLE frameworks (
  id int  NOT NULL PRIMARY KEY AUTO_INCREMENT,
  nombre varchar(50)  NOT NULL,
  lanzamiento int  NOT NULL,
  desarrollador varchar(50)  NOT NULL
) ENGINE=InnoDB  CHARACTER SET utf8MB4   AUTO_INCREMENT=1;
INSERT INTO frameworks VALUES
(1,"Laravel",2011,"Taylor Otwell"),
(2,"Symfony",2005,"Symfony community"),
(3,"CodeIgniter",2007,"British Columbia Institute of Technology"),
(4,"Yii",2008,"Yii Software LLC"),
(5,"Cake PHP",2005,"Cake Software Foundation"),
(6,"Zend",2005,"Zend Technologies"),
(7,"Fuel PHP",2019,"FuelPHP developer team");
