<?php

session_start();

require '../functions.php';

$id = $_GET["id_produk"];
$produk=query("SELECT * FROM produk WHERE id_produk = $id")[0];

$id_pelanggan =  $_SESSION['id'] ;
$user= query("SELECT * FROM user_pelanggan LEFT JOIN detail_pelanggan USING(id_pelanggan) WHERE id_pelanggan = $id_pelanggan")[0];

if(isset($_POST["tambah"])) {
        
    if(tambah_keranjang($_POST) > 0 ) {
        echo "<script>
                alert('Produk Berhasil Di tambahkan Ke Keranjang');
                window.location='Keranjang.php'
            </script>";
        // header("location:Keranjang.php");
    }else {
        echo "<script>
                alert('Produk gagal Di tambahkan Ke Keranjang');
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
    <title>Tambah Ke Keranjang</title>
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
    </style>
</head>

<body>

    <!-- navbar -->
    <?php if ( !isset($_SESSION["login"]) ){ ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-5 fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand">TOKO BAJU</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../Produk/all-produk.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Produk/all-produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Keranjang.php"><i class="bi bi-cart-fill me-2"></i>Keranjang
                            Belanja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../User/login.php"><i class="bi bi-door-open-fill me-2"></i>Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <?php } else { ?>

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

    <?php } ?>

    <div class="container pt-5">

        <h2 class="mt-5 text-primary fw-bold fs-3 mb-4">🛍️ Ukuran & Jumlah Produk</h2>

<form action="" method="post" class="bg-light p-4 rounded-4 shadow-sm">

    <!-- Hidden Inputs -->
    <input type="hidden" name="id_pelanggan" value="<?php echo $_SESSION['id']; ?>">
    <input type="hidden" name="id_produk" value="<?php echo $produk['id_produk']; ?>">
    <input type="hidden" name="nama" value="<?php echo $user['Nama']; ?>">
    <input type="hidden" name="notelp" value="<?php echo $user['No_telp']; ?>">
    <input type="hidden" name="alamat" value="<?php echo $user['Alamat']; ?>">
    <input type="hidden" name="harga" value="<?php echo $produk['harga']; ?>">

    <!-- Jumlah -->
    <label for="jumlah" class="form-label fw-semibold text-dark">Jumlah Pembelian</label>
    <input type="number" class="form-control mb-3 rounded-3 shadow-sm" name="jumlah" id="jumlah" value="1" min="1" max="10" required>

    <!-- Ukuran -->
    <p class="text-muted mb-1">Tersedia ukuran: <span class="text-primary fw-semibold"><?php echo $produk["ukuran_produk"]; ?></span></p>
    <input type="text" class="form-control mb-3 rounded-3 shadow-sm" name="ukuran" id="ukuran" placeholder="Masukkan ukuran" required>

    <!-- Catatan -->
    <label for="catatan" class="form-label fw-semibold text-dark">Catatan Pembelian <small class="text-muted">(opsional)</small></label>
    <textarea name="catatan" class="form-control rounded-3 shadow-sm mb-4" id="catatan" rows="3" placeholder='Contoh: "Kemas rapi ya kak"' required></textarea>

    <!-- Tombol Submit -->
    <button type="submit" name="tambah" id="tambah" class="btn btn-primary w-100 rounded-pill fw-semibold shadow-sm">
        <i class="bi bi-cart-plus me-2"></i>Tambah ke Keranjang
    </button>
</form>

    </div>

    <script type="text/javascript" src="../js/bootstrap.js"></script>

</body>

</html>