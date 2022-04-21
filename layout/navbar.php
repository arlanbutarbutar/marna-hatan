<nav id="navbar-header" class="navbar navbar-expand-lg">
  <div class="container">
    <a class="navbar-brand navbar-brand-center d-flex align-items-center p-0 only-mobile" href="./">
      <img src="assets/img/img-layout/Logo.png" alt="">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="lnr lnr-menu"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
      <a class="navbar-brand navbar-brand-center d-flex align-items-center only-desktop" href="./">
        <img src="assets/img/img-layout/Logo.png" alt="">
      </a>
      <ul class="navbar-nav d-flex justify-content-between">
        <li class="nav-item only-desktop"></li>
        <div class="d-flex flex-lg-row flex-column">
          <li class="nav-item">
            <a class="nav-link" href="index.php">Home</a>
          </li>
          <?php if(!isset($_SESSION['id-user'])){?>
          <li class="nav-item">
            <a class="nav-link" href="#gtco-welcome">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#gtco-menu">Daftar Kursus</a>
          </li>
          <?php }if(isset($_SESSION['id-user'])){if($_SESSION['id-role']==2){?>
          <li class="nav-item">
            <a class="nav-link" href="#gtco-menu">Daftar Kursus</a>
          </li>
          <?php }}if(isset($_SESSION['id-user'])){if($_SESSION['id-role']<=2){?>
          <li class="nav-item">
            <a class="nav-link"></a>
          </li>
          <li class="nav-item">
            <form action="" method="POST">
              <button type="submit" name="keluar" class="btn btn-primary btn-shadow btn-lg">Keluar</button>
            </form>
          </li>
          <?php }}if(!isset($_SESSION['id-user'])){?>
          <li class="nav-item">
            <a class="nav-link"></a>
          </li>
          <li class="nav-item">
            <button type="button" class="btn btn-primary btn-shadow btn-lg" data-toggle="modal" data-target="#masuk"><ion-icon name="log-in-outline"></ion-icon> Masuk</button>
            <div class="modal fade bg-white" id="masuk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content border-0">
                  <form method="POST" class="form-signin m-3">
                    <div class="modal-body text-center">
                      <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                      <h1 class="h3 mb-3 font-weight-normal">Masuk</h1>
                      <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control text-center" placeholder="Email" required>
                      </div>
                      <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control text-center" placeholder="Password" required>
                      </div>
                      <button type="button" class="btn btn-link text-dark text-decoration-none btn-lg" data-toggle="modal" data-target="#daftar">Belum ada akun? daftar sekarang!</button>
                    </div>
                    <div class="modal-footer border-top-0">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      <button class="btn btn-lg btn-primary btn-block" type="submit" name="masuk">Masuk</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </li>
          <li class="nav-item">
            <div class="modal <?php if(isset($_POST['daftar'])){echo "show";}else{echo "fade";}?> bg-white" id="daftar" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content border-0">
                  <form method="POST" class="form-signin m-3" enctype="multipart/form-data">
                    <div class="modal-body text-center">
                      <img class="mb-2 mr-4" src="assets/img/img-layout/idea.png" alt="" width="100" height="100">
                      <h1 class="h3 mb-3 font-weight-normal">Daftar</h1>
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
                      <hr>
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
                      </div>
                    </div>
                    <div class="modal-footer border-top-0">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                      <button class="btn btn-lg btn-primary btn-block" type="submit" name="daftar">Daftar</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </li>
          <?php }?>
        </div>
      </ul>
    </div>
  </div>
</nav>