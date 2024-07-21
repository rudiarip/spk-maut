<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\SubKriteriaModel;

class SubKriteria extends BaseController
{
    public function __construct()
    {
        $this->m_sub_kriteria = new SubKriteriaModel();
    }

    public function index()
    {
        $data = [
            'judul'     => 'Sub Kriteria',
            'subjudul'  => 'List Sub Kriteria',
            'uri1'      => $this->request->uri->getSegment(1),
            'isi'       => 'admin/page/v_sub_kriteria',
            'script'    => 'admin/script/script_sub_kriteria'
        ];

        return view('admin/layout/wrapper', $data);
    }

    public function loadTable()
    {
        $results = $this->m_sub_kriteria->getKriteria();
        $data = [];
        foreach ($results as $r) {
            if ($r->id_sub == NULL) {
                $data[$r->kriteria][$r->id_kriteria][] = [];
            } else {
                $data[$r->kriteria][$r->id_kriteria][] = [
                    'id_sub' => $r->id_sub,
                    'nama_sub' => $r->nama_sub,
                    'nilai_sub' => $r->nilai_sub,
                    'id_kriteria' => $r->id_kriteria,
                ];
            }
        }

        $data2['dataKriteria'] = $data;
        return view('admin/page/v_sub_kriteria_table', $data2);
    }

    // public function datatables()
    // {
    //     $draw   = intval($this->request->getPost("draw"));
    //     $start  = intval($this->request->getPost("start"));
    //     $length = intval($this->request->getPost("length"));
    //     $search = $this->request->getPost('search');

    //     $result                 = $this->m_sub_kriteria->results($length, $start, $search);
    //     $totalRecords           = $this->m_sub_kriteria->count_all();
    //     $totalRecordsWithFilter = $this->m_sub_kriteria->total_record_with_filter($search);

    //     $aksi        = '';
    //     $data        = [];
    //     $no          = $start + 1;
    //     foreach ($result as $key => $r) :

    //         $aksi = '<a href="javascript:;" class="btn btn-warning btn-sm bedit" onclick="editData(' . $r['id'] . ')"><i class="fa fa-edit nav-icon"></i></a>';
    //         // $aksi .= ' <a href="javascript:;" class="btn btn-danger btn-sm bhapus" data="' . $r['id'] . '"><i class="fa fa-trash nav-icon"></i></a>';

    //         $data[$key][]    = $no++;
    //         $data[$key][]    = $r['kode'];
    //         $data[$key][]    = $r['nama'];
    //         $data[$key][]    = $r['bobot'];
    //         // $data[$key][]    = date('d F Y', strtotime($r['created_at']));
    //         $data[$key][]     = $aksi;

    //     endforeach;

    //     $response = [
    //         "draw"             => intval($draw),
    //         "recordsTotal"     => $totalRecords,
    //         "recordsFiltered"  => $totalRecordsWithFilter,
    //         "data"             => $data
    //     ];

    //     echo json_encode($response);
    //     return;
    // }

    public function store()
    {
        $id_kriteria        = $this->request->getPost("id_kriteria");
        $id_sub_kriteria    = $this->request->getPost("id_sub_kriteria");
        $nama               = $this->request->getPost("nama");
        $nilai              = $this->request->getPost("nilai");

        if ($id_sub_kriteria == '' && $id_kriteria != '') {
            $param = [
                'table' => 'tbl_sub_kriteria',
                'data' => [
                    'id_kriteria'   => $id_kriteria,
                    'nama_sub'      => $nama,
                    'nilai_sub'     => $nilai,
                    "created_at" => date('Y-m-d H:i:s'),
                    // "created_by" => $this->session->userdata('username'),
                    "created_by" => 'system',
                ]
            ];

            $action = $this->m_sub_kriteria->insert_with_param($param);
        } else if ($id_sub_kriteria != '' && $id_kriteria != '') {
            $param = [
                'table' => 'tbl_sub_kriteria',
                'data' => [
                    'nama_sub'   => $nama,
                    'nilai_sub'  => $nilai,
                    "updated_at" => date('Y-m-d H:i:s'),
                    // "updated_by" => $this->session->userdata('username'),
                    "updated_by" => 'system',
                ],
                'where' => [
                    'id_sub' => $id_sub_kriteria
                ]
            ];

            $action = $this->m_sub_kriteria->update_with_param($param);
        } else {
            $return = [
                'status' => FALSE,
                'message' => 'Maaf! Kesalahan parameter'
            ];

            echo json_encode($return);
            return;
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

    // public function getEdit()
    // {
    //     $id = $this->request->getPost("id");

    //     $param = [
    //         'table' => 'tbl_kriteria',
    //         'where' => [
    //             'id' => $id
    //         ]
    //     ];

    //     $result = $this->m_sub_kriteria->select_with_param_row($param);

    //     if ($result) {
    //         $return = [
    //             'data' => $result,
    //             'status' => TRUE,
    //             'message' => 'Berhasil Ambil Data'
    //         ];
    //     } else {
    //         $return = [
    //             'status' => FALSE,
    //             'message' => 'Gagal Ambil Data'
    //         ];
    //     }
    //     echo json_encode($return);
    //     return;
    // }
}
