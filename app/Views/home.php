<?php
use CodeIgniter\HTTP\URI;
$session = session();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>

    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- css datatables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.7/css/dataTables.dataTables.css" />
    <script src="https://cdn.datatables.net/2.1.7/js/dataTables.js"></script>
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- link CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>?v=<?= time(); ?>">

    <!-- Data tables -->
    <script>
        let table = new DataTable('#showTable');

        $(document).ready(function() {
            $('#userTable').DataTable();
            // Enable Bootstrap tooltips
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
    </script>

</head>

<body>

    <?php include("nav.php"); ?>
    <div class="container mt-5">
        <div class="row d-flex justify-content-center align-items-center">
            <div class="col-12 col-lg-12">
                <div class="mb-3">
                    <?php if (session()->getFlashdata('success')) { ?>
                        <p id="information-message" class="text-center bg-success text-light py-1 rounded">
                            <?= session()->getFlashdata('success') ?>
                        </p>
                    <?php } elseif (session()->getFlashdata('error')) { ?>
                        <p id="information-message" class="text-center bg-success text-light py-1 rounded">
                            <?= session()->getFlashdata('success') ?>
                        </p>
                    <?php }; ?>
                </div>
                <section class="mb-4">
            <h2 class="fw-bold text-primary">Overview</h2>
            <p>Welcome to Jake's User Management System! This platform is designed to make user management straightforward and efficient. From handling user sessions to managing passwords and tracking history, our system is your solution for effective user administration.</p>
        </section>

        <section class="mb-4">
            <h3 class="fw-bold text-secondary">Features</h3>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <h5 class="fw-bold">1. Login</h5>
                    <p>Securely log in to access personalized features and manage user data.</p>
                </li>
                <li class="list-group-item">
                    <h5 class="fw-bold">2. Registration</h5>
                    <p>New users can register, providing necessary details to access the system.</p>
                </li>
                <li class="list-group-item">
                    <h5 class="fw-bold">3. Logout</h5>
                    <p>Safely end your session at any time with a single click.</p>
                </li>
                <li class="list-group-item">
                    <h5 class="fw-bold">4. User Handling</h5>
                    <p>Manage user details, roles, and permissions with ease.</p>
                </li>
                <li class="list-group-item">
                    <h5 class="fw-bold">5. Session Management</h5>
                    <p>Track active sessions to ensure user security and data integrity.</p>
                </li>
                <li class="list-group-item">
                    <h5 class="fw-bold">6. History Page</h5>
                    <p>View your activity history and track important changes.</p>
                </li>
                <li class="list-group-item">
                    <h5 class="fw-bold">7. Change Password</h5>
                    <p>Change your password conveniently if you need it.</p>
                </li>
                <li class="list-group-item">
                    <h5 class="fw-bold">8. Email Sending</h5>
                    <p>Receive notifications and account updates directly to your email.</p>
                </li>
            </ul>
        </section>
    </main>

    <footer class="bg-light py-3">
        <div class="container text-center">
            <p class="mb-0">© 2024 Jake's User Management System</p>
        </div>
    </footer>

            </div>
        </div>
    </div>


    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <!-- script data tables -->
    <script src="https://cdn.datatables.net/2.1.7/css/dataTables.bootstrap5.min.css"></script>

    <!-- JS Bootstrap bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>

    <script>
        // Use JavaScript to set a timeout to hide the message after 5 seconds
        setTimeout(function() {
            var message = document.getElementById('information-message');
            if (message) {
                message.style.display = 'none'; // Hide the message
            }
        }, 3000); // 5000 milliseconds = 5 seconds
    </script>

</body>

</html>