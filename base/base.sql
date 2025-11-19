CREATE DATABASE ETU4082_4394;
USE ETU4082_4394;

CREATE TABLE Category_karma(
    Category_ID INT PRIMARY KEY AUTO_INCREMENT,
    Category_Name VARCHAR(100) NOT NULL
);

CREATE TABLE Produit_karma (
    id_product INT PRIMARY KEY AUTO_INCREMENT,
    id_category INT,
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

INSERT INTO Produit_karma (id_category, Product_name, prix_product, Image_name) VALUES
(1, 'addidas New Hammer', 150.00, 'p1.jpg'),
(1, 'addidas Curry', 150.00, 'p2.jpg'),
(1, 'addidas New Messi', 150.00, 'p3.jpg'),
(2, 'Poisson', 50, 'Fish1.jpeg'),
(2, 'Viande', 70, 'Meat.jpeg'),
(2, 'Poisson chat', 2, 'Fish2.jpeg'),
(3, 'Apple', 10, 'fruit2.jpeg'),
(3, 'Orange', 12, 'fruit1.jpeg'),
(3, 'Pineapple', 12, 'fruit3.jpeg'),
(4, 'Milk', 4.5, 'milk1.jpeg'),
(4, 'Cheese', 15, 'cheese.jpeg'),
(4, 'Bread', 5, 'mofo.jpeg'),
(5, 'Olive Oil', 20, 'oil.jpeg'),
(5, 'Salt', 3, 'salt.jpeg'),
(5, 'Sugar', 3, 'sugar.jpeg'),
(6, 'Coca Cola', 2, 'coca.jpeg'),
(6, 'Orange Juice', 3, 'orange.jpeg'),
(6, 'Sprite', 3, 'sprite.jpeg');

CREATE TABLE Produit_Details_karma (
    id_details INT PRIMARY KEY AUTO_INCREMENT,
    id_product INT NOT NULL,
    description TEXT,
    stock INT DEFAULT 0,
    brand VARCHAR(100),
    weight VARCHAR(50),
    FOREIGN KEY (id_product) REFERENCES Produit_karma(id_product)
);
