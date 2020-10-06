<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<?php if (session()->get('success')) { ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong><?= session()->getFlashData('success') ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<?php if (session()->get('fail')) { ?>
    <div class="alert alert-fail alert-dismissible fade show" role="alert">
        <strong><?= session()->getFlashData('fail') ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php } ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header borderless">
                <h5>Input Data Baru</h5>
                <span>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab cumque nihil eum doloremque beatae, placeat quo exercitationem velit omnis quos error dicta. Ipsa, doloremque cum qui porro consequuntur saepe enim.</span>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-12">
                        <?php echo form_open_multipart(site_url('/upload')); ?>
                        <div class="form-group">
                            <label for="file">Upload File CSV</label>
                            <input type="file" class="form-control-file" id="file" accept="text/csv" name="berkas">
                        </div>

                        <button type="submit" class="btn btn-success btn-block" name="submit">Submit</button>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>