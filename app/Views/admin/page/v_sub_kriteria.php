<div class="container-xxl flex-grow-1 container-p-y">
    <!-- <h4 class="fw-semibold py-3 mb-4"><span class="text-muted fw-light"><= $judul ?> /</span> <= $subjudul ?></h4> -->
    <div class="card mb-4">
        <h5 class="card-header"></span> <?= $subjudul ?></h5>
        <div class="card-body">
            <div id="isiTable"></div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" id="inputform">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_kriteria" id="id_kriteria">
                    <input type="hidden" name="id_sub_kriteria" id="id_sub_kriteria">
                    <div class="form-group mb-3">
                        <label for="nama">Nama Sub Kriteria <span style="color:red"> *</span></label>
                        <input type="text" class="form-control form-input" id="nama" name="nama" placeholder="Masukkan Nama Sub Kriteria" required>
                    </div>
                    <div class="form-group mb-3">
                        <label for="nilai">Nilai <span style="color:red"> *</span></label>
                        <input type="number" class="form-control form-input" id="nilai" name="nilai" placeholder="Masukkan Nilai" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn-simpan"><i class="fas fa-save"></i> Simpan</button>
                </div>
        </div>
        </form>
    </div>
</div>