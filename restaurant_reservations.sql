mysql -u root -p

CREATE DATABASE restaurant_reservations;

USE restaurant_reservations;

CREATE TABLE customers (
    customerId INT AUTO_INCREMENT PRIMARY KEY,
    customerName VARCHAR(255),
    contactInfo VARCHAR(255)
);

CREATE TABLE reservations (
    reservationId INT AUTO_INCREMENT PRIMARY KEY,
    customerId INT,
    reservationTime DATETIME,
    numberOfGuests INT,
    specialRequests TEXT,
    FOREIGN KEY (customerId) REFERENCES customers(customerId)
);

CREATE TABLE diningPreferences (
    preferenceId INT AUTO_INCREMENT PRIMARY KEY,
    customerId INT,
    favoriteTable VARCHAR(255),
    dietaryRestrictions TEXT,
    FOREIGN KEY (customerId) REFERENCES customers(customerId)
);

SHOW CREATE TABLE reservations;
SHOW CREATE TABLE customers;

#Code to add reservation to database
INSERT INTO customers (customerName, contactInfo) VALUES ('Smiller Espinal', '123456789');
INSERT INTO reservations (customerId, reservationTime, numberOfGuests, specialRequests) 
VALUES (1, '2024-12-12 18:00:00', 4, 'Window table');

INSERT INTO customers (customerName, contactInfo) VALUES ('Joe Sanders', '987654321');
INSERT INTO reservations (customerId, reservationTime, numberOfGuests, specialRequests) 
VALUES (2, '2024-15-12 19:00:00', 4, 'Outside table');

#Code to delete specific reservation from database based on reservationId
DELETE FROM reservations
WHERE reservationId = 3;





