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
            <form action="<?php echo $action; ?>" method="post">
            <div class="card-body">
                <?php if (validation_errors()){
                    ?>
                        <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                            <?php echo validation_list_errors() ?>
                        </div>
                    <?php
                }
                ?>
                
                <?php
                if(session()->getFlashdata('error')){
                ?>
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-warning"></i> Error</h5>
                        <?php echo session()->getFlashdata('error'); ?>
                    </div>
                <?php
                }
                ?>

                <?php echo csrf_field()?>
                <?php
                if (current_url(true)->getSegment(2) == 'edit'){
                ?>
                    <input type="hidden" name="param" id="param" value="<?php echo $edit_data['id_pasien']; ?>">
                <?php
                }
                ?>
                <div class="form-group">
                    <label for="id_pasien">Identitas Pasien</label>
                    <input type="text" name="id_pasien" id="id_pasien" value="<?php echo empty(set_value('id_pasien')) ? (empty($edit_data['id_pasien']) ? "" : $edit_data['id_pasien']) : set_value('id_pasien'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nama_pasien">Nama Pasien</label>
                    <input type="text" name="nama_pasien" id="nama_pasien" value="<?php echo empty(set_value('nama_pasien')) ? (empty($edit_data['nama_pasien']) ? "" : $edit_data['nama_pasien']) : set_value('nama_pasien'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <input type="text" name="jenis_kelamin" id="jenis_kelamin" value="<?php echo empty(set_value('jenis_kelamin')) ? (empty($edit_data['jenis_kelamin']) ? "" : $edit_data['jenis_kelamin']) : set_value('jenis_kelamin'); ?>"class="form-control">
                </div>
                <div class="form-group">
                    <label for="no_telp">Nomer Telpon</label>
                    <input type="text" name="no_telp" id="no_telp" value="<?php echo empty(set_value('no_telp')) ? (empty($edit_data['no_telp']) ? "" : $edit_data['no_telp']) : set_value('no_telp'); ?>"class="form-control">
                </div>
                <div class="form-group">
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" value="<?php echo empty(set_value('alamat')) ? (empty($edit_data['alamat']) ? "" : $edit_data['alamat']) : set_value('alamat'); ?>"class="form-control">
                </div>
                <div class="form-group">
                    <label for="tanggal_lahir">Tanggal Lahir</label>
                    <input type="text" name="tanggal_lahir" id="tanggal_lahir" value="<?php echo empty(set_value('tanggal_lahir')) ? (empty($edit_data['tanggal_lahir']) ? "" : $edit_data['tanggal_lahir']) : set_value('tanggal_lahir'); ?>"class="form-control">   
                </div> 
            </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save"></i>Simpan</button>
                </div>  
            </form> 
        </div>
    </div>
</div>
<?php
echo $this->endSection();