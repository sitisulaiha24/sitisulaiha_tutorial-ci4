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
                <a class="btn btn-sm btn-primary" href="<?php echo base_url(); ?>/RekamMedis/tambah"><i class="fa-solid fa-plus"></i>Tambah RekamMedis</a>
            <table class="table">
                <thead>
                    <tr>
                    <th style="width: 10px">#</th>
                    <th>id RekamMedis</th>
                    <th>Tanggal</th>
                    <th>Keluhan</th>
                    <th>Pemeriksaan</th>
                    <th>Pengobatan</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($data_RekamMedis as $r){
                    
                    ?>
                    <tr>
                        <td><?php echo $no; ?></td>
                        <td><?php echo $r['id_rekam_medis']; ?></td>
                        <td><?php echo $r['tanggal']; ?></td>
                        <td><?php echo $r['keluhan']; ?></td>
                        <td><?php echo $r['pemeriksaan']; ?></td>
                        <td><?php echo $r['pengobatan']; ?></td>
                        <td>
                            <a class="btn btn-xs btn-info" href="<?php echo base_url(); ?>/RekamMedis/edit/<?php echo $r['id_rekam_medis']; ?>"><i class="fa-solid fa-edit"></i></a>
                            <a class="btn btn-xs btn-danger" href="#" onclick="return hapusConfig(<?php echo $r['id_rekam_medis']; ?>);"><i class="fa-solid fa-trash"></i></a>
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
            window.location.href = '<?php echo base_url(); ?>/RekamMedis/hapus/' +id;
        }
    })
}
</script> 

<?php
echo $this->endSection();