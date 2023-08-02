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
                    <input type="hidden" name="param" id="param" value="<?php echo $edit_data['id_rekam_medis']; ?>">
                <?php
                }
                ?>
                <div class="form-group">
                    <label for="id_rekam_medis">Identitas Rekammedis</label>
                    <input type="text" name="id_rekam_medis" id="id_rekam_medis" value="<?php echo empty(set_value('id_rekam_medis')) ? (empty($edit_data['id_rekam_medis']) ? "" : $edit_data['id_rekam_medis']) : set_value('id_rekam_medis'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="tanggal">Tanggal</label>
                    <input type="text" name="tanggal" id="tanggal" value="<?php echo empty(set_value('tanggal')) ? (empty($edit_data['tanggal']) ? "" : $edit_data['tanggal']) : set_value('tanggal'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="keluhan">Keluhan</label>
                    <input type="text" name="keluhan" id="keluhan" value="<?php echo empty(set_value('keluhan')) ? (empty($edit_data['keluhan']) ? "" : $edit_data['keluhan']) : set_value('keluhan'); ?>"class="form-control">
                </div>
                <div class="form-group">
                    <label for="pemeriksaan">Pemeriksaan</label>
                    <input type="text" name="pemeriksaan" id="pemeriksaan" value="<?php echo empty(set_value('pemeriksaan')) ? (empty($edit_data['pemeriksaan']) ? "" : $edit_data['pemeriksaan']) : set_value('pemeriksaan'); ?>"class="form-control">
                </div>
                <div class="form-group">
                    <label for="pengobatan">Pengobatan</label>
                    <input type="text" name="pengobatan" id="pengobatan" value="<?php echo empty(set_value('pengobatan')) ? (empty($edit_data['pengobatan']) ? "" : $edit_data['pengobatan']) : set_value('pengobatan'); ?>"class="form-control">
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