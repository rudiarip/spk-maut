<?php

namespace App\Models;

use CodeIgniter\Model;

class PerhitunganModel extends Model
{
    protected $table            = 'tbl_penilaian';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function select_with_param($param)
    {
        $builder = $this->db->table($param['table']);

        $builder->select('*');

        if (isset($param['where'])) {
            $builder->where($param['where']);
        }

        if (isset($param['order'])) {
            $builder->orderBy($param['order']);
        }

        return $builder->get()->getResultArray();
    }

    public function select_with_param_row($param)
    {
        $builder = $this->db->table($param['table']);

        $builder->select('*');

        if (isset($param['where'])) {
            $builder->where($param['where']);
        }

        return $builder->get()->getRow();
    }

    public function insert_with_param($param)
    {
        $builder = $this->db->table($param['table']);

        $builder->insert($param['data']);

        return $this->db->insertID();
    }

    public function update_with_param($param)
    {
        $builder = $this->db->table($param['table']);

        $builder->set($param['data']);

        if (isset($param['where'])) {
            $builder->where($param['where']);
        }

        $builder->update();

        return $this->db->affectedRows();
    }

    public function getKriteria()
    {
        return $this->db->table('tbl_kriteria')->orderBy('kode')->get()->getResult();
    }

    public function getPenilaian()
    {
        $builder = $this->db->table($this->table . ' pen');
        $builder->select('ta.nama_alternatif, sub.nilai_sub, tk.kode');
        $builder->join('tbl_alternatif ta', 'pen.id_alternatif = ta.id', 'left');
        $builder->join('tbl_sub_kriteria sub', 'sub.id_sub = pen.id_sub', 'left');
        $builder->join('tbl_kriteria tk', 'sub.id_kriteria = tk.id', 'left');
        $builder->orderBy('tk.kode');
        $builder->orderBy('ta.nama_alternatif');

        return $builder->get()->getResult();
    }

    public function normalisasiKriteria()
    {
        $query = "
        SELECT 
            kode, 
            ROUND(bobot / total_bobot, 1) AS normalisasi
        FROM 
            (
                SELECT 
                    kode, 
                    bobot, 
                    (SELECT SUM(bobot) FROM tbl_kriteria) AS total_bobot
                FROM tbl_kriteria
            ) AS subquery
        order by kode
        ";

        return $this->db->query($query)->getResult();
    }
}
