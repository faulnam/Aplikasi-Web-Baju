<?php

session_start();

require '../functions.php';

// if ( !isset($_SESSION["beranda"]) ){
//     header("location:../Beranda.php");
//     exit;
// }


$id = $_GET["id"];
$produk=query("SELECT * FROM produk WHERE id_produk = $id")[0];


if(isset($_POST["beli"])) {
    //$_SESSION["id_produk"] = $produk["id_produk"];
    setcookie('id_produk', $produk["id_produk"],time() + 7200);

    if(transaksi($_POST) > 0 ){
        echo "<script>
                document.location.href = 'detail_transaksi.php';
            </script>";
    } else {
        echo "<script>
                alert('Transaksi Gagal');
                document.location.href = 'error_transaksi.php';
            </script>";
    }


}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Pembelian | <?php echo $produk["nama_produk"] ?></title>
    <style>
         .navbar-custom {
    background: linear-gradient(90deg, #2c3e50, #4ca1af);
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  }

  .navbar-brand {
    font-weight: 700;
    font-size: 1.5rem;
    letter-spacing: 1px;
    color: #fff !important;
  }

  .nav-link {
    color: #ffffffcc !important;
    font-weight: 500;
    transition: color 0.3s ease;
  }

  .nav-link:hover {
    color: #ffffff !important;
  }

  .nav-link.active {
    color: #f1c40f !important;
  }

  .dropdown-menu {
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    animation: fadeIn 0.3s ease;
  }

  .dropdown-item:hover {
    background-color: #f1f1f1;
    color: #2c3e50 !important;
  }

  .form-control {
    border-radius: 20px;
  }

  .btn-outline-light {
    border-radius: 20px;
    transition: all 0.3s ease;
  }

  .btn-outline-light:hover {
    background-color: #f1c40f;
    color: #2c3e50;
    border: none;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
      transform: translateY(10px);
    }

    to {
      opacity: 1;
      transform: translateY(0);
    }
  }

  input::placeholder,
textarea::placeholder {
    color: #aaa;
    font-style: italic;
}

input:focus, textarea:focus {
    border-color: #4f46e5;
    box-shadow: 0 0 0 .2rem rgba(79, 70, 229, 0.25);
}

button.btn-primary {
    background-color: #4f46e5;
    border-color: #4f46e5;
}

button.btn-primary:hover {
    background-color: #4338ca;
    border-color: #4338ca;
}

    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-5 fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand"><b>FASSEN</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="../Beranda.php">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="Produk/all-produk.php">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../Keranjang/Keranjang.php">
            <i class="bi bi-cart-fill me-2"></i>Keranjang Belanja
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle mx-2"></i> Profil
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li>
              <a class="dropdown-item" href="../User/account/profil.php">
                <i class="bi bi-person-circle mx-2"></i>Profil
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="../User/account/riwayat.php">
                <i class="bi bi-clock-history mx-2"></i>Riwayat
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item" href="../User/logout.php" onclick="return confirm('Yakin akan logout?')">
                <i class="bi bi-box-arrow-right mx-2"></i> Logout
              </a>
            </li>
          </ul>
        </li>
      </ul>
      <form class="d-flex" action="" method="post">
        <input class="form-control me-2" type="search" name="keyword" id="keyword" autofocus
          placeholder="Search" autocomplete="off" aria-label="Search">
        <button class="btn btn-outline-light" type="submit" name="cari" id="cari">Search</button>
      </form>
    </div>
  </div>
</nav>


    <div class="container mt-5">

        <!-- produk -->
        <div class="pt-5">
    <div class="row g-0 bg-white shadow-lg rounded-4 overflow-hidden">
        <!-- Gambar Produk -->
        <div class="col-md-6">
            <img src="../img/<?php echo $produk['gambar'] ?>" class="img-fluid w-100 h-100 object-fit-cover">
        </div>

        <!-- Detail Produk + Form -->
        <div class="col-md-6 p-4">
            <!-- Info Produk -->
            <h2 class="fw-bold text-dark"><?php echo $produk["nama_produk"] ?></h2>
            <p class="text-primary fs-5 fw-semibold">Rp. <?php echo number_format($produk["harga"], 2, ',', '.') ?></p>
            <p class="text-muted mb-3">Ukuran tersedia: <span class="text-dark fw-medium"><?php echo $produk["ukuran_produk"] ?></span></p>

            <!-- Judul Form -->
            <h5 class="fw-bold text-dark border-top pt-3 mt-4 mb-3">📝 Data Pembelian</h5>

            <!-- Form -->
            <form action="" method="post" enctype="multipart/form-data">
                <input type="hidden" name="id_produk" value="<?php echo $produk["id_produk"] ?>">
                <input type="hidden" name="harga" value="<?php echo $produk['harga'] ?>">

                <!-- Nama -->
                <div class="mb-3">
                    <input type="text" class="form-control rounded-3 shadow-sm" name="nama_pembeli" id="nama_pembeli" placeholder="Nama kamu" required>
                </div>

                <!-- No HP -->
                <div class="mb-3">
                    <input type="text" class="form-control rounded-3 shadow-sm" name="telepon" id="telepon" placeholder="Nomor WhatsApp / HP" required>
                </div>

                <!-- Jumlah -->
                <div class="mb-3">
                    <input type="number" class="form-control rounded-3 shadow-sm" name="jumlah" id="jumlah" min="1" max="10" value="1" placeholder="Jumlah produk" required>
                </div>

                <!-- Ukuran -->
                <div class="mb-3">
                    <input type="text" class="form-control rounded-3 shadow-sm" name="ukuran" id="ukuran" placeholder="Ukuran produk (contoh: M, L, XL)" required>
                </div>

                <!-- Alamat -->
                <div class="mb-3">
                    <input type="text" class="form-control rounded-3 shadow-sm" name="Alamat" id="Alamat" placeholder="Alamat pengiriman lengkap" required>
                </div>

                <!-- Catatan -->
                <div class="mb-2">
                    <label for="catatan" class="form-label text-muted small">Catatan (opsional)</label>
                    <textarea name="catatan" class="form-control rounded-3 shadow-sm" id="catatan" rows="3" placeholder="Contoh: Tolong packing yang rapi ya kak 😊">tidak ada</textarea>
                </div>

                <!-- Tombol Submit -->
                <button type="submit" name="beli" onclick="return confirm('Pastikan data yang kamu isi sudah benar!')" class="btn btn-primary w-100 rounded-pill fw-semibold mt-3 shadow-sm">
                    <i class="bi bi-bag-check-fill me-2"></i>Buat Pesanan
                </button>
            </form>
        </div>
    </div>
</div>

    </div>
    </div>
    </div>

    <script type="text/javascript" src="../js/bootstrap.js"></script>
</body>

</html>