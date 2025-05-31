<?php

require '../functions.php';

$id = $_GET["id"];
$kategori = query("SELECT * FROM kategori WHERE id_kategori = $id")[0];
$produk = query("SELECT * FROM produk LEFT JOIN kategori USING(id_kategori) WHERE id_kategori = $id  ORDER BY id_produk DESC");

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css">
    <title>Kategori | <?php echo $kategori["nama_kategori"] ?></title>
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

    .card:hover {
    transform: translateY(-4px);
    transition: 0.3s ease;
    box-shadow: 0 10px 24px rgba(0, 0, 0, 0.08);
}

.card-body h5 {
    font-size: 1.1rem;
    color: #333;
}

.card-body p {
    font-size: 0.95rem;
}

.btn {
    transition: background-color 0.3s ease;
}

.btn:hover {
    background-color: #4839C9 !important;
}

    </style>
</head>

<body>

    <!-- navbar -->
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
    <div class="row">
        <!-- Judul Kategori -->
        <h2 class="my-3 mt-5 fw-bold text-dark"><?php echo $kategori["nama_kategori"] ?></h2>

        <!-- Wrapper Produk -->
        <div class="d-flex flex-wrap gap-4" id="load_produk">
            <?php foreach($produk as $row) { ?>
                <div class="card shadow-sm border-0 rounded-4 overflow-hidden" style="width: 18rem; background: #ffffff;">
                    <a href="detail_produk.php?id_produk=<?php echo $row['id_produk'] ?>" class="text-decoration-none text-dark"
                       data-bs-toggle="tooltip" data-bs-placement="top" title="Klik untuk melihat detail produk">

                        <!-- Gambar Produk -->
                        <img src="../img/<?php echo $row['gambar'] ?>" class="img-fluid"
                             style="height: 250px; object-fit: cover; border-bottom: 1px solid #f0f0f0;">
                    </a>

                    <!-- Konten Produk -->
                    <div class="card-body">
                        <h5 class="fw-semibold mb-1"><?php echo $row['nama_produk'] ?></h5>
                        <p class="text-primary fw-bold mb-3">Rp <?php echo number_format($row['harga'], 2, ',', '.') ?></p>

                        <!-- Tombol Keranjang -->
                        <a href="../Keranjang/jumlah_ukuran.php?id_produk=<?php echo $row['id_produk'] ?>">
                            <button type="submit"
                                    class="btn w-100 fw-semibold text-white"
                                    style="background-color: #5D50C6; border-radius: 12px;"
                                    name="tambah" id="tambah"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    title="Klik untuk menambahkan produk ke keranjang">
                                <i class="bi bi-cart-plus-fill me-2"></i>Tambah ke Keranjang
                            </button>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>


    </div>
    </div>


    <script type="text/javascript" src="../js/bootstrap.js"></script>

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