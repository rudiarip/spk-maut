<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    public function index()
    {
        $db = db_connect();

        $hitung = [
            'totalKriteria' => $db->table('tbl_kriteria')->countAllResults(),
            'totalSub' => $db->table('tbl_sub_kriteria')->countAllResults(),
            'totalAlternatif' => $db->table('tbl_alternatif')->countAllResults(),
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
