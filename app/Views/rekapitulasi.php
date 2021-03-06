<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>


<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header borderless">
                <h5>Total Lulus</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card bg-c-blue total-card">
                            <div class="card-block">
                                <div class="text-left">
                                    <h4><?= $totalLulus ?></h4>
                                    <p class="m-0">Total Lulus</p>
                                </div>
                                <!-- <span class="label bg-c-blue value-badges">12%</span> -->
                            </div>
                            <!-- <div id="total-value-graph-1" style="height: 100px;"></div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header borderless">
                <h5>Jenis Pekerjaan</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <!-- sale card start -->
                    <?php foreach ($jenis->getResultArray() as $data => $d) { ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-c-red total-card d-flex justify-content-around" style="height: 100%;">
                                <div class="card-block">
                                    <div class="text-left">
                                        <h4><?= $d['JUMLAH'] ?></h4>
                                        <p class="m-0" style="font-size: .8em;"><?= $d['JENIS'] ?></p>
                                    </div>
                                    <span class="label bg-c-red value-badges"><?= number_format(((float)$d['JUMLAH'] / $totalLulus), 4, '.', '') * 100 ?>%</span>
                                </div>
                                <!-- <div id="total-value-graph-2" style="height: 100px;"></div> -->
                            </div>
                        </div>
                    <?php } ?>
                    <!-- sale card end -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header borderless">
                <h5>Cluster</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <!-- sale card start -->
                    <?php foreach ($cluster as $key_cluster => $value_cluster) { ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-c-green total-card">
                                <div class="card-block">
                                    <div class="text-left">
                                        <h4><?= $value_cluster ?></h4>
                                        <p class="m-0 text-uppercase"><?= $key_cluster ?></p>
                                    </div>
                                    <span class="label bg-c-green value-badges"><?= number_format(((float)$value_cluster / $totalLulus), 4, '.', '') * 100 ?>%</span>
                                </div>
                                <!-- <div id="total-value-graph-2" style="height: 100px;"></div> -->
                            </div>
                        </div>
                    <?php } ?>
                    <!-- sale card end -->
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card">
            <div class="card-header borderless">
                <h5>Kategori Pekerjaan</h5>
            </div>
            <div class="card-block">
                <div class="row">
                    <!-- sale card start -->
                    <?php foreach ($kategori->getResultArray() as $data => $d) { ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card bg-c-yellow total-card">
                                <div class="card-block">
                                    <div class="text-left">
                                        <h4><?= $d['JUMLAH'] ?></h4>
                                        <p class="m-0"><?= $d['KATEGORI'] ?></p>
                                    </div>
                                    <span class="label bg-c-yellow value-badges"><?= number_format(((float)$d['JUMLAH'] / $totalLulus), 4, '.', '') * 100 ?>%</span>
                                </div>
                                <!-- <div id="total-value-graph-2" style="height: 100px;"></div> -->
                            </div>
                        </div>
                    <?php } ?>
                    <!-- sale card end -->
                </div>
            </div>
        </div>
    </div>

</div>

<div class="floating-filter" data-toggle="modal" data-target="#filterModal">
    <i class="feather icon-search" id="filter"></i>
</div>

<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form action="/" method="POST">
                            <div class="form-group">
                                <select name="thnKeluar" id="" class="form-control">
                                    <?php foreach ($thnKeluar as $key => $value) { ?>
                                        <option value="<?= $value ?>"><?= $value ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <button class="btn btn-success btn-block">Filter</button>
                        </form>
                    </div>
                    <!-- Default select end -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Float Chart js -->
<script src="/files/assets/pages/chart/float/jquery.flot.js"></script>
<script src="/files/assets/pages/chart/float/jquery.flot.categories.js"></script>
<script src="/files/assets/pages/chart/float/curvedLines.js"></script>
<script src="/files/assets/pages/chart/float/jquery.flot.tooltip.min.js"></script>
<!-- amchart js -->
<script src="/files/assets/pages/widget/amchart/amcharts.js"></script>
<script src="/files/assets/pages/widget/amchart/serial.js"></script>
<script src="/files/assets/pages/widget/amchart/light.js"></script>
<!-- Custom js -->
<script type="text/javascript" src="/files/assets/pages/dashboard/custom-dashboard.min.js"></script>

<?= $this->endSection() ?>