<?php

namespace App\Models;

use CodeIgniter\Model;

class ObatModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'obat';
    protected $primaryKey       = 'kode_obat';
    protected $useAutoIncrement = false;
    protected $allowedFields    = ['kode_obat', 'nama_obat', 'jenis_obat', 'tahun_produksi', 'masa_berlaku'];


}
