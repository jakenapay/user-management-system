<?php

namespace App\Controllers;

use CodeIgniter\Model;
use App\Models\UserModel;
use App\Models\HistoryModel;

class HistoryController extends BaseController
{

    public function history()
    {
        $session = session();
        $historyModel = new HistoryModel;

        // I did a relational database with JOIN
        // And selected all important data that is neccessary for Login history table
        // Fetch data from the database
        $data = $historyModel->select('login_history.id AS id, 
                                                CONCAT(users.firstName, " ", users.lastName) AS fullName, 
                                                login_history.timeIn as timeIn, 
                                                login_history.timeOut as timeOut, 
                                                login_history.ip as ip')
            ->join('users', 'login_history.userId = users.id');

        // Check the role from the session
        if ($session->get('role') === 'admin') {
            // If the user is an admin, fetch all records
            $data = $historyModel->findAll();
        } else {
            // If the user is a regular user, fetch only their records
            $data = $historyModel->where('users.id', $session->get('id'))->findAll();
        }


        // Pass the data to the view
        return view('history', ['data' => $data]);
    }

}