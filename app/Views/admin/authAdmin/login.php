<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Admin</title>
    <link href="<?= base_url('style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
</head>
<body>

<div class="container login-container">
    <div class="login-box">
        <div class="login-image d-none d-md-block"></div>

        <div class="login-form">
            <h2 class="mb-4">Login Admin</h2>

            <?php if (session()->getFlashdata('error')): ?>
                <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
            <?php endif; ?>

            <form action="<?= base_url('/loginAdmin/process') ?>" method="post">
                <div class="mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                <div class="mb-3">
                    <input type="password" name="password" class="form-control" placeholder="Password" required>
                </div>
                <button class="btn btn-primary w-100" type="submit">Login</button>
            </form>
            <div class="text-center mt-3">
                <p><a href="<?= base_url('/') ?>">Kembali</a></p>
                <!-- <p>Belum punya akun? <a href="<?= base_url('registerAdmin') ?>">Daftar di sini</a></p> -->
            </div>
        </div>
    </div>
</div>

</body>
</html>
