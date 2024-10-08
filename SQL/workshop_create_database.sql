CREATE TABLE Products (
    ProductID INT PRIMARY KEY IDENTITY(1,1),
    ProductName NVARCHAR(100) NOT NULL,
    ProductDescription NVARCHAR(255),
    UnitPrice DECIMAL(10, 2) NOT NULL,
    CreatedDate DATETIME DEFAULT GETDATE()
);
CREATE TABLE Inventory (
    InventoryID INT PRIMARY KEY IDENTITY(1,1),
    ProductID INT FOREIGN KEY REFERENCES Products(ProductID),
    QuantityInStock INT NOT NULL CHECK (QuantityInStock >= 0),
    LastUpdated DATETIME DEFAULT GETDATE()
);
CREATE TABLE Orders (
    OrderID INT PRIMARY KEY IDENTITY(1,1),
    OrderDate DATETIME DEFAULT GETDATE(),
    OrderStatus NVARCHAR(50) DEFAULT 'Pending'
);
CREATE TABLE OrderDetails (
    OrderDetailID INT PRIMARY KEY IDENTITY(1,1),
    OrderID INT FOREIGN KEY REFERENCES Orders(OrderID),
    ProductID INT FOREIGN KEY REFERENCES Products(ProductID),
    Quantity INT NOT NULL CHECK (Quantity > 0),
    Price DECIMAL(10, 2) NOT NULL,
    CONSTRAINT FK_OrderProduct FOREIGN KEY (ProductID) REFERENCES Products(ProductID)
);
CREATE TABLE Users (
    UserID INT PRIMARY KEY IDENTITY(1,1),
    UserName NVARCHAR(100) NOT NULL,
    UserRole NVARCHAR(50) NOT NULL CHECK (UserRole IN ('Warehouse Staff', 'Business Analyst')),
    Email NVARCHAR(255) NOT NULL UNIQUE,
    PasswordHash NVARCHAR(255) NOT NULL,
    CreatedDate DATETIME DEFAULT GETDATE()
);
