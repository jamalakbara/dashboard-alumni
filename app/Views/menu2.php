<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h5>Bidang Pekerjaan</h5>
                <span>This example shows DataTables with just the hover class specified. This class will instruct DataTables' styling to highlight a row when the mouse is hovered over it.</span>
            </div>
            <div class="card-block">
                <!-- sale card start -->
                <div class="row">
                    <?php foreach ($bidang->getResultArray() as $data => $d) { ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-c-green total-card" style="height: 10em;">
                                <div class="card-block">
                                    <div class="text-left">
                                        <h4><?= $d['JUMLAH'] ?></h4>
                                        <p class="m-0"><?= $d['BDG_PERUSAHAAN'] ?></p>
                                    </div>
                                    <span class="label bg-c-green value-badges"><?= number_format(((float)$d['JUMLAH'] / $totalLulus), 4, '.', '') * 100 ?>%</span>
                                </div>
                                <!-- <div id="total-value-graph-2" style="height: 100px;"></div> -->
                            </div>
                        </div>
                    <?php } ?>
                </div>
                <!-- sale card end -->
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>