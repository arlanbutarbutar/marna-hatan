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
      <h1 class="h3 mb-3 font-weight-normal">Data Pendaftaran Kursus dan Konfirmasi Pembayaran</h1>
      <div class="text-left mb-3">
        <a href="admin.php" class="btn btn-success btn-sm shadow">Kembali</a>
      </div>
      <div style="overflow-x: auto;">
        <table class="table table-sm">
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
                        <img src="assets/img/img-tagihan/<?= $row['bukti_bayar']?>" style="width: 100%;" alt="<?= $row['biaya']?>">
                        <?php }?>
                      </div>
                    </div>
                  </div>
                </div>
              </td>
              <td>
                <?php if($row['id_status_bayar']==1){?>
                  <button type="button" class="btn btn-danger btn-sm shadow">Belum Bayar</button>
                <?php }else if($row['id_status_bayar']==2){?>
                  <button type="button" class="btn btn-warning btn-sm shadow" data-toggle="modal" data-target="#validasi<?= $row['id_daftar']?>">Validasi</button>
                <?php }else if($row['id_status_bayar']==3){if(empty($row['bukti_bayar'])){?>
                  <button type="button" class="btn btn-danger btn-sm shadow">Validasi Ulang</button>
                <?php }else if(!empty($row['bukti_bayar'])){?>
                  <button type="button" class="btn btn-danger btn-sm shadow" data-toggle="modal" data-target="#validasi<?= $row['id_daftar']?>">Validasi Ulang</button>
                <?php }}else if($row['id_status_bayar']==4){?>
                  <button type="button" class="btn btn-success btn-sm shadow">Sudah Bayar</button>
                <?php }?>
                <div class="modal fade bg-white" id="validasi<?= $row['id_daftar']?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content border-0">
                      <div class="modal-body">
                        <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                        <h1 class="h3 mb-3 font-weight-normal">Validasi Pembayaran <?= $row['username'];?></h1>
                        Apakah pembayaran yang dilakukan <?= $row['username'];?> sudah benar? jika sudah, silahkan klik <strong>Validasi Sekarang</strong>.
                      </div>
                      <form action="" method="POST">
                        <div class="modal-footer border-top-0">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                          <input type="hidden" name="id-daftar" value="<?= $row['id_daftar']?>">
                          <input type="hidden" name="username" value="<?= $row['username']?>">
                          <input type="hidden" name="bukti-bayar" value="<?= $row['bukti_bayar']?>">
                          <button type="submit" name="vadidasi-gagal" class="btn btn-lg btn-danger btn-block">Tolak Bukti Bayar</button>
                          <button type="submit" name="vadidasi-sekarang" class="btn btn-lg btn-primary btn-block">Validasi Sekarang</button>
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
