-- Drop the existing Bookstore database if it exists and create a new one
DROP DATABASE IF EXISTS `Bookstore`;
CREATE DATABASE `Bookstore`;
USE `Bookstore`;

-- 1. Creating the Category Table
CREATE TABLE Category (
    category_id INT AUTO_INCREMENT PRIMARY KEY,  -- Unique ID for each category
    category_name VARCHAR(50) NOT NULL,          -- Name of the category (e.g., Electronics)
    category_description TEXT                    -- Description of the category
);

-- 2. Creating the Role Table
CREATE TABLE Role (
    role_id INT AUTO_INCREMENT PRIMARY KEY,     -- Unique ID for each role
    role_name VARCHAR(50) NOT NULL              -- Name of the role (e.g., Admin, Regular User)
);

-- 3. Creating the User Table
CREATE TABLE User (
    user_id INT AUTO_INCREMENT PRIMARY KEY,     -- Unique ID for each user
    first_name VARCHAR(50) NOT NULL,            -- User's first name
    last_name VARCHAR(50) NOT NULL,             -- User's last name
    address VARCHAR(255) NOT NULL               -- User's address
);

-- 4. Creating the Item Table
CREATE TABLE Item (
    item_id INT AUTO_INCREMENT PRIMARY KEY,     -- Unique ID for each item
    item_name VARCHAR(100) NOT NULL,            -- Name of the item
    price DECIMAL(10, 2) NOT NULL,              -- Price of the item
    quantity INT NOT NULL,                      -- Quantity in stock
    description TEXT,                           -- Description of the item
    category_id INT,                            -- Foreign key to the Category table
    FOREIGN KEY (category_id) REFERENCES Category(category_id)  -- Linking to Category table
);

-- 5. Inserting Sample Data into the Category Table
INSERT INTO Category (category_name, category_description) 
VALUES 
    ('Electronics', 'Devices and gadgets like phones, computers, and cameras'),
    ('Furniture', 'Tables, chairs, and other home furniture'),
    ('Clothing', 'Men\'s and Women\'s apparel, shoes, and accessories');

-- 6. Inserting Sample Data into the Role Table
INSERT INTO Role (role_name) 
VALUES 
    ('Admin'),
    ('Regular User');

-- 7. Inserting Sample Data into the User Table
INSERT INTO User (first_name, last_name, address) 
VALUES 
    ('John', 'Doe', '123 Main St, Springfield'),
    ('Jane', 'Smith', '456 Elm St, Oakville'),
    ('Alice', 'Johnson', '789 Pine St, Rivertown');

-- 8. Inserting Sample Data into the Item Table
INSERT INTO Item (item_name, price, quantity, description, category_id) 
VALUES 
    ('Laptop', 899.99, 10, '15-inch laptop with Intel i7 processor', 1),
    ('Smartphone', 599.99, 5, 'Android smartphone with 128GB storage', 1),
    ('Dining Table', 299.99, 2, 'Wooden dining table for 6 people', 2),
    ('T-shirt', 19.99, 50, 'Cotton T-shirt, various colors', 3);

-- 9. Query to List Products Under a Specific Category
SELECT 
    Item.item_name,                            -- Product name
    Item.price,                                -- Product price
    Item.quantity,                             -- Quantity in stock
    CASE 
        WHEN Item.quantity > 0 THEN 'In Stock' 
        ELSE 'Out of Stock' 
    END AS stock_status,                       -- Display stock status based on quantity
    Category.category_name                     -- Category name
FROM 
    Item
JOIN 
    Category ON Item.category_id = Category.category_id  -- Join Item and Category tables on category_id
WHERE 
    Category.category_name = 'Electronics';   -- Filter by category name, which can be customized

-- 10. Query to List Users and Their Roles
SELECT 
    User.first_name,                          -- User's first name
    User.last_name,                           -- User's last name
    Role.role_name                            -- Role assigned to the user
FROM 
    User
JOIN 
    Role ON User.user_id = Role.role_id;      -- Join User and Role tables on user_id and role_id
