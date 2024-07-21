<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\PenilaianModel;

class Penilaian extends BaseController
{
    public function __construct()
    {
        $this->m_penilaian = new PenilaianModel();
    }

    public function index()
    {
        $data = [
            'judul'     => 'Penilaian',
            'subjudul'  => 'List Penilaian',
            'uri1'      => $this->request->uri->getSegment(1),
            'isi'       => 'admin/page/v_penilaian',
            'script'    => 'admin/script/script_penilaian'
        ];

        return view('admin/layout/wrapper', $data);
    }

    public function loadModal()
    {
        $id_alternatif = $this->request->getPost("id_alternatif");

        ### Get sub kriteria
        $results = $this->m_penilaian->getSubKriteria();
        $data = [];
        foreach ($results as $r) {
            $data[$r->kriteria][] = [
                'id_sub' => $r->id_sub,
                'nama_sub' => $r->nama_sub,
                'nilai_sub' => $r->nilai_sub,
                'id_kriteria' => $r->id_kriteria,
            ];
        }

        ### Get penilaian by id alternatif
        $results_penilaian = $this->m_penilaian->getPenilaianByAlternatif($id_alternatif);
        $results_penilaian = array_column($results_penilaian, 'id_sub');

        $data2['dataSub'] = $data;
        $data2['penilaian'] = $results_penilaian;

        return view('admin/page/v_penilaian_modal', $data2);
    }

    public function datatables()
    {
        $draw   = intval($this->request->getPost("draw"));
        $start  = intval($this->request->getPost("start"));
        $length = intval($this->request->getPost("length"));
        $search = $this->request->getPost('search');

        $result                 = $this->m_penilaian->results($length, $start, $search);
        $totalRecords           = $this->m_penilaian->count_all();
        $totalRecordsWithFilter = $this->m_penilaian->total_record_with_filter($search);

        $data        = [];
        $no          = $start + 1;
        foreach ($result as $key => $r) :
            $aksi        = '';

            if ($r->cek_id_penilaian) {
                $aksi = '<a href="javascript:;" class="btn btn-warning btn-sm" onclick="loadModal(\'' . $r->id . '\')"><i class="fa fa-edit nav-icon"></i> Edit</a>';
            } else {
                $aksi = '<a href="javascript:;" class="btn btn-success btn-sm" onclick="loadModal(\'' . $r->id . '\')"><i class="fa fa-edit nav-icon"></i> Tambah</a>';
            }

            $data[$key][]  = $no++;
            $data[$key][]  = $r->nama_alternatif;
            $data[$key][]  = $aksi;

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
        $db = db_connect();
        $id_alternatif  = $this->request->getPost("id_alternatif");
        $subArr         = $this->request->getPost("sub_kriteria");
        $now            = date('Y-m-d H:i:s');
        $user           = 'System';
        // $user = $this->session->userdata('username') ? $this->session->userdata('username') : 'System';

        $getPenilaian = $this->m_penilaian->getPenilaianByAlternatif($id_alternatif);

        if (empty($getPenilaian)) {
            $row = [];
            $allRow = [];

            foreach ($subArr as $s) {
                $row['id_alternatif'] = $id_alternatif;
                $row['id_sub'] = $s;
                $row['created_at'] = $now;
                $row['created_by'] = $user;

                $allRow[] = $row;
            }

            $action = $this->m_penilaian->insert_batch('tbl_penilaian', $allRow);
        } else {
            $subExist = array_column($getPenilaian, 'id_sub');

            ### Delete data yang Sub IDnya tidak ada di $subArr
            $db->table('tbl_penilaian')
                ->where('id_alternatif', $id_alternatif)
                ->whereNotIn('id_sub', $subArr)
                ->delete();
            ###

            foreach ($subArr as $id) {

                if (in_array($id, $subExist)) {

                    $data = [
                        'id_alternatif' => $id_alternatif,
                        'id_sub'        => $id,
                        'updated_at'    => $now,
                        'updated_by'    => $user
                    ];

                    $builder = $db->table('tbl_penilaian')
                        ->where('id_alternatif', $id_alternatif)
                        ->where('id_sub', $id)
                        ->update($data);
                    $action = $db->affectedRows();
                } else {
                    $data = [
                        'id_alternatif' => $id_alternatif,
                        'id_sub'        => $id,
                        'created_at'    => $now,
                        'created_by'    => $user
                    ];

                    $builder = $db->table('tbl_penilaian');
                    $builder->insert($data);
                    $action = $db->affectedRows();
                }
            }
        }

        if ($action > 0) {
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
