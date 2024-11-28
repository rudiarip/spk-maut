<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\KriteriaModel;

class Kriteria extends BaseController
{
    public function __construct()
    {
        $this->m_kriteria = new KriteriaModel();
    }

    public function index()
    {
        $data = [
            'judul'     => 'Kriteria',
            'subjudul'  => 'List Kriteria',
            'uri1'      => $this->request->uri->getSegment(1),
            'isi'       => 'admin/page/v_kriteria',
            'script'    => 'admin/script/script_kriteria'
        ];

        return view('admin/layout/wrapper', $data);
    }

    public function datatables()
    {
        $draw   = intval($this->request->getPost("draw"));
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
        $search = $this->request->getPost('search');

        $result                 = $this->m_kriteria->results($length, $start, $search);
        $totalRecords           = $this->m_kriteria->count_all();
        $totalRecordsWithFilter = $this->m_kriteria->total_record_with_filter($search);

        $aksi        = '';
        $data        = [];
        $no          = $start + 1;
        foreach ($result as $key => $r) :

            $aksi = '<a href="javascript:;" class="btn btn-warning btn-sm bedit" onclick="editData(\'' . $r->id . '\',\'' . $r->kode . '\',\'' . $r->nama . '\',\'' . $r->bobot . '\')"><i class="fa fa-edit nav-icon"></i> Edit</a>';
            // $aksi .= ' <a href="javascript:;" class="btn btn-danger btn-sm bhapus" data="' . $r['id'] . '"><i class="fa fa-trash nav-icon"></i></a>';

            $data[$key][]    = $no++;
            $data[$key][]    = $r->kode;
            $data[$key][]    = $r->nama;
            $data[$key][]    = $r->bobot;
            // $data[$key][]    = date('d F Y', strtotime($r['created_at']));
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
        $id    = $this->request->getPost("id_kriteria");
        $kode  = $this->request->getPost("kode");
        $nama  = $this->request->getPost("nama");
        $bobot = $this->request->getPost("bobot");

        if ($id == '') {
            $param = [
                'table' => 'tbl_kriteria',
                'data' => [
                    'kode'      => $kode,
                    'nama'      => $nama,
                    'bobot'     => $bobot,
                    "created_at" => date('Y-m-d H:i:s'),
                    "created_by" => session()->get('user_data')['username'],
                    // "created_by" => 'system',
                ]
            ];

            $action = $this->m_kriteria->insert_with_param($param);
        } else {
            $param = [
                'table' => 'tbl_kriteria',
                'data' => [
                    'kode'      => $kode,
                    'nama'      => $nama,
                    'bobot'     => $bobot,
                    "updated_at" => date('Y-m-d H:i:s'),
                    "updated_by" => session()->get('user_data')['username'],
                    // "updated_by" => 'system',
                ],
                'where' => [
                    'id' => $id
                ]
            ];

            $action = $this->m_kriteria->update_with_param($param);
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
