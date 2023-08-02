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
                    <input type="hidden" name="param" id="param" value="<?php echo $edit_data['kode_obat']; ?>">
                <?php
                }
                ?>
                <div class="form-group">
                    <label for="kode_obat">Kode Obat</label>
                    <input type="text" name="kode_obat" id="kode_obat" value="<?php echo empty(set_value('kode_obat')) ? (empty($edit_data['kode_obat']) ? "" : $edit_data['kode_obat']) : set_value('kode_obat'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nama_obat">Nama Obat</label>
                    <input type="text" name="nama_obat" id="nama_obat" value="<?php echo empty(set_value('nama_obat')) ? (empty($edit_data['nama_obat']) ? "" : $edit_data['nama_obat']) : set_value('nama_obat'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="jenis_obat">Jenis Obat</label>
                    <input type="text" name="jenis_obat" id="jenis_obat" value="<?php echo empty(set_value('jenis_obat')) ? (empty($edit_data['jenis_obat']) ? "" : $edit_data['jenis_obat']) : set_value('jenis_obat'); ?>"class="form-control">
                </div>
                <div class="form-group">
                    <label for="tahun_produksi">Tahun Produksi</label>
                    <input type="text" name="tahun_produksi" id="tahun_produksi" value="<?php echo empty(set_value('tahun_produksi')) ? (empty($edit_data['tahun_produksi']) ? "" : $edit_data['tahun_produksi']) : set_value('tahun_produksi'); ?>"class="form-control">
                </div>
                <div class="form-group">
                    <label for="masa_berlaku">Masa Berlaku</label>
                    <input type="text" name="masa_berlaku" id="masa_berlaku" value="<?php echo empty(set_value('masa_berlaku')) ? (empty($edit_data['masa_berlaku']) ? "" : $edit_data['masa_berlaku']) : set_value('masa_berlaku'); ?>"class="form-control">
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