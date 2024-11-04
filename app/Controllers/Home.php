<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    // My Home Controller is where my web pages are. 
    // Redirecting users to the view
    public function home(): string
    {
        return view('home');
    }

    // Login page for users to enter the website
    public function login()
    {
        return view('login');
    }

    // Register page for users to create their own account
    public function register()
    {

        // To make the set_value work
        // To help users from getting their credentials back when sudden refresh or change of url
        helper(['form']);

        $data = [];

        // Go to the register page
        return view('register', $data);
    }

    // Users page for logged in users
    public function users()
    {
        // Instantiate a new object and select all from users table
        // Pass the fetched data to a variable and pass the variable to the view(users)
        $userModel = new UserModel;
        $data['data'] = $userModel->findAll();
        return view('/users', $data);
    }

    // User's own profile page
    public function profile($id = null) {
        $session = session();
        $userModel = new UserModel;
        $data['data'] = $userModel->where('id', $session->get('id'))->first();
        return view('/profile', $data);
    }

    // User's own password page where they can change their password
    public function password($id = null) {
        $session = session();
        $userModel = new UserModel;
        $data['data'] = $userModel->where('id', $session->get('id'))->first();
        return view('/password', $data);
    }

   
}
