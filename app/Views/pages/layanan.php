<?= $this->extend('/index');?>
<?= $this->section('content') ?>

<section id="layanan" class="py-0 my-2">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="section-header align-center">
                            <h2 class="section-title">Layanan Pemesanan</h2>
                            <p class="section-subtitle">
                                Pemesanan akan dikirim melalui WhatsApp.
                            </p>
                        </div>

                        <div class="form-group mt-3">
                            <label for="nama">Nama</label>
                            <input
                                type="text"
                                id="nama"
                                class="form-control"
                                placeholder="Masukkan nama Anda"
                                required />
                        </div>

                        <div class="form-group mt-3">
                            <label for="alamat">Alamat Lengkap</label>
                            <input
                                type="text"
                                id="alamat"
                                class="form-control"
                                placeholder="Masukkan alamat Anda"
                                required />
                        </div>

                        <!-- Jenis Batik -->
                        <h5>Pilih Jenis Batik</h5>
                        <div class="row mb-4" id="jenisBatikGroup">
                            <div class="col-md-2">
                                <img
                                    src="images/jenis1.jpg"
                                    alt="Batik 1"
                                    class="img-thumbnail pilihan-batik"
                                    data-value="Batik 1" />
                            </div>
                            <div class="col-md-2">
                                <img
                                    src="images/jenis2.jpg"
                                    alt="Batik 2"
                                    class="img-thumbnail pilihan-batik"
                                    data-value="Batik 2" />
                            </div>
                            <div class="col-md-2">
                                <img
                                    src="images/jenis3.jpg"
                                    alt="Batik 3"
                                    class="img-thumbnail pilihan-batik"
                                    data-value="Batik 3" />
                            </div>
                            <div class="col-md-2">
                                <img
                                    src="images/jenis4.jpg"
                                    alt="Batik 4"
                                    class="img-thumbnail pilihan-batik"
                                    data-value="Batik 4" />
                            </div>
                            <div class="col-md-2">
                                <img
                                    src="images/reqbatik.png"
                                    alt="Request1"
                                    class="img-thumbnail pilihan-batik"
                                    data-value="Request1" />
                            </div>
                        </div>
                        <p class="mt-2 text-muted" style="font-size: 14px">
                            *Bisa request batik sendiri melalui WA
                        </p>

                        <!-- Model Batik -->
                        <h5>Pilih Model Batik</h5>
                        <div class="row mb-4" id="modelBatikGroup">
                            <div class="col-md-2">
                                <img
                                    src="images/model1.png"
                                    alt="Model 1"
                                    class="img-thumbnail pilihan-model"
                                    data-value="Model 1" />
                            </div>
                            <div class="col-md-2">
                                <img
                                    src="images/model2.png"
                                    alt="Model 2"
                                    class="img-thumbnail pilihan-model"
                                    data-value="Model 2" />
                            </div>
                            <div class="col-md-2">
                                <img
                                    src="images/model3.png"
                                    alt="Model 3"
                                    class="img-thumbnail pilihan-model"
                                    data-value="Model 3" />
                            </div>
                            <div class="col-md-2">
                                <img
                                    src="images/model4.png"
                                    alt="Model 4"
                                    class="img-thumbnail pilihan-model"
                                    data-value="Model 4" />
                            </div>
                            <div class="col-md-2">
                                <img
                                    src="images/reqmodel.png"
                                    alt="Request2"
                                    class="img-thumbnail pilihan-model"
                                    data-value="Request2" />
                            </div>
                        </div>
                        <p class="mt-2 text-muted" style="font-size: 14px">
                            *Bisa request model sendiri melalui WA
                        </p>
                        <div class="row justify-content-center my-4">
                            <div class="col-md-6 text-center">
                                <h4>Panduan Ukuran Batik</h4>
                                <img
                                    src="images/size1.jpg"
                                    alt="Panduan Ukuran Batik"
                                    class="img-fluid rounded shadow" />
                                <p class="mt-2 text-muted"
                                    style="font-size: 14px">
                                    *Silakan lihat panduan di atas sebelum
                                    memilih ukuran.
                                </p>
                            </div>
                        </div>

                        <div class="form-group mt-3">
                            <label for="lengan">Lengan</label>
                            <select id="lengan" class="form-control" required>
                                <option value>Pilih Lengan</option>
                                <option value="Lengan Panjang">Lengan
                                    Panjang</option>
                                <option value="Lengan Pendek">Lengan
                                    Pendek</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                            <label for="ukuranBatik">Ukuran</label>
                            <select id="ukuranBatik" class="form-control"
                                required>
                                <option value>Pilih Ukuran</option>
                                <option value="S">S</option>
                                <option value="M">M</option>
                                <option value="L">L</option>
                                <option value="XL">XL</option>
                                <option value="2XL">2XL</option>
                                <option value="3XL">3XL</option>
                                <option value="4XL">4XL</option>
                                <option value="5XL">5XL</option>
                            </select>
                        </div>

                        <div class="form-group mt-3">
                          <label for="jumlah">Jumlah</label>
                          <input type="number" id="jumlah" class="form-control" min="1" value="1" required />
                        </div>

                        <div class="mt-3">
                            <button onclick="cekHarga()"
                                class="btn btn-primary">
                                Cek Harga
                            </button>
                            <p id="hasilHarga"
                                class="mt-2 font-weight-bold"></p>
                        </div>

                        <p class="mb-1 text-muted" style="font-size: 14px">
                            *Jika request, Untuk harga mungkin bisa berbeda.</p>

                        <p class="mt-2 text-muted" style="font-size: 14px">
                            *Stok batik dapat berbeda tergantung jenis, model,
                            dan
                            ketersediaan. Admin akan mengonfirmasi kembali
                            setelah pemesanan.
                        </p>
                        <button type="button" class="btn btn-primary mt-2"
                            onclick="tambahKeKeranjang()">Tambah ke
                            Keranjang</button>
                        <div class="mt-5">
                            <h4>Keranjang Pemesanan</h4>
                            <table class="table table-bordered"
                                id="tabelKeranjang">
                                <thead>
                                    <tr>
                                        <th>Jenis</th>
                                        <th>Model</th>
                                        <th>Ukuran</th>
                                        <th>Lengan</th>
                                        <th>Jumlah</th>
                                        <th>Harga</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                            <h5 class="text-right mt-3">Total Harga: <span
                                    id="totalHarga">Rp 0</span></h5>
                        </div>
                        <button type="button" class="btn btn-primary mt-2"
                            onclick="kirimSemuaWA()">Kirim Semua via
                            WhatsApp</button>

                    </div>
                </div>
            </div>
        </section>

        <script>
      let jenisDipilih = "";
      let modelDipilih = "";

      document.querySelectorAll(".pilihan-batik").forEach((img) => {
        img.addEventListener("click", function () {
          document
            .querySelectorAll(".pilihan-batik")
            .forEach((i) => i.classList.remove("active"));
          this.classList.add("active");
          jenisDipilih = this.getAttribute("data-value");
        });
      });

      document.querySelectorAll(".pilihan-model").forEach((img) => {
        img.addEventListener("click", function () {
          document
            .querySelectorAll(".pilihan-model")
            .forEach((i) => i.classList.remove("active"));
          this.classList.add("active");
          modelDipilih = this.getAttribute("data-value");
        });
      });


      function cekHarga() {
        if (!jenisDipilih || !modelDipilih) {
          alert("Silakan pilih jenis dan model batik terlebih dahulu.");
          return;
        }

        const ukuran = document.getElementById("ukuranBatik").value;
        const lengan = document.getElementById("lengan").value;

        if (!ukuran || !lengan) {
          alert("Silakan pilih ukuran dan panjang lengan.");
          return;
        }
        const jumlah = parseInt(document.getElementById("jumlah").value);
        const harga = hitungHarga(jenisDipilih, modelDipilih, ukuran, lengan);
        const total = harga * jumlah;

        document.getElementById("hasilHarga").innerText = "Estimasi Harga: Rp " + total.toLocaleString();

        switch (jenisDipilih) {
          case "Batik 1":
            harga += 30000;
            break;
          case "Batik 2":
            harga += 30000;
            break;
          case "Batik 3":
            harga += 40000;
            break;
          case "Batik 4":
            harga += 40000;
            break;
          case "Request1":
            harga += 60000;
            break;
            
        }

        switch (modelDipilih) {
          case "Model 1":
            harga += 15000;
            break;
          case "Model 2":
            harga += 15000;
            break;
          case "Model 3":
            harga += 20000;
            break;
          case "Model 4":
            harga += 20000;
            break;
          case "Request2":
            harga += 60000;
            break;
        }

        if (ukuran === "XL" || ukuran === "2XL") {
          harga += 10000;
        }

        if (ukuran === "3XL" || ukuran === "4XL" || ukuran === "5XL") {
          harga += 15000;
        }

        if (lengan === "Lengan Panjang") {
          harga += 5000;
        }

        document.getElementById("hasilHarga").innerText =
          "Estimasi Harga: Rp " + harga.toLocaleString();
      }

      let keranjang = [];

function tambahKeKeranjang() {
    const nama = document.getElementById("nama").value;
    const alamat = document.getElementById("alamat").value;
    const ukuran = document.getElementById("ukuranBatik").value;
    const lengan = document.getElementById("lengan").value;
    const jumlah = parseInt(document.getElementById("jumlah").value);

    if (!jenisDipilih || !modelDipilih || !ukuran || !lengan || !nama || !alamat) {
        alert("Harap lengkapi semua data terlebih dahulu.");
        return;
    }
    const harga = hitungHarga(jenisDipilih, modelDipilih, ukuran, lengan);
    const total = harga * jumlah;

    keranjang.push({
        jenis: jenisDipilih,
        model: modelDipilih,
        ukuran,
        lengan,
        jumlah,
        total
    });

    Keranjang();
}

function Keranjang() {
    const tbody = document.querySelector("#tabelKeranjang tbody");
    tbody.innerHTML = "";

    let total = 0;

    keranjang.forEach((item, index) => {
        total += item.total;
        const row = `<tr>
            <td>${item.jenis}</td>
            <td>${item.model}</td>
            <td>${item.ukuran}</td>
            <td>${item.lengan}</td>
            <td>${item.jumlah}</td>
            <td>Rp ${item.total.toLocaleString()}</td>
            <td><button class="btn btn-danger btn-sm" onclick="hapusItem(${index})">Hapus</button></td>
        </tr>`;
        tbody.innerHTML += row;
    });

    document.getElementById("totalHarga").innerText = "Rp " + total.toLocaleString();
}

function hapusItem(index) {
    keranjang.splice(index, 1);
    Keranjang();
}

function hitungHarga(jenis, model, ukuran, lengan) {
    let harga = 50000;

    switch (jenisDipilih) {
          case "Batik 1":
            harga += 30000;
            break;
          case "Batik 2":
            harga += 30000;
            break;
          case "Batik 3":
            harga += 40000;
            break;
          case "Batik 4":
            harga += 40000;
            break;
          case "Request1":
            harga += 60000;
            break;
            
        }

        switch (modelDipilih) {
          case "Model 1":
            harga += 15000;
            break;
          case "Model 2":
            harga += 15000;
            break;
          case "Model 3":
            harga += 20000;
            break;
          case "Model 4":
            harga += 20000;
            break;
          case "Request2":
            harga += 60000;
            break;
        }

    if (ukuran === "XL" || ukuran === "2XL") {
          harga += 10000;
        }

        if (ukuran === "3XL" || ukuran === "4XL" || ukuran === "5XL") {
          harga += 15000;
        }

        if (lengan === "Lengan Panjang") {
          harga += 5000;
        }

    return harga;
}

function kirimSemuaWA() {
    const nama = document.getElementById("nama").value;
    const alamat = document.getElementById("alamat").value;

    if (keranjang.length === 0) {
        alert("Keranjang masih kosong.");
        return;
    }

    let pesan = `Halo! Saya ingin memesan batik dengan data berikut:\n- Nama: ${nama}\n- Alamat: ${alamat}\n\n`;
    keranjang.forEach((item, i) => {
        pesan += `Pesanan ${i + 1}:\n  - Jenis: ${item.jenis}\n  - Model: ${item.model}\n  - Ukuran: ${item.ukuran}\n  - Lengan: ${item.lengan}\n  - Jumlah: ${item.jumlah}\n  - Harga: Rp ${item.total.toLocaleString()}\n\n`;
    });

    const total = keranjang.reduce((sum, item) => sum + item.total, 0);
    pesan += `Total Harga: Rp ${total.toLocaleString()}\nTerima kasih!`;

    const url = `https://wa.me/62895379119628?text=${encodeURIComponent(pesan)}`;
    window.open(url, "_blank");
}

    </script>

<?= $this->endSection();?>