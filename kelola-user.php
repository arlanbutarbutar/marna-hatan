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
    <div class="col-md-12 text-center">
      <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
      <h1 class="h3 mb-3 font-weight-normal">Data users terdaftar</h1>
      <div class="text-left mb-3">
        <a href="admin.php" class="btn btn-success btn-sm shadow">Kembali</a>
      </div>
      <div style="overflow-x: auto;">
        <table class="table table-sm">
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
              <td><?= $row['roles']?> <span class="badge badge-<?php if($row['id_status']==1){echo "danger";}else if($row['id_status']==2){echo "success";}?>"><?= $row['status']?></span></td>
              <td><?= $row['username']?> <!-- Button trigger modal -->
                <span style="cursor: pointer;" class="badge badge-info" data-toggle="modal" data-target="#profil<?= $row['id_user']?>">Lihat Photo</span>
                <div class="modal fade" id="profil<?= $row['id_user']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-body text-center">
                        <img src="assets/img/img-user/<?= $row['img_user']?>" alt="<?= $row['username']?>" style="width: 250px; height: 250px; object-fit: cover;">
                      </div>
                      <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
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
                      <form action="" method="POST">
                        <div class="modal-footer border-top-0">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                          <input type="hidden" name="id-user" value="<?= $row['id_user']?>">
                          <input type="hidden" name="username" value="<?= $row['username']?>">
                          <button type="submit" name="verifikasi-sekarang" class="btn btn-lg btn-primary btn-block">Verifikasi Sekarang</button>
                        </div>
                      </form>
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
                      <form action="" method="POST" enctype="multipart/form-data">
                        <div class="modal-body text-center">
                          <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                          <h1 class="h3 mb-3 font-weight-normal">Ubah Data <?= $row['username'];?></h1>
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
                          <input type="hidden" name="username" value="<?= $row['username']?>">
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
      </div>
    </div>
    <?php require_once("layout/footer.php");?>
</body>
</html>
