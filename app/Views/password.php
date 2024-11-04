<?php

use CodeIgniter\HTTP\URI;
// Assuming $data is available and contains user information
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- link CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>?v=<?= time(); ?>">
</head>

<body>

    <form action="<?= base_url('/updateUserPassword'); ?>" method="POST">
        <div class="font-[sans-serif]">
            <div class="min-h-screen flex flex-col items-center justify-center py-0 px-4">
                <div class="grid md:grid-cols-2 items-center gap-10 max-w-6xl w-full">
                    <div>
                        <h2 class="lg:text-5xl text-4xl font-extrabold lg:leading-[55px] text-gray-800">
                            <i class="fa-solid fa-lock"></i> Change Password
                        </h2>
                        <p class="text-sm mt-6 text-gray-800">Welcome to your password page, <span class="text-blue-600 font-semibold"><?= esc($data['firstName']); ?></span>!</p>
                        <p class="text-sm text-gray-800">Feel free to edit your password here</p>
                        <p class="text-sm mt-12 text-gray-800">Back to<a href="<?= base_url('/home'); ?>"
                                class="text-blue-600 font-semibold hover:underline ml-1">home</a></p>
                    </div>

                    <div class="max-w-md md:ml-auto w-full">
                        <h3 class="text-gray-800 text-3xl font-extrabold mb-1">
                            Change Password
                        </h3>

                        <div class="mb-3">
                            <?php if (session()->getFlashdata('success')) { ?>
                                <p id="information-message" class="text-center bg-success text-light py-1 rounded">
                                    <?= session()->getFlashdata('success') ?>
                                </p>
                            <?php } elseif (session()->getFlashdata('error')) { ?>
                                <p id="information-message" class="text-center bg-danger text-light py-1 rounded">
                                    <?= session()->getFlashdata('error') ?>
                                </p>
                            <?php } ?>
                        </div>

                        <div class="space-y-4">
                            <!-- ID -->
                            <input type="hidden" id="id" name="id" value="<?= $data['id']; ?>">
                            <div>
                                <label for="oldPassword" class="text-sm font-semibold">Current Password:</label>
                                <input
                                    id="oldPassword"
                                    name="oldPassword"
                                    type="password"
                                    class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-3.5 rounded-md outline-blue-600"
                                    required
                                    autocomplete="current-password"
                                    minlength="8"
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}"
                                    title="Please enter your current password." />
                            </div>
                            <div>
                                <label for="password" class="text-sm font-semibold">New Password:</label>
                                <input
                                    id="password"
                                    name="password"
                                    type="password"
                                    class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-3.5 rounded-md outline-blue-600"
                                    required
                                    autocomplete="new-password"
                                    minlength="8"
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}"
                                    title="Password must contain at least 8 characters, including uppercase, lowercase, number, and special character." />
                            </div>
                            <div>
                                <label for="confirmPassword" class="text-sm font-semibold">Confirm New Password:</label>
                                <input
                                    id="confirmPassword"
                                    name="confirmPassword"
                                    type="password"
                                    class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-3.5 rounded-md outline-blue-600"
                                    required
                                    autocomplete="new-password"
                                    minlength="8"
                                    pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}"
                                    title="Password must match the above password."
                                    oninput="this.setCustomValidity(this.value !== document.getElementById('password').value ? 'Passwords do not match.' : '')" />
                            </div>
                        </div>

                        <div class="!mt-3">
                            <button type="submit"
                                class="mt-2 w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none text-center block">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>

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