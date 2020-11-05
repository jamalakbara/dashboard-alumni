<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<!-- <head> -->
<!-- Data Table Css -->
<link rel="stylesheet" type="text/css" href="/files/bower_components/datatables.net-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" type="text/css" href="/files/assets/pages/data-table/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="/files/bower_components/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css">
<!-- themify-icons line icon -->
<link rel="stylesheet" type="text/css" href="/files/assets/icon/themify-icons/themify-icons.css">
<!-- ico font -->
<link rel="stylesheet" type="text/css" href="/files/assets/icon/icofont/css/icofont.css">
<!-- Font Awesome -->
<link rel="stylesheet" type="text/css" href="/files/assets/icon/font-awesome/css/font-awesome.min.css">
<!-- Style.css -->
<link rel="stylesheet" type="text/css" href="/files/assets/css/pages.css">
<!-- </head> -->

<!-- Base style - Hover table start -->
<?php $totalData = count($pekerjaan->getResultArray()) ?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header borderless text-center">
                <h3><?= $pekerjaan->getResultArray()[0]['NAMA'] ?></h3>
            </div>
            <div class="card-block">
                <div class="row">
                    <div class="col-md-12 col-sm-12">
                        <table class="table-kastem">
                            <tr>
                                <td class="table-ket">PRODI :</td>
                                <td class="table-isi"><?= $pekerjaan->getResultArray()[0]['PRODI'] ?></td>
                            </tr>
                            <tr>
                                <td class="table-ket">NOMOR TLP :</td>
                                <td class="table-isi">
                                    <?= $pekerjaan->getResultArray()[$totalData - 1]['TLP'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-ket">EMAIL :</td>
                                <td class="table-isi">
                                    <?= $pekerjaan->getResultArray()[$totalData - 1]['EMAIL'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td class="table-ket">INSTITUSI :</td>
                                <td class="table-isi">
                                    <?php for ($i = 0; $i < $totalData; $i++) {
                                        if ($pekerjaan->getResultArray()[$i]['INSTITUSI'] != '' || $pekerjaan->getResultArray()[$i]['INSTITUSI'] != null) {
                                            if ($i == $totalData - 1) { ?>
                                                <?= $pekerjaan->getResultArray()[$i]['INSTITUSI'] ?>
                                            <?php } else { ?>
                                                <?= $pekerjaan->getResultArray()[$i]['INSTITUSI'] ?><br>
                                    <?php }
                                        }
                                    } ?>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <a href="/alumni" class="btn btn-outline-danger w-100">Kembali</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="filterModalLabel">Filter</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Base style - Hover table end -->
<!-- data-table js -->
<script src="/files/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="/files/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="/files/assets/pages/data-table/js/jszip.min.js"></script>
<script src="/files/assets/pages/data-table/js/pdfmake.min.js"></script>
<script src="/files/assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="/files/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="/files/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="/files/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="/files/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="/files/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<!-- Custom js -->
<?= $this->endSection() ?>