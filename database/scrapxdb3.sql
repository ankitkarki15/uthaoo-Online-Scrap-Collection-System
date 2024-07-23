SELECT * FROM scrapx.hero;
ALTER TABLE hero ADD COLUMN password VARCHAR(255) NOT NULL;
ALTER TABLE hero ADD generated_email VARCHAR(255);

use scrapx;
show tables;
SELECT * FROM scrapx.scrap;

 -- add request_type as sell or donate or sale and donate--   
 alter table scrap add request_type VARCHAR(255) NOT NULL;
SELECT * FROM scrapx.user_tbl;

ALTER TABLE scrap
ADD COLUMN scheduled_date DATE AFTER request_type,
ADD COLUMN district VARCHAR(255) AFTER scheduled_date
-- DROP COLUMN address;

DELETE FROM scrap
WHERE id BETWEEN 138 AND 150;

SELECT * FROM scrapx.user;
show tables;

INSERT INTO user (user_id, password, email, phone, name, dob, address, role, created_at)
VALUES (3, 'K@thm@ndu', 'admin@gmail.com', '1234567890', 'Admin', '1980-01-01', '123 Admin St', 'admin', CURRENT_TIMESTAMP);

DROP TABLE scrapx.user;
