<?php require_once("controller/script.php");
  if(isset($_SESSION['id-user'])){
    if($_SESSION['id-role']==1){
      header("Location: admin.php");exit;
    }
    if($_SESSION['id-role']==2){
      header("Location: pelajar.php");exit;
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
        <div class="row d-flex align-items-center">
          <div class="col-lg-6 hero-left">
            <h1 class="display-4">Pembelajaran yang <br>mengerti Anda</h1>
            <p class="mb-5">Keterampilan untuk masa kini (dan masa depan Anda). Mulailah bersama kami.</p>
            <div class="mb-2">
              <a class="btn btn-primary btn-shadow btn-lg" href="#gtco-menu" role="button">Mulai Kursus</a>
            </div>
          </div>
          <div class="col-lg-6 hero-right">
            <div class="owl-carousel owl-theme hero-carousel">
              <div class="item">
                <img class="img-fluid" src="assets/img/img-layout/header1.jpg" alt="">
              </div>
              <div class="item">
                <img class="img-fluid" src="assets/img/img-layout/header2.jpg" alt="">
              </div>
              <div class="item">
                <img class="img-fluid" src="assets/img/img-layout/header3.jpg" alt="">
              </div>
              <div class="item">
                <img class="img-fluid" src="assets/img/img-layout/header4.jpg" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <section id="gtco-welcome" class="bg-white section-padding">
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-sm-5 img-bg d-flex shadow align-items-center justify-content-center justify-content-md-end img-2" style="background-image: url(assets/img/img-layout/about.jpg);"></div>
            <div class="col-sm-7 py-5 pl-md-0 pl-4">
              <div class="heading-section pl-lg-5 ml-md-5">
                <span class="subheading">
                  Tentang
                </span>
                <h2>
                  LP3I
                </h2>
              </div>
              <div class="pl-lg-5 ml-md-5">
                <p>LP3I College adalah lembaga pendidikan 2 tahun siap kerja yang dibekali dengan program pendidikan dengan ilmu terapan yang spesifik. Setiap lulusan dari LP3I College akan mendapatkan sertifikasi profesi yang dapat digunakan untuk mendapatkan kerja.</p>
                <p>LP3I College Kupang, NTT berdiri pada tahun 2017 yang beralamat di Jl Ahmad Yani No 9 Strat A, Oeba, Kec. Kota Lama Kupang Nusa Tenggara Timur 85226. Di LP3I College Kupang selain program studi pendidikan 2 tahun siap kerja ada juga program studi  short course 3-6 bulan.</p>
                <h3 class="mt-5">Kontak kami</h3>
                <div class="row">
                  <div class="col-12">
                    <p>WA : 0853-3300-4438</p>
                    <p>IG	: LP3I.Kupang</p>
                    <p>FB: Lp3i College Kupang</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <section id="gtco-menu" class="section-padding">
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <div class="heading-section text-center">
                <span class="subheading">
                  Daftar Kursus
                </span>
                <h2>Pilihan Kursus</h2>
              </div>  
            </div>
          </div>
          <div class="row">
            <?php if(mysqli_num_rows($kursus)==0){?>
            <div class="col-lg-12">
              <div class="align-items-center text-center mb-3">
                <h6>Belum ada kursus yang dibuat</h6>
              </div>
            </div>
            <?php }else if(mysqli_num_rows($kursus)>0){while($row=mysqli_fetch_assoc($kursus)){?>
            <div class="col-lg-4 menu-wrap">
              <div class="align-items-center text-center mb-3">
                <img class="img-fluid" src="assets/img/img-kursus/<?= $row['img_kursus']?>" style="width: 350px;height: 200px;object-fit: cover;" alt="">
              </div>
              <div class="menus align-items-center">
                <h4 class="font-weight-bold"><?= $row['nama']?></h4>
                <h4 class="text-primary">Rp. <?= number_format($row['biaya'])?></h4>
                <p><?= $row['deskripsi']?></p>
                <div class="text-center">
                  <button type="button" class="btn btn-primary btn-shadow btn-lg mt-3" data-toggle="modal" data-target="#kursus<?= $row['id_kursus']?>">Ambil Kursus</button>
                  <div class="modal fade bg-white" id="kursus<?= $row['id_kursus']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content border-0">
                        <form action="" method="POST" enctype="multipart/form-data">
                          <div class="modal-body text-center">
                            <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                            <h1 class="h3 mb-3 font-weight-normal">Ambil Kursus <?= $row['nama']?></h1><hr>
                            <h5>Data Pengguna</h5>
                            <div class="form-group">
                              <label for="username">Username <span class="text-danger">*</span></label>
                              <input type="text" name="username" <?php if(isset($_POST['username'])){echo "value='".$_POST['username']."'";}?> id="username" class="form-control text-center" placeholder="Username" required>
                            </div>
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="first-name">Nama depan <span class="text-danger">*</span></label>
                                  <input type="text" name="first-name" <?php if(isset($_POST['first-name'])){echo "value='".$_POST['first-name']."'";}?> id="first-name" class="form-control text-center" placeholder="Nama depan" required>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="last-name">Nama belakang <span class="text-danger">*</span></label>
                                  <input type="text" name="last-name" <?php if(isset($_POST['last-name'])){echo "value='".$_POST['last-name']."'";}?> id="last-name" class="form-control text-center" placeholder="Nama belakang" required>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="email">Email <span class="text-danger">*</span></label>
                              <input type="email" name="email" <?php if(isset($_POST['email'])){echo "value='".$_POST['email']."'";}?> id="email" class="form-control text-center" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                              <label for="password">Password <span class="text-danger">*</span></label>
                              <input type="password" name="password" <?php if(isset($_POST['password'])){echo "value='".$_POST['password']."'";}?> id="password" class="form-control text-center" placeholder="Password" required>
                            </div>
                            <div class="form-group mt-4">
                              <label for="nik">NIK (No. Induk Kependudukan) <span class="text-danger">*</span></label>
                              <input type="number" name="nik" <?php if(isset($_POST['nik'])){echo "value='".$_POST['nik']."'";}?> id="nik" class="form-control text-center" placeholder="NIK (No. Induk Kependudukan)" required>
                            </div>
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="tempat-lahir">Tempat lahir <span class="text-danger">*</span></label>
                                  <input type="text" name="tempat-lahir" <?php if(isset($_POST['tempat-lahir'])){echo "value='".$_POST['tempat-lahir']."'";}?> id="tempat-lahir" class="form-control text-center" placeholder="Tempat lahir" required>
                                </div>
                              </div>
                              <div class="col-lg-6">
                                <div class="form-group">
                                  <label for="tanggal-lahir">Tanggal lahir <span class="text-danger">*</span></label>
                                  <input type="date" name="tanggal-lahir" <?php if(isset($_POST['tanggal-lahir'])){echo "value='".$_POST['tanggal-lahir']."'";}?> id="tanggal-lahir" class="form-control text-center" placeholder="Tanggal lahir" required>
                                </div>
                              </div>
                            </div>
                            <div class="form-group">
                              <label for="alamat">Alamat <span class="text-danger">*</span></label>
                              <input type="address" name="alamat" <?php if(isset($_POST['alamat'])){echo "value='".$_POST['alamat']."'";}?> id="alamat" class="form-control text-center" placeholder="Alamat" required>
                            </div>
                            <div class="form-group">
                              <label for="no-hp">No. Handphone <span class="text-danger">*</span></label>
                              <input type="number" name="no-hp" <?php if(isset($_POST['no-hp'])){echo "value='".$_POST['no-hp']."'";}?> id="no-hp" class="form-control text-center" placeholder="No. Handphone" required>
                            </div>
                            <div class="form-group">
                              <label for="img-profile">Gambar Profil <small>(3x4)</small> <span class="text-danger">*</span></label>
                              <div class="custom-file">
                                <input type="file" name="img-user" class="custom-file-input" id="customFile">
                                <label class="custom-file-label" for="customFile">Pilih Gambar Profil</label>
                              </div>
                            </div><hr>
                            <h5>Metode Pembayaran</h5>
                            <div class="form-group">
                              <label for="metode">Pilih Pembayaran</label>
                              <select name="id-metode" id="metode" class="form-control">
                                <?php foreach($metodeBayar as $rowMB):?>
                                <option value="<?= $rowMB['id_metode']?>" class="text-center"><?= $rowMB['metode_bayar']." (".$rowMB['norek'].") - A/N ".$rowMB['an']?></option>
                                <?php endforeach;?>
                              </select>
                            </div>
                          </div>
                          <div class="modal-footer border-top-0 justify-content-center">
                            <input type="hidden" name="id-kursus" value="<?= $row['id_kursus']?>">
                            <input type="hidden" name="nama-kursus" value="<?= $row['nama']?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" name="ambil-kursus" class="btn btn-lg btn-primary btn-block">Ambil Sekarang</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <?php }}?>
          </div>
        </div>
      </div>
    </section>
    <?php require_once("layout/footer.php");?>
</body>
</html>
