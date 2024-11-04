<?php

// Created a User Model for USERS
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model {

    // Initialize and assign the table
    // Initialize and assign the primary key
    protected $table = "users";
    protected $key = "id";
    protected $allowedFields = [
        'id',
        'firstName',
        'lastName',
        'email',
        'password',
        'confirmPassword',
        'phone',
        'role',
        'status',
        'token',
        'ucreadted_at',
        'uupdated_at'
    ];
}