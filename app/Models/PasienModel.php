<?php

namespace App\Models;

use CodeIgniter\Model;

class PasienModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'pasien';
    protected $primaryKey       = 'id_pasien';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['id_pasien', 'nama_pasien', 'jenis_kelamin', 'no_telp', 'alamat', 'tanggal_lahir'];


}
