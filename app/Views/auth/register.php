<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link href="<?= base_url('css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('style.css') ?>" rel="stylesheet">
    <script>
    function togglePassword(id) {
        const input = document.getElementById(id);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }

    function validateForm() {
        const password = document.getElementById('password').value;
        const confirm = document.getElementById('confirm_password').value;

        if (password !== confirm) {
            alert("Password dan Konfirmasi Password tidak sama!");
            return false; 
        }
        return true; 
    }
    </script>
</head>
<body>

<div class="container register-container">
    <div class="register-box">
        <div class="register-image d-none d-md-block"></div>

        <div class="register-form">
            <h2 class="mb-4">Register</h2>

            <form action="<?= base_url('login/saveRegister') ?>" method="post" onsubmit="return validateForm()">
                <div class="mb-3">
                    <input type="text" name="username" class="form-control" placeholder="Username" required>
                </div>
                
                <div class="mb-3 position-relative">
                    <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                    <button type="button" class="btn-eye" onclick="togglePassword('password')">👁️</button>


                </div>

                <div class="mb-3 position-relative">
                    <input type="password" id="confirm_password" class="form-control" placeholder="Konfirmasi Password" required>
                    <button type="button" class="btn-eye" onclick="togglePassword('confirm_password')">👁️</button>

                </div>
                <h2 class="mb-4">Data Diri</h2>
                <div class="mb-3">
                    <input type="text" name="nama" class="form-control" placeholder="Nama" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="alamat" class="form-control" placeholder="Alamat" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="no_hp" class="form-control" placeholder="No HP" required>
                </div>

                <button class="btn btn-primary w-100" type="submit">Register</button>
            </form>

            <div class="text-center mt-3">
                <p><a href="<?= base_url('/') ?>">Kembali</a></p>
                <p>Sudah punya akun? <a href="<?= base_url('login') ?>">Login di sini</a></p>
            </div>
        </div>
    </div>
</div>

</body>
</html>
