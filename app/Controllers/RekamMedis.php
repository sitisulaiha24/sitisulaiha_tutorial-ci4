<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\RekamMedisModel;

class RekamMedis extends BaseController
{
    protected $pm;
    private $menu;
    private $rules;

    public function __construct()
    {
        $this->pm = new RekamMedisModel(); 

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
                'aktif'=>'active',
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
            'id_rekam_medis' => [
                'rules' =>'required',
                'errors' => [
                    'required' => 'Identitas RekamMedis tidak boleh kosong',
                ]
            ],
        ];

    }
    public function index()
    {

        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">RekamMedis</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item active">RekamMedis</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Data RekamMedis";

        $query = $this->pm->find();
        $data['data_RekamMedis'] = $query;

        return view('RekamMedis/content', $data);
    }
    public function tambah()
    {
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">RekamMedis</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url() . '/RekamMedis">RekamMedis</a></li>
                                <li class="breadcrumb-item active">Tambah RekamMedis</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Tambah RekamMedis';
        $data['action'] = base_url() . '/RekamMedis/simpan'; 
        return view('RekamMedis/input', $data);
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
            return redirect()->to('RekamMedis')->with('success', 'Data Berhasil Disimpan');

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
            return redirect()->to('RekamMedis')->with('success', 'Data RekamMedis Dengan Identitas '.$id.' Berhasil Dihapus');
        }catch( \CodeIgniter\Database\Exceptions\DatabaseException $th){
            return redirect()->to('RekamMedis')->with('error', $e->getMessage());
        }
    }
    public function edit($id){
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">RekamMedis</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="'. base_url() . '">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="'. base_url() . '/RekamMedis">RekamMedis</a></li>
                                <li class="breadcrumb-item active">Edit RekamMedis</li>
                            </ol>
                        </div>';
        $data['menu'] = $this->menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = 'Edit RekamMedis';
        $data['action'] = base_url() . '/RekamMedis/update'; 

        $data['edit_data'] = $this->pm->find($id);
        return view('RekamMedis/input', $data);
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
            return redirect()->to('RekamMedis')->with('success', 'Data Berhasil Diupdate');
        }catch(\CodeIgniter\Database\Exceptions\DatabaseException $e){
            session()->setFlashdata('error', $e->getMessage());
            return redirect()->back()->withInput();
        }
    }
}
