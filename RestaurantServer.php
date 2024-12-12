<?php
require_once 'RestaurantDatabase.php';

class RestaurantPortal {
    private $db;

    public function __construct() {
        $this->db = RestaurantDatabase::getInstance();
    }

    public function handleRequest() {
        $action = $_GET['action'] ?? 'home';

        switch ($action) {
            case 'addReservation':
                $this->addReservation();
                break;
            case 'viewReservations':
                $this->viewReservations();
                break;
            case 'deleteReservation': // Added case for delete action
                $this->deleteReservation();
                break;
            case 'reservationConfirmed':
                include 'ReservationConfirmed.php';
                break;
            default:
                $this->home();
                break;
        }
    }

    private function home() {
        include 'home.php';
    }

    public function addReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customerName = $_POST['customerName'];
            $contactInfo = $_POST['contactInfo'];
            $reservationTime = $_POST['reservationTime'];
            $numberOfGuests = (int)$_POST['numberOfGuests'];
            $specialRequests = $_POST['specialRequests'];

            try {
                $this->db->addReservation($customerName, $contactInfo, $reservationTime, $numberOfGuests, $specialRequests);
                header("Location: RestaurantServer.php?action=reservationConfirmed");
                exit();
            } catch (Exception $e) {
                die("Error adding reservation: " . $e->getMessage());
            }
        } else {
            include 'addReservation.php';
        }
    }

    private function viewReservations() {
        $reservations = $this->db->getAllReservations();
        include 'viewReservations.php';
    }

    public function deleteReservation() {
        $reservationId = $_GET['reservationId'] ?? null;
        if ($reservationId) {
            $this->db->deleteReservation($reservationId);
            header("Location: RestaurantServer.php?action=viewReservations&message=Reservation Deleted");
            exit();
        }
    }
}

$portal = new RestaurantPortal();
$portal->handleRequest();
