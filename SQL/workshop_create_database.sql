CREATE SCHEMA jyoung1201_lol;




CREATE TABLE Products (
    ProductID INT PRIMARY KEY AUTO_INCREMENT,
    ProductName VARCHAR(100) NOT NULL,
    ProductDescription VARCHAR(255),
    UnitPrice DECIMAL(10, 2) NOT NULL,
    CreatedDate DATETIME DEFAULT CURRENT_TIMESTAMP
);

ALTER TABLE Products 
ADD ImageURL VARCHAR(255);


CREATE TABLE Inventory (
    InventoryID INT PRIMARY KEY AUTO_INCREMENT,
    ProductID INT,
    QuantityInStock INT NOT NULL CHECK (QuantityInStock >= 0),
    LastUpdated DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);




CREATE TABLE Orders (
    OrderID INT PRIMARY KEY AUTO_INCREMENT,
    OrderDate DATETIME DEFAULT CURRENT_TIMESTAMP,
    OrderStatus VARCHAR(50) DEFAULT 'Pending'
);

CREATE TABLE OrderDetails (
    OrderDetailID INT PRIMARY KEY AUTO_INCREMENT,
    OrderID INT,
    ProductID INT,
    Quantity INT NOT NULL CHECK (Quantity > 0),
    Price DECIMAL(10, 2) NOT NULL,
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
    FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);

CREATE TABLE Users (
    UserID INT PRIMARY KEY AUTO_INCREMENT,
    UserName VARCHAR(100) NOT NULL,
    UserRole VARCHAR(50) NOT NULL CHECK (UserRole IN ('Warehouse Staff', 'Business Analyst')),
    Email VARCHAR(255) NOT NULL UNIQUE,
    PasswordHash VARCHAR(255) NOT NULL,
    CreatedDate DATETIME DEFAULT CURRENT_TIMESTAMP
);
-- Creating the new 'login' table
CREATE TABLE login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'publisher', 'customer') NOT NULL
);

INSERT INTO login (username, password, role) VALUES
('admin', '$2y$10$NC8qwakAEP.nDKSC9ILlsOg9Uit8rc/5CJKL.weziABLFNY7.dJRK', 'admin'),
('publisher', '$2y$10$mavrb1tvbJNI2DtImZ5vpO0x1iIVtWEgq4e8Nx8bKweEzmHgCrv02', 'publisher'),
('customer', '$2y$10$H/LqI.j.R4iz/skyMsaPP.TDdNKnbqhshDzAPnoHRwIVHoOHboat6', 'customer');

CREATE TABLE comments (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    title VARCHAR(255) NOT NULL,
    comments TEXT NOT NULL,
    commentdate TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO Products (ProductName, ProductDescription, UnitPrice, ImageURL) VALUES
('Red Wine', 'A fine bottle of red wine', 19.99, 'catalog/red_wine.jpg'),
('White Wine', 'A crisp bottle of white wine', 17.50, 'catalog/white_wine.jpg'),
('Whiskey', 'Premium aged whiskey', 45.00, 'catalog/whiskey.jpg'),
('Gin', 'London dry gin', 25.00, 'catalog/gin.jpg'),
('Rum', 'Dark Caribbean rum', 30.00, 'catalog/rum.jpg'),
('Tequila', 'Gold tequila', 38.00, 'catalog/tequila.jpg'),
('Vodka', 'Distilled vodka', 20.00, 'catalog/vodka.jpg'),
('Cognac', 'Fine French cognac', 65.00, 'catalog/cognac.jpg'),
('Beer', 'Pale lager beer', 12.00, 'catalog/beer.jpg'),
('Champagne', 'Luxury champagne', 99.99, 'catalog/champagne.jpg');

-- Insert sample data into Inventory table
INSERT INTO Inventory (ProductID, QuantityInStock)
VALUES
(1, 50),
(2, 30),
(3, 25),
(4, 40),
(5, 20),
(6, 15),
(7, 60),
(8, 10),
(9, 70),
(10, 5);

-- Insert sample data into Orders table
INSERT INTO Orders (OrderDate, OrderStatus)
VALUES
(NOW(), 'Shipped'),
(NOW(), 'Pending'),
(NOW(), 'Delivered'),
(NOW(), 'Canceled'),
(NOW(), 'Processing');

-- Insert sample data into OrderDetails table
INSERT INTO OrderDetails (OrderID, ProductID, Quantity, Price)
VALUES
(1, 3, 2, 90.00),
(1, 5, 1, 30.00),
(2, 10, 1, 99.99),
(3, 7, 3, 60.00),
(3, 9, 2, 56.00), -- Changed 19 to 9 to match available products
(4, 8, 1, 75.00), -- Changed 16 to 8 to match available products
(5, 6, 2, 80.00); -- Changed 12 to 6 to match available products

-- Insert sample data into Users table
INSERT INTO Users (UserName, UserRole, Email, PasswordHash)
VALUES
('John Doe', 'Warehouse Staff', 'john.doe@example.com', 'hash1'),
('Jane Smith', 'Business Analyst', 'jane.smith@example.com', 'hash2'),
('Sam Green', 'Warehouse Staff', 'sam.green@example.com', 'hash3'),
('Alice White', 'Business Analyst', 'alice.white@example.com', 'hash4');

