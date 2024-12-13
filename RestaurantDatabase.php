<?php
class RestaurantDatabase {
    private static $instance = null;
    private $connection;
    private $host = "localhost";
    private $port = "3306";
    private $database = "restaurant_reservations";
    private $user = "root";
    private $password = "";

    
    public function __construct() {
        $this->connect();
    }

 
    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new RestaurantDatabase();
        }
        return self::$instance;
    }

    //connects to database
    private function connect() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database, $this->port);
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
        }
    }

    //obtains database connection
    public function getConnection() {
        return $this->connection;
    }

    //adds or gets customer during reservation process
    public function addOrGetCustomer($customerName, $contactInfo) {
        //checks if the customer already exists in database
        $stmt = $this->connection->prepare("SELECT customerId FROM customers WHERE customerName = ? AND contactInfo = ?");
        $stmt->bind_param("ss", $customerName, $contactInfo);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            //customer already exists, return customerId
            $customer = $result->fetch_assoc();
            return $customer['customerId'];
        } else {
            //customer doesn't exist, insert a new record
            $stmt = $this->connection->prepare("INSERT INTO customers (customerName, contactInfo) VALUES (?, ?)");
            $stmt->bind_param("ss", $customerName, $contactInfo);
            $stmt->execute();
            return $stmt->insert_id;
        }
    }
    
    //adds new customer directly
    public function addCustomer($customerName, $contactInfo) {
        $stmt = $this->connection->prepare(
            "INSERT INTO Customers (customerName, contactInfo) VALUES (?, ?)"
        );
        $stmt->bind_param("ss", $customerName, $contactInfo);
        $stmt->execute();
        $customerId = $stmt->insert_id;
        $stmt->close();
        return $customerId;
    }

    //adds reservation
    public function addReservation($customerName, $contactInfo, $reservationTime, $numberOfGuests, $specialRequests) {
        $customerId = $this->addOrGetCustomer($customerName, $contactInfo);
    
        $stmt = $this->connection->prepare(
            "INSERT INTO reservations (customerId, reservationTime, numberOfGuests, specialRequests) 
             VALUES (?, ?, ?, ?)"
        );
        if (!$stmt) {
            die("Preparation failed: " . $this->connection->error);
        }
    
        $stmt->bind_param("isis", $customerId, $reservationTime, $numberOfGuests, $specialRequests);
    
        if (!$stmt->execute()) {
            die("Execution failed: " . $stmt->error);
        } else {
            echo "Reservation added successfully!";
        }
        $stmt->close();
    }
    
    
    

    //gets all reservations
    public function getAllReservations() {
        $query = "
            SELECT r.reservationId, c.customerName, r.reservationTime, r.numberOfGuests, r.specialRequests
            FROM reservations r
            JOIN customers c ON r.customerId = c.customerId
        ";
        $result = $this->connection->query($query);
    
        if (!$result) {
            die("Query failed: " . $this->connection->error);
        }
    
    
        $reservations = [];
        while ($row = $result->fetch_assoc()) {
            $reservations[] = $row;
        }
    
        //cebugging output
        echo "<pre>";
        print_r($reservations);
        echo "</pre>";
    
        return $reservations;
    }
    
    
    //deletes a reservation
    public function deleteReservation($reservationId) {
        $stmt = $this->connection->prepare("DELETE FROM reservations WHERE reservationId = ?");
        $stmt->bind_param("i", $reservationId);
        $stmt->execute();
        $stmt->close();
    }
    

    }

