<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class User extends BaseController
{

    private $modeluser;
    public function __construct()
    {
        $this->modeluser = new UserModel();
    }


    public function index()
    {
        $data = [
            'title' => 'Kelola User',
            'user' => $this->modeluser->join('tb_role', 'tb_role.id_role = tb_user.id_role')->orderBy('id_user', 'ASC')->findAll()
        ];

        return view('user/index', $data);
    }


    public function new()
    {
        $data = [
            'title' => 'New User',
            'role' => $this->modeluser->getRole()
        ];

        return view('user/new', $data);
    }

    public function create()
    {
        $data = [
            'username' => $this->request->getVar('username'),
            'password' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT),
            'id_role' => $this->request->getVar('id_role'),
            'email' => $this->request->getVar('email'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'nik' => $this->request->getVar('nik'),
            'npm' => $this->request->getVar('npm'),
            'no_hp' => $this->request->getVar('no_hp'),
            'is_active' => 1,
        ];

        $rules = [
            'password'  => 'required|min_length[3]',
            'nama_lengkap'  => 'required|min_length[3]',
            'id_role'  => 'required',
            'npm'  => 'required|is_unique[tb_user.npm]',
            'no_hp'  => 'required',
            'email' => 'required|valid_email|is_unique[tb_user.email]',
            'username' => 'required|is_unique[tb_user.username]',
        ];

        if (!$this->validateData($data, $rules)) {
            $error = '';
            foreach ($this->validator->getErrors() as $key => $value) {
                $error .=  $value . ' ';
            }
            $this->alert->set('warning', 'Warning', $error);

            return redirect()->to('user/new');
        }

        $data = createLog($data, 0);

        $res = $this->modeluser->save($data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Add Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Add Failed');
        }
        return redirect()->to('user');
    }

    public function active($id, $active)
    {
        $data = [
            'is_active' => $active
        ];

        $res = $this->modeluser->update($id, $data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Active Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Active Failed');
        }
        return redirect()->to('user');
    }


    public function edit($id = null)
    {
        $data = [
            'title' => 'Edit User',
            'role' => $this->modeluser->getRole(),
            'user' => $this->modeluser->find($id)
        ];

        return view('user/edit', $data);
    }

    public function update($id = null)
    {
        $data = [
            // 'username' => $this->request->getVar('username'),
            'id_role' => $this->request->getVar('id_role'),
            'email' => $this->request->getVar('email'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'npm' => $this->request->getVar('npm'),
            'no_hp' => $this->request->getVar('no_hp'),
        ];

        $rules = [
            'nama_lengkap'  => 'required|min_length[3]',
            'id_role'  => 'required',
            'email' => 'required|valid_email',
            'npm'  => 'required',
            'no_hp'  => 'required',
        ];

        $dataUser = $this->modeluser->find($id);

        if ($data['email'] != $dataUser['email']) {
            $rules['email'] = 'required|valid_email|is_unique[tb_user.email]';
        }

        if ($data['npm'] != $dataUser['npm']) {
            $rules['npm'] = 'required|is_unique[tb_user.npm]';
        }

        if (!$this->validateData($data, $rules)) {
            $error = '';
            foreach ($this->validator->getErrors() as $key => $value) {
                $error .=  $value . ' ';
            }
            $this->alert->set('warning', 'Warning', $error);

            return redirect()->to('user/new');
        }


        $password = $this->request->getVar('password');

        if ($password != '') {
            $data['password'] = password_hash($this->request->getVar('password'), PASSWORD_DEFAULT);
        }

        $data = createLog($data, 1);

        $res = $this->modeluser->update($id, $data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Update Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Update Failed');
        }
        return redirect()->to('user');
    }


    public function delete($id)
    {
        $this->modeluser->delete($id);
        $this->alert->set('success', 'Success', 'Delete Success');
        return redirect()->to('user');
    }


    public function profile()
    {
        $data = [
            'title' => 'My Profile',
            'user' => $this->modeluser->join('tb_role', 'tb_role.id_role = tb_user.id_role')->find(session()->get('id_user'))
        ];

        return view('user/profile', $data);
    }

    public function editProfile()
    {
        $data = [
            'title' => 'My Profile',
            'user' => $this->modeluser->find(session()->get('id_user'))
        ];

        return view('user/profile_edit', $data);
    }

    public function updateProfile()
    {
        $id = session()->get('id_user');

        $data = [
            'email' => $this->request->getVar('email'),
            'nama_lengkap' => $this->request->getVar('nama_lengkap'),
            'no_hp' => $this->request->getVar('no_hp'),
        ];

        $rules = [
            'nama_lengkap'  => 'required|min_length[3]',
            'email' => 'required|valid_email',
            'no_hp' => 'required',
        ];

        $dataUser = $this->modeluser->find($id);

        if ($data['email'] != $dataUser['email']) {
            $rules['email'] = 'required|valid_email|is_unique[tb_user.email]';
        }

        if (!$this->validateData($data, $rules)) {
            $error = '';
            foreach ($this->validator->getErrors() as $key => $value) {
                $error .=  $value . ' ';
            }
            $this->alert->set('warning', 'Warning', $error);

            return redirect()->to('profile/edit');
        }

        $data = createLog($data, 1);

        $res = $this->modeluser->update($id, $data);
        if ($res) {
            $this->alert->set('success', 'Success', 'Update Success');
        } else {
            $this->alert->set('warning', 'Warning', 'Update Failed');
        }
        return redirect()->to('profile');
    }





    public function gantiPass()
    {
        $data = [
            'title' => 'Ganti Kata Sandi'
        ];

        return view('user/gantipass', $data);
    }


    public function prosesGantiPass()
    {
        $password_lama = $this->request->getVar('password_lama');
        $password_baru = $this->request->getVar('password_baru');
        $password_retype = $this->request->getVar('password_retype');

        $dataRes = $this->modeluser->find(session()->get('id_user'));

        if (password_verify($password_lama, $dataRes['password'])) {
            if ($password_baru == $password_retype) {
                $data = [
                    'password' => password_hash($password_baru, PASSWORD_DEFAULT)
                ];


                $this->modeluser->update(session()->get('id_user'), $data);

                $this->alert->set('success', 'Success', 'Password Berhasil Di Ganti');
            } else {
                $this->alert->set('warning', 'Warning', 'Password Baru Tidak Sama');
            }
        } else {
            $this->alert->set('warning', 'Warning', 'Password Lama Beda');
        }


        return redirect()->to('gantipass');
    }
}
