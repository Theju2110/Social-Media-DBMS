create database social_network;
USE social_network;

CREATE TABLE users (
  user_id INT NOT NULL AUTO_INCREMENT,
  f_name VARCHAR(20) NOT NULL,
  l_name VARCHAR(20),
  user_name CHAR(25),
  describe_user VARCHAR(255),
  user_pass VARCHAR(255),
  user_email VARCHAR(25) NOT NULL,
  user_country CHAR(100),
  Address VARCHAR(20),
  user_birthday DATE NOT NULL,
  user_cover VARCHAR(255),
  user_image VARCHAR(255),
  user_reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  status CHAR(100) DEFAULT 'verified',
  posts CHAR(100) DEFAULT 'No',
  recovery_account VARCHAR(255),
  user_gender CHAR(10),
  PRIMARY KEY (user_id)
);
ALTER TABLE users
ADD COLUMN Relationship TEXT;

CREATE TABLE posts (
    post_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    post_content TEXT,
    post_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

ALTER TABLE posts
ADD COLUMN upload_image VARCHAR(255);
CREATE TABLE comments(
    com_id INT AUTO_INCREMENT PRIMARY KEY,
    post_id INT,
    user_id INT,
    comment TEXT,
    comment_author VARCHAR(255),
    date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (post_id) REFERENCES posts(post_id),
    FOREIGN KEY (user_id) REFERENCES users(user_id)
);

use social_network;
select *  from users;
select * from posts;
drop database social_network;
