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
                    <input type="hidden" name="param" id="param" value="<?php echo $edit_data['id_dokter']; ?>">
                <?php
                }
                ?>
                <div class="form-group">
                    <label for="id_dokter">Identitas Dokter</label>
                    <input type="text" name="id_dokter" id="id_dokter" value="<?php echo empty(set_value('id_dokter')) ? (empty($edit_data['id_dokter']) ? "" : $edit_data['id_dokter']) : set_value('id_dokter'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="nama_dokter">Nama Dokter</label>
                    <input type="text" name="nama_dokter" id="nama_dokter" value="<?php echo empty(set_value('nama_dokter')) ? (empty($edit_data['nama_dokter']) ? "" : $edit_data['nama_dokter']) : set_value('nama_dokter'); ?>" class="form-control">
                </div>
                <div class="form-group">
                    <label for="jenis_kelamin">Jenis Kelamin</label>
                    <input type="text" name="jenis_kelamin" id="jenis_kelamin" value="<?php echo empty(set_value('jenis_kelamin')) ? (empty($edit_data['jenis_kelamin']) ? "" : $edit_data['jenis_kelamin']) : set_value('jenis_kelamin'); ?>"class="form-control">
                </div>
                <div class="form-group">
                    <label for="pemeriksaan">Pemeriksaan</label>
                    <input type="text" name="pemeriksaan" id="pemeriksaan" value="<?php echo empty(set_value('pemeriksaan')) ? (empty($edit_data['pemeriksaan']) ? "" : $edit_data['pemeriksaan']) : set_value('pemeriksaan'); ?>"class="form-control">
                </div>
                <div class="form-group">
                    <label for="pengobatan">Pengobatan</label>
                    <input type="text" name="pengobatan" id="pengobatan" value="<?php echo empty(set_value('pengobatan')) ? (empty($edit_data['pengobatan']) ? "" : $edit_data['pengobatan']) : set_value('pengobatan'); ?>"class="form-control">
                </div>
                <div class="form-group">
                    <label for="diagnosis_penyakit">Diagnosis Penyakit</label>
                    <input type="text" name="diagnosis_penyakit" id="diagnosis_penyakit" value="<?php echo empty(set_value('diagnosis_penyakit')) ? (empty($edit_data['diagnosis_penyakit']) ? "" : $edit_data['diagnosis_penyakit']) : set_value('diagnosis_penyakit'); ?>"class="form-control">   
                </div> 
                <div class="form-group">
                    <label for="meracik_obat">Meracik Obat</label>
                    <input type="text" name="meracik_obat" id="meracik_obat" value="<?php echo empty(set_value('meracik_obat')) ? (empty($edit_data['meracik_obat']) ? "" : $edit_data['meracik_obat']) : set_value('meracik_obat'); ?>"class="form-control">   
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