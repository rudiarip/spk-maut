<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Login extends BaseController
{
    public function index()
    {
        if (session()->get('user_data') != NULL) {
            return redirect()->to(base_url());
        }

        $data['title'] =  'SPK MAUT';
        return view('admin/login', $data);
    }

    public function proses()
    {
        $session = session();

        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');

        $model = new UserModel();
        $user = $model->where('username', $username)->first();

        if ($user) {
            if (password_verify($password, $user['password'])) {

                if ($user['status'] == 1) {
                    $data = [
                        'id'        => $user['id'],
                        'username'  => $user['username'],
                        'level'     => $user['level'],
                        'full_name' => $user['full_name'],
                        'logged'    => TRUE
                    ];

                    $session->set('user_data', $data);

                    // Update Last Login
                    $paramUpdate = [
                        'last_login' => date('Y-m-d H:i:s'),
                    ];

                    $model->update($user['id'], $paramUpdate);
                    $return = [
                        'status' => TRUE,
                        'message' => 'Berhasil login',
                        'url' => base_url('dashboard')
                    ];
                    return $this->response->setJSON($return);
                } else {
                    $return = [
                        'status' => FALSE,
                        'message' => 'Maaf akun anda tidak aktif, mohon hubungi admin'
                    ];

                    return $this->response->setJSON($return);
                }
            } else {
                $return = [
                    'status' => FALSE,
                    'message' => 'Maaf password salah'
                ];
                return $this->response->setJSON($return);
            }
        } else {
            $return = [
                'status' => FALSE,
                'message' => 'Maaf username tidak ditemukan'
            ];
            return $this->response->setJSON($return);
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();

        $session->setFlashdata('success', 'Anda Telah Logout');
        return redirect()->to(base_url('login'));
    }
}
