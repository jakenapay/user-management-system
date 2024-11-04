<?php
$session = session();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employees</title>

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

        $(document).ready(function () {
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
                    <?php }
                    ; ?>
                </div>
                <table class="text-center table table-responsive table-hover" id="userTable" style="width:100%">
                    <thead>
                        <tr class="dm-serif-display-regular">
                            <!-- If you're an admin then display all the ID of history -->
                            <?php if ($session->get('role') == 'admin') { ?>
                                <th class="text-center">ID</th>
                            <?php } ?>
                            <th class="text-center">Fulll Name</th>
                            <th class="text-center">Time In</th>
                            <th class="text-center">Time Out</th>
                            <th class="text-center">IP Address</th>
                        </tr>
                    </thead>
                    <tbody class="open-sans-text">
                        <?php foreach ($data as $person): ?>
                            <tr>
                                <!-- If you're an admin, show the ids of history -->
                                <?php if ($session->get('role') == 'admin') { ?>
                                    <td class="text-center"><?= htmlspecialchars($person['id']) ?></td>
                                <?php } ?>
                                <td class='text-capitalize'><?= htmlspecialchars($person['fullName']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($person['timeIn']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($person['timeOut']) ?></td>
                                <td class="text-center"><?= htmlspecialchars($person['ip']) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>

    <!-- Edit user Modal -->
    <div class="modal fade" id="editUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5 fw-semibold dm-serif-display-regular" id="staticBackdropLabel">Edit User
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form class="border rounded px-4 pb-3" method="POST" action="<?= base_url('/update'); ?>">
                    <div class="modal-body">

                        <!-- ID -->
                        <input type="hidden" id="editUserId" name="editUserId">
                        <div class="mb-3 open-sans-text">
                            <label for="editUserFirstName">Given Name</label>
                            <input id="editUserFirstName" name="editUserFirstName" class="form-control form-control-sm"
                                type="text" placeholder="">
                        </div>
                        <div class="mb-3 open-sans-text">
                            <label for="editUserLastName">Family Name</label>
                            <input id="editUserLastName" name="editUserLastName" class="form-control form-control-sm"
                                type="text" placeholder="">
                        </div>
                        <div class="mb-3 open-sans-text">
                            <label for="editUserPhone">Phone</label>
                            <input id="editUserPhone" name="editUserPhone" class="form-control form-control-sm"
                                type="text" placeholder="">
                        </div>
                        <div class="mb-3 open-sans-text">
                            <label for="editUserEmail">Email Address</label>
                            <input id="editUserEmail" name="editUserEmail" class="form-control form-control-sm"
                                type="email" placeholder="">
                        </div>
                        <div class="mb-3 open-sans-text">
                            <label for="editUserRole">Role</label>
                            <select class="form-select form-select-sm" id="editUserRole" name="editUserRole">
                                <option value="admin">Admin
                                </option>
                                <option value="user">User
                                </option>
                            </select>
                        </div>
                        <div class="mb-3 open-sans-text">
                            <label for="editUserStatus">Status</label>
                            <select class="form-select form-select-sm" id="editUserStatus" name="editUserStatus">
                                <option value="active">Active
                                </option>
                                <option value="inactive">
                                    Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer dm-serif-display-regular pb-0">
                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Close</button>
                        <!-- <button type="button" class="btn btn-primary">Understood</button> -->
                        <button type="submit" class="mx-1 btn btn-success btn-sm">Submit</button>
                    </div>
                </form>
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
        $(document).ready(function () {
            var table = $('#userTable').DataTable();

            $(document).on("click", ".editUserModalButton", function () {
                var userId = $(this).attr('data-id');
                var userFirstName = $(this).attr('data-firstName');
                var userLastName = $(this).attr('data-lastName');
                var userPhone = $(this).attr('data-phone');
                var userEmail = $(this).attr('data-email');
                var userRole = $(this).attr('data-role');
                var userStatus = $(this).attr('data-status');

                // Set values in the modal
                $('#editUserId').val(userId);
                $('#editUserFirstName').val(userFirstName);
                $('#editUserLastName').val(userLastName);
                $('#editUserEmail').val(userEmail);
                $('#editUserPhone').val(userPhone);
                $('#editUserRole').val(userRole);
                $('#editUserStatus').val(userStatus);
            });
        });

        // Use JavaScript to set a timeout to hide the message after 5 seconds
        setTimeout(function () {
            var message = document.getElementById('information-message');
            if (message) {
                message.style.display = 'none'; // Hide the message
            }
        }, 3000); // 5000 milliseconds = 5 seconds
    </script>

</body>

</html>