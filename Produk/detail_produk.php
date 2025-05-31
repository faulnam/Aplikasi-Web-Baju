<?php

session_start();

require '../functions.php';


$id = $_GET["id_produk"];
$produk=query("SELECT * FROM produk WHERE id_produk = $id")[0];
$komen =query("SELECT * FROM komen WHERE id_produk = $id ORDER BY id_komen DESC");

$jumlah = mysqli_query($conn,"SELECT COUNT(*) FROM transaksi LEFT JOIN produk USING (id_produk) WHERE id_produk = $id");
$jumlah_beli = mysqli_fetch_array($jumlah)[0];

$data_produk = mysqli_query($conn,"SELECT * FROM produk WHERE id_produk = $id");


if(isset($_POST["komen"])) {

    if(komen($_POST) > 0) {
        header('location:detail_produk.php?id_produk='.$id);
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
    <title><?php echo $produk["nama_produk"] ?></title>
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

  .text-gradient {
    background: linear-gradient(to right, #4c84ff, #8f94fb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

textarea::placeholder {
    color: #999;
    font-style: italic;
}

.btn:hover {
    transform: scale(1.03);
    box-shadow: 0 10px 18px rgba(0, 0, 0, 0.08);
    transition: 0.3s ease-in-out;
}

.text-gradient {
    background: linear-gradient(90deg, #4c84ff, #8f94fb);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.bg-gradient-primary {
    background: linear-gradient(135deg, #4c84ff 0%, #6a90ff 100%) !important;
}

.hover-shadow:hover {
    box-shadow: 0 10px 20px rgba(76, 132, 255, 0.3) !important;
    transition: box-shadow 0.3s ease;
}

.card {
    border-radius: 15px !important;
}

.card-header h5 {
    font-family: 'Poppins', sans-serif;
}

.card-body p {
    font-family: 'Inter', sans-serif;
    line-height: 1.5;
    color: #212529;
    white-space: pre-wrap;
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
                        <a class="nav-link active" aria-current="page" href="../Beranda.php">Beranda</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="all-produk.php">Produk</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../Keranjang/Keranjang.php"><i
                                class="bi bi-cart-fill me-2"></i>Keranjang
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
    <a class="navbar-brand"><b>JUANG</b></a>
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
          <a class="nav-link active" href="all-produk.php">Produk</a>
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

    <?php

    if ( mysqli_num_rows($data_produk) !== 1 ) {

        if(!isset($id)) {
            header('location:../Beranda.php');
        }

    }else {
    
    ?>

    <div class="container mt-5">

       <div class="pt-5">
    <h3 class="fw-bold text-dark mb-4">Deskripsi Produk</h3>
    <div class="row g-0 bg-white border rounded-4 shadow-sm overflow-hidden">
        <!-- Gambar Produk -->
        <div class="col-md-6 p-4 d-flex align-items-center justify-content-center bg-light">
            <img class="rounded-4 img-fluid" src="../img/<?php echo $produk['gambar'] ?>" alt="Gambar Produk" style="max-height: 400px; object-fit: contain;">
        </div>

        <!-- Informasi Produk -->
        <div class="col-md-6 p-4">
            <h3 class="fw-bold text-dark"><?php echo $produk["nama_produk"] ?></h3>
            <h6 class="text-muted mb-3">Terjual <?php echo $jumlah_beli; ?> produk</h6>

            <div id="load_desk">
                <h6 class="fw-semibold mb-2">DESKRIPSI :</h6>
                <p class="text-secondary"><?php echo $produk["deskripsi"]?></p>
                <p class="text-secondary">Ukuran tersedia: <span class="fw-medium"><?php echo $produk["ukuran_produk"] ?></span></p>
                <p class="fs-5 fw-bold text-primary">Rp. <?php echo number_format($produk['harga'],2,',','.' );?></p>

                <!-- Tombol Aksi -->
                <div class="d-flex flex-wrap gap-2 mt-4">
                    <a href="https://api.whatsapp.com/send?phone=+6289504753863&text=hai ,saya ingin bertanya tentang  <?php echo $produk['nama_produk'] ;?>,yang saya lihat di Fassen"
                        target="_blank" data-bs-toggle="tooltip" data-bs-placement="top"
                        title="Klik untuk chat penjual via Whatsapp">
                        <button class="btn btn-outline-success rounded-pill px-4 shadow-sm">
                            <i class="bi bi-whatsapp me-2"></i>Tanya Penjual
                        </button>
                    </a>

                    <a href="../Pembayaran/pembayaran.php?id=<?php echo $produk['id_produk'] ?>"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Klik untuk membeli produk">
                        <button class="btn btn-primary rounded-pill px-4 shadow-sm">
                            <i class="bi bi-bag-fill me-2"></i>Beli Sekarang
                        </button>
                    </a>

                    <a href="../Keranjang/jumlah_ukuran.php?id_produk=<?php echo $produk['id_produk']  ?>"
                        data-bs-toggle="tooltip" data-bs-placement="top" title="Tambah ke keranjang">
                        <button class="btn btn-outline-dark rounded-pill px-4 shadow-sm">
                            <i class="bi bi-cart-plus-fill me-2"></i>Keranjang
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>


       <div class="row g-0 position-relative mt-5 p-4 rounded-4 shadow-sm bg-white text-dark" id="load_komen">
    <h3 class="text-gradient fw-bold mb-4"><i class="bi bi-chat-dots-fill me-2"></i>Beri Komentar</h3>

    <div class="col-md-6">
        <!-- form komen -->
        <?php if (!isset($_SESSION["login"])) { ?>
            <div class="alert alert-warning d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <span>Anda harus <b>login</b> terlebih dahulu untuk meninggalkan komentar.</span>
            </div>
        <?php } else { ?>
            <form action="" method="post" id="form_Comment" class="bg-light p-4 rounded-3 shadow-sm">
                <!-- Hidden Input ID -->
                <input type="hidden" name="id_produk" id="id_produk" value="<?php echo $produk['id_produk'] ?>">

                <!-- Hidden Nama -->
                <input type="hidden" name="nama" id="nama" value="<?php echo $_SESSION['nama'] ?>" required>

                <!-- Textarea Komentar -->
                <div class="mb-3">
                    <label for="isi" class="form-label text-muted fw-medium">Komentar</label>
                    <textarea class="form-control rounded-3 shadow-sm" name="isi" id="isi" rows="4" placeholder="Tulis komentar kamu di sini..." required></textarea>
                </div>

                <!-- Tombol Submit -->
                <button class="btn btn-primary rounded-pill px-4 shadow-sm" type="submit" name="komen" id="komen">
                    <i class="bi bi-send-fill me-2"></i>Komentar
                </button>
            </form>
        <?php } ?>
    </div>
</div>



            <!-- isi komen -->
            <h3 class="px-4 pt-3 fw-bold text-gradient"><i class="bi bi-chat-left-text-fill me-2"></i>Komentar</h3>
<div class="col-md-6 p-3 ps-md-0 mx-2">

    <?php foreach($komen as $row){ ?>
    <div class="card shadow-sm rounded-4 my-3 border-0 hover-shadow">
        <div class="card-header bg-gradient-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
            <h5 class="mb-0 fw-semibold"><?php echo htmlspecialchars($row["nama"]); ?></h5>
            <small class="opacity-75 fst-italic" style="font-size: 0.85rem;"><?php echo htmlspecialchars($row["tanggal"]); ?></small>
        </div>
        <div class="card-body bg-light rounded-bottom-4">
            <p class="mb-0 text-dark fs-6"><?php echo nl2br(htmlspecialchars($row["isi_komen"])); ?></p>
        </div>
    </div>
    <?php } ?>

</div>

        </div>
    </div>

    <?php } ?>

    <script src="../js/jquery-3.6.0.min.js"></script>

    <script>
    $(document).ready(function() {


        $("#more").on("click", function() {
            $("#load_desk").load("../ajax/load_desk.php?id_produk=" + <?php $produk["id_produk"] ?>)
        });

        //event ketika button komen di klik
        $('#komen').on("click", function() {

            //var data  = $("#form_Comment").serialize();
            var id_produk = $("#id_produk").val();
            var nama = $("#nama").val();
            var isi = $("#isi").val();

            $.ajax({
                type: "POST",
                url: "../ajax/add_komen.php",
                data: {
                    type: "INSERT",
                    id_produk: id_produk,
                    nama: nama,
                    isi: isi
                },
                succes: function() {
                    $("#load_komen").load("../ajax/load_komen.php?id=" + $('#id_produk')
                        .val())
                }
            });
        });
    });
    </script>

    <script type="text/javascript" src="../js/bootstrap.js"></script>

</body>

</html>