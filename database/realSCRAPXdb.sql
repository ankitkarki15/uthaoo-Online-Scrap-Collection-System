use scrapx;
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
use scrapx;

-- Step 1: Addinmg the user_id column to the feedback table
ALTER TABLE feedback
ADD COLUMN user_id INT;

-- Step 2: Adding the foreign key
ALTER TABLE feedback
ADD CONSTRAINT fk_feedback_user_id
FOREIGN KEY (user_id)
REFERENCES user_tbl(id);

ALTER TABLE scrap
ADD COLUMN user_id INT;

-- Step 2: Add the foreign key constraint
ALTER TABLE scrap
ADD CONSTRAINT fk_scrap_user_id
FOREIGN KEY (user_id)
REFERENCES user_tbl(id);

-- Step 1: Add the scrap_id column to the pricing table
ALTER TABLE pricing
ADD COLUMN scrap_id INT;

-- Step 2: Add the foreign key constraint
ALTER TABLE pricing
ADD CONSTRAINT fk_pricing_scrap_id
FOREIGN KEY (scrap_id)
REFERENCES scrap(id);

-- delete all feedbacks-- 
DELETE FROM feedback WHERE id > 0;
-- ser_tbl-- 

ALTER TABLE scrap ADD COLUMN messages TEXT;

