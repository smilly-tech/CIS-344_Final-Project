--Log in to MySQL
mysql -u root -p

--Create Database
CREATE DATABASE restaurant_reservations;

--Use the Database
USE restaurant_reservations;

--Create Customers Table
CREATE TABLE customers (
    customerId INT AUTO_INCREMENT PRIMARY KEY,
    customerName VARCHAR(255) NOT NULL,
    contactInfo VARCHAR(255) NOT NULL UNIQUE
);

--Create Reservations Table
CREATE TABLE reservations (
    reservationId INT AUTO_INCREMENT PRIMARY KEY,
    customerId INT NOT NULL,
    reservationTime DATETIME NOT NULL,
    numberOfGuests INT NOT NULL,
    specialRequests TEXT,
    FOREIGN KEY (customerId) REFERENCES customers(customerId)
);

--Create Dining Preferences Table
CREATE TABLE diningPreferences (
    preferenceId INT AUTO_INCREMENT PRIMARY KEY,
    customerId INT NOT NULL,
    favoriteTable VARCHAR(255),
    dietaryRestrictions TEXT,
    FOREIGN KEY (customerId) REFERENCES customers(customerId)
);

--Stored Procedure to Find Reservations for a Customer
DELIMITER $$
CREATE PROCEDURE findReservations(IN custId INT)
BEGIN
    SELECT r.reservationId, r.reservationTime, r.numberOfGuests, r.specialRequests
    FROM reservations r
    WHERE r.customerId = custId;
END$$
DELIMITER ;

--Stored Procedure to Add a Special Request to a Reservation
DELIMITER $$
CREATE PROCEDURE addSpecialRequest(IN resId INT, IN requests TEXT)
BEGIN
    UPDATE reservations
    SET specialRequests = requests
    WHERE reservationId = resId;
END$$
DELIMITER ;

--Stored Procedure to Add a Reservation and Create Customer if Necessary
DELIMITER $$
CREATE PROCEDURE addReservation(
    IN custName VARCHAR(255),
    IN contact VARCHAR(255),
    IN resTime DATETIME,
    IN numGuests INT,
    IN requests TEXT
)
BEGIN
    DECLARE custId INT;

    --Check if the customer already exists
    SELECT customerId INTO custId
    FROM customers
    WHERE contactInfo = contact;

    --If the customer does not exist, create a new one
    IF custId IS NULL THEN
        INSERT INTO customers (customerName, contactInfo)
        VALUES (custName, contact);
        SET custId = LAST_INSERT_ID();
    END IF;

    --Add the reservation
    INSERT INTO reservations (customerId, reservationTime, numberOfGuests, specialRequests)
    VALUES (custId, resTime, numGuests, requests);
END$$
DELIMITER ;

--Stored Procedure to Retrieve Customer Preferences
DELIMITER $$
CREATE PROCEDURE getCustomerPreferences(IN custId INT)
BEGIN
    SELECT favoriteTable, dietaryRestrictions
    FROM diningPreferences
    WHERE customerId = custId;
END$$
DELIMITER ;

--Stored Procedure to Delete a Reservation
DELIMITER $$
CREATE PROCEDURE deleteReservation(IN resId INT)
BEGIN
    DELETE FROM reservations
    WHERE reservationId = resId;
END$$
DELIMITER ;
