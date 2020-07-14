DROP database IF EXISTS app_blog; CREATE database app_blog;

CREATE user if NOT EXISTS 'fvegau'@'localhost' IDENTIFIED BY 'Serenid4d$34'; GRANT ALL PRIVILEGES ON app_blog.* TO 'fvegau'@'localhost'; FLUSH PRIVILEGES;
-- Create the tables USE app_blog;

USE app_blog;

CREATE TABLE users (  
	id INT NOT NULL AUTO_INCREMENT,  
	fullname VARCHAR(100) NULL, 
	username VARCHAR(50) NULL,  
	email VARCHAR(50) NOT NULL,  
	password VARCHAR(100) NOT NULL,  
	role ENUM('R', 'S', 'O') NOT NULL DEFAULT 'S',  
	blocked ENUM('Y','N') NOT NULL DEFAULT 'N',
	token VARCHAR(200) NULL,
PRIMARY KEY (id),  UNIQUE KEY username_ukey (username));

CREATE TABLE visit_counter ( 
	id INT NOT NULL AUTO_INCREMENT,  
	cont INT NOT NULL DEFAULT 0,   
	PRIMARY KEY(id) );

CREATE TABLE category(
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(150) NOT NULL,
	PRIMARY KEY(id)
);
CREATE TABLE post (
	id INT NOT NULL AUTO_INCREMENT,
	user_id INT NOT NULL,
	category_id INT NULL,
	date_post DATE NOT NULL,
	date_modified DATE NULL,
	tittle VARCHAR(150) NOT NULL,
	long_description VARCHAR(5000) NOT NULL,
	short_description VARCHAR(1000) NOT NULL,
	link VARCHAR(250) NULL,
	img VARCHAR(255) NULL,
	counter_likes INT NOT NULL DEFAULT 0,
	PRIMARY KEY(id),
	CONSTRAINT user_id_post FOREIGN KEY(user_id) REFERENCES users(id) ON UPDATE NO ACTION ON DELETE NO ACTION,
	CONSTRAINT category_id_post FOREIGN KEY(category_id) REFERENCES category(id) ON UPDATE NO ACTION ON DELETE NO ACTION
);
CREATE TABLE visit(
	id INT NOT NULL AUTO_INCREMENT,
	ip VARCHAR(30) NOT NULL,
	post_id INT NOT NULL,
	PRIMARY KEY(id),
	CONSTRAINT post_id_visit FOREIGN KEY(post_id) REFERENCES post(id) ON UPDATE NO ACTION ON DELETE NO ACTION
);
CREATE TABLE applications(
	id INT NOT NULL AUTO_INCREMENT,
	name VARCHAR(150) NOT NULL,
	link VARCHAR(150) NULL,
	img VARCHAR(255) NULL,
	PRIMARY KEY(id)
);
CREATE TABLE messages(
	id INT NOT NULL AUTO_INCREMENT,
	email VARCHAR(255) NOT NULL,
	user_message VARCHAR(2500) NOT NULL,
	date_message date NOT NULL,
	PRIMARY KEY(id)
);
INSERT INTO users (fullname, username, email, password, role, blocked) VALUES(
	"Fabricio Vega Ugalde",
	"fvegau",
	"fabriciovu@gmail.com",
	"5b40b515783990e181c87abf9088eeaf",
	"S",
	"N");