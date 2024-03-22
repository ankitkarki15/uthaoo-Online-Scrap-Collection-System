-- create database scrapx;
-- use scrapx;
-- show tables

-- user table-- 
CREATE TABLE user_tbl (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255),
  email VARCHAR(255),
  password VARCHAR(255),
  phone_no VARCHAR(20),
  role ENUM('user', 'admin') DEFAULT 'user'
);

  INSERT INTO user_tbl (name, email, password, phone_no, role) 
  VALUES ('Admin', 'adminhere@gmail.com', '12345', '9812345679', 'admin');

-- feedback table-- 
CREATE TABLE feedback (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50),
  email VARCHAR(50),
  phone_no VARCHAR(20),
  message TEXT,
  created_at TIMESTAMP
);

use scrapx;


ALTER TABLE scrap ADD COLUMN status VARCHAR(50) DEFAULT 'Pending';

CREATE TABLE pricing (
    id INT AUTO_INCREMENT PRIMARY KEY,
    scrapname VARCHAR(255) NOT NULL,
	rate DECIMAL(10, 2) NOT NULL
);
INSERT INTO `pricing` (`id`, `scrapname`, `rate`) VALUES
-- --(1, 'Paper', '15');--
-- (2, 'Plastic', '17');
-- (3, 'Cartoon', '15');
(4, 'bottle', '16');

CREATE TABLE scrap (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(50),
  email VARCHAR(100),
  phone_no VARCHAR(20),
  address VARCHAR(200),
  scrap_items VARCHAR(100),
  des TEXT,
  rate DECIMAL(10,2),
  quantity DECIMAL(10,2),
  image VARCHAR(200),
  created_at TIMESTAMP
);
	
-- altering some table -- 
-- ALTER TABLE pricing ADD COLUMN scrapcategory VARCHAR(255) NOT NULL;
-- ALTER TABLE pricing CHANGE rate scraprate VARCHAR(255) NOT NULL;
-- ALTER TABLE scrap CHANGE scrap_items scrapname VARCHAR(255) NOT NULL;
-- ALTER TABLE scrap CHANGE rate scraprate VARCHAR(255) NOT NULL;
ALTER TABLE scrap CHANGE quantity scrapquantity VARCHAR(255) NOT NULL;
 


