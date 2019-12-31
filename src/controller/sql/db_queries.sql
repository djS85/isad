-- noinspection SqlNoDataSourceInspectionForFile

-- noinspection SqlDialectInspectionForFile

-- CREATE TABLE STATEMENTS

-- tables :
-- customers, orders, orderItems, products.

-- customers needs a constraint on table number.

-- create myself as user in phpmyadmin console, then make database
-- and give myself all privileges.
CREATE USER 'djs'@'localhost' IDENTIFIED BY 'pwd';
CREATE DATABASE db_CoffeeShop;
GRANT ALL PRIVILEGES ON db_CoffeeShop.* TO 'djs'@'localhost';


CREATE TABLE customers (

	customer_id VARCHAR(20) NOT NULL PRIMARY KEY,
	customer_name VARCHAR(255) NOT NULL,
	customer_table INT(10) NOT NULL

);

CREATE TABLE orders (

    order_id VARCHAR(20) NOT NULL PRIMARY KEY,
    customer_id VARCHAR(20) NOT NULL,
    order_total FLOAT(10) NOT NULL,
    order_date DATETIME NULL,
    FOREIGN KEY (customer_id) REFERENCES customers(customer_id)

);

CREATE TABLE products (

    product_id INT(10) AUTO_INCREMENT NOT NULL PRIMARY KEY,
    product_name VARCHAR(255) NOT NULL,
    product_price FLOAT(10) NOT NULL,
    stock_qty INT(10) NOT NULL,
    restock_qty INT(10) NOT NULL,
    isDrink BOOL NOT NULL

);

CREATE TABLE orderItems (

    item_id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    order_id VARCHAR(20) NOT NULL,
    product_id INT(10) NOT NULL,
    product_qty INT(10) NOT NULL,
    FOREIGN KEY (order_id) REFERENCES orders(order_id),
    FOREIGN KEY (product_id) REFERENCES products(product_id)

);

CREATE TABLE admin (

    user_id INT(10) AUTO_INCREMENT PRIMARY KEY NOT NULL,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL

);

-- insert statement for products table, just adds some test data.

INSERT INTO products (product_name, product_price, stock_qty, restock_qty, isdrink) VALUES
('Cappucino', 2.40, 50, 10, TRUE),
('Latte', 2.40, 50, 10, TRUE),
('Americano', 2.40, 50, 10, TRUE),
('Espresso', 2.00, 50, 10, TRUE),
('Breakfast Tea', 1.80, 50, 10, TRUE),
('Rooibos Tea', 2.00, 50, 10, TRUE),
('Earl Grey Tea', 2.00, 50, 10, TRUE),
('Mocha', 2.35, 50, 10, TRUE),
('Strawberry Cheescake', 1.80, 50, 10, FALSE),
('New York Cheescake', 1.80, 50, 10, FALSE),
('Croissant', 1.00, 50, 10, FALSE),
('Madeira Cake', 1.60, 50, 10, FALSE),
('Lemon Drizzle Cake', 1.40, 50, 10, FALSE),
('Bakewell Tart', 1.40, 50, 10, FALSE),
('Choc Chip Cookie', 1.00, 50, 10, FALSE),
('Blueberry Muffin', 1.60, 50, 10, FALSE);

-- insert for orders table to test the date trigger

INSERT INTO orders (order_id, customer_id, order_total, order_cancelled) VALUES
(1, 1, 2.40, 0);

INSERT INTO orders (order_id, customer_id, order_total, order_cancelled) VALUES
(2, 2, 2.40, 0);

-- insert for customers table

INSERT INTO customers (customer_name, customer_table) VALUES ('Dan', 2);
INSERT INTO customers (customer_name, customer_table) VALUES ('Matt', 3);

-- Triggers

-- trigger for adding date to order records.

CREATE TRIGGER before_orders_insert BEFORE INSERT ON orders
FOR EACH ROW
    SET new.order_date = now();

-- Views

-- View Orders

CREATE VIEW ordersView AS
SELECT * FROM `orders`;

