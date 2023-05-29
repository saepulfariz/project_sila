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
        $username = htmlspecialchars($this->request->getVar('username'), true);
        $password = htmlspecialchars($this->request->getVar('password'), true);

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

    public function proses_register()
    {
        $password = htmlspecialchars($this->request->getVar('password'), true);
        $password_retype = htmlspecialchars($this->request->getVar('password_retype'), true);



        $rules = [
            'npm' => [
                'rules'  => 'required|min_length[9]|max_length[9]|is_unique[tb_user.npm]',
                'errors' => [
                    'required' => 'You must choose a Username.',
                    'min_length' => 'Min length 9.',
                    'max_length' => 'Max length 9.',
                    'is_unique' => 'Already register.',
                ],
            ],
            'nama_lengkap' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'You must choose a Full Name.',
                ],
            ],
            'no_hp' => [
                'rules'  => 'required',
                'errors' => [
                    'required' => 'You must choose NO HP.',
                ],
            ],
            'password' => [
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required' => 'You must choose a Password',
                    'min_length' => 'Min length 3.',
                ],
            ],
            'password_retype' => [
                'rules'  => 'required|matches[password]',
                'errors' => [
                    'required' => 'You must choose a Password',
                    'matches' => 'Password not match',
                ],
            ],
            'email' => [
                'rules'  => 'required|valid_email|is_unique[tb_user.email]',
                'errors' => [
                    'required' => 'You must choose a Email',
                    'valid_email' => 'Please check the Email field. It does not appear to be valid.',
                    'is_unique' => 'Already register.',
                ],
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput();
        };

        $data = [
            'nama_lengkap' => htmlspecialchars($this->request->getVar('nama_lengkap'), true),
            'npm' => htmlspecialchars($this->request->getVar('npm'), true),
            'username' => htmlspecialchars($this->request->getVar('npm'), true),
            'email' => htmlspecialchars($this->request->getVar('email'), true),
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'no_hp' => htmlspecialchars($this->request->getVar('no_hp'), true),
            'is_active' => 1,
            'id_role' => 4,
        ];




        $data = createLog($data, 0);

        $res = $this->modeluser->save($data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Register Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Register Failed');
        }
        return redirect()->to('auth');
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
