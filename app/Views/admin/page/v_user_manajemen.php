<div class="container-xxl flex-grow-1 container-p-y">
    <!-- <h4 class="fw-semibold py-3 mb-4"><span class="text-muted fw-light"><= $judul ?> /</span> <= $subjudul ?></h4> -->
    <div class="card mb-4">
        <h5 class="card-header"></span> <?= $subjudul ?></h5>
        <div class="card-body">
            <button type="button" class="btn btn-primary btn-sm mb-5" onclick="addData()">
                <i class="fas fa-plus-circle"></i> Tambah Data
            </button>
            <div class="table-responsive text-nowrap">
                <table id="user_manajemen" class="table">
                    <thead>
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Username</th>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="text-center">
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
                    <h5 class="modal-title" id="modalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="id_user" id="id_user" class="form-input">
                    <div class="form-group mb-3">
                        <label for="username">Username <span style="color:red"> *</span></label>
                        <input type="text" class="form-control form-input" id="username" name="username" placeholder="Masukkan Username" required oninput="this.value = this.value.replace(/\s+/g, '')">
                    </div>
                    <div class="form-group mb-3">
                        <label for="nama_lengkap">Nama Lengkap <span style="color:red"> *</span></label>
                        <input type="text" class="form-control form-input" id="nama_lengkap" name="nama_lengkap" placeholder="Masukkan Nama Lengkap" required>
                    </div>
                    <div class="form-group mb-3" id="showStatus">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control form-input">
                            <option>Pilih</option>
                            <option value="1">Aktif</option>
                            <option value="0">Non-Aktif</option>
                        </select>
                    </div>
                    <div id="hidePassword">
                        <div class="form-group mb-3">
                            <label for="password">Password <span style="color:red"> *</span></label>
                            <input type="password" class="form-control form-input" id="password" name="password" placeholder="Masukkan password">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password2">Ulangi Password <span style="color:red"> *</span></label>
                            <input type="password" class="form-control form-input" id="password2" name="password2" placeholder="Ulangi password">
                        </div>
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