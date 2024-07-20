<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\AlternatifModel;

class Alternatif extends BaseController
{
    public function __construct()
    {
        $this->m_alternatif = new AlternatifModel();
    }

    public function index()
    {
        $data = [
            'judul'     => 'Alternatif',
            'subjudul'  => 'List Alternatif',
            'uri1'      => $this->request->uri->getSegment(1),
            'isi'       => 'admin/page/v_alternatif',
            'script'    => 'admin/script/script_alternatif'
        ];

        return view('admin/layout/wrapper', $data);
    }

    public function datatables()
    {
        $draw   = intval($this->request->getPost("draw"));
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
        $search = $this->request->getPost('search');

        $result                 = $this->m_alternatif->results($length, $start, $search);
        $totalRecords           = $this->m_alternatif->count_all();
        $totalRecordsWithFilter = $this->m_alternatif->total_record_with_filter($search);

        $aksi        = '';
        $data        = [];
        $no          = $start + 1;
        foreach ($result as $key => $r) :

            $aksi = '<a href="javascript:;" class="btn btn-warning btn-sm bedit" onclick="editData(\'' . $r->id . '\', \'' . $r->nama_alternatif . '\')"><i class="fa fa-edit nav-icon"></i> Edit</a>';
            // $aksi .= ' <a href="javascript:;" class="btn btn-danger btn-sm bhapus" data="' . $r['id'] . '"><i class="fa fa-trash nav-icon"></i></a>';

            $data[$key][]    = $no++;
            $data[$key][]    = $r->nama_alternatif;
            $data[$key][]    = $aksi;

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
        $id    = $this->request->getPost("id_alternatif");
        $nama  = $this->request->getPost("nama");

        if ($id == '') {
            $param = [
                'table' => 'tbl_alternatif',
                'data' => [
                    'nama_alternatif' => $nama,
                    "created_at" => date('Y-m-d H:i:s'),
                    // "created_by" => $this->session->userdata('username'),
                    "created_by" => 'system',
                ]
            ];

            $action = $this->m_alternatif->insert_with_param($param);
        } else {
            $param = [
                'table' => 'tbl_alternatif',
                'data' => [
                    'nama_alternatif' => $nama,
                    "updated_at" => date('Y-m-d H:i:s'),
                    // "updated_by" => $this->session->userdata('username'),
                    "updated_by" => 'system',
                ],
                'where' => [
                    'id' => $id
                ]
            ];

            $action = $this->m_alternatif->update_with_param($param);
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
