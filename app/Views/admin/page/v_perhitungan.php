<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-3">
        <h5 class="card-header"></span> Data Penilaian</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="penilaian" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Alternatif</th>
                            <?php foreach ($code as $c) { ?>
                                <th><?= $c ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($dataPenilaian as $key => $val) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $key ?></td>
                                <?php foreach ($val as $v) { ?>
                                    <td><?= $v ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <h5 class="card-header"></span> Nilai Min dan Max</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="penilaian" class="table">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>#</th>
                            <?php foreach ($code as $c) { ?>
                                <th><?= $c ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($dataMinMax as $key => $val) {
                            // echo "<pre>";
                            // var_dump($val);
                            // exit;
                        ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $key ?></td>
                                <?php foreach ($val as $v) { ?>
                                    <td><?= $v ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <h5 class="card-header"></span> Normalisasi Bobot</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="penilaian" class="table">
                    <thead>
                        <tr class="text-center">
                            <th>Faktor</th>
                            <?php foreach ($code as $c) { ?>
                                <th><?= $c ?></th>
                            <?php } ?>
                            <th>∑W</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="text-center">
                            <td>Bobot</td>
                            <?php $sumNormalisasi = 0;
                            foreach ($bobotKriteria as $nor) {
                                $sumNormalisasi += $nor;
                            ?>
                                <td><?= $nor ?></td>
                            <?php } ?>
                            <td><?= $sumNormalisasi ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <h5 class="card-header"></span> Normalisasi dengan rumus Utilitas metode Maut</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="penilaian" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Alternatif</th>
                            <?php foreach ($code as $c) { ?>
                                <th><?= $c ?></th>
                            <?php } ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($normalisasiMaut as $key => $val) {
                        ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $key ?></td>
                                <?php foreach ($val as $v) { ?>
                                    <td><?= $v ?></td>
                                <?php } ?>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="card mb-3">
        <h5 class="card-header"></span> Nilai Preferensi</h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="penilaian" class="table">
                    <thead>
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nama Alternatif</th>
                            <th>Nilai</th>
                            <th>Rank</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1;
                        foreach ($nilaiPreferensi as $keyni => $ni) { ?>
                            <tr class="text-center">
                                <td><?= $no++ ?></td>
                                <td><?= $keyni ?></td>
                                <td><?= number_format($ni['nilai'], 2) ?></td>
                                <td><?= $ni['rank'] ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>