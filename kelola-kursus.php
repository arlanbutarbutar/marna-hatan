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
      <h1 class="h3 mb-3 font-weight-normal">Data Kursus</h1>
      <div class="text-left mb-3">
        <a href="admin.php" class="btn btn-success btn-sm shadow">Kembali</a>
        <a class="btn btn-success btn-sm shadow text-white" style="cursor: pointer;" data-toggle="modal" data-target="#tambah-kursus">Tambah Kursus</a>
        <div class="modal fade bg-white" id="tambah-kursus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content border-0">
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="modal-body text-center">
                  <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                  <h1 class="h3 mb-3 font-weight-normal">Tambah Kursus</h1>
                  <div class="form-group">
                    <label for="img">Gambar <span class="text-danger">*</span></label>
                    <div class="custom-file">
                      <input type="file" name="img-kursus" class="custom-file-input" id="customFile">
                      <label class="custom-file-label" for="customFile">Unggah Gambar</label>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="nama">Nama <span class="text-danger">*</span></label>
                    <input type="text" name="nama" <?php if(isset($_POST['nama'])){echo "value='".$_POST['nama']."'";}?> class="form-control" required>
                  </div>
                  <div class="form-group">
                    <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                    <textarea name="deskripsi" id="deskripsi" class="form-control" cols="30" rows="10" required><?php if(isset($_POST['deskripsi'])){echo $_POST['deskripsi'];}?></textarea>
                  </div>
                  <div class="form-group">
                    <label for="biaya">Biaya <span class="text-danger">*</span></label>
                    <input type="number" name="biaya" <?php if(isset($_POST['biaya'])){echo "value='".$_POST['biaya']."'";}?> class="form-control" required>
                  </div>
                </div>
                <div class="modal-footer border-top-0">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-kursus" class="btn btn-lg btn-primary btn-block">Tambah</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div style="overflow-x: auto;">
        <table class="table table-sm">
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
      </div>
    </div>
    <?php require_once("layout/footer.php");?>
</body>
</html>
