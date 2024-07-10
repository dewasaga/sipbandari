<?php
session_start();
include 'koneksi.php';

if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin') {
    header("Location: index.php");
    exit();
}

// Konfirmasi pengguna jika ada permintaan POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['confirm_id'])) {
      $confirm_id = $_POST['confirm_id'];
      
      // Logika untuk mengonfirmasi pengguna
      $stmt = $conn->prepare("UPDATE user SET is_confirmed = 1 WHERE id = ?");
      $stmt->bind_param("i", $confirm_id);
      $stmt->execute();
      $stmt->close();
  } elseif (isset($_POST['delete_id'])) {
      $delete_id = $_POST['delete_id'];
      
      // Hapus dari tabel profile
      $stmt = $conn->prepare("DELETE FROM profile WHERE user_id = ?");
      $stmt->bind_param("i", $delete_id);
      $stmt->execute();
      $stmt->close();

      // Hapus dari tabel user
      $stmt = $conn->prepare("DELETE FROM user WHERE id = ?");
      $stmt->bind_param("i", $delete_id);
      $stmt->execute();
      $stmt->close();
  }
}

// Ambil daftar pengguna yang belum dikonfirmasi
$stmt = $conn->prepare("SELECT u.id, p.nama, p.no_kk, p.nomor_hp, p.email FROM user u JOIN profile p ON u.id = p.user_id WHERE u.is_confirmed = 0 AND u.role = 'warga'");
$stmt->execute();
$stmt->bind_result($id, $nama, $no_kk, $nomor_hp, $email);
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard | SIP</title>
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="footer.css"/>
    <link rel="stylesheet" href="navbar.css"/>
    <link flex href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
    <script src="navbar.js" defer></script>
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
            <h2>Konfirmasi akun warga</h2>
        </div>
        <div class="data-container">
        <table>
            <thead>
            <tr>
                <th>Nama</th>
                <th>No. KK</th>
                <th>Nomor HP</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            <?php while ($stmt->fetch()): ?>
    <tr>
        <td><?php echo htmlspecialchars($nama); ?></td>
        <td><?php echo htmlspecialchars($no_kk); ?></td>
        <td><?php echo htmlspecialchars($nomor_hp); ?></td>
        <td><?php echo htmlspecialchars($email); ?></td>
        <td>
            <form action="adminconfirm.php" method="POST" style="display:inline;">
                <input type="hidden" name="confirm_id" value="<?php echo $id; ?>">
                <button type="submit" class="btn btn-success">Konfirmasi</button>
            </form>
            <form action="adminconfirm.php" method="POST" style="display:inline;">
                <input type="hidden" name="delete_id" value="<?php echo $id; ?>">
                <button type="submit" class="btn btn-danger">Tolak</button>
            </form>
        </td>
    </tr>
<?php endwhile; ?>

            </tbody>
        </table>
        </div>
        
    </section>
</div>
<footer>
    <div class="content">
        <div class="top">
            <div class="logo-details">
                <span class="logo_name" style="color: #fff;">DUSUN BANDARI RT 01</span>
            </div>
            <div class="media-icons">
                <a href="#"><i class="fab fa-facebook-f"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
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
</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
