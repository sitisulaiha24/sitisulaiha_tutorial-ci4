<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $menu = [
            'beranda'=> [
                'title'=>'Beranda',
                'link'=>base_url(),
                'icon'=>"fa-solid fa-house", 
                'aktif'=>'active',
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
                'aktif'=>'',
            ], 
            'pasien'=> [
                'title'=>'pasien',
                'link'=>base_url().'/pasien',
                'icon'=>"fa-solid fa-hospital-user",
                'aktif'=>'', 
            ], 
        ];
        $breadcrumb = '<div class="col-sm-6">
                            <h1 class="m-0">Beranda</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">Beranda</li>
                            </ol>
                        </div>';
        $data['menu'] = $menu;
        $data['breadcrumb'] = $breadcrumb;
        $data['title_card'] = "Welcome to Rumah Sakit";
        $data['selamat_datang'] = "Selamat Datang Di aplikasi Sederhana";
        return view('template/content', $data);
    }
}
