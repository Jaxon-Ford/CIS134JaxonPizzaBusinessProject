DROP DATABASE IF EXISTS jf_database;
CREATE DATABASE jf_database;
USE jf_database;

DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS items;

CREATE TABLE jf_database.items (
    item_id INT AUTO_INCREMENT PRIMARY KEY,
    item_name VARCHAR(100) NOT NULL,
    description VARCHAR(255),
    price DECIMAL(8,2) NOT NULL
);

CREATE TABLE jf_database.orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    item_id INT NOT NULL,
    quantity INT NOT NULL,
    order_date DATE NOT NULL,
    total_cost DECIMAL(8,2) NOT NULL,
    FOREIGN KEY (item_id) REFERENCES items(item_id)
);
