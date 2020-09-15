<?= $this->extend('layouts/main') ?>


<?= $this->section('content') ?>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h5>Jumlah Bekerja Per Prodi</h5>
                <span>lorem ipsum dolor sit amet, consectetur adipisicing elit</span>
            </div>
            <div class="card-block">
                <canvas id="barChart" height="90%"></canvas>
            </div>
        </div>
    </div>
</div>

<!-- Chart js -->
<script type="text/javascript" src="/files/bower_components/chart.js/js/Chart.js"></script>

<script>
    "use strict";
    $(document).ready(function() {
        /*Bar chart*/
        const label = []
        const data = []
        const backgroundColor = []
        <?php foreach ($jumKerjaProdi->getResultArray() as $data => $d) { ?>
            label["<?= $data ?>"] = "<?= $d['PRODI'] ?>"
            data["<?= $data ?>"] = parseInt("<?= $d['JUMLAH'] ?>")
        <?php } ?>
        data.push(0)
        for (let index = 0; index < label.length; index++) {
            backgroundColor[index] = `rgba(${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, ${Math.floor(Math.random() * 255)}, 0.5)`
        }
        var data1 = {
            labels: label,
            datasets: [{
                label: "Data",
                backgroundColor: backgroundColor,
                data: data,
            }, ],
        };

        var bar = document.getElementById("barChart").getContext("2d");
        var myBarChart = new Chart(bar, {
            type: "bar",
            data: data1,
            options: {
                barValueSpacing: 20,
            },
        });
    });
</script>
</body>

</html>

<?= $this->endSection() ?>