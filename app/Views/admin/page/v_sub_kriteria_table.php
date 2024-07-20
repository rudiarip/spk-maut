<?php
foreach ($dataKriteria as $k => $v) {
    foreach ($v as $key => $value) {
?>
        <div class="text-center">
            <h4><span><b><?= $k ?></b></span></h4>
        </div>
        <div class="row mt-2">
            <div class="col-3">
                <button type="button" class="btn btn-primary btn-sm" onclick="addData(<?= $key ?>)">
                    <i class="fas fa-plus-circle"></i> Tambah
                </button>
            </div>
        </div>
        <div class="table-responsive text-nowrap mt-3">
            <table class="table isi-table" id="table_<?= $key ?>">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nilai</th>
                        <th>Opsi</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    <?php $no = 1;
                    foreach ($value as $val) {
                        if (!empty($val)) { ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $val['nama_sub'] ?></td>
                                <td><?= $val['nilai_sub'] ?></td>
                                <td><button type="button" class="btn btn-warning btn-sm" onclick="editData('<?= $val['id_kriteria'] ?>', '<?= $val['id_sub'] ?>', '<?= $val['nama_sub'] ?>', '<?= $val['nilai_sub'] ?>')">
                                        <i class="fa fa-edit nav-icon"></i> Edit
                                    </button>
                                </td>
                            </tr>
                    <?php }
                    } ?>
                </tbody>
            </table>
        </div>
        <hr>
    <?php } ?>
<?php } ?>