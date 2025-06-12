<?php

namespace App\Controllers;

use App\Models\User;

class AuthController
{
    public function login()
    {
        return view('auth.login');
    }

    public function postLogin()
    {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $user = User::select(['*'])
            ->where('email', '=', $email)
            ->get();

        //Trường hợp có email
        if ($user) {
            $user = $user[0];
            //Kiểm tra mật khẩu
            if (password_verify($password, $user->password)) {
                $_SESSION['user'] = $user;
                redirect('admin/products');
            } else {
                $error['auth'] = "Thông tin tài khoản không chính xác";
            }
        } else {
            $error['auth'] = "Thông tin tài khoản không chính xác";
        }

        if (isset($error)) {
            return view('auth.login', compact('email', 'error'));
        }
    }

    public function register()
    {
        return view('auth.register');
    }
    public function postRegister()
    {
        $data = $_POST;
        //mã hóa mật khẩu
        $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

        User::create($data);
        redirect('auth/login');
    }

    public function logout()
    {
        unset($_SESSION['user']);
        redirect('auth/login');
    }
}
