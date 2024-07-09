<?php

namespace App\Models;

use CodeIgniter\Model;

class PackagesModel extends Model
{
    protected $table            = 'packages';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['sender','sender_mobile', 'recipient', 'recipient_mobile', 'origin_id', 'destination_id', 'status', 'paid_amount', 'time', 'user_id', 'description'];

    // protected bool $allowEmptyInserts = false;
    // protected bool $updateOnlyChanged = true;

    // protected array $casts = [];
    // protected array $castHandlers = [];

    // // Dates
    // protected $useTimestamps = false;
    // protected $dateFormat    = 'datetime';
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $deletedField  = 'deleted_at';

    // // Validation
    // protected $validationRules      = [];
    // protected $validationMessages   = [];
    // protected $skipValidation       = false;
    // protected $cleanValidationRules = true;

    // // Callbacks
    // protected $allowCallbacks = true;
    // protected $beforeInsert   = [];
    // protected $afterInsert    = [];
    // protected $beforeUpdate   = [];
    // protected $afterUpdate    = [];
    // protected $beforeFind     = [];
    // protected $afterFind      = [];
    // protected $beforeDelete   = [];
    // protected $afterDelete    = [];

    public function getPackagesWithUsernames()
    {
        return $this->select('packages.*, origin.username as origin_name, destination.username as destination_name')
                    ->join('auth as origin', 'packages.origin_id = origin.id')
                    ->join('auth as destination', 'packages.destination_id = destination.id')
                    ->findAll();
    }

    public function incoming($id)
    {
        return $this->select('packages.*, origin.username as origin_name, destination.username as destination_name')
                    ->join('auth as origin', 'packages.origin_id = origin.id')
                    ->join('auth as destination', 'packages.destination_id = destination.id')
                    ->where('destination_id', $id)
                    ->findAll();
    }

    public function outgoing($id)
    {
        return $this->select('packages.*, origin.username as origin_name, destination.username as destination_name')
        ->join('auth as origin', 'packages.origin_id = origin.id')
        ->join('auth as destination', 'packages.destination_id = destination.id')
        ->where('origin_id', $id)
        ->findAll();
    }
}
