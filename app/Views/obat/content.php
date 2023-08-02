<?php
echo $this->extend('template/index');
echo $this->section('content');
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            
            <div class="card-header">
                <h3 class="card-title"><?php echo $title_card; ?></h3>
            </div>
            <!-- /.card-header -->
            <?php
                if(session()->getFlashdata('success')){
                ?>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-warning"></i> Success</h5>
                        <?php echo session()->getFlashdata('success'); ?>
                    </div>
                <?php
                }
                ?>

            <div class="card-body">
                <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>/obat/tambah"><i class="fa-solid fa-plus"></i>Tambah Obat</a>
            <table class="table">
                <thead>
                    <tr>
                    <th style="width: 10px">#</th>
                    <th>kode obat</th>
                    <th>Nama obat</th>
                    <th>Jenis Obat</th>
                    <th>Tahun Produksi</th>
                    <th>Masa Berlaku</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_obat as $r){
                    
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $r['kode_obat']; ?></td>
                        <td><?php echo $r['nama_obat']; ?></td>
                        <td><?php echo $r['jenis_obat']; ?></td>
                        <td><?php echo $r['tahun_produksi']; ?></td>
                        <td><?php echo $r['masa_berlaku']; ?></td>
                        <td>
                            <a class="btn btn-xs btn-info" href="<?php echo base_url(); ?>/obat/edit/<?php echo $r['kode_obat']; ?>"><i class="fa-solid fa-edit"></i></a>
                            <a class="btn btn-xs btn-danger" href="#" onclick="return hapusConfig(<?php echo $r['kode_obat']; ?>);"><i class="fa-solid fa-trash"></i></a>
                        </td>
                    </tr>
                    <?php
                    $no++;
                    }
                    ?>
                </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<script>
    function hapusConfig(id){
        Swal.fire({
            title: 'Anda Yakin Akan Menghapus Data Ini?',
            text: "Data Akan Dihapus Secara Permanent!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!'
        }).then((result) => {
            if (result.isConfirmed) {
            window.location.href = '<?php echo base_url(); ?>/obat/hapus/' +id;
        }
    })
}
</script> 

<?php
echo $this->endSection();