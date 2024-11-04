<?php

namespace App\Controllers;

use App\Models\HistoryModel;
use CodeIgniter\Model;
use App\Models\UserModel;
use CodeIgniter\I18n\Time; // Time for time in and out

class UserController extends BaseController
{

    public function setUpmail($recipient, $subject, $message)
    {
        // recipient 
        $to = $recipient;
        $subj = $subject;
        $msg = $message;
        $email = \Config\Services::email();
        $email->setTo($to);
        $email->setSubject($subj);
        $email->setFrom('napayjakem@gmail.com', $subject);
        $email->setMessage($msg);
        if ($email->send()) {
        } else {
            $data = $email->printDebugger();
            print ($data);
        }
    }

    public function sendMail($x, $y, $z)
    {
        $this->setUpmail($x, $y, $z);
        return redirect()->to('/sendMail')->with('success', 'Registered successfully');
    }

    // Generate random token for user
    // You can use this by calling function: token($)
    public function token($length)
    {
        $str_result = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
        return substr(str_shuffle($str_result), 0, $length);
    }

    // Registration process for user to insert an account to database
    public function registration()
    {
        // Instantiate a new object from UserModel
        $userModel = new UserModel();

        // To make the set_value work
        // To help users from getting their credentials back when sudden refresh or change of url
        helper(['form']);

        // Data from the registration form
        $registrationData = [
            'firstName' => htmlspecialchars(trim($this->request->getVar('firstName'))),
            'lastName' => htmlspecialchars(trim($this->request->getVar('lastName'))),
            'phone' => htmlspecialchars(trim($this->request->getVar('phone'))),

            // Sanitize and validate email
            'email' => filter_var(trim($this->request->getVar('email')), FILTER_SANITIZE_EMAIL),
            'password' => htmlspecialchars(trim($this->request->getVar('password'))),
            'confirmPassword' => htmlspecialchars(trim($this->request->getVar('confirmPassword'))),
            'role' => 'user',
            'status' => 'inactive'
        ];

        // Validate firstName and lastName for letters only
        if (!preg_match('/^[a-zA-Z]+$/', $registrationData['firstName'])) {
            return redirect()->to('/profile/' . $registrationData['id'])->with('error', 'First name should contain letters only.');
        }

        if (!preg_match('/^[a-zA-Z]+$/', $registrationData['lastName'])) {
            return redirect()->to('/profile/' . $registrationData['id'])->with('error', 'Last name should contain letters only.');
        }

        // Validate email format
        if (!filter_var($registrationData['email'], FILTER_VALIDATE_EMAIL)) {
            return redirect()->to('/register')->withInput()->with('error', 'Invalid email format.');
        }

        // Check if email is existing in database
        if ($userModel->where('email', $registrationData['email'])->first()) {
            return redirect()->to('/register')->withInput()->with('error', 'Email already exists. Please use a different email.');
        }

        // validate password
        function validatePassword($password)
        {
            // Regular expression for password validation
            $pattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';
            return preg_match($pattern, $password);
        }

        // Validate password
        if (!validatePassword($registrationData['password'])) {
            // Handle invalid password error, e.g., set a flashdata error message or return an error response
            return redirect()->to('/register')->withInput()->with('error', 'Invalid password format.');
        }

        // Check the password from registration form if match
        if ($registrationData['password'] !== $registrationData['confirmPassword']) {
            return redirect()->to('/register')->withInput()->with('error', 'Passwords do not match. Please try again.');
        }

        // Prepare the data for inserting to database
        $data = [
            'firstName' => $registrationData['firstName'],
            'lastName' => $registrationData['lastName'],
            'email' => $registrationData['email'],
            'password' => password_hash($registrationData['password'], PASSWORD_DEFAULT),
            'phone' => $registrationData['phone'],
            'role' => $registrationData['role'],
            'status' => $registrationData['status'],
            'token' => $this->token(100)
        ];

        // Attempt to save the user data
        if ($userModel->save($data)) {

            // Set up the email function
            $subject = "Account activation";
            $userName = $data['firstName'];
            $activationToken = $data['token'];
            $recipient = $data['email'];

            // Send the email
            $message = "
                    <!DOCTYPE html>
                        <html lang='en'>
                        <head>
                            <meta charset='UTF-8'>
                            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                            <title>Activate Your Account</title>
                            <link href='https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css' rel='stylesheet'>
                        </head>
                        <body class='bg-gray-100 font-sans'>
                            <div class='max-w-md mx-auto mt-10 p-6 bg-white rounded-lg shadow-lg'>
                                <h2 class='text-2xl font-bold text-center text-gray-800'>Hi, {$userName}!</h2>
                                <p class='mt-4 text-gray-700 text-center'>We are excited to inform you that your account has been successfully created! To get started, please activate your account by clicking the link below:</p>
                                <p class='mt-4 text-center'>
                                    <a href='http://localhost:8080/activate/{$activationToken}' class='inline-block px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700'>Activate Your Account</a>
                                </p>
                                <p class='mt-4 text-gray-600 text-center'>If you did not create this account, please ignore this email.</p>
                                <p class='mt-6 text-gray-700 text-center'>Thank you for joining us! If you have any questions or need assistance, feel free to contact our support team.</p>
                                <br>
                                <p class='mt-6 text-center text-gray-800 font-semibold'>Best regards,</p>
                                <p class='text-center text-gray-700'>
                                    <strong>Jake Napay</strong><br>
                                    09453347158<br>
                                    Jake's User Management System
                                </p>
                            </div>
                        </body>
                        </html>
                    ";

            // Send the email
            $this->sendMail($recipient, $subject, $message);

            return redirect()->to('/login')->with('success', 'Registered successfully, activate your account via email.');
        } else {
            return redirect()->to('/register')->with('error', 'Failed to register user, please try again.');
        }
    }

    // Log in process for user to enter/access the website's contents
    public function loggingIn()
    {
        // Start session and instantiate a new object from UserModel
        $session = session();
        $userModel = new UserModel();
        $currentDateTime = Time::now('Asia/Manila');
        $ipAddress = $this->request->getIPAddress();

        // Get the email and password from login form
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');

        // Sanitize and validate email
        $email = filter_var(trim($email), FILTER_SANITIZE_EMAIL);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $session->setFlashData('error', 'Inactive email format');
            return redirect()->to('/login');
        }

        // Select from database using builder, by using the object and assigning into a new variable
        $database_data = $userModel->where('email', $email)->first();
        if (!$database_data) {
            $session->setFlashData('error', 'Email does not exists.');
            return redirect()->to('/login');
        }

        if ($database_data['status'] == 'inactive') {
            $session->setFlashData('error', 'Inactive account. Please activate via your email.');
            return redirect()->to('/login');
        }

        $database_password = $database_data['password'];
        if (!password_verify($password, $database_password)) {
            $session->setFlashdata('error', 'Invalid username or password.');
            return redirect()->to('/login');
        }

        $session_data = [
            'id' => $database_data['id'],
            'firstName' => $database_data['firstName'],
            'lastName' => $database_data['lastName'],
            'email' => $database_data['email'],
            'phone' => $database_data['phone'],
            'token' => $database_data['token'],
            'role' => $database_data['role'],
            'status' => $database_data['status'],
            'isLoggedIn' => true,
            'timeIn' => $currentDateTime,
            'ip' => $ipAddress
        ];

        $session->set($session_data);

        // Redirect to users page on successful login
        return redirect()->to('/home');
    }

    // Log out process, opens session, destroy sessions, and redirect users back to login
    public function loggingOut()
    {
        $currentDateTime = Time::now('Asia/Manila');
        $session = session();

        // Fetch session data
        $userId = $session->get('id');
        $timeIn = $session->get('timeIn'); // Make sure 'timeIn' is set earlier in the session
        $ip = $session->get('ip'); // Ensure 'ip' is stored in session when the user logs in

        // Prepare the data for insertion
        $userModel = new HistoryModel();
        $insertingData = [
            'userId' => $userId,
            'timeIn' => $timeIn,
            'timeOut' => $currentDateTime,
            'ip' => $ip,
        ];

        // Insert to database table
        if ($userModel->save($insertingData)) {
            $session->destroy(); // Destroy session after saving data
            return redirect()->to('/login');
        }

        $session->destroy(); // Fallback if saving fails
        return redirect()->to('/home');
    }

    // From route called update
    // This is built for updating users from users
    // Built for ADMINS

    public function updating()
    {
        $userModel = new UserModel();

        $updated_data = [
            'id' => htmlspecialchars($this->request->getVar('editUserId')),
            'firstName' => htmlspecialchars(trim($this->request->getVar('editUserFirstName'))),
            'lastName' => htmlspecialchars(trim($this->request->getVar('editUserLastName'))),
            'phone' => htmlspecialchars(trim($this->request->getVar('editUserPhone'))),
            'email' => htmlspecialchars($this->request->getVar('editUserEmail')),
            'role' => htmlspecialchars($this->request->getVar('editUserRole')),
            'status' => htmlspecialchars(trim($this->request->getVar('editUserStatus')))
        ];

        // Validate firstName and lastName for letters only
        if (!preg_match('/^[a-zA-Z]+$/', $updated_data['firstName'])) {
            return redirect()->to('/users')->with('error', 'First name should contain letters only.');
        } elseif (!preg_match('/^[a-zA-Z]+$/', $updated_data['lastName'])) {
            return redirect()->to('/users')->with('error', 'Last name should contain letters only.');
        } elseif (!preg_match('/^09[0-9]{9}$/', $updated_data['phone'])) {
            return redirect()->to('/users')->with('error', 'Phone number must match the format 09XXXXXXXXX.');
        } elseif (!filter_var($updated_data['email'], FILTER_VALIDATE_EMAIL)) {
            return redirect()->to('/users')->with('error', 'Invalid email address.');
        }





        // Start a transaction
        $database = \Config\Database::connect();
        $database->transStart();

        try {
            // Update the user
            $userModel->update($updated_data['id'], $updated_data);
            $database->transComplete();

            $session = session();
            if ($database->transStatus() === false) {
                $database->transRollback();
                $session->setFlashData('error', 'Failed to update the user. Please try again.');
            } else {
                // Commit changes
                $database->transCommit();
                $session->setFlashData('success', 'User was updated successfully');
            }
        } catch (\Exception $e) {
            $database->transRollback();
            $session->setFlashdata('error', 'An error occurred while updating the user. Please try again later.');
        }

        if ($session->get('role') == 'admin') {
            return redirect()->to('/users');
        } else {
            return redirect()->to('/home');
        }
    }

    // From route called updateUser
    // This is built for updating users from profile
    // Built for USERS

    public function updatingUser()
    {
        $userModel = new UserModel();
        $session = session();

        $updated_data = [
            'id' => htmlspecialchars($this->request->getVar('id')),
            'firstName' => htmlspecialchars($this->request->getVar('firstName')),
            'lastName' => htmlspecialchars($this->request->getVar('lastName')),
            'phone' => htmlspecialchars($this->request->getVar('phone')),
            'email' => htmlspecialchars($this->request->getVar('email')),
            'role' => htmlspecialchars($session->get('role')),
            'status' => 'active'
        ];

        // Validate firstName and lastName for letters only
        if (!preg_match('/^[a-zA-Z]+$/', $updated_data['firstName'])) {
            return redirect()->to('/profile/' . $updated_data['id'])->with('error', 'First name should contain letters only.');
        } elseif (!preg_match('/^[a-zA-Z]+$/', $updated_data['lastName'])) {
            return redirect()->to('/profile/' . $updated_data['id'])->with('error', 'Last name should contain letters only.');
        } elseif (!preg_match('/^09[0-9]{9}$/', $updated_data['phone'])) {
            return redirect()->to('/profile/' . $updated_data['id'])->with('error', 'Phone number must match the format 09XXXXXXXXX.');
        } elseif (!filter_var($updated_data['email'], FILTER_VALIDATE_EMAIL)) {
            return redirect()->to('/profile/' . $updated_data['id'])->with('error', 'Invalid email address.');
        }

        // Start a transaction
        $database = \Config\Database::connect();
        $database->transStart();

        try {
            // Update the user
            $userModel->update($updated_data['id'], $updated_data);
            $database->transComplete();

            $session = session();
            if ($database->transStatus() === false) {
                $database->transRollback();
                $session->setFlashData('error', 'Failed to update the user. Please try again.');
            } else {
                // Commit changes
                $database->transCommit();
                $session->setFlashData('success', 'User was updated successfully');
            }
        } catch (\Exception $e) {
            $database->transRollback();
            $session->setFlashdata('error', 'An error occurred while updating the user. Please try again later.');
        }

        return redirect()->to('/profile/' . $updated_data['id']);
    }

    public function updatingUserPassword()
    {
        $userModel = new UserModel();
        $session = session();

        // Fetch and sanitize input data
        $updated_data = [
            'id' => htmlspecialchars($this->request->getVar('id')),
            'email' => htmlspecialchars($session->get('email')),
            'oldPassword' => htmlspecialchars($this->request->getVar('oldPassword')),
            'password' => htmlspecialchars($this->request->getVar('password')),
            'confirmPassword' => htmlspecialchars($this->request->getVar('confirmPassword')),
        ];

        // Password validation pattern
        $passwordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/';

        // Validate the password
        if (!preg_match($passwordPattern, $updated_data['password'])) {
            $session->setFlashdata('error', 'Invalid password format.');
            return redirect()->to('/password/' . $session->get('id'));
        }

        if (!preg_match($passwordPattern, $updated_data['oldPassword'])) {
            $session->setFlashdata('error', 'Invalid password format.');
            return redirect()->to('/password/' . $session->get('id'));
        }

        // Check if new passwords match
        if ($updated_data['password'] !== $updated_data['confirmPassword']) {
            $session->setFlashdata('error', 'Passwords do not match.');
            return redirect()->to('/password/' . $session->get('id'));
        }

        // Retrieve the user's current password
        $database_data = $userModel->where('email', $updated_data['email'])->first();

        if ($database_data) {
            $database_password = $database_data['password'];

            // Validate old password
            if (!password_verify($updated_data['oldPassword'], $database_password)) {
                $session->setFlashdata('error', 'Incorrect current password.');
                return redirect()->to('/password/' . $session->get('id'));
            }

            // Hash the new password and update the record
            $new_password_data = [
                'password' => password_hash($updated_data['password'], PASSWORD_DEFAULT)
            ];

            if ($userModel->update($updated_data['id'], $new_password_data)) {
                $session->setFlashdata('success', 'Password changed successfully');
            } else {
                $session->setFlashdata('error', 'Failed to change password. Please try again.');
            }
        } else {
            $session->setFlashdata('error', 'User not found.');
        }
        return redirect()->to('/password/' . $updated_data['id']);
    }

    public function activate($token)
    {
        $userModel = new UserModel();

        // Find the user with the provided activation token
        $user = $userModel->where('token', $token)->first();
        if ($user) {
            // Check if the account is already activated
            if ($user['status'] == 'active') {
                return redirect()->to('/login')->with('message', 'Your account is already activated. You can log in now.');
            }

            // Activate the account
            $userModel->update($user['id'], [
                'status' => 'active',
                'token' => null // Clear the activation token
            ]);

            return redirect()->to('/login')->with('success', 'Your account has been activated. You can now log in.');
        } else {
            return redirect()->to('/login')->with('error', 'Invalid activation token. Please check your email for the correct link.');
        }
    }
}
