<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link href="<?= base_url('style.css') ?>" rel="stylesheet">
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
</head>

<body>

    <div class="container login-container">
        <div class="login-box">
            <div class="login-image d-none d-md-block"></div>
            <div class="login-form">
                <h2 class="mb-4">Login</h2>

                <?php if (session()->getFlashdata('error')): ?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>

                <form action="<?= base_url('login/process') ?>" method="post">
                    <div class="mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                </form>
                <div class="text-center mt-2">
                    <p class="mb-1"><a href="<?= base_url('/') ?>">Kembali</a></p>
                    <p class="mb-1">Belum punya akun? <a href="<?= base_url('register') ?>">Daftar di sini</a></p>
                    <p class="mb-0">
                        Aktivasi akun?
                        <a
                            href="https://wa.me/62895379119628?text=Halo%20Admin%2C%20saya%20ingin%20mengaktifkan%20akun%20saya%20yang%20baru%20saja%20didaftarkan.%20Mohon%20dibantu.%20Terima%20kasih."
                            target="_blank">
                            Chat admin
                        </a>
                    </p>

                </div>
            </div>
        </div>
    </div>

</body>

</html>