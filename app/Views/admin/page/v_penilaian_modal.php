<?php $no = 1;
foreach ($dataSub as $key => $value) { ?>
    <div class="form-group mb-3">
        <label for="sub_kriteria_<?= $no ?>"><?= $key ?> <span style="color:red"> *</span></label>
        <select class="form-control" name="sub_kriteria[]" id="sub_kriteria_<?= $no ?>" required>
            <option value="" selected disabled>-- Pilih --</option>
            <?php foreach ($value as $val) { ?>
                <option value="<?= $val['id_sub'] ?>" <?= in_array($val['id_sub'], $penilaian) ? 'selected' : ''; ?>><?= $val['nama_sub'] ?></option>
            <?php } ?>
        </select>
    </div>
<?php
    $no++;
} ?>

<hr>
<div align="right">
    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
        Close
    </button>
    <button type="submit" class="btn btn-primary" id="btn-simpan"><i class="fas fa-save"></i> Simpan</button>
</div>