<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>

<head>
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
</head>

<!-- Base style - Hover table start -->
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header borderless">
                <h5>Tabel Kerja Prodi</h5>
                <span>This example shows DataTables with just the hover class specified. This class will instruct DataTables' styling to highlight a row when the mouse is hovered over it.</span>

                <div class="card-header-right">
                    <ul class="list-unstyled card-option">
                        <li data-toggle="modal" data-target="#filterModal">
                            <i class="feather icon-search" id="filter"></i>
                        </li>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="card-block">
                <div class="dt-responsive table-responsive">
                    <table id="table-style-hover" class="table table-striped table-hover table-bordered nowrap">
                        <thead>
                            <tr>
                                <th>Nama</th>
                                <th>Prodi</th>
                                <th>Nama Perusahaan</th>
                                <th>Email</th>
                                <th>Nomor Telepon</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pekerjaan->getResultArray() as $data => $d) { ?>
                                <tr>
                                    <td><?= $d['NAMA'] ?></td>
                                    <td><?= $d['PRODI'] ?></td>
                                    <td><?= $d['INSTITUSI'] ?></td>
                                    <td><?= $d['EMAIL'] ?></td>
                                    <td><?= $d['TLP'] ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nama Prodi</th>
                                <th>Angkatan</th>
                                <th>Nama Perusahaan</th>
                                <th>Jenis Pekerjaan</th>
                                <th>Kategori Pekerjaan</th>
                            </tr>
                        </tfoot>
                    </table>
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
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <form method="POST" action="/filter-menu3">
                            <div class="row">
                                <div class="col-sm-12 m-b-30">
                                    <h4 class="sub-title">Program Studi</h4>
                                    <select name="prodi" class="form-control form-control-inverse">
                                        <option value="">Pilih</option>
                                        <?php if ($prodi) {
                                            foreach ($prodi->getResultArray() as $key => $data) { ?>
                                                <option value="<?= $data['PRODI'] ?>"><?= $data['PRODI'] ?></option>
                                        <?php    }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 m-b-30">
                                    <h4 class="sub-title">Angkatan</h4>
                                    <select name="angkatan" class="form-control form-control-inverse">
                                        <option value="">Pilih</option>
                                        <?php if ($angkatan) {
                                            foreach ($angkatan->getResultArray() as $key => $data) { ?>
                                                <option value="<?= $data["ANGKATAN"] ?>"><?= $data["ANGKATAN"] ?></option>
                                        <?php    }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 m-b-30">
                                    <h4 class="sub-title">Perusahaan</h4>
                                    <select name="perusahaan" class="form-control form-control-inverse">
                                        <option value="">Pilih</option>
                                        <?php if ($perusahaan) {
                                            foreach ($perusahaan->getResultArray() as $key => $data) { ?>
                                                <option value="<?= $data["INSTITUSI"] ?>"><?= $data["INSTITUSI"] ?></option>
                                        <?php   }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 m-b-30">
                                    <h4 class="sub-title">Jenis Pekerjaan</h4>
                                    <select name="j_pekerjaan" class="form-control form-control-inverse">
                                        <option value="">Pilih</option>
                                        <?php if ($jenis) {
                                            foreach ($jenis->getResultArray() as $key => $data) { ?>
                                                <option value="<?= $data["JENIS"] ?>"><?= $data["JENIS"] ?></option>
                                        <?php   }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 m-b-30">
                                    <h4 class="sub-title">Kategori Pekerjaan</h4>
                                    <select name="kategori" class="form-control form-control-inverse">
                                        <option value="">Pilih</option>
                                        <?php if ($kategori) {
                                            foreach ($kategori->getResultArray() as $key => $data) { ?>
                                                <option value="<?= $data["KATEGORI"] ?>"><?= $data["KATEGORI"] ?></option>
                                        <?php   }
                                        } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-2">
                                    <button class="btn btn-success w-100">Filter</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12 mb-2">
                                    <button type="button" class="btn btn-secondary w-100" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <!-- Default select end -->
                </div>
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
<script src="/files/assets/pages/data-table/js/data-table-custom.js"></script>
<?= $this->endSection() ?>