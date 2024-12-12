<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Reservations</title>
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
        table {
            width: 80%;
            margin: 20px auto;
            border-collapse: collapse;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            background-color: white;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #c0392b;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #f9e0dd;
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
    <h1>All Reservations</h1>

    <?php if (isset($_GET['message'])) { ?>
        <p style="text-align: center; color: green;"><?= htmlspecialchars($_GET['message']) ?></p>
    <?php } ?>

    <?php
    require_once 'RestaurantDatabase.php';

    $db = RestaurantDatabase::getInstance();
    $reservations = $db->getAllReservations();

    if (empty($reservations)) {
        echo "<p style='text-align: center; color: red;'>No reservations found.</p>";
    } else {
        echo "<table>";
        echo "<tr><th>ID</th><th>Name</th><th>Time</th><th>Guests</th><th>Requests</th><th>Actions</th></tr>";
        foreach ($reservations as $reservation) {
            echo "<tr>
                <td>{$reservation['reservationId']}</td>
                <td>{$reservation['customerName']}</td>
                <td>{$reservation['reservationTime']}</td>
                <td>{$reservation['numberOfGuests']}</td>
                <td>{$reservation['specialRequests']}</td>
                <td><a href='RestaurantServer.php?action=deleteReservation&reservationId={$reservation['reservationId']}'>Delete</a></td>
            </tr>";
        }
        echo "</table>";
    }
    ?>

    <a href="home.php">Back to Home</a>
</body>
</html>
