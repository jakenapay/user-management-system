<?php

$session = session();
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

    <form action="<?= base_url('/updateUser'); ?>" method="POST">
        <div class="font-[sans-serif]">
            <div class="min-h-screen flex flex-col items-center justify-center py-0 px-4">
                <div class="grid md:grid-cols-2 items-center gap-10 max-w-6xl w-full">
                    <div>
                        <h2 class="lg:text-5xl text-4xl font-extrabold lg:leading-[55px] text-gray-800">
                            <i class="fa-solid fa-pen-to-square"></i> User Profile
                        </h2>
                        <p class="text-sm mt-6 text-gray-800">Welcome to your profile page, <span
                                class="text-blue-600 font-semibold"><?= esc($data['firstName']); ?></span>!</p>
                        <p class="text-sm text-gray-800">Feel free to edit your profile here</p>
                        <p class="text-sm mt-12 text-gray-800">Back to<a href="<?= base_url('/home'); ?>"
                                class="text-blue-600 font-semibold hover:underline ml-1">home</a></p>
                    </div>

                    <div class="max-w-md md:ml-auto w-full">
                        <h3 class="text-gray-800 text-3xl font-extrabold mb-1">
                            Profile Information
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
                                <label for="firstName" class="text-sm font-semibold">First Name:</label>
                                <input id="firstName" name="firstName" type="text" required minlength="2" maxlength="50"
                                    class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-3.5 rounded-md outline-blue-600"
                                    value="<?= htmlspecialchars($data['firstName'], ENT_QUOTES, 'UTF-8'); ?>"
                                    pattern="[A-Za-z]{2,}" title="Only letters are allowed, minimum of 2 characters" />
                            </div>
                            <div>
                                <label for="lastName" class="text-sm font-semibold">Last Name:</label>
                                <input id="lastName" name="lastName" type="text" required minlength="2" maxlength="50"
                                    class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-3.5 rounded-md outline-blue-600"
                                    value="<?= htmlspecialchars($data['lastName'], ENT_QUOTES, 'UTF-8'); ?>"
                                    pattern="[A-Za-z]{2,}" title="Only letters are allowed, minimum of 2 characters" />
                            </div>
                            <div>
                                <label for="phone" class="text-sm font-semibold">Phone:</label>
                                <input id="phone" name="phone" type="text" required maxlength="11"
                                    class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-3.5 rounded-md outline-blue-600"
                                    value="<?= htmlspecialchars($data['phone'], ENT_QUOTES, 'UTF-8'); ?>"
                                    pattern="09[0-9]{9}" title="Format: 09XXXXXXXXX" />
                            </div>
                            <div>
                                <label for="email" class="text-sm font-semibold">Email:</label>
                                <input id="email" name="email" type="email" required maxlength="254"
                                    class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-3.5 rounded-md outline-blue-600"
                                    value="<?= htmlspecialchars($data['email'], ENT_QUOTES, 'UTF-8'); ?>"
                                    pattern="[a-zA-Z0-9]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}"
                                    title="Please enter a valid email address (e.g., user@example.com)" />
                            </div>
                            
                        </div>

                        <div class="!mt-3">
                            <button type="submit"
                                class="mt-2 w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none text-center block">
                                Edit
                            </button>
                            <p class="text-center text-sm mt-6 text-gray-800 font-semibold">Or</p>
                            <p class="text-center text-sm mt-3 text-gray-800"><a
                                    href="/password/<?php echo esc($session->get('id')); ?>"
                                    class="text-blue-600 font-semibold hover:underline ml-1">Change Password</a></p>
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
        setTimeout(function () {
            var message = document.getElementById('information-message');
            if (message) {
                message.style.display = 'none'; // Hide the message
            }
        }, 3000); // 5000 milliseconds = 5 seconds
    </script>
</body>

</html>