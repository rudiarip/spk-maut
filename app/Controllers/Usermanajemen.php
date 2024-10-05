<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsermanajemenModel;

class Usermanajemen extends BaseController
{
    public function __construct()
    {
        $this->m_user = new UsermanajemenModel();
    }

    public function index()
    {
        $data = [
            'judul'     => 'User Management',
            'subjudul'  => 'List User',
            'uri1'      => $this->request->uri->getSegment(1),
            'isi'       => 'admin/page/v_user_manajemen',
            'script'    => 'admin/script/script_user_manajemen'
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

        $aksi = '';
        $data = [];
        $no   = $start + 1;
        foreach ($result as $key => $r) :

            $aksi = '<a href="javascript:;" class="btn btn-warning btn-sm bedit" onclick="editData(\'' . $r->id . '\',\'' . $r->username . '\',\'' . $r->full_name . '\',\'' . $r->status . '\')"><i class="fa fa-edit nav-icon"></i> Edit</a>';

            $data[$key][] = $no++;
            $data[$key][] = $r->username;
            $data[$key][] = $r->full_name;
            $data[$key][] = $aksi;

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
        $id            = $this->request->getPost("id_user");
        $username      = $this->request->getPost("username");
        $nama_lengkap  = $this->request->getPost("nama_lengkap");
        $status        = $this->request->getPost("status");
        $password      = $this->request->getPost("password");
        $password2     = $this->request->getPost("password2");
        $created_by    = session()->get('user_data')['username'];
        $created_at    = date('Y-m-d H:i:s');

        if ($id == '') {

            if ($password !== $password2) {
                $return = [
                    'status' => FALSE,
                    'message' => 'Password tidak cocok'
                ];
                return $this->response->setJSON($return);
            }

            $cekUsername = $this->m_user->cekUsername($username);
            if ($cekUsername) {
                $return = [
                    'status' => FALSE,
                    'message' => 'Maaf! Username sudah terdaftar'
                ];
                return $this->response->setJSON($return);
            }

            $param = [
                'table' => 'tbl_login',
                'data' => [
                    'username'   => $username,
                    'full_name'  => $nama_lengkap,
                    'password'   => password_hash($password, PASSWORD_DEFAULT),
                    'level'      => 'admin',
                    'status'     => 1,
                    "created_at" => $created_at,
                    "created_by" => $created_by,
                ]
            ];

            $action = $this->m_user->insert_with_param($param);
        } else {
            $param = [
                'table' => 'tbl_login',
                'data' => [
                    'username'   => $username,
                    'full_name'  => $nama_lengkap,
                    'status'     => $status,
                    "updated_at" => $created_at,
                    "updated_by" => $created_by,
                ],
                'where' => [
                    'id' => $id
                ]
            ];

            $action = $this->m_user->update_with_param($param);
        }

        if ($action) {
            $return = [
                'status' => TRUE,
                'message' => 'Berhasil menyimpan data'
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
}
