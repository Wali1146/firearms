<?php

namespace App\Controllers;

use App\Models\UserModel;
use Config\App;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    public function login()
    {
        // dd($this->request->getMethod());
        if (session()->get('user_id')) {
            return redirect()->to(base_url());
        }

        $data = [
            'title' => 'Login - Rhys Firearms'
        ];

        $method = strtolower($this->request->getMethod());

        if ($method === 'post') {
            $rules = [
                'username' => 'required',
                'password' => 'required'
            ];

            if ($this->validate($rules)) {
                $usernameOrEmail = $this->request->getPost('username');
                $password = $this->request->getPost('password');

                $user = $this->userModel->where('username', $usernameOrEmail)
                    ->orWhere('email', $usernameOrEmail)
                    ->first();

                if ($user && password_verify($password, $user['password'])) {
                    session()->set([
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'user_role' => $user['role']
                    ]);
                    return redirect()->to('/');
                } else {
                    session()->setFlashdata('error', 'Invalid username/email or password.');
                }
            } else {
                $data['validation'] = $this->validator;
                // dd($this->validator->getErrors());
            }
        }
        return view('auth/login', $data);
    }

    public function register()
    {
        if (session()->get('user_id')) {
            return redirect()->to('/');
        }

        $data = [
            'title' => 'Register - Rhys Firearms'
        ];

        $method = strtolower($this->request->getMethod());
        log_message('debug', 'Register method: ' . $method);

        if ($method === 'post') {
            log_message('debug', 'POST data received');
            
            $username = $this->request->getPost('username');
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');
            $confirm_password = $this->request->getPost('confirm_password');
            
            log_message('debug', "Register attempt - username: $username, email: $email");

            $rules = [
                'username' => 'required|min_length[3]|max_length[50]|is_unique[users.username]',
                'email' => 'required|valid_email|is_unique[users.email]',
                'password' => 'required|min_length[6]',
                'confirm_password' => 'required|matches[password]'
            ];

            if ($this->validate($rules)) {
                log_message('debug', 'Validation passed');
                
                $userData = [
                    'username' => $username,
                    'email' => $email,
                    'password' => $this->userModel->hashPassword($password),
                    'role' => 'user',
                    'created_at' => date('Y-m-d H:i:s')
                ];

                log_message('debug', 'Attempting insert with data: ' . json_encode($userData));

                if ($this->userModel->insert($userData)) {
                    log_message('debug', 'Insert successful, ID: ' . $this->userModel->getInsertID());
                    session()->setFlashdata('success', 'Registration successful! Please login.');
                    return redirect()->to('/login');
                } else {
                    $error = $this->userModel->errors();
                    log_message('error', 'Registration failed: ' . json_encode($error));
                    session()->setFlashdata('error', 'Registration failed: ' . json_encode($error));
                }
            } else {
                log_message('debug', 'Validation failed: ' . json_encode($this->validator->getErrors()));
                $data['validation'] = $this->validator;
            }
        }

        return view('auth/register', $data);
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    // Helper methods for checking authentication
    protected function requireLogin()
    {
        if (!session()->get('user_id')) {
            return redirect()->to('/login');
        }
        return null;
    }

    protected function requireAdmin()
    {
        $redirect = $this->requireLogin();
        if ($redirect) return $redirect;

        if (session()->get('user_role') !== 'admin') {
            return redirect()->to('/');
        }
        return null;
    }
}
