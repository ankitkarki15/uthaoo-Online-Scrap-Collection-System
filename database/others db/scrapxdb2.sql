use scrapx;
SHOW TABLES;
CREATE TABLE hero (
    hero_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    phone_number VARCHAR(20) NOT NULL UNIQUE,
    nationality VARCHAR(100), 
    vehicle_type VARCHAR(50),
    license_number VARCHAR(50),
    hero_photo BLOB,
    license_photo BLOB,
    available BOOLEAN DEFAULT TRUE
);
ALTER TABLE hero
DROP COLUMN license_photo;
SHOW COLUMNS FROM hero;

USE scrapx;

ALTER TABLE hero
CHANGE COLUMN nationality location VARCHAR(100);


INSERT INTO hero (name, email, phone_number, location, vehicle_type, license_number, hero_photo, available) 
VALUES ('John Doe', 'johndoe@example.com', '+1234567890', 'Thamel', 'Car', 'ABC123',  NULL, TRUE);

