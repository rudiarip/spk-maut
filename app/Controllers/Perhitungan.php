<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PerhitunganModel;

class Perhitungan extends BaseController
{
    public function __construct()
    {
        $this->m_perhitungan = new PerhitunganModel();
    }

    public function index()
    {
        $getPenilaian = $this->m_perhitungan->getPenilaian();
        $allCodes     = array_column($getPenilaian, 'kode');
        $uniqueCodes  = array_unique($allCodes);

        ### Cari Penilaian
        $dataPenilaian = [];
        foreach ($getPenilaian as $nilai) {
            $dataPenilaian[$nilai->nama_alternatif][$nilai->kode] = $nilai->nilai_sub;
        }
        ###

        ### Cari Min Max
        $minMaxValues = [];
        foreach ($dataPenilaian as $values) {
            foreach ($values as $code => $value) {
                $value = (int)$value;

                if (!isset($minMaxValues['A-'][$code]) || $value < $minMaxValues['A-'][$code]) {
                    $minMaxValues['A-'][$code] = $value;
                }

                // Periksa nilai terbesar
                if (!isset($minMaxValues['A+'][$code]) || $value > $minMaxValues['A+'][$code]) {
                    $minMaxValues['A+'][$code] = $value;
                }
            }
        }
        ###

        ### Normalisasi Bobot Kriteria
        $bobotKriteria = [];
        $getNormalisasiKriteria = $this->m_perhitungan->normalisasiKriteria();

        foreach ($getNormalisasiKriteria as $nor) {
            $bobotKriteria[$nor->kode] = $nor->normalisasi;
        }
        ###

        ### Normalisasi dengan rumus Utilitas metode Maut
        $normalisasiMaut = [];

        foreach ($dataPenilaian as $kri => $value) {
            foreach ($value as $code => $val) {
                $pembagi = (float)$minMaxValues['A+'][$code] - (float)$minMaxValues['A-'][$code];
                $atas = (float) $val - (float) $minMaxValues['A-'][$code];

                $hitung = ($pembagi != 0 && $atas != 0) ? $atas / $pembagi : 0;

                $normalisasiMaut[$kri][$code] = $hitung;
            }
        }
        ###

        ### Ngitung Nilai Preferensi
        $nilaiPreferensi = [];

        foreach ($normalisasiMaut as $keyP => $valueP) {
            $hasilPreferensi = 0;

            foreach ($valueP as $codeP => $valP) {
                $hasilPreferensi += (float)$bobotKriteria[$codeP] * (float)$valP;
            }

            $nilaiPreferensi[$keyP] = $hasilPreferensi;
        }

        // buat rank
        $sorted_data = $nilaiPreferensi;
        // Urutkan array
        arsort($sorted_data);

        // Buat array baru
        $ranked = array();
        $rank = 1;

        // Tambahin rank
        foreach ($sorted_data as $key => $value) {
            $ranked[$key] = array(
                'nilai' => $value,
                'rank' => $rank++
            );
        }

        // Buat array hasil akhir dengan urutan kunci asli
        $resultNilaiPreferensi = array();

        foreach ($nilaiPreferensi as $key => $value) {
            $resultNilaiPreferensi[$key] = array(
                'nilai' => $ranked[$key]['nilai'],
                'rank' => $ranked[$key]['rank']
            );
        }
        ###

        $data = [
            'code'            => $uniqueCodes,
            'dataPenilaian'   => $dataPenilaian,
            'dataMinMax'      => $minMaxValues,
            'bobotKriteria'   => $bobotKriteria,
            'normalisasiMaut' => $normalisasiMaut,
            'nilaiPreferensi' => $resultNilaiPreferensi,
            'judul'           => 'Data perhitungan',
            'subjudul'        => '',
            'uri1'            => $this->request->uri->getSegment(1),
            'isi'             => 'admin/page/v_perhitungan',
            'script'          => 'admin/script/script_perhitungan'
        ];

        return view('admin/layout/wrapper', $data);
    }
}
