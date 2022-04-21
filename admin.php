<?php require_once("controller/script.php");
  if(!isset($_SESSION['id-user'])){
    header("Location: index.php");exit;
  }else if(isset($_SESSION['id-user'])){
    if($_SESSION['id-role']==2){
      header("Location: index.php");exit;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once("layout/header.php");?>
</head>
<body data-spy="scroll" data-target="#navbar" class="static-layout">
  <?php if(isset($_SESSION['message-success'])){?>
  <div class="message-success" data-message-success="<?= $_SESSION['message-success']?>"></div>
  <?php } if(isset($_SESSION['message-info'])){?>
  <div class="message-info" data-message-info="<?= $_SESSION['message-info']?>"></div>
  <?php } if(isset($_SESSION['message-warning'])){?>
  <div class="message-warning" data-message-warning="<?= $_SESSION['message-warning']?>"></div>
  <?php } if(isset($_SESSION['message-danger'])){?>
  <div class="message-danger" data-message-danger="<?= $_SESSION['message-danger']?>"></div>
  <?php }?>
	<div class="boxed-page">
	  <?php require_once("layout/navbar.php");?>
    <div class="hero">
      <div class="container">
        <div class="row mt-5">
          <div class="col-md-12 text-center mb-3">
            <h2>Selamat datang <?= $dataUser['username']?> di Dashboard kamu</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <!-- Kelola Users -->
          <div class="col-lg-6">
            <div class="menus d-flex align-items-center">
              <div class="menu-img rounded-circle">
                <img class="img-fluid" src="assets/img/img-layout/kelola-users.png" alt="">
              </div>
              <div class="text-wrap">
                <div class="row align-items-start">
                  <div class="col-6">
                    <h4 class="font-weight-bold">Kelola Users</h4>
                  </div>
                  <div class="col-6">
                    <a href="kelola-user.php" class="btn btn-primary btn-shadow btn-lg">Lihat</a>
                  </div>
                </div>
                <p>Aktif/Belum Aktif</p>
                <p><?= $count_userAktif;?>/<?= $count_userNon_Aktif;?></p>
              </div>
            </div>
          </div>
          <!-- Kelola Pembayaran -->
          <div class="col-lg-6">
            <div class="menus d-flex align-items-center">
              <div class="menu-img rounded-circle">
                <img class="img-fluid" src="assets/img/img-layout/kelola-pembayaran.png" alt="">
              </div>
              <div class="text-wrap">
                <div class="row align-items-start">
                  <div class="col-6">
                    <h4 class="font-weight-bold">Kelola Pembayaran</h4>
                  </div>
                  <div class="col-6">
                    <a href="kelola-pembayaran.php" class="btn btn-primary btn-shadow btn-lg">Lihat</a>
                  </div>
                </div>
                <p>Lunas/Belum Lunas</p>
                <p><?= $count_lunas;?>/<?= $count_belumLunas;?></p>
              </div>
            </div>
          </div>
          <!-- Kelola Kursus -->
          <div class="col-lg-6">
            <div class="menus d-flex align-items-center">
              <div class="menu-img rounded-circle">
                <img class="img-fluid" src="assets/img/img-layout/kelola-kursus.png" alt="">
              </div>
              <div class="text-wrap">
                <div class="row align-items-start">
                  <div class="col-6">
                    <h4 class="font-weight-bold">Kelola Kursus</h4>
                  </div>
                  <div class="col-6">
                    <a href="kelola-kursus.php" class="btn btn-primary btn-shadow btn-lg">Lihat</a>
                  </div>
                </div>
                <p>Total Kursus</p>
                <p><?= $count_kursus;?></p>
              </div>
            </div>
          </div>
          <!-- Kelola Metode Bayar -->
          <div class="col-lg-6">
            <div class="menus d-flex align-items-center">
              <div class="menu-img rounded-circle">
                <img class="img-fluid" src="assets/img/img-layout/wallet.png" alt="">
              </div>
              <div class="text-wrap">
                <div class="row align-items-start">
                  <div class="col-6">
                    <h4 class="font-weight-bold">Kelola Metode Bayar</h4>
                  </div>
                  <div class="col-6">
                    <a href="kelola-metode-bayar.php" class="btn btn-primary btn-shadow btn-lg">Lihat</a>
                  </div>
                </div>
                <p>Total Kursus</p>
                <p><?= $count_kursus;?></p>
              </div>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
    <?php require_once("layout/footer.php");?>
</body>
</html>
