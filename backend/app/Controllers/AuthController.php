<?php

namespace App\Controllers;

use App\Models\UserModel;

class AuthController extends BaseController
{
    public function login()
    {
        log_message('error', 'LOGIN METHOD HIT');

        $userModel = new UserModel();

        $data = $this->request->getJSON(true);

        $username = $data['username'] ?? '';
        $password = $data['password'] ?? '';

        $user = $userModel
                    ->where('username', $username)
                    ->first();

         if (!$user) {

        return $this->response
            ->setStatusCode(401)
            ->setJSON([
                'message' => 'User not found'
            ]);
        }

        if ($user['password'] !== $password) {

            return $this->response
                ->setStatusCode(401)
                ->setJSON([
                    'message' => 'Invalid password'
                ]);
        }

        return $this->response->setJSON([

            'id' => $user['id'],

            'username' => $user['username'],

            'role' => $user['role'],

            'message' => 'Login successful'

        ]);

        
    }
}