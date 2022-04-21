<?php require_once("controller/script.php");
  if(!isset($_SESSION['id-user'])){
    header("Location: index.php");exit;
  }else if(isset($_SESSION['id-user'])){
    if($_SESSION['id-role']==1){
      header("Location: index.php");exit;
    }
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php require_once("layout/header.php");?>
  <style>
    .img-user{width: 150px;height: 150px;object-fit: cover;}
    .hero-right{margin-top: 0;}
    .subheading{margin-top: 0;}
    @media screen and (max-width: 460px){
      .img-user{width: 300px;height: 300px;}
      .hero-right{margin-top: 200px;}
      .subheading{margin-top: 30px;}
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
    <div class="hero">
      <div class="container">
        <div class="row d-flex align-items-center">
          <div class="col-lg-6 hero-left">
            <!-- Kelola Users -->
            <?php if(mysqli_num_rows($myAccount)>0){while($row=mysqli_fetch_assoc($myAccount)){?>
            <div class="menus d-flex align-items-center">
              <div class="menu-img rounded-circle">
                <img class="img-fluid" src="assets/img/img-layout/kelola-users.png" alt="">
              </div>
              <div class="text-wrap">
                <div class="row align-items-start">
                  <div class="col-6">
                    <h4 class="font-weight-bold">Kelola Akun</h4>
                    <p class="font-weight-bold"><?= $row['username']?></p>
                    <small><?= $row['email']?></small>
                  </div>
                  <div class="col-6">
                    <button type="button" class="btn btn-primary btn-shadow btn-lg" data-toggle="modal" data-target="#ubah-akun">Ubah</button>
                    <div class="modal fade bg-white" id="ubah-akun" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content border-0">
                          <form action="" method="POST" enctype="multipart/form-data">
                            <div class="modal-body text-center">
                              <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                              <h1 class="h3 mb-3 font-weight-normal">Ubah Data</h1>
                              <div class="row">
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label for="first-name">Nama depan</label>
                                    <input type="text" name="first-name" <?php if(isset($_POST['first-name'])){echo "value='".$_POST['first-name']."'";}else if(!isset($_POST['first-name'])){echo "value='".$row['first_name']."'";}?> id="first-name" class="form-control text-center" placeholder="Nama depan" required>
                                  </div>
                                </div>
                                <div class="col-lg-6">
                                  <div class="form-group">
                                    <label for="last-name">Nama belakang</label>
                                    <input type="text" name="last-name" <?php if(isset($_POST['last-name'])){echo "value='".$_POST['last-name']."'";}else if(!isset($_POST['last-name'])){echo "value='".$row['last_name']."'";}?> id="last-name" class="form-control text-center" placeholder="Nama belakang" required>
                                  </div>
                                </div>
                              </div><hr>
                              <div class="form-group mt-4">
                                <label for="nik">NIK (No. Induk Kependudukan)</label>
                                <input type="number" name="nik" <?php if(isset($_POST['nik'])){echo "value='".$_POST['nik']."'";}else if(!isset($_POST['nik'])){echo "value='".$row['nik']."'";}?> id="nik" class="form-control text-center" placeholder="NIK (No. Induk Kependudukan)" required>
                              </div>
                              <div class="form-group">
                                <label for="ttl">TTL</label>
                                <input type="text" name="ttl" <?php if(isset($_POST['ttl'])){echo "value='".$_POST['ttl']."'";}else if(!isset($_POST['ttl'])){echo "value='".$row['ttl']."'";}?> id="ttl" class="form-control text-center" placeholder="TTL" required>
                              </div>
                              <div class="form-group">
                                <label for="alamat">Alamat</label>
                                <input type="address" name="alamat" <?php if(isset($_POST['alamat'])){echo "value='".$_POST['alamat']."'";}else if(!isset($_POST['alamat'])){echo "value='".$row['alamat']."'";}?> id="alamat" class="form-control text-center" placeholder="Alamat" required>
                              </div>
                              <div class="form-group">
                                <label for="no-hp">No. Handphone</label>
                                <input type="number" name="no-hp" <?php if(isset($_POST['no-hp'])){echo "value='".$_POST['no-hp']."'";}else if(!isset($_POST['no-hp'])){echo "value='".$row['no_hp']."'";}?> id="no-hp" class="form-control text-center" placeholder="No. Handphone" required>
                              </div>
                              <div class="form-group">
                                <label for="img-profile">Gambar Profil <small>(3x4)</small></label>
                                <div class="custom-file">
                                  <input type="file" name="img-user" class="custom-file-input" id="customFile">
                                  <label class="custom-file-label" for="customFile">Pilih Gambar Profil</label>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer border-top-0">
                              <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                              <input type="hidden" name="nik-old" value="<?= $row['nik']?>">
                              <input type="hidden" name="no-hpOld" value="<?= $row['no_hp']?>">
                              <input type="hidden" name="img-userOld" value="<?= $row['img_user']?>">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                              <button type="submit" name="ubah-akun" class="btn btn-lg btn-primary btn-block">Ubah</button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-4 text-center">
                <img src="assets/img/img-user/<?= $row['img_user']?>" class="img-thumbnail img-user" alt="<?= $row['username']?>">
              </div>
              <div class="col-lg-8">
                <table class="table table-borderless table-sm">
                  <tbody>
                    <tr>
                      <th scope="col">Nama Lengkap</th>
                      <th>:</th>
                      <td><?= $row['first_name']." ".$row['last_name']?></td>
                    </tr>
                    <tr>
                      <th scope="col">Nomor Induk Kependudukan</th>
                      <th>:</th>
                      <td><?= $row['nik']?></td>
                    </tr>
                    <tr>
                      <th scope="col">Tempat & Tanggal Lahir</th>
                      <th>:</th>
                      <td><?= $row['ttl']?></td>
                    </tr>
                    <tr>
                      <th scope="col">Alamat</th>
                      <th>:</th>
                      <td><?= $row['alamat']?></td>
                    </tr>
                    <tr>
                      <th scope="col">No. Handphone</th>
                      <th>:</th>
                      <td><?= $row['no_hp']?></td>
                    </tr>
                    <tr>
                      <th scope="col">Tgl Daftar</th>
                      <th>:</th>
                      <td><?php $date_created=date_create($row['date_created']); echo date_format($date_created, 'l, d M Y')?></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <?php }}?>
          </div>
          <div class="col-lg-6 hero-right">
            <h4 class="text-center font-weight-bold">Daftar kursus yang kamu ambil</h4><hr>
            <div class="row flex-nowrap" style="overflow-x: auto;">
              <?php if(mysqli_num_rows($myKursus)==0){?>
              <p>Belum ada kursus yang diambil</p>
              <?php }else if(mysqli_num_rows($myKursus)>0){while($row=mysqli_fetch_assoc($myKursus)){?>
              <div class="col-lg-6 menu-wrap mb-3">
                <div class="align-items-center text-center mb-3">
                  <img class="img-fluid" src="assets/img/img-kursus/<?= $row['img_kursus']?>" style="width: 350px;height: 120px;object-fit: cover;" alt="">
                </div>
                <div class="menus text-left">
                  <h6 class="font-weight-bold"><?= $row['nama']?></h6>
                  <h5 class="text-primary">Rp. <?= number_format($row['biaya'])?></h5>
                  <span class="badge badge-pill badge-<?php if($row['id_status_bayar']==1){echo "danger";}else if($row['id_status_bayar']==2){echo "warning";}else if($row['id_status_bayar']==3){echo "danger";}else if($row['id_status_bayar']==4){echo "success";}?>"><?= $row['status_bayar']?></span>
                  <?php if($row['id_status_bayar']==3){?><small>Bukti pembayaran yang anda masukan belum benar, silakan masukan ulang!</small><?php }?>
                  <p class="mt-3"><?= $row['deskripsi']?></p>
                </div>
                <?php if($row['id_status_bayar']==1 || $row['id_status_bayar']==3){?>
                  <div class="d-flex justify-content-center">
                    <a href="print-tagihan.php?id=<?= $row['id_daftar']?>" class="btn btn-secondary"><i class="fas fa-print"></i></a>
                    <button type="button" class="btn btn-lg btn-primary btn-block ml-2" data-toggle="modal" data-target="#konfirmasi-pembayaran<?= $row['id_daftar']?>">Konfirmasi Pembayaran</button>
                    <div class="modal fade bg-white" id="konfirmasi-pembayaran<?= $row['id_daftar']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content border-0">
                          <form action="" method="POST" enctype="multipart/form-data">
                            <div class="modal-body text-center">
                              <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                              <h1 class="h3 mb-3 font-weight-normal">Konfirmasi Pembayaran</h1>
                              <div class="form-group">
                                <label for="img-konfirmasi-pembayaran">Bukti Pembayaran</label>
                                <div class="custom-file">
                                  <input type="file" name="bukti-bayar" class="custom-file-input" id="customFile" required>
                                  <label class="custom-file-label" for="customFile">Choose file</label>
                                </div>
                              </div>
                            </div>
                            <div class="modal-footer border-top-0">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                              <input type="hidden" name="id-daftar" value="<?= $row['id_daftar']?>">
                              <button type="submit" name="konfirmasi-pembayaran" class="btn btn-lg btn-primary btn-block"><?php if($row['id_status_bayar']==1){echo "Konfirmasi Sekarang";}else if($row['id_status_bayar']==3){echo "Konfirmasi Ulang";}?></button>
                            </div>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                <?php }?>
              </div>
              <?php }}?>
            </div>
          </div>
        </div>
      </div>
    </div>
    <section id="gtco-menu" class="section-padding">
      <div class="container">
        <div class="section-content">
          <div class="row">
            <div class="col-md-12">
              <div class="heading-section text-center">
                <span class="subheading">
                  Ambil Kursus
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
                          <form action="" method="POST">
                            <div class="modal-body text-center">
                              <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                              <h1 class="h3 mb-3 font-weight-normal">Ambil Kursus <?= $row['nama']?></h1>
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
                              <input type="hidden" name="id-user" value="<?= $_SESSION['id-user']?>">
                              <input type="hidden" name="nama-kursus" value="<?= $row['nama']?>">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                              <button type="submit" name="ambil-kursus-akun" class="btn btn-lg btn-primary btn-block">Ambil Sekarang</button>
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
