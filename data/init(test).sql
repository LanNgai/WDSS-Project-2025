DROP DATABASE IF EXISTS catsdelight;
CREATE DATABASE catsdelight;


use catsdelight;
    CREATE TABLE login (
        LoginID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        Username VARCHAR(45) NOT NULL,
        Email VARCHAR(45) NOT NULL,
        Password VARCHAR(300) NOT NULL
    );

    CREATE TABLE administrator (
        AdminLoginID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        FOREIGN KEY (AdminLoginID) REFERENCES login(LoginID)
    );

    CREATE TABLE user (
        UserLoginID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        FOREIGN KEY (UserLoginID) REFERENCES login(LoginID)
    );
    
    CREATE TABLE profile (
		ProfileID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        UserLoginID INT UNSIGNED,
        FOREIGN KEY (UserLoginID) REFERENCES user(UserLoginID),
        Bio VARCHAR(300) DEFAULT 'Hello! I am a cat owner, I hope to find the best products for my kitties!',
        ProfileImage VARCHAR(45),
        TotalLikes INT DEFAULT 0
    );

    CREATE TABLE products(
        ProductID INT PRIMARY KEY AUTO_INCREMENT,
        AdminLoginID INT UNSIGNED,
        FOREIGN KEY (AdminLoginID) REFERENCES administrator(AdminLoginID),
        ProductName VARCHAR(45) NOT NULL,
        ProductType VARCHAR(45),
        ProductDescription TEXT NOT NULL,
        ProductManufacturer VARCHAR(45) NOT NULL,
        ProductImage VARCHAR(45) DEFAULT NULL,
        ProductLink VARCHAR(300) NOT NULL
    );

    CREATE TABLE reviews(
        ReviewID INT AUTO_INCREMENT PRIMARY KEY,
        ProductID INT,
        FOREIGN KEY (ProductID) REFERENCES products(ProductID),
        AdminLoginID INT UNSIGNED,
        FOREIGN KEY (AdminLoginID) REFERENCES administrator(AdminLoginID),
        QualityRating INT,
        PriceRating INT,
        ReviewText TEXT,
        DateAndTime DATETIME
    );

    CREATE TABLE comments(
        CommentID INT AUTO_INCREMENT PRIMARY KEY,
        ReviewID INT,
        FOREIGN KEY (ReviewID) REFERENCES reviews(ReviewID),
        UserLoginID INT UNSIGNED,
        FOREIGN KEY (UserLoginID) references user(UserLoginID),
        CommentText TEXT NOT NULL,
        Likes INT DEFAULT 0,
        DateAndTime DATETIME
    );

/*-----------------------------Next user------------------------------*/

-- Insert into login
INSERT INTO login (Username, Email, Password)
VALUES ('Lan', 'lanngai79@gmail.com', '123');

-- Link to user
INSERT INTO administrator (AdminLoginID)
VALUES (LAST_INSERT_ID());

/*-----------------------------Next user------------------------------*/
-- Insert into login
INSERT INTO login (Username, Email, Password)
VALUES ('Fausta', 'f@gmail.com', '456');

-- Link to user
INSERT INTO administrator (AdminLoginID)
VALUES (LAST_INSERT_ID());

/*-----------------------------Next user------------------------------*/
-- Insert into login
INSERT INTO login (Username, Email, Password)
VALUES ('Kevin', 'k@gmail.com', '789');

-- Link to user
INSERT INTO user (UserLoginID)
VALUES (LAST_INSERT_ID());

-- Create profile for the user
INSERT INTO profile (UserLoginID)
VALUES (LAST_INSERT_ID());

/*-----------------------------Next user------------------------------*/
-- Insert into login
INSERT INTO login (Username, Email, Password)
VALUES ('RobertS', 'rsmith@hotmail.com', 'qwe');

-- Link to user
INSERT INTO user (UserLoginID)
VALUES (LAST_INSERT_ID());

-- Create profile for the user
INSERT INTO profile (UserLoginID)
VALUES (LAST_INSERT_ID());

/*-----------------------------Next user------------------------------*/
-- Insert into login
INSERT INTO login (Username, Email, Password)
VALUES ('Nathan', 'johnbarry21@hotmail.com', 'applejohn52');

-- Link to user
INSERT INTO user (UserLoginID)
VALUES (LAST_INSERT_ID());

-- Create profile for the user
INSERT INTO profile (UserLoginID)
VALUES (LAST_INSERT_ID());

/*-----------------------------Products------------------------------*/

INSERT INTO catsdelight.products (ProductID, AdminLoginID, ProductName, ProductType, ProductDescription, ProductManufacturer, ProductImage, ProductLink)
VALUES (1, 1, 'Automatic Cat Feeder with Timer for 2 Cats', 'Misc', '𝐍𝐨 𝐖𝐚𝐢𝐭𝐢𝐧𝐠, 𝐒𝐚𝐭𝐢𝐬𝐟𝐲 𝐓𝐡𝐞𝐢𝐫 𝐏𝐨𝐬𝐬𝐞𝐬𝐬𝐢𝐯𝐞𝐧𝐞𝐬𝐬: Cats are often possessive about their food and we hope to satisfy this adorable desire. oneisall PFD002 automatic cat feeder for 2 cats, no sharing, no waiting, symmetrical design, safeguarding their sense of security when eating', 'oneisall', 'feeder.jpg', 'link');

/*-----------------------------Reviews------------------------------*/

INSERT INTO catsdelight.reviews (ReviewID, ProductID, AdminLoginID, QualityRating, PriceRating, ReviewText, DateAndTime)
VALUES (2, 1, 1, 4, 4, 'I’m super impressed with this automatic cat feeder! One of my top priorities was ensuring each of my cats had their own bowl, and this design works perfectly for that. The setup process was straightforward, and I had it up and running in no time. The food storage compartment is secure, giving me peace of mind that the food stays fresh and safe.', '2025-03-22 16:00:00');

