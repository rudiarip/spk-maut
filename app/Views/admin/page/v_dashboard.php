<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row">
        <div class="col-md-12 mb-4 order-0">
            <div class="card">
                <div class="d-flex align-items-end row">
                    <div class="col-sm-12">
                        <div class="card-body">
                            <h3 class="card-title text-primary">Welcome Admin ! </h3>
                            <p>
                                SPK (Sistem Pendukung Keputusan) metode MAUT (Multi-Attribute Utility Theory) adalah suatu metode yang digunakan untuk membantu pengambilan keputusan yang melibatkan banyak kriteria atau atribut. MAUT berfokus pada penilaian dan perbandingan utilitas (kepuasan atau nilai) dari berbagai alternatif yang tersedia berdasarkan beberapa atribut yang relevan.
                            </p>
                        </div>
                    </div>
                    <!-- <div class="col-sm-5 text-center text-sm-left">
						<div class="card-body pb-0 px-0 px-md-4">
							<img src="<= base_url('') ?>assets/img/siswanobg.png" height="140" alt="View Badge User" />
						</div>
					</div> -->
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 col-6 mt-3">
            <div class="card shortcut-card text-center">
                <a href="<?= base_url('kriteria') ?>">
                    <div class="card-body">
                        <i class="fas fa-file fa-3x mb-3"></i>
                        <h5 class="card-title"><?= $hitung['totalKriteria'] ?> Kriteria</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-6 mt-3">
            <div class="card shortcut-card text-center">
                <a href="<?= base_url('subkriteria') ?>">
                    <div class="card-body">
                        <i class="fas fa-podcast fa-3x mb-3"></i>
                        <h5 class="card-title"><?= $hitung['totalSub'] ?> Sub Kriteria</h5>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-md-4 col-6 mt-3">
            <div class="card shortcut-card text-center">
                <a href="<?= base_url('alternatif') ?>">
                    <div class="card-body">
                        <i class="fas fa-sitemap fa-3x mb-3"></i>
                        <h5 class="card-title"><?= $hitung['totalAlternatif'] ?> Alternatif</h5>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>