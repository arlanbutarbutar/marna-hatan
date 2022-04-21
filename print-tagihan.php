<?php require_once("controller/script.php");
  if(!isset($_SESSION['id-user'])){
    header("Location: index.php");exit;
  }else if(isset($_SESSION['id-user'])){
    if($_SESSION['id-role']==1){
      header("Location: index.php");exit;
    }
  }
  if(!isset($_GET['id'])){
    header("Location: pelajar.php");exit;
  }else if(isset($_GET['id'])){
    $id=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_GET['id']))));
    $data=mysqli_query($conn, "SELECT * FROM daftar_kursus JOIN kursus ON daftar_kursus.id_kursus=kursus.id_kursus JOIN status_bayar ON daftar_kursus.id_status_bayar=status_bayar.id_status_bayar JOIN metode_bayar ON daftar_kursus.id_metode_bayar=metode_bayar.id_metode WHERE daftar_kursus.id_user='$id_user' AND id_daftar='$id'");
    if(mysqli_num_rows($data)==0){
      header("Location: pelajar.php");exit;
    }else if(mysqli_num_rows($data)>0){
      $row=mysqli_fetch_assoc($data);
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once("layout/header.php");?>
  <style>
    @media print {
      body * {visibility: hidden;}
      #print, #print * {visibility: visible;}
      #print{position: absolute;left: 0;top: 0;}
      #printTop, #printTop *{margin-top: -350px;}
      #unprint, #unprint * {visibility: hidden;}
    }
  </style>
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
    <div id="print">
      <div class="col-md-12 text-center">
        <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
        <h1 class="h3 mb-3 font-weight-normal">Tagihan Anda</h1>
      </div>
      <div class="hero" style="height: 100%;">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-lg-4 hero-left">
              <div class="align-items-center text-center mb-3">
                <img class="img-fluid" src="assets/img/img-kursus/<?= $row['img_kursus']?>" style="width: 350px;height: 200px;object-fit: cover;" alt="">
              </div>
              <div class="menus align-items-center">
                <h4 class="font-weight-bold"><?= $row['nama']?></h4>
                <h4 class="text-primary">Rp. <?= number_format($row['biaya'])?></h4>
                <p><?= $row['deskripsi']?></p>
              </div>
              <div class="menus align-items-center">
                <h5>Tagihan Kamu sebesar</h5>
                <p>Total : Rp. <?= number_format($row['biaya'])?></p>
                <p>Metode Pembayaran : <?= $row['metode_bayar']." (".$row['norek'].") - A/N ".$row['an']?></p>
              </div>
              <div class="d-flex justify-content-center mb-5">
                <a href="pelajar.php" class="btn btn-secondary" id="unprint">Kembali</a>
                <button type="button" name="print-now" class="btn btn-lg btn-primary btn-block ml-2" onClick="window.print();" id="unprint"><ion-icon name="print"></ion-icon> Print</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require_once("layout/footer.php");?>
    <script>
      function printDiv(elementId) {
        var a = document.getElementById('printing-css').value;
        var b = document.getElementById(elementId).innerHTML;
        window.frames["print_frame"].document.title = document.title;
        window.frames["print_frame"].document.body.innerHTML = '<style>' + a + '</style>' + b;
        window.frames["print_frame"].window.focus();
        window.frames["print_frame"].window.print();
      }
    </script>
</body>
</html>