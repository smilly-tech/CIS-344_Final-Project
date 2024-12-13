<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Reservation</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f4eb;
            color: #333;
        }
        h1 {
            text-align: center;
            margin-top: 20px;
            color: #c0392b;
        }
        form {
            width: 50%;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        form input, form textarea, form button {
            display: block;
            width: calc(100% - 20px);
            margin: 10px auto;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
        }
        form input:focus, form textarea:focus {
            outline: none;
            border-color: #c0392b;
            box-shadow: 0 0 5px rgba(192, 57, 43, 0.5);
        }
        form button {
            background-color: #c0392b;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        form button:hover {
            background-color: #e74c3c;
        }
        a {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            text-align: center;
            background-color: #c0392b;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        a:hover {
            background-color: #e74c3c;
        }
    </style>
</head>
<body>
    <h1>Add Reservation</h1>
    <form method="POST" action="ReservationConfirmed.php?action=addReservation">
        <label for="customer_name">Customer Name:</label>
        <input type="text" id="customer_name" name="customer_name" required>
        
        <label for="contact_info">Contact Info:</label>
        <input type="text" id="contact_info" name="contact_info" required>
        
        <label for="reservation_time">Reservation Time:</label>
        <input type="datetime-local" id="reservation_time" name="reservation_time" required>
        
        <label for="number_of_guests">Number of Guests:</label>
        <input type="number" id="number_of_guests" name="number_of_guests" min="1" required>
        
        <label for="special_requests">Special Requests:</label>
        <textarea id="special_requests" name="special_requests"></textarea>
        
        <button type="submit">Submit</button>
    </form>
    <a href="home.php">Back to Home</a>
</body>
</html>

<?php

//checks if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $guests = $_POST['guests'];

    //insert data into the database
    $sql = "INSERT INTO reservations (name, date, time, guests) 
            VALUES ('$name', '$date', '$time', '$guests')";

    //execute the query
    $result = $conn->query($sql);

    //check if the query was successful
    if ($result) {
        echo "New reservation created successfully";
    } else {
        echo "Error executing query: " . $conn->error; //access error if query fails
    }
}
?>

