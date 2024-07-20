<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\UserModel;

class User extends BaseController
{
    public function __construct()
    {
        $this->m_user = new UserModel();
    }

    public function index()
    {
        $data = [
            'judul'     => 'Setting',
            'subjudul'  => 'User Manajemen',
            'isi'       => 'admin/page/v_user',
            'script'    => 'admin/script/script_user'
        ];

        return view('admin/layout/wrapper', $data);
    }

    public function datatables()
    {
        $draw   = intval($this->request->getPost("draw"));
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
        $search = $this->request->getPost('search');

        $result                 = $this->m_user->results($length, $start, $search);
        $totalRecords           = $this->m_user->count_all();
        $totalRecordsWithFilter = $this->m_user->total_record_with_filter($search);

        $aksi        = '';
        $data        = [];
        $no          = $start + 1;
        foreach ($result as $key => $r) :

            $aksi = '<a href="javascript:;" class="btn btn-warning btn-sm bedit" data="' . $r['id'] . '" ><i class="fa fa-edit nav-icon"></i></a>';
            $aksi .= ' <a href="javascript:;" class="btn btn-danger btn-sm bhapus" data="' . $r['id'] . '"><i class="fa fa-trash nav-icon"></i></a>';

            $data[$key][]    = $no++;
            $data[$key][]    = $r['username'];
            $data[$key][]    = $r['email'];
            $data[$key][]    = ($r['last_login']) == NULL ? 'Belum Pernah Login' : $r['last_login'];
            $data[$key][]    = $r['status'];
            $data[$key][]     = $aksi;

        endforeach;

        $response = [
            "draw"             => intval($draw),
            "recordsTotal"     => $totalRecords,
            "recordsFiltered"  => $totalRecordsWithFilter,
            "data"             => $data
        ];

        echo json_encode($response);
        return;
    }

    public function store()
    {
        $username   = $this->request->getPost("username");
        $email      = $this->request->getPost("email");
        $password   = $this->request->getPost("password1");
        $password2  = $this->request->getPost("password2");
        $user_group = $this->request->getPost("user_group");
        $status     = $this->request->getPost("status");

        ### Cek sudah ada username yang terdaftar atau belum ###
        $param_cek = [
            'table' => 'set_user',
            'where' => [
                'username' => $username
            ]
        ];
        $cek = $this->m_user->select_with_param($param_cek);

        if ($cek) {
            $return = [
                'status' => FALSE,
                'message' => 'Username sudah terdaftar'
            ];

            echo json_encode($return);
            return;
        }
        ############# Cek passwordnya sama atau tidak ##############

        if ($password != $password2) {
            $return = [
                'status' => FALSE,
                'message' => 'Password Tidak Cocok'
            ];

            echo json_encode($return);
            return;
        }
        ###########################################################

        $param = [
            'table' => 'set_user',
            'data' => [
                'username'      => $username,
                'id_group'      => $user_group,
                'email'         => $email,
                'password'      => password_hash($password, PASSWORD_DEFAULT),
                'status'        => $status,
                'created_at'    => date('Y-m-d H:i:s'),
                // "created_by" => $this->session->userdata('username'),
                'created_by'    => 'system',
                'photo'         => 'default.jpg',
            ]
        ];

        $insert = $this->m_user->insert_with_param($param);

        if ($insert) {
            $return = [
                'status' => TRUE,
                'message' => 'Berhasil'
            ];
        } else {
            $return = [
                'status' => FALSE,
                'message' => 'Gagal menyimpan data'
            ];
        }

        echo json_encode($return);
        return;
    }

    public function showedit()
    {
        $id = $this->request->getPost("id");

        $param = [
            'table' => 'set_user',
            'where' => [
                'id' => $id
            ]
        ];

        $result = $this->m_user->select_with_param_row($param);

        if ($result) {
            $return = [
                'data' => $result,
                'status' => TRUE,
                'message' => 'Berhasil Ambil Data'
            ];
        } else {
            $return = [
                'status' => FALSE,
                'message' => 'Gagal Ambil Data'
            ];
        }
        echo json_encode($return);
        return;
    }

    public function store_edit()
    {
        $id         = $this->request->getPost("kodedit");
        $nama       = $this->request->getPost("enama");
        $keterangan = $this->request->getPost("eketerangan");

        $param = [
            'table' => 'set_group',
            'data' => [
                'nama'       => $nama,
                'keterangan' => $keterangan,
                "updated_at" => date('Y-m-d H:i:s'),
                // "updated_by" => $this->session->userdata('username'),
                "updated_by" => 'sistem'
            ],
            'where' => [
                'id' => $id
            ]
        ];

        $update = $this->m_user->update_with_param($param);

        if ($update > 0) {
            $return = [
                'status' => TRUE,
                'message' => 'Berhasil Update'
            ];
        } else {
            $return = [
                'status' => FALSE,
                'message' => 'Gagal Update'
            ];
        }

        echo json_encode($return);
        return;
    }

    public function destroy()
    {
        $id         = $this->request->getPost("id");

        $param = [
            'table' => 'set_user',
            'data' => [
                "deleted_at" => date('Y-m-d H:i:s'),
                // "deleted_by" => $this->session->userdata('username'),
                "deleted_by" => 'sistem'
            ],
            'where' => [
                'id' => $id
            ]
        ];

        $destroy = $this->m_user->update_with_param($param);

        if ($destroy > 0) {
            $return = [
                'status' => TRUE,
                'message' => 'Berhasil Hapus Data'
            ];
        } else {
            $return = [
                'status' => FALSE,
                'message' => 'Gagal Hapus Data'
            ];
        }

        echo json_encode($return);
        return;
    }

    public function list_group_js()
    {
        $param = [
            'table' => 'set_group',
            'where' => [
                'deleted_at' => NULL
            ]
        ];

        $results = $this->m_user->select_with_param($param);

        $return = [
            'status'  => TRUE,
            'message' => 'Berhasil ambil data group',
            'data'    => $results
        ];

        echo json_encode($return);
        return;
    }
}
