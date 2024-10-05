<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $db;

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function index()
    {
        // if (session()->get('user_data') == NULL) {
        //     return redirect()->to(base_url('login'));
        // }
        $hitung = [
            'totalKriteria' => $this->db->table('tbl_kriteria')->countAllResults(),
            'totalSub' => $this->db->table('tbl_sub_kriteria')->countAllResults(),
            'totalAlternatif' => $this->db->table('tbl_alternatif')->countAllResults(),
        ];

        $data = [
            'hitung'   => $hitung,
            'judul'     => 'Dashboard',
            'subjudul'  => 'Dashboard',
            'uri1'      => $this->request->uri->getSegment(1),
            'isi'       => 'admin/page/v_dashboard',
            'script'    => 'admin/script/script_dashboard'
        ];

        return view('admin/layout/wrapper', $data);
    }
}
