<?php

namespace App\Models;

use CodeIgniter\Model;

class SubKriteriaModel extends Model
{
    protected $table            = 'tbl_sub_kriteria';
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

    public function results($rowperpage, $start, $searchValue)
    {
        $builder = $this->db->table($this->table);

        if (!empty($searchValue)) {
            $searchValue = strtolower($searchValue);
            $builder->like('LOWER(kode)', $searchValue);
            $builder->orLike('LOWER(nama)', $searchValue);
        }

        $builder->limit($rowperpage, $start);

        return $builder->get()->getResultArray();
    }

    public function count_all()
    {
        return $this->db->table($this->table)
            ->countAllResults();
    }

    public function total_record_with_filter($searchValue)
    {
        $builder = $this->db->table($this->table);

        if (!empty($searchValue)) {
            $searchValue = strtolower($searchValue);
            $builder->like('LOWER(kode)', $searchValue);
            $builder->orLike('LOWER(nama)', $searchValue);
        }

        return $builder->countAllResults();
    }

    public function getKriteria()
    {
        return $this
            ->db
            ->table('tbl_kriteria k')
            ->select("sk.id_sub, sk.nama_sub, sk.nilai_sub, k.id as id_kriteria, CONCAT(k.kode, ' (', k.nama, ')') as kriteria")
            ->join($this->table . ' sk', 'sk.id_kriteria=k.id', 'left')
            ->orderBy('id')
            ->get()
            ->getResult();
    }
}
