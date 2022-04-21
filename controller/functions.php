<?php if(!isset($_SESSION)){session_start();}
  $date=date("l, d M Y"); $datetime=date("h:i:s a"); $datesearch=date('Y-m-d');
  if(!isset($_SESSION['id-user'])){
    function img_user(){;
      $namaFile=$_FILES["img-user"]["name"];
      $ukuranFile=$_FILES["img-user"]["size"];
      $error=$_FILES["img-user"]["error"];
      $tmpName=$_FILES["img-user"]["tmp_name"];
      if($error===4){
        $_SESSION['message-danger']="Pilih gambar terlebih dahulu!";
        $_SESSION['time-message']=time();
        return false;}
      $ekstensiGambarValid=['jpg','png','jpeg','heic'];
      $ekstensiGambar=explode('.',$namaFile);
      $ekstensiGambar=strtolower(end($ekstensiGambar));
      if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
        $_SESSION['message-danger']="Maaf, file kamu bukan gambar!";
        $_SESSION['time-message']=time();
        return false;}
      if($ukuranFile>2000000){
        $_SESSION['message-danger']="Maaf, ukuran gambar terlalu besar! (2 MB)";
        $_SESSION['time-message']=time();
        return false;}
      $namaFile_encrypt=crc32($namaFile);
      $encrypt=$namaFile_encrypt.".".$ekstensiGambar;
      move_uploaded_file($tmpName,'assets/img/img-user/'.$encrypt);
      return $encrypt;
    }
    function daftar($data){global $conn;
      $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
      $firstname=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['first-name']))));
      $last_name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['last-name']))));
      $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
      $checkEmail=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
      if(mysqli_num_rows($checkEmail)>0){
        $_SESSION['message-danger']="Maaf, email yang kamu masukkan sudah terdaftar.";
        $_SESSION['time-message']=time();
        return false;
      }
      $password=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
      $password=password_hash($password, PASSWORD_DEFAULT);
      $nik=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nik']))));
      $checkNIK=mysqli_query($conn, "SELECT * FROM users WHERE nik='$nik'");
      if(mysqli_num_rows($checkNIK)>0){
        $_SESSION['message-danger']="Maaf, NIK yang kamu masukkan sudah terdaftar.";
        $_SESSION['time-message']=time();
        return false;
      }
      if(strlen($nik)>16 || strlen($nik)<16){
        $_SESSION['message-danger']="Maaf, sepertinya kamu memasukan NIK dengan tidak benar.";
        $_SESSION['time-message']=time();
        return false;
      }
      $tempat_lahir=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tempat-lahir']))));
      $tanggal_lahir=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tanggal-lahir']))));
      if(!empty($tanggal_lahir)){
        $tanggal_lahir=date_create($tanggal_lahir);
        $tanggal_lahir=date_format($tanggal_lahir, 'd M Y');
      }
      $ttl=$tempat_lahir." ".$tanggal_lahir;
      $alamat=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
      $no_hp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['no-hp']))));
      $checkNOHP=mysqli_query($conn, "SELECT * FROM users WHERE no_hp='$no_hp'");
      if(mysqli_num_rows($checkNOHP)>0){
        $_SESSION['message-danger']="Maaf, nomor hp yang kamu masukkan sudah terdaftar.";
        $_SESSION['time-message']=time();
        return false;
      }
      if(strlen($no_hp)>12 || strlen($no_hp)<11){
        $_SESSION['message-danger']="Maaf, nomor hp yang kamu masukkan tidak benar.";
        $_SESSION['time-message']=time();
        return false;
      }
      $no_hpLen=substr($no_hp, 0, 2);
      if($no_hpLen!='08'){
        $_SESSION['message-danger']="Maaf, nomor hp yang kamu masukkan tidak benar.";
        $_SESSION['time-message']=time();
        return false;
      }
      $img_user=img_user();
      if(!$img_user){return false;}
      mysqli_query($conn, "INSERT INTO users(img_user,username,first_name,last_name,email,password,nik,ttl,alamat,no_hp) VALUES('$img_user','$username','$firstname','$last_name','$email','$password','$nik','$ttl','$alamat','$no_hp')");
      return mysqli_affected_rows($conn);
    }
    function masuk($data){global $conn;
      $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
      $password=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
      $checkEmail=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
      if(mysqli_num_rows($checkEmail)==0){
        $_SESSION['message-danger']="Maaf, email yang kamu masukkan belum terdaftar";
        $_SESSION['time-message']=time();
        return false;
      }else if(mysqli_num_rows($checkEmail)>0){
        $row=mysqli_fetch_assoc($checkEmail);
        $passUser=$row['password'];
        $id_status=$row['id_status'];
        if(password_verify($password, $passUser)){
          if($id_status==1){
            $_SESSION['message-danger']="Maaf, akun kamu belum diverifikasi oleh admin";
            $_SESSION['time-message']=time();
            return false;
          }else if($id_status==2){
            $_SESSION['id-user']=$row['id_user'];
            $_SESSION['id-role']=$row['id_role'];
            return mysqli_affected_rows($conn);
          }
        }else{
          $_SESSION['message-danger']="Maaf, password yang kamu masukan salah";
          $_SESSION['time-message']=time();
          return false;
        }
      }
    }
    function ambil_kursus($data){global $conn;
      $checkIDUser=mysqli_query($conn, "SELECT * FROM users ORDER BY id_user DESC LIMIT 1");
      if(mysqli_num_rows($checkIDUser)>0){
        $row=mysqli_fetch_assoc($checkIDUser);
        $id_user=$row['id_user']+1;
      }else if(mysqli_num_rows($checkIDUser)==0){
        $id_user=1;
      }
      $id_kursus=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kursus']))));
      $id_metode=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-metode']))));
      $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['username']))));
      $firstname=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['first-name']))));
      $last_name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['last-name']))));
      $email=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['email']))));
      $checkEmail=mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
      if(mysqli_num_rows($checkEmail)>0){
        $_SESSION['message-danger']="Maaf, email yang kamu masukkan sudah terdaftar.";
        $_SESSION['time-message']=time();
        return false;
      }
      $password=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['password']))));
      $password=password_hash($password, PASSWORD_DEFAULT);
      $nik=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nik']))));
      $checkNIK=mysqli_query($conn, "SELECT * FROM users WHERE nik='$nik'");
      if(mysqli_num_rows($checkNIK)>0){
        $_SESSION['message-danger']="Maaf, NIK yang kamu masukkan sudah terdaftar.";
        $_SESSION['time-message']=time();
        return false;
      }
      if(strlen($nik)>16 || strlen($nik)<16){
        $_SESSION['message-danger']="Maaf, sepertinya kamu memasukan NIK dengan tidak benar.";
        $_SESSION['time-message']=time();
        return false;
      }
      $tempat_lahir=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tempat-lahir']))));
      $tanggal_lahir=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['tanggal-lahir']))));
      if(!empty($tanggal_lahir)){
        $tanggal_lahir=date_create($tanggal_lahir);
        $tanggal_lahir=date_format($tanggal_lahir, 'd M Y');
      }
      $ttl=$tempat_lahir." ".$tanggal_lahir;
      $alamat=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
      $no_hp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['no-hp']))));
      $checkNOHP=mysqli_query($conn, "SELECT * FROM users WHERE no_hp='$no_hp'");
      if(mysqli_num_rows($checkNOHP)>0){
        $_SESSION['message-danger']="Maaf, nomor hp yang kamu masukkan sudah terdaftar.";
        $_SESSION['time-message']=time();
        return false;
      }
      if(strlen($no_hp)>12 || strlen($no_hp)<11){
        $_SESSION['message-danger']="Maaf, nomor hp yang kamu masukkan tidak benar.";
        $_SESSION['time-message']=time();
        return false;
      }
      $no_hpLen=substr($no_hp, 0, 2);
      if($no_hpLen!='08'){
        $_SESSION['message-danger']="Maaf, nomor hp yang kamu masukkan tidak benar.";
        $_SESSION['time-message']=time();
        return false;
      }
      $img_user=img_user();
      if(!$img_user){return false;}
      mysqli_query($conn, "INSERT INTO users(id_user,img_user,username,first_name,last_name,email,password,nik,ttl,alamat,no_hp) VALUES('$id_user','$img_user','$username','$firstname','$last_name','$email','$password','$nik','$ttl','$alamat','$no_hp')");
      mysqli_query($conn, "INSERT INTO daftar_kursus(id_user,id_kursus,id_metode_bayar) VALUES('$id_user','$id_kursus','$id_metode')");
      return mysqli_affected_rows($conn);
    }
    // function ($data){global $conn;}
  }
  if(isset($_SESSION['id-user'])){
    function img_user(){;
      $namaFile=$_FILES["img-user"]["name"];
      $ukuranFile=$_FILES["img-user"]["size"];
      $error=$_FILES["img-user"]["error"];
      $tmpName=$_FILES["img-user"]["tmp_name"];
      if($error===4){
        $_SESSION['message-danger']="Pilih gambar terlebih dahulu!";
        $_SESSION['time-message']=time();
        return false;}
      $ekstensiGambarValid=['jpg','png','jpeg','heic'];
      $ekstensiGambar=explode('.',$namaFile);
      $ekstensiGambar=strtolower(end($ekstensiGambar));
      if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
        $_SESSION['message-danger']="Maaf, file kamu bukan gambar!";
        $_SESSION['time-message']=time();
        return false;}
      if($ukuranFile>2000000){
        $_SESSION['message-danger']="Maaf, ukuran gambar terlalu besar! (2 MB)";
        $_SESSION['time-message']=time();
        return false;}
      $namaFile_encrypt=crc32($namaFile);
      $encrypt=$namaFile_encrypt.".".$ekstensiGambar;
      move_uploaded_file($tmpName,'assets/img/img-user/'.$encrypt);
      return $encrypt;
    }
    function img_kursus(){;
      $namaFile=$_FILES["img-kursus"]["name"];
      $ukuranFile=$_FILES["img-kursus"]["size"];
      $error=$_FILES["img-kursus"]["error"];
      $tmpName=$_FILES["img-kursus"]["tmp_name"];
      if($error===4){
        $_SESSION['message-danger']="Pilih gambar terlebih dahulu!";
        $_SESSION['time-message']=time();
        return false;}
      $ekstensiGambarValid=['jpg','png','jpeg','heic'];
      $ekstensiGambar=explode('.',$namaFile);
      $ekstensiGambar=strtolower(end($ekstensiGambar));
      if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
        $_SESSION['message-danger']="Maaf, file kamu bukan gambar!";
        $_SESSION['time-message']=time();
        return false;}
      if($ukuranFile>2000000){
        $_SESSION['message-danger']="Maaf, ukuran gambar terlalu besar! (2 MB)";
        $_SESSION['time-message']=time();
        return false;}
      $namaFile_encrypt=crc32($namaFile);
      $encrypt=$namaFile_encrypt.".".$ekstensiGambar;
      move_uploaded_file($tmpName,'assets/img/img-kursus/'.$encrypt);
      return $encrypt;
    }
    function img_pembayaran(){;
      $namaFile=$_FILES["bukti-bayar"]["name"];
      $ukuranFile=$_FILES["bukti-bayar"]["size"];
      $error=$_FILES["bukti-bayar"]["error"];
      $tmpName=$_FILES["bukti-bayar"]["tmp_name"];
      if($error===4){
        $_SESSION['message-danger']="Pilih gambar terlebih dahulu!";
        $_SESSION['time-message']=time();
        return false;}
      $ekstensiGambarValid=['jpg','png','jpeg','heic'];
      $ekstensiGambar=explode('.',$namaFile);
      $ekstensiGambar=strtolower(end($ekstensiGambar));
      if(!in_array($ekstensiGambar,$ekstensiGambarValid)){
        $_SESSION['message-danger']="Maaf, file kamu bukan gambar!";
        $_SESSION['time-message']=time();
        return false;}
      if($ukuranFile>2000000){
        $_SESSION['message-danger']="Maaf, ukuran gambar terlalu besar! (2 MB)";
        $_SESSION['time-message']=time();
        return false;}
      $namaFile_encrypt=crc32($namaFile);
      $encrypt=$namaFile_encrypt.".".$ekstensiGambar;
      move_uploaded_file($tmpName,'assets/img/img-tagihan/'.$encrypt);
      return $encrypt;
    }
    if($_SESSION['id-role']==1){
      function tambah_kursus($data){global $conn;
        $img_kursus=img_kursus();
        if(!$img_kursus){return false;}
        $nama=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
        $checkKursus=mysqli_query($conn, "SELECT * FROM kursus WHERE nama='$nama'");
        if(mysqli_num_rows($checkKursus)>0){
          $_SESSION['message-danger']="Maaf, kursus yang ingin kamu tambahkan sudah ada";
          $_SESSION['time-message']=time();
          return false;
        }
        $deskripsi=addslashes(trim($data['deskripsi']));
        $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['biaya']))));
        mysqli_query($conn, "INSERT INTO kursus(img_kursus,nama,deskripsi,biaya) VALUES('$img_kursus','$nama','$deskripsi','$biaya')");
        return mysqli_affected_rows($conn);
      }
      function verifikasi_sekarang($data){global $conn;
        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
        mysqli_query($conn, "UPDATE users SET id_status='2' WHERE id_user='$id_user'");
        return mysqli_affected_rows($conn);
      }
      function hapus_akun($data){global $conn;
        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
        mysqli_query($conn, "DELETE FROM users WHERE id_user='$id_user'");
        return mysqli_affected_rows($conn);
      }
      function validasi_sekarang($data){global $conn;
        $id_daftar=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-daftar']))));
        mysqli_query($conn, "UPDATE daftar_kursus SET id_status_bayar='4' WHERE id_daftar='$id_daftar'");
        return mysqli_affected_rows($conn);
      }
      function validasi_gagal($data){global $conn;
        $id_daftar=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-daftar']))));
        $bukti_bayar=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['bukti-bayar']))));
        unlink('assets/img/img-tagihan/'.$bukti_bayar);
        mysqli_query($conn, "UPDATE daftar_kursus SET id_status_bayar='3', bukti_bayar='' WHERE id_daftar='$id_daftar'");
        return mysqli_affected_rows($conn);
      }
      function ubah_kursus($data){global $conn;
        $id_kursus=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kursus']))));
        $namaFile=$_FILES["img-kursus"]["name"];
        if(!empty($namaFile)){
          $img_kursus=img_kursus();
          if(!$img_kursus){return false;}
        }else{
          $img_kursus=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['img-kursus-old']))));
        }
        $nama=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nama']))));
        $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['name']))));
        if($nama!=$name){
          $checkKursus=mysqli_query($conn, "SELECT * FROM kursus WHERE nama='$nama'");
          if(mysqli_num_rows($checkKursus)>0){
            $_SESSION['message-danger']="Maaf, kursus yang ingin kamu tambahkan sudah ada";
            $_SESSION['time-message']=time();
            return false;
          }
        }
        $deskripsi=addslashes(trim($data['deskripsi']));
        $biaya=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['biaya']))));
        mysqli_query($conn, "UPDATE kursus SET img_kursus='$img_kursus', nama='$nama', deskripsi='$deskripsi', biaya='$biaya', tgl_edit=NOW() WHERE id_kursus='$id_kursus'");
        return mysqli_affected_rows($conn);
      }
      function hapus_kursus($data){global $conn;
        $id_kursus=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kursus']))));
        mysqli_query($conn, "DELETE FROM kursus WHERE id_kursus='$id_kursus'");
        return mysqli_affected_rows($conn);
      }
      function tambah_metode_bayar($data){global $conn;
        $metode=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['metode']))));
        $norek=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['norek']))));
        $an=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['an']))));
        mysqli_query($conn, "INSERT INTO metode_bayar(metode_bayar,norek,an) VALUES('$metode','$norek','$an')");
        return mysqli_affected_rows($conn);
      }
      function ubah_metode_bayar($data){global $conn;
        $id_metode=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-metode']))));
        $metode=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['metode']))));
        $norek=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['norek']))));
        $an=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['an']))));
        mysqli_query($conn, "UPDATE metode_bayar SET metode_bayar='$metode', norek='$norek', an='$an' WHERE id_metode='$id_metode'");
        return mysqli_affected_rows($conn);
      }
      function hapus_metode_bayar($data){global $conn;
        $id_metode=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-metode']))));
        mysqli_query($conn, "DELETE FROM metode_bayar WHERE id_metode='$id_metode'");
        return mysqli_affected_rows($conn);
      }
      // function ($data){global $conn;}
    }
    if($_SESSION['id-role']==2){
      function konfirmasi_pembayaran($data){global $conn;
        $id_daftar=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-daftar']))));
        $img_pembayaran=img_pembayaran();
        if(!$img_pembayaran){return false;}
        mysqli_query($conn, "UPDATE daftar_kursus SET bukti_bayar='$img_pembayaran', id_status_bayar='2' WHERE id_daftar='$id_daftar'");
        return mysqli_affected_rows($conn);
      }
      function ambil_kursus_akun($data){global $conn;
        $id_kursus=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-kursus']))));
        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
        $checkKursus=mysqli_query($conn, "SELECT * FROM daftar_kursus WHERE id_user='$id_user' AND id_kursus='$id_kursus'");
        if(mysqli_num_rows($checkKursus)>0){
          $_SESSION['message-danger']="Maaf, kursus yang ingin kamu tambahkan sudah kamu ambil sebelumnya";
          $_SESSION['time-message']=time();
          return false;
        }
        $id_metode=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-metode']))));
        mysqli_query($conn, "INSERT INTO daftar_kursus(id_user,id_kursus,id_metode_bayar) VALUES('$id_user','$id_kursus','$id_metode')");
        return mysqli_affected_rows($conn);
      }
      // function ($data){global $conn;}
    }
    if($_SESSION['id-role']<=2){
      function ubah_akun($data){global $conn;
        $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['id-user']))));
        $first_name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['first-name']))));
        $last_name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['last-name']))));
        $nik=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nik']))));
        if(!empty($nik)){
          $nik_old=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['nik-old']))));
          if($nik!=$nik_old){
            $checkNIK=mysqli_query($conn, "SELECT * FROM users WHERE nik='$nik'");
            if(mysqli_num_rows($checkNIK)>0){
              $_SESSION['message-danger']="Maaf, NIK yang kamu masukan sudah ada";
              $_SESSION['time-message']=time();
              return false;
            }
            if(strlen($nik)>16 || strlen($nik)<16){
              $_SESSION['message-danger']="Maaf, sepertinya kamu memasukan NIK dengan tidak benar.";
              $_SESSION['time-message']=time();
              return false;
            }
          }
        }
        $ttl=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['ttl']))));
        $alamat=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['alamat']))));
        $no_hp=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['no-hp']))));
        if(!empty($no_hp)){
          $no_hpOld=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['no-hpOld']))));
          if($no_hp!=$no_hpOld){
            $checkNOHP=mysqli_query($conn, "SELECT * FROM users WHERE no_hp='$no_hp'");
            if(mysqli_num_rows($checkNOHP)>0){
              $_SESSION['message-danger']="Maaf, nomor hp yang kamu masukkan sudah terdaftar.";
              $_SESSION['time-message']=time();
              return false;
            }
            if(strlen($no_hp)>12 || strlen($no_hp)<11){
              $_SESSION['message-danger']="Maaf, nomor hp yang kamu masukkan tidak benar.";
              $_SESSION['time-message']=time();
              return false;
            }
            $no_hpLen=substr($no_hp, 0, 2);
            if($no_hpLen!='08'){
              $_SESSION['message-danger']="Maaf, nomor hp yang kamu masukkan tidak benar.";
              $_SESSION['time-message']=time();
              return false;
            }
          }
        }
        if(!empty($_FILES["img-user"]["name"])){
          $img_user=img_user();
          if(!$img_user){return false;}
        }else{
          $img_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $data['img-userOld']))));
        }
        mysqli_query($conn, "UPDATE users SET img_user='$img_user', first_name='$first_name', last_name='$last_name', nik='$nik', ttl='$ttl', alamat='$alamat', no_hp='$no_hp' WHERE id_user='$id_user'");
        return mysqli_affected_rows($conn);
      }
      // function ($data){global $conn;}
    }
  }