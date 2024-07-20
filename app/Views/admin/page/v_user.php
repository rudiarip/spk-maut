<div class="container-xxl flex-grow-1 container-p-y">
    <!-- <h4 class="fw-semibold py-3 mb-4"><span class="text-muted fw-light"><= $judul ?> /</span> <= $subjudul ?></h4> -->
    <div class="card mb-4">
        <h5 class="card-header"></span> <?= $subjudul ?></h5>
        <div class="card-body">
            <button type="button" class="btn btn-primary mb-5" data-bs-toggle="modal" data-bs-target="#modal-add">
                <i class="fas fa-plus-circle"></i> Tambah Data
            </button>
            <div class="table-responsive text-nowrap">
                <table id="user" class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Terakhir Login</th>
                            <th>Status</th>
                            <th>Opsi</th>
                        </tr>
                    </thead>
                    <tbody class="table-border-bottom-0">
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>