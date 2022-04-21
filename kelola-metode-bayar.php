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
      <h1 class="h3 mb-3 font-weight-normal">Metode Pembayaran</h1>
      <div class="text-left mb-3">
        <a href="admin.php" class="btn btn-success btn-sm shadow">Kembali</a>
        <button type="button" class="btn btn-success btn-sm shadow text-white" data-toggle="modal" data-target="#tambah-metode">Tambah Metode Bayar</button>
        <div class="modal fade bg-white" id="tambah-metode" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content border-0">
              <form action="" method="POST">
                <div class="modal-body text-center">
                  <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                  <h1 class="h3 mb-3 font-weight-normal">Tambah Metode Bayar</h1>
                  <div class="form-group">
                    <label for="metode">Bank <span class="text-danger">*</span></label>
                    <input type="text" name="metode" <?php if(isset($_POST['metode'])){echo "value='".$_POST['metode']."'";}?> class="form-control text-center" required>
                  </div>
                  <div class="form-group">
                    <label for="norek">No. Rekening <span class="text-danger">*</span></label>
                    <input type="number" name="norek" <?php if(isset($_POST['norek'])){echo "value='".$_POST['norek']."'";}?> class="form-control text-center" required>
                  </div>
                  <div class="form-group">
                    <label for="an">A/N (Atas Nama) <span class="text-danger">*</span></label>
                    <input type="text" name="an" <?php if(isset($_POST['an'])){echo "value='".$_POST['an']."'";}?> class="form-control text-center" required>
                  </div>
                </div>
                <div class="modal-footer border-top-0">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                  <button type="submit" name="tambah-metode-bayar" class="btn btn-lg btn-primary btn-block">Tambah</button>
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
              <th scope="col" class="font-weight-bold">Nama BANK</th>
              <th scope="col" class="font-weight-bold">No. Rekening</th>
              <th scope="col" class="font-weight-bold">A/N</th>
              <th scope="col" class="font-weight-bold" colspan="2">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no=1; if(mysqli_num_rows($metodeBayar)==0){?>
            <tr>
              <th scope="row" colspan="6">Belum ada data</th>
            </tr>
            <?php }else if(mysqli_num_rows($metodeBayar)>0){while($row=mysqli_fetch_assoc($metodeBayar)){?>
            <tr>
              <th scope="row"><?= $no;?></th>
              <td><?= $row['metode_bayar']?></td>
              <td><?= $row['norek']?></td>
              <td><?= $row['an']?></td>
              <td>
                <button type="button" class="btn btn-warning btn-sm shadow" data-toggle="modal" data-target="#ubah-metode<?= $row['id_metode']?>">Ubah</button>
                <div class="modal fade bg-white" id="ubah-metode<?= $row['id_metode']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content border-0">
                      <form action="" method="POST">
                        <div class="modal-body text-center">
                          <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                          <h1 class="h3 mb-3 font-weight-normal">Ubah Data Metode Bayar</h1>
                          <div class="form-group">
                            <label for="metode">Bank <span class="text-danger">*</span></label>
                            <input type="text" name="metode" <?php if(isset($_POST['metode'])){echo "value='".$_POST['metode']."'";}else if(!isset($_POST['metode'])){echo "value='".$row['metode_bayar']."'";}?> class="form-control text-center" required>
                          </div>
                          <div class="form-group">
                            <label for="norek">No. Rekening <span class="text-danger">*</span></label>
                            <input type="number" name="norek" <?php if(isset($_POST['norek'])){echo "value='".$_POST['norek']."'";}else if(!isset($_POST['norek'])){echo "value='".$row['norek']."'";}?> class="form-control text-center" required>
                          </div>
                          <div class="form-group">
                            <label for="an">A/N (Atas Nama) <span class="text-danger">*</span></label>
                            <input type="text" name="an" <?php if(isset($_POST['an'])){echo "value='".$_POST['an']."'";}else if(!isset($_POST['an'])){echo "value='".$row['an']."'";}?> class="form-control text-center" required>
                          </div>
                        </div>
                        <div class="modal-footer border-top-0">
                          <input type="hidden" name="id-metode" value="<?= $row['id_metode']?>">
                          <input type="hidden" name="metode-bayar" value="<?= $row['metode_bayar']?>">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                          <button type="submit" name="ubah-metode-bayar" class="btn btn-lg btn-primary btn-block">Ubah</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <button type="button" class="btn btn-danger btn-sm shadow" data-toggle="modal" data-target="#hapus-metode<?= $row['id_metode']?>">Hapus</button>
                <div class="modal fade bg-white" id="hapus-metode<?= $row['id_metode']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content border-0">
                      <div class="modal-body text-center">
                        <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                        <h1 class="h3 mb-3 font-weight-normal">Hapus Data</h1>
                        Kamu yakin ingin menghapus pembayaran dengan <?= $row['metode_bayar']?>? Silakan klik <strong>Hapus</strong> untuk melanjutkan.
                      </div>
                      <form action="" method="POST">
                        <div class="modal-footer border-top-0">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                          <input type="hidden" name="id-metode" value="<?= $row['id_metode']?>">
                          <input type="hidden" name="metode-bayar" value="<?= $row['metode_bayar']?>">
                          <button type="submit" name="hapus-metode-bayar" class="btn btn-lg btn-primary btn-block">Hapus</button>
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
