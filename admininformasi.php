<?php
session_start();
include 'koneksi.php';

// Memeriksa sesi dan peran pengguna
if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
  header("Location: index.php");
  exit();
}


if(isset($_POST["submit"])) {
  
  // cek data berhasil di tambakan atau tidak
  if (tambah($_POST) > 0) {
    if(mysqli_affected_rows($conn) > 0 ) {
      echo "<script>
            alert('Data Berhasil Di Tambakan');
            document.location.href = 'admininformasi.php';
            </script>";
    } else {
      echo "<script>
      alert('Data Gagal Di Tambakan');
      document.location.href = 'admininformasi.php';
      </script>";
  }

  }
}


$informasi = query("SELECT * FROM tb_informasi");

 ?>
<!DOCTYPE html>

<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Kelola Informasi | SIP</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="footer.css"/>
    <link rel="stylesheet" href="navbar.css"/>
    <script src="navbar.js" defer></script>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css"/>
  </head>
  <body>
    <div class="all">
    <nav class="sidebar locked">
      <div class="logo_items flex">
        <span class="nav_image">
          <img src="images/logo.png" alt="" />
        </span>
        <span class="logo_name">Dashboard Admin</span>
        <i class="bx bx-lock-alt" id="lock-icon" title="Unlock Sidebar"></i>
        <i class="bx bx-x" id="sidebar-close"></i>
      </div>
      <div class="menu_container">
        <div class="menu_items">
          <ul class="menu_item">
            <div class="menu_title flex">
              <span class="title">Beranda</span>
              <span class="line"></span>
            </div>
            <li class="item">
              <a href="admin.php" class="link flex">
                <i class="bx bx-home-alt"></i>
                <span>Informasi</span>
              </a>
            </ul>
            <ul class="menu_item">
                <div class="menu_title flex">
                    <span class="title">Kelola </span>
                    <span class="line"></span>
                </div>
            </li>
            <li class="item">
              <a href="admininformasi.php" class="link flex">
              <i class='bx bx-cog'></i>
                <span>Kelola Informasi</span>
              </a>
            </li>
                <li class="item">
              <a href="adminKK.php" class="link flex">
              <i class='bx bx-credit-card-front'></i>
                <span>Kartu Keluarga</span>
              </a>
            </li>
            <li class="item">
              <a href="adminsaran.php" class="link flex">
              <i class='bx bx-book-content'></i>
                <span>Saran</span>
              </a>
            </li>
            <li class="item">
              <a href="adminconfirm.php" class="link flex">
              <i class='bx bxs-contact'></i>  
                <span>Konfirmasi Data</span>
              </a>
            </li>
          </ul>
          <ul class="menu_item">
            <div class="menu_title flex">
              <span class="title">Lainnya</span>
              <span class="line"></span>
            </div>
            <li class="item">
              <a href="logout.php" class="link flex">
              <i class='bx bx-log-out'></i>
                <span>Log out</span>
              </a>
            </li>
          </ul>
        </div>
        <div class="sidebar_profile flex">
          <span class="nav_image">
            <img src="images/logo.png" alt="" />
          </span>
          <div class="data_text">
            <span class="name">RT 01 <br> Dusun Bandari</span>
          </div>
        </div>
      </div>
    </nav>
    <nav class="navbar flex">
      <i class="bx bx-menu" id="sidebar-open"></i>
    </nav>

        <section>
        <div class="header">
        <h2>Kelola Informasi</h2>
        </div>
        <form action="admininformasi.php" method="POST">
        <div class="form-group">
        <div class="form-input">
            <label for="judul">Judul Informasi</label><br>
            <input type="text" name="judul" id="judul" required placeholder="Masukan judul informasi">
        </div>
        <div class="form-input">
            <label for="informasi">Informasi</label><br>
            <textarea name="informasi" id="informasi" cols="65" rows="5" required></textarea>
        </div>
        <div class="form-input">
            <label for="date">Tanggal</label><br>
            <input type="date" name="date" id="date" required>
        </div>
        <input type="submit" value="submit" name="submit" id="submit">
    </div>
        </form>

    <div class="read_informasi">
        <br>
          <div class="data-container">
            <h2>DATA PENGUMUMAN</h2>   
               <table>
               <thead>
                <tr>
                  <th>Judul</th>
                    <th>Informasi</th>
                      <th>Aksi</th>
                      </tr>
                      </thead>
                      <tbody>
                    <?php foreach( $informasi as $row ) : ?>   
                       <tr>         
                        <td><?php echo $row['judul']; ?></td>
                        <td><?php echo $row['informasi']; ?></td>
                        <td style="padding: 10px; display:flex;">
                            <a href="delete_informasi.php?id=<?= $row["id"]; ?>" onclick="return confirm('Apakah Anda yakin ingin menghapus informasi ini?');">Hapus</a>
                            <a href="update_informasi.php?id=<?= $row["id"]; ?>" id="update" >Edit</a>
                        </td>
                        </tr>                               
                    <?php endforeach; ?>
                 </tbody>
        </table>

    </div>    
    </div>
    </section>
    </div>
  </body>
  <footer>
  <div class="content">
    <div class="top">
      <div class="logo-details">
        <span class="logo_name" style="color: #fff;">DUSUN BANDARI RT 01</span>
      </div>
    </div>
    <div class="link-boxes">
      <ul class="box">
        <li class="link_name">Dusun Bandari RT 01</li>
        <li><a href="#">Beranda</a></li>
        <li><a href="#">Tentang Kami</a></li>
        <li><a href="#">Kontak Kami</a></li>
      </ul>
      <ul class="box">
        <li class="link_name">Developer</li>
        <li><a href="#">Kelompok 2 / 4B</a></li>
        <li><a href="#">Teknik Informatika</a></li>
        <li><a href="#">Politeknik Negeri Ambon</a></li>
      </ul>
      <ul class="box">
        <li class="link_name">Source</li>
        <li><a href="#">HTML & CSS</a></li>
        <li><a href="#">Java Script</a></li>
        <li><a href="#">PHP & Bootstrap</a></li>
      </ul>
    </div>
    <div class="map-box">
      <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3981.7108650810596!2d128.16709147460904!3d-3.65322919632079!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2d6cef0a8a675545%3A0x916a3952f0162d7f!2sDusun%20Bandari!5e0!3m2!1sid!2sid!4v1720324849627!5m2!1sid!2sid" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div>
  </div>
  <div class="bottom-details">
    <div class="bottom_text">
      <span class="copyright_text">Copyright © 2024 <a href="#">KElOMPOK 2</a> All rights reserved</span>
      <span class="policy_terms">
        <a href="#">Privacy policy</a>
        <a href="#">Terms & condition</a>
      </span>
    </div>
  </div>
</footer>
</html>