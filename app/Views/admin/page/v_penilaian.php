<div class="container-xxl flex-grow-1 container-p-y">
    <!-- <h4 class="fw-semibold py-3 mb-4"><span class="text-muted fw-light"><= $judul ?> /</span> <= $subjudul ?></h4> -->
    <div class="card mb-4">
        <h5 class="card-header"></span> <?= $subjudul ?></h5>
        <div class="card-body">
            <div class="table-responsive text-nowrap">
                <table id="penilaian" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Alternatif</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal-add" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form enctype="multipart/form-data" id="inputform">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Isi Penilaian</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_alternatif" name="id_alternatif">
                    <div id="isiModal"></div>
                </div>
                <!-- <div class="modal-footer">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-primary" id="btn-simpan"><i class="fas fa-save"></i> Simpan</button>
                </div> -->
        </div>
        </form>
    </div>
</div>