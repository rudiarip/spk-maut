<?php

namespace App\Models;

use CodeIgniter\Model;

class ModuleModel extends Model
{
    protected $table            = 'set_module';
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
            $builder->like('nama', $searchValue);
        }

        $builder->where('deleted_at', null);
        $builder->limit($rowperpage, $start);

        return $builder->get()->getResultArray();
    }

    public function count_all()
    {
        return $this->db->table($this->table)
            ->where('deleted_at', null)
            ->countAllResults();
    }

    public function total_record_with_filter($searchValue)
    {
        $builder = $this->db->table($this->table);

        if (!empty($searchValue)) {
            $builder->like('nama', $searchValue);
        }
        $builder->where('deleted_at', null);

        return $builder->countAllResults();
    }
}
