<?php

namespace App\Models;

use CodeIgniter\Model;

class RekamMedisModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'rekammedis';
    protected $primaryKey       = 'id_rekam_medis';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['id_rekam_medis', 'tanggal', 'keluhan', 'pemeriksaan', 'pengobatan'];


}
