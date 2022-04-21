<?php require_once("controller/script.php");?>
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
	  <?php require_once("layout/navbar.php");
      if(!isset($_SESSION['id-user'])){?>
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
                    <div class="modal fade" id="kursus<?= $row['id_kursus']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header border-bottom-0">
                            <h5 class="modal-title" id="exampleModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <form action="" method="POST">
                            <div class="modal-body">
                              ...
                            </div>
                            <div class="modal-footer border-top-0 justify-content-center">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                              <button type="button" class="btn btn-primary"></button>
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
    <?php }else if(isset($_SESSION['id-user'])){
      if($_SESSION['id-role']==1){?>
    <!-- role admin -->
    <div class="hero">
      <div class="container">
        <div class="row mt-5">
          <div class="col-md-12 text-center mb-3">
            <h2>Selamat datang <?= $dataUser['username']?> di Dashboard kamu</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-lg-6">
            <!-- Kelola Users -->
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
                    <button type="button" class="btn btn-primary btn-shadow btn-lg" data-toggle="modal" data-target="#kelola-user"> Lihat</button>
                  </div>
                </div>
                <p>Aktif/Belum Aktif</p>
                <p><?= $count_userAktif;?>/<?= $count_userNon_Aktif;?></p>
              </div>
            </div>
            <!-- Kelola Pembayaran -->
            <div class="menus d-flex align-items-center">
              <div class="menu-img rounded-circle">
                <img class="img-fluid" src="assets/img/img-layout/kelola-pembayaran.png" alt="">
              </div>
              <div class="text-wrap">
                <div class="row align-items-start">
                  <div class="col-6">
                    <h4>Kelola Pembayaran</h4>
                  </div>
                  <div class="col-6">
                    <button type="button" class="btn btn-primary btn-shadow btn-lg" data-toggle="modal" data-target="#kelola-pembayaran"> Lihat</button>
                  </div>
                </div>
                <p>Lunas/Belum Lunas</p>
                <p><?= $count_lunas;?>/<?= $count_belumLunas;?></p>
              </div>
            </div>
            <!-- Kelola Kursus -->
            <div class="menus d-flex align-items-center">
              <div class="menu-img rounded-circle">
                <img class="img-fluid" src="assets/img/img-layout/kelola-kursus.png" alt="">
              </div>
              <div class="text-wrap">
                <div class="row align-items-start">
                  <div class="col-6">
                    <h4>Kelola kursus</h4>
                  </div>
                  <div class="col-6">
                    <button type="button" class="btn btn-primary btn-shadow btn-lg" data-toggle="modal" data-target="#kelola-kursus"> Lihat</button>
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
    <div class="col-md-12">
      <!-- Data Table Kelola Users -->
      <div class="modal fade bg-white" id="kelola-user" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 85%;">
          <div class="modal-content border-0">
            <form method="POST" class="form-signin m-3">
              <div class="modal-body text-center">
                <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                <h1 class="h3 mb-3 font-weight-normal">Data users terdaftar</h1>
                <table class="table table-sm table-responsive">
                  <thead>
                    <tr>
                      <th scope="col" class="font-weight-bold">#</th>
                      <th scope="col" class="font-weight-bold">Hak Akses</th>
                      <th scope="col" class="font-weight-bold">Username</th>
                      <th scope="col" class="font-weight-bold">Nama Depan</th>
                      <th scope="col" class="font-weight-bold">Nama Belakang</th>
                      <th scope="col" class="font-weight-bold">Email</th>
                      <th scope="col" class="font-weight-bold">NIK</th>
                      <th scope="col" class="font-weight-bold">TTL</th>
                      <th scope="col" class="font-weight-bold">Alamat</th>
                      <th scope="col" class="font-weight-bold">No.HP</th>
                      <th scope="col" class="font-weight-bold">Tgl Regis</th>
                      <th scope="col" class="font-weight-bold">Kursus</th>
                      <th scope="col" class="font-weight-bold" colspan="3">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; if(mysqli_num_rows($queryUsers)==0){?>
                    <tr>
                      <th scope="row" colspan="16">Belum ada data</th>
                    </tr>
                    <?php }else if(mysqli_num_rows($queryUsers)>0){while($row=mysqli_fetch_assoc($queryUsers)){?>
                    <tr>
                      <th scope="row"><?= $no;?></th>
                      <td><?= $row['roles']?> <a href="#" class="badge badge-<?php if($row['id_status']==1){echo "danger";}else if($row['id_status']==2){echo "success";}?>"><?= $row['status']?></a></td>
                      <td><?= $row['username']?></td>
                      <td><?= $row['first_name']?></td>
                      <td><?= $row['last_name']?></td>
                      <td><?= $row['email']?></td>
                      <td><?= $row['nik']?></td>
                      <td><?= $row['ttl']?></td>
                      <td><?= $row['alamat']?></td>
                      <td><?= $row['no_hp']?></td>
                      <td><?php $date_created=date_create($row['date_created']); echo date_format($date_created, 'l, d M Y')?></td>
                      <td>
                        <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#kursus-user<?= $row['id_user']?>">Lihat</button>
                        <div class="modal fade bg-white" id="kursus-user<?= $row['id_user']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog modal-lg">
                            <div class="modal-content border-0">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">
                                  <img class="mb-2" src="assets/img/img-layout/idea.png" alt="" width="50" height="50">
                                  Kursus yang diambil oleh <?= $row['username'];?>
                                </h5>
                                <button type="button" class="close mt-1" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body text-center">
                                <?php $id_user_kursus=$row['id_user'];
                                  $queryUsers_kursus=mysqli_query($conn, "SELECT * FROM daftar_kursus JOIN users ON daftar_kursus.id_user=users.id_user JOIN kursus ON daftar_kursus.id_kursus=kursus.id_kursus WHERE daftar_kursus.id_user='$id_user_kursus'");
                                  if(mysqli_num_rows($queryUsers_kursus)==0){
                                ?>
                                Belum ada kursus yang diambil oleh <?= $row['username'];?>.
                                <?php }else if(mysqli_num_rows($queryUsers_kursus)>0){while($rowUK=mysqli_fetch_assoc($queryUsers_kursus)){?>
                                  <div class="row">
                                    <div class="col-lg-4 menu-wrap">
                                      <div class="align-items-center text-center mb-3">
                                        <img class="img-fluid" src="assets/img/img-kursus/<?= $rowUK['img_kursus']?>" style="width: 350px;height: 120px;object-fit: cover;" alt="">
                                      </div>
                                      <div class="menus text-left">
                                        <h6 class="font-weight-bold"><?= $rowUK['nama']?></h6>
                                        <h5 class="text-primary">Rp. <?= number_format($rowUK['biaya'])?></h5>
                                        <p><?= $rowUK['deskripsi']?></p>
                                      </div>
                                    </div>
                                  </div>
                                <?php }}?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <?php if($row['id_status']==1){?>
                      <td>
                        <button type="button" class="btn btn-success btn-sm shadow" data-toggle="modal" data-target="#verifikasi<?= $row['id_user']?>">Verifikasi</button>
                        <div class="modal fade bg-white" id="verifikasi<?= $row['id_user']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content border-0">
                              <div class="modal-body">
                                <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                                <h1 class="h3 mb-3 font-weight-normal">Verifikasi Data <?= $row['username'];?></h1>
                                Apakah data ini sudah benar? jika sudah benar, klik <strong>Verifikasi Sekarang</strong> untuk mengaktifkan akun kursus dari <?= $row['username'];?>.
                              </div>
                              <div class="modal-footer border-top-0">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <form action="" method="POST">
                                  <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                  <input type="hidden" name="username" value="<?= $row['username']?>">
                                  <button type="submit" name="verifikasi-sekarang" class="btn btn-lg btn-primary btn-block">Verifikasi Sekarang</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <?php }?>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm shadow" data-toggle="modal" data-target="#ubah-user<?= $row['id_user']?>">Ubah</button>
                        <div class="modal fade bg-white" id="ubah-user<?= $row['id_user']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content border-0">
                              <form action="" method="POST">
                                <div class="modal-body text-center">
                                  <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                                  <h1 class="h3 mb-3 font-weight-normal">Ubah Data <?= $row['username'];?></h1>
                                  <div class="row">
                                    <div class="col-lg-6">
                                      <div class="form-group">
                                        <label for="first-name">Nama depan <span class="text-danger">*</span></label>
                                        <input type="text" name="first-name" <?php if(isset($_POST['first-name'])){echo "value='".$_POST['first-name']."'";}else if(!isset($_POST['first-name'])){echo "value='".$row['first_name']."'";}?> id="first-name" class="form-control text-center" placeholder="Nama depan" required>
                                      </div>
                                    </div>
                                    <div class="col-lg-6">
                                      <div class="form-group">
                                        <label for="last-name">Nama belakang <span class="text-danger">*</span></label>
                                        <input type="text" name="last-name" <?php if(isset($_POST['last-name'])){echo "value='".$_POST['last-name']."'";}else if(!isset($_POST['last-name'])){echo "value='".$row['last_name']."'";}?> id="last-name" class="form-control text-center" placeholder="Nama belakang" required>
                                      </div>
                                    </div>
                                  </div><hr>
                                  <div class="form-group mt-4">
                                    <label for="nik">NIK (No. Induk Kependudukan) <span class="text-danger">*</span></label>
                                    <input type="number" name="nik" <?php if(isset($_POST['nik'])){echo "value='".$_POST['nik']."'";}else if(!isset($_POST['nik'])){echo "value='".$row['nik']."'";}?> id="nik" class="form-control text-center" placeholder="NIK (No. Induk Kependudukan)" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="ttl">TTL <span class="text-danger">*</span></label>
                                    <input type="text" name="ttl" <?php if(isset($_POST['ttl'])){echo "value='".$_POST['ttl']."'";}else if(!isset($_POST['ttl'])){echo "value='".$row['ttl']."'";}?> id="ttl" class="form-control text-center" placeholder="TTL" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="alamat">Alamat <span class="text-danger">*</span></label>
                                    <input type="address" name="alamat" <?php if(isset($_POST['alamat'])){echo "value='".$_POST['alamat']."'";}else if(!isset($_POST['alamat'])){echo "value='".$row['alamat']."'";}?> id="alamat" class="form-control text-center" placeholder="Alamat" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="no-hp">No. Handphone <span class="text-danger">*</span></label>
                                    <input type="number" name="no-hp" <?php if(isset($_POST['no-hp'])){echo "value='".$_POST['no-hp']."'";}else if(!isset($_POST['no-hp'])){echo "value='".$row['no_hp']."'";}?> id="no-hp" class="form-control text-center" placeholder="No. Handphone" required>
                                  </div>
                                </div>
                                <div class="modal-footer border-top-0">
                                  <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                  <input type="hidden" name="username" value="<?= $row['username']?>">
                                  <input type="hidden" name="nik-old" value="<?= $row['nik']?>">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                  <button type="submit" name="ubah-akun" class="btn btn-lg btn-primary btn-block">Ubah</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <button type="button" class="btn btn-danger btn-sm shadow" data-toggle="modal" data-target="#hapus-user<?= $row['id_user']?>">Hapus</button>
                        <div class="modal fade bg-white" id="hapus-user<?= $row['id_user']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content border-0">
                              <div class="modal-body text-center">
                                <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                                <h1 class="h3 mb-3 font-weight-normal">Hapus Data <?= $row['username'];?></h1>
                                Kamu yakin ingin menghapus data <?= $row['username'];?>? Silakan klik <strong>Hapus</strong> untuk melanjutkan.
                              </div>
                              <form action="" method="POST">
                                <div class="modal-footer border-top-0">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                  <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                                  <input type="hidden" name="username" value="<?= $row['username']?>">
                                  <button type="submit" name="hapus-akun" class="btn btn-lg btn-primary btn-block">Hapus</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <?php $no++; }}?>
                  </tbody>
                </table>
                <?php if($totalRole1_1>$dataRole1_1){?>
                <div class="d-flex mt-4 flex-wrap">
                  <p class="text-muted">Showing 1 to <?= $dataRole1_1?> of <?= $totalRole1_1?> entries</p>
                  <nav class="ml-auto">
                    <ul class="pagination separated pagination-info">
                      <?php if(isset($pageRole1_1)){if(isset($total_pageRole1_1)){if($pageRole1_1>1):?>
                        <li class="page-item">
                          <a href="<?= $_SESSION['page-to']?>?page=<?= $pageRole1_1-1;?>/" class="btn btn-success btn-sm"><i class="icon-arrow-left"></i></a>
                        </li>
                      <?php endif; for($i=1; $i<=$total_pageRole1_1; $i++): if($i<=4): if($i==$pageRole1_1):?>
                        <li class="page-item active">
                          <a href="<?= $_SESSION['page-to']?>?page=<?= $i;?>/" class="btn btn-success btn-sm"><?= $i;?></a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="<?= $_SESSION['page-to']?>?page=<?= $i;?>/" class="btn btn-outline-success btn-sm"><?= $i?></a>
                        </li>
                      <?php endif; endif; endfor; if($total_pageRole1_1>=4):?>
                        <li class="page-item">
                          <a href="<?= $_SESSION['page-to']?>?page=<?php if($pageRole1_1>4){echo $pageRole1_1;}else if($pageRole1_1<=4){echo '5';}?>/" class="btn btn-<?php if($pageRole1_1<=4){echo 'outline-';}?>success btn-sm"><?php if($pageRole1_1>4){echo $pageRole1_1;}else if($pageRole1_1<=4){echo '5';}?></a>
                        </li>
                      <?php endif; if($pageRole1_1<$total_pageRole1_1 && $total_pageRole1_1>=4):?>
                        <li class="page-item">
                          <a href="<?= $_SESSION['page-to']?>?page=<?= $pageRole1_1+1;?>/" class="btn btn-success btn-sm"><i class="icon-arrow-right"></i></a>
                        </li>
                      <?php endif; }}?>
                    </ul>
                  </nav>
                </div>
                <?php }?>
              </div>
              <div class="modal-footer justify-content-center border-top-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Data Table Kelola Pembayaran -->
      <div class="modal fade bg-white" id="kelola-pembayaran" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="max-width: 85%;">
          <div class="modal-content border-0">
            <form method="POST" class="form-signin m-3">
              <div class="modal-body text-center">
                <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                <h1 class="h3 mb-3 font-weight-normal">Data Pendaftaran Kursus dan Konfirmasi Pembayaran</h1>
                <table class="table table-sm table-responsive">
                  <thead>
                    <tr>
                      <th scope="col" class="font-weight-bold">#</th>
                      <th scope="col" class="font-weight-bold">Nama Pembeli</th>
                      <th scope="col" class="font-weight-bold">Kursus</th>
                      <th scope="col" class="font-weight-bold">Biaya</th>
                      <th scope="col" class="font-weight-bold">Status Beli</th>
                      <th scope="col" class="font-weight-bold">Tgl Beli</th>
                      <th scope="col" class="font-weight-bold">Bukti Bayar</th>
                      <th scope="col" class="font-weight-bold" colspan="1">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; if(mysqli_num_rows($daftarKursus)==0){?>
                    <tr>
                      <th scope="row" colspan="8">Belum ada data</th>
                    </tr>
                    <?php }else if(mysqli_num_rows($daftarKursus)>0){while($row=mysqli_fetch_assoc($daftarKursus)){?>
                    <tr>
                      <th scope="row"><?= $no;?></th>
                      <td><?= $row['username']?></td>
                      <td><?= $row['nama']?></td>
                      <td>Rp. <?= number_format($row['biaya'])?></td>
                      <td><?= $row['status_bayar']?></td>
                      <td><?php $date_created=date_create($row['tgl_kursus']); echo date_format($date_created, 'l, d M Y')?></td>
                      <td>
                        <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#bukti-bayar<?= $row['id_daftar']?>">Lihat</button>
                        <div class="modal fade bg-white" id="bukti-bayar<?= $row['id_daftar']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content border-0">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">
                                  <img class="mb-2" src="assets/img/img-layout/idea.png" alt="" width="50" height="50">
                                  Bukti Pembayaran
                                </h5>
                                <button type="button" class="close mt-1" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body text-center">
                                <?php if(empty($row['bukti_bayar'])){?>
                                Belum ada bukti pembayaran yang dikirim oleh <?= $row['username'];?>.
                                <?php }else if(!empty($row['bukti_bayar'])){?>
                                <img src="assets/img/img-tagihan/<?= $row['bukti_bayar']?>" alt="<?= $row['biaya']?>">
                                <?php }?>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <?php if($row['id_status_bayar']==1){?>
                          <button type="button" class="btn btn-success btn-sm shadow" data-toggle="modal" data-target="#validasi<?= $row['id_daftar']?>">Validasi</button>
                        <?php }else if($row['id_status_bayar']==2){?>
                          <button type="button" class="btn btn-success btn-sm shadow"><i class="fas fa-check-double"></i></button>
                        <?php }?>
                        <div class="modal fade bg-white" id="validasi<?= $row['id_daftar']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content border-0">
                              <div class="modal-body">
                                <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                                <h1 class="h3 mb-3 font-weight-normal">Validasi Pembayaran <?= $row['username'];?></h1>
                                Apakah pembayaran yang dilakukan <?= $row['username'];?> sudah benar? jika sudah, silahkan klik <strong>Validasi Sekarang</strong>.
                              </div>
                              <div class="modal-footer border-top-0">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <form action="" method="POST">
                                  <input type="hidden" name="id-daftar" value="<?= $row['id_daftar']?>">
                                  <input type="hidden" name="username" value="<?= $row['username']?>">
                                  <button type="submit" name="vadidasi-sekarang" class="btn btn-lg btn-primary btn-block">Validasi Sekarang</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <?php $no++; }}?>
                  </tbody>
                </table>
                <?php if($totalRole1_2>$dataRole1_2){?>
                <div class="d-flex mt-4 flex-wrap">
                  <p class="text-muted">Showing 1 to <?= $dataRole1_2?> of <?= $totalRole1_2?> entries</p>
                  <nav class="ml-auto">
                    <ul class="pagination separated pagination-info">
                      <?php if(isset($pageRole1_2)){if(isset($total_pageRole1_2)){if($pageRole1_2>1):?>
                        <li class="page-item">
                          <a href="<?= $_SESSION['page-to']?>?page=<?= $pageRole1_2-1;?>/" class="btn btn-success btn-sm"><i class="icon-arrow-left"></i></a>
                        </li>
                      <?php endif; for($i=1; $i<=$total_pageRole1_2; $i++): if($i<=4): if($i==$pageRole1_2):?>
                        <li class="page-item active">
                          <a href="<?= $_SESSION['page-to']?>?page=<?= $i;?>/" class="btn btn-success btn-sm"><?= $i;?></a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="<?= $_SESSION['page-to']?>?page=<?= $i;?>/" class="btn btn-outline-success btn-sm"><?= $i?></a>
                        </li>
                      <?php endif; endif; endfor; if($total_pageRole1_2>=4):?>
                        <li class="page-item">
                          <a href="<?= $_SESSION['page-to']?>?page=<?php if($pageRole1_2>4){echo $pageRole1_2;}else if($pageRole1_2<=4){echo '5';}?>/" class="btn btn-<?php if($pageRole1_2<=4){echo 'outline-';}?>success btn-sm"><?php if($pageRole1_2>4){echo $pageRole1_2;}else if($pageRole1_2<=4){echo '5';}?></a>
                        </li>
                      <?php endif; if($pageRole1_2<$total_pageRole1_2 && $total_pageRole1_2>=4):?>
                        <li class="page-item">
                          <a href="<?= $_SESSION['page-to']?>?page=<?= $pageRole1_2+1;?>/" class="btn btn-success btn-sm"><i class="icon-arrow-right"></i></a>
                        </li>
                      <?php endif; }}?>
                    </ul>
                  </nav>
                </div>
                <?php }?>
              </div>
              <div class="modal-footer justify-content-center border-top-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
      <!-- Data Table Kelola Kursus -->
      <div class="modal fade bg-white <?php if(isset($_GET['page-kursus'])){echo "show";}?>" id="kelola-kursus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"  <?php if(isset($_GET['page-kursus'])){echo "style='display: block; padding-right: 5px;'";}?>>
        <div class="modal-dialog" style="max-width: 85%;">
          <div class="modal-content border-0">
            <form method="POST" class="form-signin m-3">
              <div class="modal-body text-center">
                <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                <h1 class="h3 mb-3 font-weight-normal">Data Kursus</h1>
                <table class="table table-sm table-responsive">
                  <thead>
                    <tr>
                      <th scope="col" class="font-weight-bold">#</th>
                      <th scope="col" class="font-weight-bold">Nama</th>
                      <th scope="col" class="font-weight-bold">Deskripsi</th>
                      <th scope="col" class="font-weight-bold">Biaya</th>
                      <th scope="col" class="font-weight-bold">Tgl Buat</th>
                      <th scope="col" class="font-weight-bold">Tgl Ubah</th>
                      <th scope="col" class="font-weight-bold">Image</th>
                      <th scope="col" class="font-weight-bold" colspan="2">Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $no=1; if(mysqli_num_rows($queryKursus)==0){?>
                    <tr>
                      <th scope="row" colspan="8">Belum ada data</th>
                    </tr>
                    <?php }else if(mysqli_num_rows($queryKursus)>0){while($row=mysqli_fetch_assoc($queryKursus)){?>
                    <tr>
                      <th scope="row"><?= $no;?></th>
                      <td><?= $row['nama']?></td>
                      <td><?= $row['deskripsi']?></td>
                      <td>Rp. <?= number_format($row['biaya'])?></td>
                      <td><?php $date_created=date_create($row['tgl_buat']); echo date_format($date_created, 'l, d M Y')?></td>
                      <td><?php $date_created=date_create($row['tgl_edit']); echo date_format($date_created, 'l, d M Y')?></td>
                      <td>
                        <button type="button" class="btn btn-info btn-sm shadow" data-toggle="modal" data-target="#image-kursus<?= $row['id_kursus']?>">Lihat</button>
                        <div class="modal fade bg-white" id="image-kursus<?= $row['id_kursus']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content border-0">
                              <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">
                                  <img class="mb-2" src="assets/img/img-layout/idea.png" alt="" width="50" height="50">
                                  Gambar Kursus
                                </h5>
                                <button type="button" class="close mt-1" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body text-center">
                                <img src="assets/img/img-kursus/<?= $row['img_kursus']?>" alt="<?= $row['nama']?>">
                              </div>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <button type="button" class="btn btn-warning btn-sm shadow" data-toggle="modal" data-target="#ubah-kursus<?= $row['id_kursus']?>">Ubah</button>
                        <div class="modal fade bg-white" id="ubah-kursus<?= $row['id_kursus']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content border-0">
                              <form action="" method="POST" enctype="multipart/form-data">
                                <div class="modal-body text-center">
                                  <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                                  <h1 class="h3 mb-3 font-weight-normal">Ubah Data Kursus <?= $row['nama'];?></h1>
                                  <div class="form-group">
                                    <label for="img">Gambar <span class="text-danger">*</span></label>
                                    <div class="custom-file">
                                      <input type="file" name="img-kursus" class="custom-file-input" id="customFile">
                                      <label class="custom-file-label" for="customFile">Choose file</label>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label for="nama">Nama <span class="text-danger">*</span></label>
                                    <input type="text" name="nama" <?php if(isset($_POST['nama'])){echo "value='".$_POST['nama']."'";}else if(!isset($_POST['nama'])){echo "value='".$row['nama']."'";}?> class="form-control" required>
                                  </div>
                                  <div class="form-group">
                                    <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                                    <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="10" required><?php if(isset($_POST['deskripsi'])){echo $_POST['deskripsi'];}else if(!isset($_POST['deskripsi'])){echo $row['deskripsi'];}?></textarea>
                                  </div>
                                  <div class="form-group">
                                    <label for="biaya">Biaya <span class="text-danger">*</span></label>
                                    <input type="number" name="biaya" <?php if(isset($_POST['biaya'])){echo "value='".$_POST['biaya']."'";}else if(!isset($_POST['biaya'])){echo "value='".$row['biaya']."'";}?> class="form-control" required>
                                  </div>
                                </div>
                                <div class="modal-footer border-top-0">
                                  <input type="hidden" name="id-kursus" value="<?= $row['id_kursus']?>">
                                  <input type="hidden" name="name" value="<?= $row['nama']?>">
                                  <input type="hidden" name="img-kursus-old" value="<?= $row['img_kursus']?>">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                  <button type="submit" name="ubah-kursus" class="btn btn-lg btn-primary btn-block">Ubah</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </td>
                      <td>
                        <button type="button" class="btn btn-danger btn-sm shadow" data-toggle="modal" data-target="#hapus-kursus<?= $row['id_kursus']?>">Hapus</button>
                        <div class="modal fade bg-white" id="hapus-kursus<?= $row['id_kursus']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content border-0">
                              <div class="modal-body text-center">
                                <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                                <h1 class="h3 mb-3 font-weight-normal">Hapus Data <?= $row['nama'];?></h1>
                                Kamu yakin ingin menghapus data <?= $row['nama'];?>? Silakan klik <strong>Hapus</strong> untuk melanjutkan.
                              </div>
                              <form action="" method="POST">
                                <div class="modal-footer border-top-0">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                  <input type="hidden" name="id-kursus" value="<?= $row['id_kursus']?>">
                                  <input type="hidden" name="name" value="<?= $row['nama']?>">
                                  <button type="submit" name="hapus-kursus" class="btn btn-lg btn-primary btn-block">Hapus</button>
                                </div>
                              </form>
                            </div>
                          </div>
                        </div>
                      </td>
                    </tr>
                    <?php $no++; }}?>
                  </tbody>
                </table>
                <?php if($totalRole1_3>$dataRole1_3){?>
                <div class="d-flex mt-4 flex-wrap">
                  <p class="text-muted">Showing 1 to <?= $dataRole1_3?> of <?= $totalRole1_3?> entries</p>
                  <nav class="ml-auto">
                    <ul class="pagination separated pagination-info">
                      <?php if(isset($pageRole1_3)){if(isset($total_pageRole1_3)){if($pageRole1_3>1):?>
                        <li class="page-item">
                          <a href="<?= $_SESSION['page-to']?>?page-kursus=<?= $pageRole1_3-1;?>/" class="btn btn-dark btn-sm"><i class="fas fa-angle-left"></i></a>
                        </li>
                      <?php endif; for($i=1; $i<=$total_pageRole1_3; $i++): if($i<=4): if($i==$pageRole1_3):?>
                        <li class="page-item active">
                          <a href="<?= $_SESSION['page-to']?>?page-kursus=<?= $i;?>/" class="btn btn-dark btn-sm ml-2"><?= $i;?></a>
                        </li>
                      <?php else : ?>
                        <li class="page-item">
                          <a href="<?= $_SESSION['page-to']?>?page-kursus=<?= $i;?>/" class="btn btn-outline-dark btn-sm ml-2"><?= $i?></a>
                        </li>
                      <?php endif; endif; endfor; if($total_pageRole1_3>=4):?>
                        <li class="page-item">
                          <a href="<?= $_SESSION['page-to']?>?page-kursus=<?php if($pageRole1_3>4){echo $pageRole1_3;}else if($pageRole1_3<=4){echo '5';}?>/" class="btn btn-<?php if($pageRole1_3<=4){echo 'outline-';}?>dark btn-sm ml-2"><?php if($pageRole1_3>4){echo $pageRole1_3;}else if($pageRole1_3<=4){echo '5';}?></a>
                        </li>
                      <?php endif; if($pageRole1_3<$total_pageRole1_3 && $total_pageRole1_3>=4):?>
                        <li class="page-item">
                          <a href="<?= $_SESSION['page-to']?>?page-kursus=<?= $pageRole1_3+1;?>/" class="btn btn-dark btn-sm ml-2"><i class="fas fa-angle-right"></i></a>
                        </li>
                      <?php endif; }}?>
                    </ul>
                  </nav>
                </div>
                <?php }?>
              </div>
              <div class="modal-footer justify-content-center border-top-0">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <?php }if($_SESSION['id-role']==2){?>
    <!-- role pengajar -->
    <?php }if($_SESSION['id-role']==3){?>
    <!-- role pelajar -->
<?php }}require_once("layout/footer.php");?>
</body>
</html>
