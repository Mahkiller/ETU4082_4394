CREATE DATABASE ETU4082;
USE ETU4082;

CREATE TABLE Category_karma(
    Category_ID INT PRIMARY KEY AUTO_INCREMENT,
    Category_Name VARCHAR(100) NOT NULL
);

CREATE  TABLE Produit_karma(
    id_product INT PRIMARY KEY AUTO_INCREMENT,
    id_category INT NOT NULL,
    Product_name VARCHAR(100) NOT NULL,
    prix_product FLOAT,
    Image_name VARCHAR(100),
    FOREIGN KEY (id_category) REFERENCES Category_karma(Category_ID)
);

INSERT INTO Category_karma (Category_Name) VALUES
('Tennis(53)'),
('Meat and Fish (53)'),
('Fruits and Vegetables (53)'),
('Dairy Products (53)'),
('Cooking (53)'),
('Beverages (24)');

INSERT INTO Products_karma (id_category, Product_name, prix_product, Image_name) VALUES
(1, 'Sunstar Fresh Melon Juice', 4.5, 20, 18.00, "thumb-orange-juice.png"),
(6, 'Crunchy Cookie', 5, 15, 25.00, "thumb-biscuits.png"),
(1, 'Cumcumber', 3, 30, 10.00, "thumb-cucumber.png"),
(3, 'Milk', 4.5, 50, 30.00, "thumb-milk.png");