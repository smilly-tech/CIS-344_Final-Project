<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Confirmed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: #f8f4eb;
            color: #333;
            padding: 50px;
        }
        h1 {
            color: #2ecc71;
        }
        p {
            font-size: 18px;
        }
        a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
        }
        a:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>
    <h1>Reservation Confirmed!</h1>
    <p>Your booking has been successfully added to our system.</p>
    <a href="RestaurantServer.php?action=viewReservations">View Reservations</a>
    <a href="home.php">Back to Home</a>
</body>
</html>
