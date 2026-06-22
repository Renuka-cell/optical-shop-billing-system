<?php

namespace App\Controllers;

use App\Models\UserModel;

class StaffController extends BaseController
{
    // =========================
    // CREATE STAFF
    // =========================

    public function createStaff()
    {
        $userModel = new UserModel();

        $data = $this->request->getJSON(true);

        $username = trim($data['username'] ?? '');
        $password = trim($data['password'] ?? '');

        if (!$username || !$password) {

            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'error' => 'Username and password required'
                ]);
        }

        $existing = $userModel
            ->where('username', $username)
            ->first();

        if ($existing) {

            return $this->response
                ->setStatusCode(400)
                ->setJSON([
                    'error' => 'Username already exists'
                ]);
        }

        $userModel->insert([
            'username' => $username,
            'password' => $password,
            'role' => 'staff',
            'created_at' => date('Y-m-d H:i:s')
        ]);

        return $this->response->setJSON([
            'success' => true,
            'message' => 'Staff created successfully'
        ]);
    }

    // =========================
    // STAFF LIST
    // =========================

    public function getStaffList()
    {
        $userModel = new UserModel();

        $staff = $userModel
            ->where('role', 'staff')
            ->findAll();

        return $this->response
            ->setJSON($staff);
    }

    // =========================
    // DELETE STAFF
    // =========================

    public function deleteStaff($id)
    {
        $userModel = new UserModel();

        $staff = $userModel->find($id);

        if (!$staff) {

            return $this->response
                ->setStatusCode(404)
                ->setJSON([
                    'error' => 'Staff not found'
                ]);
        }

        $userModel->delete($id);

        return $this->response
            ->setJSON([
                'success' => true
            ]);
    }

    // =========================
    // UPDATE STAFF
    // =========================

    public function updateStaff($id)
    {
        $userModel = new UserModel();

        $data = $this->request->getJSON(true);

        $username =
            trim($data['username'] ?? '');

        $userModel->update($id, [
            'username' => $username
        ]);

        return $this->response
            ->setJSON([
                'success' => true
            ]);
    }

    // =========================
    // RESET PASSWORD
    // =========================

    public function resetPassword($id)
    {
        $userModel = new UserModel();

        $data = $this->request->getJSON(true);

        $password =
            trim($data['password'] ?? '');

        $userModel->update($id, [
            'password' => $password
        ]);

        return $this->response
            ->setJSON([
                'success' => true
            ]);
    }
}