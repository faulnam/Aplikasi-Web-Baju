<?php

session_start();

require 'functions.php';

$produk=query("SELECT * FROM produk WHERE status_produk = 1  ORDER BY id_produk DESC LIMIT  12");
$kategori = query("SELECT * FROM kategori ORDER BY id_kategori DESC");



if ( !isset($_SESSION["login"]) ){
    

    header("location:User/login.php");
    exit;
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <title>JUANG| BERANDA</title>
    <style>
  .carousel-inner img {
    border-radius: 20px;
    object-fit: cover;
    height: 450px;
    transition: transform 0.5s ease;
  }

  .carousel-item:hover img {
    transform: scale(1.03);
  }

  .carousel-indicators [data-bs-target] {
    background-color: #fff;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    opacity: 0.7;
    transition: opacity 0.3s ease;
  }

  .carousel-indicators .active {
    opacity: 1;
  }

  .carousel-control-prev-icon,
  .carousel-control-next-icon {
    background-color: rgba(0, 0, 0, 0.6);
    border-radius: 50%;
    padding: 10px;
  }

  .carousel {
    max-width: 960px;
    margin: 0 auto;
  }

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

   .kategori-card {
        border-radius: 20px;
        background: #f5f7fa;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
        text-align: center;
        padding: 20px;
        height: 100%;
    }

    .kategori-card:hover {
        background: linear-gradient(135deg, #6f86d6, #48c6ef);
        color: white !important;
        transform: translateY(-5px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    }

    .kategori-card:hover b {
        color: white;
    }

    .kategori-title {
        font-size: 1rem;
        color: #2c3e50;
    }

    @media (max-width: 768px) {
        .kategori-title {
            font-size: 0.9rem;
        }
    }

    .produk-card {
        background-color: #ffffff;
        border-radius: 20px;
        transition: all 0.3s ease;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.05);
        overflow: hidden;
        height: 35%;
    }

    .produk-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .produk-card img {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-top-left-radius: 20px;
        border-top-right-radius: 20px;
    }

    .produk-card .card-body {
        padding: 1.2rem;
    }

    .produk-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #333;
    }

    .produk-price {
        color: #555;
        font-size: 0.95rem;
        margin: 0.5rem 0 1rem;
    }

    .produk-button {
        border-radius: 12px;
        transition: all 0.2s ease-in-out;
    }

    .produk-button:hover {
        background-color: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }

    .footer-modern {
        background: linear-gradient(135deg, #1f1f1f, #2b2b2b);
        color: #fff;
        margin-top: 10rem;
        padding: 3rem 0;
        font-family: 'Poppins', sans-serif;
        border-top: 5px solid #ffd700;
    }

    .footer-modern .social-icon {
        font-size: 48px;
        transition: all 0.3s ease-in-out;
        color: #fff;
    }

    .footer-modern .social-icon:hover {
        transform: scale(1.1);
        color: #ffd700;
    }

    .footer-modern .footer-box {
        padding: 1rem;
        margin: 0 auto;
    }

    .footer-modern .footer-title {
        font-weight: 600;
        font-size: 1.25rem;
        margin-top: 1rem;
    }

    .footer-modern .footer-desc {
        font-size: 0.95rem;
        color: #ccc;
    }

    .footer-modern .footer-bottom {
        border-top: 1px solid #444;
        margin-top: 2rem;
        padding-top: 1rem;
        font-size: 0.85rem;
        color: #aaa;
    }
</style>
</head>

<body>

    <!-- navbar -->
    <?php if ( !isset($_SESSION["login"]) ){ ?>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-5 fixed-top">
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
                        <a class="nav-link active" aria-current="page" href="Beranda.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Produk/all-produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="Keranjang/Keranjang.php"><i class="bi bi-cart-fill me-2"></i>Keranjang
                            Belanja</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="User/login.php"><i class="bi bi-door-open-fill me-2"></i>Login</a>
                    </li>
                </ul>
                <form class="d-flex" action="" method="post">
                    <input class="form-control me-2" type="search" name="keyword" id='keyword' autofocus
                        placeholder="Search" autocomplete="off" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit" name="cari" id="cari">Search</button>
                </form>
            </div>
        </div>
    </nav>

    <?php } else { ?>

    <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mb-5 fixed-top">
  <div class="container-fluid">
    <a class="navbar-brand"><b>JUANG</b></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
      aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="Beranda.php">Beranda</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Produk/all-produk.php">Produk</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Keranjang/Keranjang.php">
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
              <a class="dropdown-item" href="User/account/profil.php">
                <i class="bi bi-person-circle mx-2"></i>Profil
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="User/account/riwayat.php">
                <i class="bi bi-clock-history mx-2"></i>Riwayat
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item" href="User/logout.php" onclick="return confirm('Yakin akan logout?')">
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

    <div class="container mt-5">
        <div class="row">
            <!-- slide -->
            <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
  <div class="carousel-indicators">
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
      aria-current="true" aria-label="Slide 1"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
      aria-label="Slide 2"></button>
    <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
      aria-label="Slide 3"></button>
  </div>

  <div class="carousel-inner shadow-lg mt-4">
    <div class="carousel-item active">
      <img src="icon/baju.jpg" class="d-block w-100" alt="Slide 1">
    </div>
    <div class="carousel-item">
      <img src="icon/kemeja.jpg" class="d-block w-100" alt="Slide 2">
    </div>
    <div class="carousel-item">
      <img src="icon/jam.jpg" class="d-block w-100" alt="Slide 3">
    </div>
  </div>

  <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
    data-bs-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Previous</span>
  </button>
  <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
    data-bs-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="visually-hidden">Next</span>
  </button>
</div>

            <!-- kategori -->
           <div class="col-12">
    <h3 class="mt-5 mb-3 fw-bold text-dark">✨ Kategori Populer</h3>
    <div class="row g-3">
        <?php foreach($kategori as $rows) { ?>
        <div class="col-6 col-md-4 col-lg-3">
            <a href="Produk/kategori_produk.php?id=<?php echo $rows['id_kategori'] ?>" class="text-decoration-none">
                <div class="kategori-card h-100">
                    <b class="kategori-title"><?php echo $rows['nama_kategori'] ?></b>
                </div>
            </a>
        </div>
        <?php } ?>
    </div>
</div>


            <!-- produk -->
            <h2 class="my-4 fw-bold text-dark">🔥 Terbaru</h2>
<div class="d-flex flex-wrap justify-content-center gap-4" id="load_produk">
    <?php foreach($produk as $row) { ?>
    <div class="produk-card" style="width: 18rem;">
        <a href="Produk/detail_produk.php?id_produk=<?php echo $row['id_produk'] ?>"
            style="text-decoration: none;" data-bs-toggle="tooltip" title="Klik untuk melihat detail produk">
            <img src="img/<?php echo $row['gambar'] ?>" alt="<?php echo $row['nama_produk'] ?>">
        </a>
        <div class="card-body text-center">
            <h5 class="produk-title"><?php echo $row['nama_produk'] ?></h5>
            <p class="produk-price">Rp. <?php echo number_format($row['harga'], 2, ',', '.') ?></p>
            <a href="Keranjang/jumlah_ukuran.php?id_produk=<?php echo $row['id_produk'] ?>">
                <button class="btn btn-outline-primary produk-button w-100" data-bs-toggle="tooltip"
                    title="Klik untuk menambahkan produk ke keranjang">
                    <i class="bi bi-cart-plus-fill me-2"></i>Masukkan ke Keranjang
                </button>
            </a>
        </div>
    </div>
    <?php } ?>
</div>
    </div>
    </div>
    </div>
    <script src="js/jquery-3.6.0.min.js"></script>

    <script>
    $("#document").ready(function() {
        $('#cari').hide();


        $('#keyword').on('keyup', function() {
            $('#load_produk').load('ajax/load_produk.php?keyword=' + $('#keyword').val());
        });
    });
    </script>

    <script type="text/javascript" src="js/bootstrap.js"></script>

</body>

<footer class="footer-modern">
    <div class="container">
        <div class="row text-center text-md-start">
            <div class="col-md-4 footer-box">
                <div>
                    <i class="bi bi-instagram social-icon"></i>
                    <div class="footer-title">Instagram</div>
                    <p class="footer-desc">Ikuti kami di <strong>@toko_baju</strong></p>
                </div>
            </div>

            <div class="col-md-4 footer-box">
                <div>
                    <i class="bi bi-whatsapp social-icon"></i>
                    <div class="footer-title">WhatsApp</div>
                    <p class="footer-desc">Chat langsung di <strong>089787998929</strong></p>
                </div>
            </div>

            <div class="col-md-4 footer-box">
                <div>
                    <i class="bi bi-facebook social-icon"></i>
                    <div class="footer-title">Facebook</div>
                    <p class="footer-desc">Like kami di <strong>@tokoBaju</strong></p>
                </div>
            </div>
        </div>

        <div class="footer-bottom text-center mt-4">
            <i class="bi bi-house-door-fill me-2"></i>
            <span>Terima kasih telah mengunjungi toko kami 💛</span>
        </div>
    </div>
</footer>

</html>