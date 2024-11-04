<?php
$session = session();
if ($session->get('remember') == 'true') {
    return redirect()->to('/home'); 
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- fontawesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">

    <!-- link CSS -->
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>?v=<?= time(); ?>">
</head>

<body>
    <div class="font-[sans-serif]">
        <div class="min-h-screen flex fle-col items-center justify-center py-0 px-4">
            <div class="grid md:grid-cols-2 items-center gap-10 max-w-6xl w-full">
                <div>
                    <h2 class="lg:text-5xl text-4xl font-extrabold lg:leading-[55px] text-gray-800">
                        Welcome to <span class="text-blue-600">Jake</span>'s User Management System
                    </h2>
                    <p class="text-sm mt-6 text-gray-800">The website consists of user profiles, tables, login,
                        registration, and logout. Trully created with CodeIgniter4</p>
                    <p class="text-sm mt-12 text-gray-800">Don't have an account <a href="<?= base_url('/register'); ?>"
                            class="text-blue-600 font-semibold hover:underline ml-1">Register here</a></p>
                </div>

                <form class="max-w-md md:ml-auto w-full" action="<?= base_url('/loggingIn'); ?>" method="POST">
                    <h3 class="text-gray-800 text-3xl font-extrabold mb-1">
                    <i class="fa-solid fa-person-shelter"></i> Sign in
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
                        <div>
                            <input id="email" name="email" type="email" autocomplete="email" required
                                class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-3.5 rounded-md outline-blue-600 focus:bg-transparent"
                                placeholder="Email address" />
                        </div>
                        <div>
                            <input id="password" name="password" type="password" autocomplete="current-password"
                                required
                                class="bg-gray-100 w-full text-sm text-gray-800 px-4 py-3.5 rounded-md outline-blue-600 focus:bg-transparent"
                                placeholder="Password" />
                        </div>
                    </div>

                    <div class="!mt-8">
                        <button type="submit"
                            class="w-full shadow-xl py-2.5 px-4 text-sm font-semibold rounded text-white bg-blue-600 hover:bg-blue-700 focus:outline-none">
                            Log in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- JS Bootstrap bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>