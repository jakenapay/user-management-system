<?php

// Created a User Model for USERS
namespace App\Models;
use CodeIgniter\Model;

class HistoryModel extends Model {

    // Initialize and assign the table
    // Initialize and assign the primary key
    protected $table = "login_history";
    protected $key = "id";
    protected $allowedFields = [
        'id',
        'userId',
        'timeIn',
        'timeOut',
        'ip'
    ];
}