-- Sweet Delights Bakery — DB migration (MySQL)
-- Run this in phpMyAdmin or mysql CLI to create schema and seed demo data

CREATE DATABASE IF NOT EXISTS `bakery_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `bakery_db`;

CREATE TABLE IF NOT EXISTS `categories` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS `products` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `price` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `description` TEXT,
  `image_url` VARCHAR(1000),
  `category_id` INT,
  FOREIGN KEY (category_id) REFERENCES categories(id) ON DELETE SET NULL
);

CREATE TABLE IF NOT EXISTS `contact_messages` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `subject` VARCHAR(255),
  `message` TEXT NOT NULL,
  `submitted_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `orders` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `customer_name` VARCHAR(255) NOT NULL,
  `customer_email` VARCHAR(255) NOT NULL,
  `address` TEXT NOT NULL,
  `total` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `created_at` DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS `order_items` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `order_id` INT NOT NULL,
  `product_id` INT NOT NULL,
  `quantity` INT NOT NULL DEFAULT 1,
  `unit_price` DECIMAL(10,2) NOT NULL DEFAULT 0,
  FOREIGN KEY (order_id) REFERENCES orders(id) ON DELETE CASCADE,
  FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE
);

-- Seed categories
INSERT INTO categories (name) VALUES ('Birthday Cakes'),('Wedding Cakes'),('Anniversary Cakes'),('Custom Cakes');

-- Seed some sample products
INSERT INTO products (name,price,description,image_url,category_id) VALUES
('Chocolate Cake',2200,'Rich dark chocolate sponge layered with ganache.','https://images.unsplash.com/photo-1578985545062-69928b1d9587?w=500&auto=format&fit=crop',1),
('Lotus Three Milk Cake',4000,'Soaked in three milks with Lotus Biscoff cream.','https://images.unsplash.com/photo-1563729784474-d77dbb933a9e?w=500&auto=format&fit=crop',1),
('German Fudge Cake',4500,'Traditional German-style chocolate fudge.','https://images.unsplash.com/photo-1571877227200-a0d98ea607e9?w=500&auto=format&fit=crop',2);
