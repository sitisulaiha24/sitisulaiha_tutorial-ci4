<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\DokterModel;

class Dokter extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;

    public function __construct()
    {
        $this->pm = new DokterModel(); 

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
                'aktif'=>'active',
            ], 
            'obat'=> [
                'title'=>'obat',
                'link'=>base_url().'/obat',
                'icon'=>"fa-solid fa-capsules", 
                'aktif'=>'',
            ], 
            'pasien'=> [
                'title'=>'pasien',
                'link'=>base_url().'/pasien',
                'icon'=>"fa-solid fa-hospital-user", 
                'aktif'=>'',
            ], 
        ];

        $this->rules = [
            'id_dokter' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'Identitas dokter tidak boleh kosong',
                ]
            ],
            'nama_dokter' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'Nama dokter tidak boleh kosong',
                ]
            ],
        ];

    }
    public function index()
    {

        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Dokter</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item active">Dokter</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data Dokter";

        $query = $this->pm->find();
        $data['data_dokter'] = $query;

        return view('dokter/content', $data);
    }
    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Dokter</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url() . '/dokter">Dokter</a></li>
                                <li class="breadcrumb-item active">Tambah Dokter</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah Dokter';
        $data['action'] = base_url() . '/dokter/simpan'; 
        return view('dokter/input', $data);
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
            return redirect()->to('dokter')->with('success', 'Data Berhasil Disimpan');

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
            return redirect()->to('dokter')->with('success', 'Data Dokter Dengan Identitas '.$id.' Berhasil Dihapus');
        }catch( \CodeIgniter\Database\Exceptions\DatabaseException $th){
            return redirect()->to('dokter')->with('error', $e->getMessage());
        }
    }
    public function edit($id){
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Dokter</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url() . '/dokter">Dokter</a></li>
                                <li class="breadcrumb-item active">Edit Dokter</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Edit Dokter';
        $data['action'] = base_url() . '/dokter/update'; 

        $data['edit_data'] = $this->pm->find($id);
        return view('dokter/input', $data);
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
            return redirect()->to('dokter')->with('success', 'Data Berhasil Diupdate');
        }catch(\CodeIgniter\Database\Exceptions\DatabaseException $e){
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
