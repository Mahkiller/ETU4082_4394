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

INSERT INTO Produit_Details_karma (id_product, description, stock, brand, weight) VALUES
(1, 'Chaussures de tennis Adidas New Hammer avec technologie Boost pour un amorti optimal. Semelle en caoutchouc durable pour une excellente adhérence sur tous les terrains.', 25, 'Adidas', '400g'),
(2, 'Chaussures de basketball Adidas Curry conçues pour Stephen Curry. Semelle souple et tige en mesh respirant pour un maximum de confort pendant le jeu.', 18, 'Adidas', '420g'),
(3, 'Chaussures de football Adidas New Messi avec design aerodynamique. Crampons moulés pour une traction exceptionnelle sur terrain naturel et synthétique.', 30, 'Adidas', '380g'),

(4, 'Filet de poisson frais pêché localement. Riche en oméga-3 et protéines. Idéal pour grillade ou cuisson au four.', 15, 'Ocean Fresh', '500g'),
(5, 'Viande de bœuf premium, marbrée parfaite pour steak. Provenant d''élevages locaux respectueux de l''environnement.', 12, 'Farm Prime', '1kg'),
(6, 'Poisson-chat frais, excellent pour les soupes et plats en sauce. Saveur douce et texture ferme.', 20, 'River Catch', '300g'),

(7, 'Pommes rouges croquantes, riches en fibres et vitamine C. Provenant de nos vergers biologiques locaux.', 50, 'Bio Garden', '1kg'),
(8, 'Oranges juteuses et sucrées, pleines de vitamine C. Parfaites pour les jus ou à consommer nature.', 45, 'Sunshine Fruits', '1kg'),
(9, 'Ananas frais importés, sucrés et juteux. Idéal pour les desserts, salades de fruits ou smoothies.', 22, 'Tropical Gold', '1.2kg'),

(10, 'Lait entier frais pasteurisé. Riche en calcium et protéines. Emballage écologique.', 35, 'Dairy Pure', '1L'),
(11, 'Fromage cheddar affiné 6 mois. Texture ferme et saveur riche. Parfait pour sandwiches et plats cuisinés.', 28, 'Cheese Masters', '250g'),
(12, 'Pain frais cuit quotidiennement. Croûte croustillante et mie moelleuse. Sans conservateurs.', 40, 'Bakery Fresh', '500g'),

(13, 'Huile d''olive extra vierge pressée à froid. Idéale pour les salades et la cuisson à basse température.', 20, 'Olive Grove', '750ml'),
(14, 'Sel de mer naturel non raffiné. Riche en minéraux essentiels. Parfait pour assaisonnement.', 60, 'Sea Pure', '200g'),
(15, 'Sucre de canne non raffiné. Conserve ses mélasse naturelles pour une saveur riche et complexe.', 55, 'Cane Sweet', '1kg'),

(16, 'Boisson gazeuse classique au cola. Format économique familial. Rafraîchissante et énergisante.', 75, 'Coca-Cola', '2L'),
(17, 'Jus d''orange 100% pur sans sucre ajouté. Pressé à froid pour préserver les vitamines.', 42, 'Juice Fresh', '1L'),
(18, 'Boisson gazeuse au citron rafraîchissante. Sans caféine, parfaite pour toute la famille.', 65, 'Sprite', '2L');