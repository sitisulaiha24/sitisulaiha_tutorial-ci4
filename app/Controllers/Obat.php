<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ObatModel;

class Obat extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;

    public function __construct()
    {
        $this->pm = new ObatModel(); 

        $this->menu = [
            'beranda'=> [
                'title'=>'Beranda',
                'link'=>base_url(),
                'icon'=>"fa-solid fa-house", 
                'aktif'=>'',
            ], 
            'RekamMedis'=> [
                'title'=>'RekamMedis',
                'link'=>base_url().'/RekamMedis',
                'icon'=>"fa-solid fa-clipboard-user", 
                'aktif'=>'',
            ], 
            'dokter'=> [
                'title'=>'dokter',
                'link'=>base_url().'/dokter',
                'icon'=>"fa-solid fa-user-doctor", 
                'aktif'=>'',
            ], 
            'obat'=> [
                'title'=>'obat',
                'link'=>base_url().'/obat',
                'icon'=>"fa-solid fa-capsules", 
                'aktif'=>'active',
            ], 
            'pasien'=> [
                'title'=>'pasien',
                'link'=>base_url().'/pasien',
                'icon'=>"fa-solid fa-hospital-user", 
                'aktif'=>'',
            ], 
        ];

        $this->rules = [
            'kode_obat' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'Identitas obat tidak boleh kosong',
                ]
            ],
            'nama_obat' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'Nama obat tidak boleh kosong',
                ]
            ],
        ];

    }
    public function index()
    {

        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Obat</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item active">Obat</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Obat";

        $query = $this->pm->find();
        $data['data_obat'] = $query;

        return view('obat/content', $data);
    }
    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Obat</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url() . '/obat">Obat</a></li>
                                <li class="breadcrumb-item active">Tambah Obat</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Obat';
        $data['action'] = base_url() . '/obat/simpan'; 
        return view('obat/input', $data);
    }
    public function simpan()
    {
        
        if (strtolower($this->request->getmethod()) !== 'post') {
            
            return redirect()->back()->withInput();
        }

        if (! $this->validate($this->rules)) {

            return redirect()->back()->withInput();
        }

        
        $dt = $this->request->getpost();
        try{
            $simpan = $this->pm->insert($dt);
            return redirect()->to('obat')->with('success', 'Data Berhasil Disimpan');

        }catch ( \CodeIgniter\Database\Exceptions\DatabaseException $e){
            
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    public function hapus($id)
    {
        if(empty($id)){
            return redirect()->back()->with('error', 'Hapus Data Gagal Dilakukan'); 
        }
        
        try{
            $this->pm->delete($id);
            return redirect()->to('obat')->with('success', 'Data Obat Dengan Identitas '.$id.' Berhasil Dihapus');
        }catch( \CodeIgniter\Database\Exceptions\DatabaseException $th){
            return redirect()->to('obat')->with('error', $e->getMessage());
        }
    }
    public function edit($id){
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Obat</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url() . '/obat">Obat</a></li>
                                <li class="breadcrumb-item active">Edit Obat</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Edit Obat';
        $data['action'] = base_url() . '/obat/update'; 

        $data['edit_data'] = $this->pm->find($id);
        return view('obat/input', $data);
    }

    public function update(){
        $dtEdit = $this->request->getPost();
        $param = $dtEdit['param'];
        unset($dtEdit['param']);

        if (! $this->validate($this->rules)) {

            return redirect()->back()->withInput();
        }

        try{
            $this->pm->update($param, $dtEdit);
            return redirect()->to('obat')->with('success', 'Data Berhasil Diupdate');
        }catch(\CodeIgniter\Database\Exceptions\DatabaseException $e){
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
