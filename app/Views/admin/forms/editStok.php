<?= $this->extend('/admin/index'); ?>
<?= $this->section('content') ?>

<?php if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('error') ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<!-- Perhatikan enctype multipart untuk upload gambar -->
<form action="<?= base_url('/admin/updateStok/' . $stok['id']) ?>" method="post" enctype="multipart/form-data">
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Edit Stok Batik</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Data Batik</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Admin</a>
                    </li>
                </ul>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Form Stok</div>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6 col-lg-4">
                                    <div class="form-group">
                                        <label for="jenis">Jenis Batik</label>
                                        <input type="text" name="jenis" class="form-control" id="jenis" placeholder="" value="<?= $stok['jenis'] ?>" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="stok">Stok</label>
                                        <input type="number" name="stok" class="form-control" id="stok" placeholder="" value="<?= $stok['stok'] ?>" required />
                                    </div>

                                    <div class="form-group">
                                        <label for="gambar">Gambar Batik</label>
                                        <input type="file" name="gambar" class="form-control" id="gambar" accept="image/*" value="<?= $stok['gambar'] ?>" required />
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-action">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="reset" class="btn btn-danger">Batal</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<!-- Scripts tetap seperti sebelumnya -->
<?= $this->endSection(); ?>