<?php

session_start();

require '../../functions.php';

if ( isset($_SESSION["login"]) ){
    
    $id_pelanggan =  $_SESSION["id"];
    $result = mysqli_query($conn,"SELECT * FROM user_pelanggan WHERE id_pelanggan = $id_pelanggan");
    $profil = mysqli_fetch_assoc($result);

    // $detail = mysqli_query($conn,"SELECT * FROM detail_pelanggan WHERE id_pelanggan = $id_pelanggan ");
    // $isi_detail = mysqli_num_rows($detail);

}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    
    <title>Profil | <?php echo $profil["Username"] ?> </title>
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

  .bg-gradient-primary {
    background: linear-gradient(135deg, #4c84ff, #6a90ff);
}

.hover-elevate:hover {
    transform: translateY(-3px);
    transition: all 0.3s ease;
    box-shadow: 0 8px 20px rgba(76, 132, 255, 0.15);
}

.btn-light:hover {
    background-color: #f0f0f0;
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
                        <a class="nav-link active" aria-current="page" href="../../Produk/all-produk.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../Produk/all-produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../../Keranjang/Keranjang.php"><i
                                class="bi bi-cart-fill me-2"></i>Keranjang
                            Belanja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../login.php"><i class="bi bi-door-open-fill me-2"></i>Login</a>
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
          <a class="nav-link" aria-current="page" href="../../Beranda.php">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../Produk/all-produk.php">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="../../Keranjang/Keranjang.php">
            <i class="bi bi-cart-fill me-2"></i>Keranjang Belanja
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="#" id="navbarDropdown" role="button"
            data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person-circle mx-2"></i> Profil
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li>
              <a class="dropdown-item" href="profil.php">
                <i class="bi bi-person-circle mx-2"></i>Profil
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="riwayat.php">
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

        <div class="mt-5 p-4 bg-gradient-primary rounded-4 text-white shadow-sm">
    <h2 class="fw-bold">👋 SELAMAT DATANG, <?php echo $profil["Username"] ?>!</h2>
    <p class="mb-3">Terima kasih telah bergabung! Yuk, bantu kami kembangkan platform ini dengan saranmu. 💡</p>
    <a href="kirim_masukan.php">
        <button type="button" class="btn btn-light rounded-pill fw-semibold shadow-sm">
            <i class="bi bi-envelope-heart-fill me-2"></i>Kirim Masukan
        </button>
    </a>
</div>

<div class="mt-4">
    <a href="edit_profil.php" class="text-decoration-none">
        <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light shadow-sm hover-elevate text-dark">
            <h3 class="mb-0"><i class="bi bi-person-circle text-primary"></i></h3>
            <h5 class="mb-0 fw-semibold">Ubah Profil</h5>
        </div>
    </a>

    <a href="ubah_password.php" class="text-decoration-none">
        <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light shadow-sm hover-elevate text-danger mt-3">
            <h3 class="mb-0"><i class="bi bi-lock-fill"></i></h3>
            <h5 class="mb-0 fw-semibold">Ubah Password</h5>
        </div>
    </a>

    <a href="riwayat.php" class="text-decoration-none">
        <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light shadow-sm hover-elevate text-warning mt-3">
            <h3 class="mb-0"><i class="bi bi-clock-history"></i></h3>
            <h5 class="mb-0 fw-semibold">Histori Pembelian</h5>
        </div>
    </a>

    <a href="lengkapi_data.php" class="text-decoration-none">
        <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-light shadow-sm hover-elevate text-success mt-3">
            <h3 class="mb-0"><i class="bi bi-clipboard-data-fill"></i></h3>
            <h5 class="mb-0 fw-semibold">Lengkapi Data Diri</h5>
        </div>
    </a>
</div>

    <script type="text/javascript" src="../../js/bootstrap.js"></script>


</body>

</html>