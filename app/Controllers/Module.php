<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModuleModel;

class Module extends BaseController
{
    public function __construct()
    {
        $this->module = new ModuleModel();
    }

    public function index()
    {
        $data = [
            'judul'     => 'Module',
            'subjudul'  => 'Module',
            'isi'       => 'admin/page/v_module',
            'script'    => 'admin/script/script_module'
        ];

        return view('admin/layout/wrapper', $data);
    }

    public function datatables()
    {
        $draw   = intval($this->request->getPost("draw"));
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
        $search = $this->request->getPost('search');

        $result                 = $this->module->results($length, $start, $search);
        $totalRecords           = $this->module->count_all();
        $totalRecordsWithFilter = $this->module->total_record_with_filter($search);

        $aksi        = '';
        $data        = [];
        $no          = $start + 1;
        foreach ($result as $key => $r) :

            $aksi = '<a href="javascript:;" class="btn btn-warning btn-sm bedit" data="' . $r['id'] . '" ><i class="fa fa-edit nav-icon"></i></a>';
            $aksi .= ' <a href="javascript:;" class="btn btn-danger btn-sm bhapus" data="' . $r['id'] . '"><i class="fa fa-trash nav-icon"></i></a>';

            $data[$key][]    = $no++;
            $data[$key][]    = $r['nama'];
            $data[$key][]    = $r['keterangan'];
            $data[$key][]    = date('d F Y', strtotime($r['created_at']));
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
        $nama       = $this->request->getPost("nama");
        $keterangan = $this->request->getPost("keterangan");

        $param = [
            'table' => 'set_group',
            'data' => [
                'nama'       => $nama,
                'keterangan' => $keterangan,
                "created_at" => date('Y-m-d H:i:s'),
                // "created_by" => $this->session->userdata('username'),
                "created_by" => 'system',
            ]
        ];

        $insert = $this->module->insert_with_param($param);

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
            'table' => 'set_group',
            'where' => [
                'id' => $id
            ]
        ];

        $result = $this->module->select_with_param_row($param);

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

        $update = $this->module->update_with_param($param);

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
            'table' => 'set_group',
            'data' => [
                "deleted_at" => date('Y-m-d H:i:s'),
                // "deleted_by" => $this->session->userdata('username'),
                "deleted_by" => 'sistem'
            ],
            'where' => [
                'id' => $id
            ]
        ];

        $destroy = $this->module->update_with_param($param);

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
}
