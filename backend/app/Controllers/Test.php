<?php

namespace App\Controllers;

class Test extends BaseController
{
    public function index()
    {
        $db = \Config\Database::connect();

        if ($db) {
            return $this->response->setJSON([
                'status' => true,
                'message' => 'Database Connected Successfully'
            ]);
        }

        return $this->response->setJSON([
            'status' => false,
            'message' => 'Database Connection Failed'
        ]);
    }
}