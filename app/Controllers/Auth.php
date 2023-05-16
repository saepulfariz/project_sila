<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{

    private $modeluser;
    public function __construct()
    {
        $this->modeluser = new UserModel();
    }

    public function index()
    {
        if (session()->get('id_user')) {
            return redirect()->to('dashboard');
        }

        $data = [
            'title' => 'Login'
        ];
        return view('front/login', $data);
    }


    public function proses_login()
    {
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');

        $res = $this->modeluser->cekLogin($username);

        if (count($res) > 0) {
            $userData = $res[0];
            if (password_verify($password, $userData['password'])) {

                if ($userData['is_active'] == 1) {
                    $this->alert->set('success', 'Success', 'User Login');
                    session()->set('id_user', $userData['id_user']);
                    session()->set('username', $userData['username']);
                    session()->set('id_role', $userData['id_role']);
                    return redirect()->to('dashboard');
                } else {
                    $this->alert->set('warning', 'Warning', 'User Not Active');
                }
            } else {
                $this->alert->set('warning', 'Warning', 'Password Salah');
            }
        } else {
            $this->alert->set('warning', 'Warning', 'User Gak Ada');
        }

        return redirect()->to('auth');
    }

    public function register()
    {
        $data = [
            'title' => 'Register'
        ];

        return view('front/register', $data);
    }


    public function logout()
    {
        session()->remove('id_user');
        session()->remove('id_role');
        session()->remove('username');
        session()->destroy();

        return redirect()->to('auth');
    }
}
