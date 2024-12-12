<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Portal</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f4eb;
            color: #333;
        }
        header {
            background-color: #c0392b;
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 2rem;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
        }
        nav {
            display: flex;
            justify-content: center;
            padding: 10px;
            background-color: #ecf0f1;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }
        nav a {
            margin: 0 15px;
            text-decoration: none;
            color: #c0392b;
            font-weight: bold;
            font-size: 1.2rem;
            transition: color 0.3s;
        }
        nav a:hover {
            color: #e74c3c;
        }
        main {
            text-align: center;
            margin-top: 50px;
        }
        footer {
            margin-top: 50px;
            background-color: #ecf0f1;
            text-align: center;
            padding: 10px;
            color: #7f8c8d;
            font-size: 0.9rem;
        }
        .hero {
            background-image: url('https://images.unsplash.com/photo-1546069901-ba9599a7e63c');
            background-size: cover;
            background-position: center;
            height: 300px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
            font-size: 2rem;
        }
    </style>
</head>
<body>
    <header>
        Restaurant Management Portal
    </header>
    <div class="hero">
        <h1>Welcome to the Restaurant Portal</h1>
    </div>
    <nav>
        <a href="RestaurantServer.php?action=addReservation">Add Reservation</a>
        <a href="RestaurantServer.php?action=viewReservations">View Reservations</a>

    </nav>
    <main>
        <p>Manage reservations and provide exceptional dining experiences with ease!</p>
    </main>
    <footer>
        &copy; Final Project 2024 Restaurant Management Portal. Smiller Espinal.
    </footer>
</body>
</html>
