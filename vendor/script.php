<?php if(!isset($_SESSION)){session_start();}
  require_once("db_connect.php"); require_once("functions.php");
  if (isset($_SESSION['time-message'])) {
    if((time()-$_SESSION['time-message'])>2){
        if(isset($_SESSION['message-success'])){unset($_SESSION['message-success']);}
        if(isset($_SESSION['message-info'])){unset($_SESSION['message-info']);}
        if(isset($_SESSION['message-warning'])){unset($_SESSION['message-warning']);}
        if(isset($_SESSION['message-danger'])){unset($_SESSION['message-danger']);}
        if(isset($_SESSION['message-dark'])){unset($_SESSION['message-dark']);}
        unset($_SESSION['time-alert']);}}
  $kursus=mysqli_query($conn, "SELECT * FROM kursus");
  if(!isset($_SESSION['id-user'])){
    if(isset($_POST['daftar'])){
      if(daftar($_POST)>0){
        $_SESSION['message-success']="Kamu telah terdaftar, silakan masuk untuk melanjutkan kursus kamu";
        $_SESSION['time-message']=time();
        header("Location: ./");
        return true;
      }
    }
    if(isset($_POST['masuk'])){
      if(masuk($_POST)>0){
        header("Location: ./");
        return true;
      }
    }
  }
  if(isset($_SESSION['id-user'])){
    $id_user=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_SESSION['id-user']))));
    $dataUser=mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_user'");
    $dataUser=mysqli_fetch_assoc($dataUser);
    if(isset($_POST['keluar'])){
      unset($_SESSION);
      $_SESSION = [];
      session_unset();
      session_destroy();
      header("Location: ./");
      return true;
    }
    if($_SESSION['id-role']==1){
      if(isset($_POST['tambah-kursus'])){
        if(tambah_kursus($_POST)>0){
          $_SESSION['message-success']="Kamu telah menambahkan kursus baru";
          $_SESSION['time-message']=time();
          header("Location: ./");
          return true;
        }
      }
      $userAktif=mysqli_query($conn, "SELECT * FROM users WHERE id_status='1'");
      $count_userAktif=mysqli_num_rows($userAktif);
      $userNon_Aktif=mysqli_query($conn, "SELECT * FROM users WHERE id_status='2'");
      $count_userNon_Aktif=mysqli_num_rows($userNon_Aktif);
      $dataRole1_1=25;
      $resultRole1_1=mysqli_query($conn, "SELECT * FROM users WHERE id_user='$id_user'");
      $totalRole1_1=mysqli_num_rows($resultRole1_1);
      $total_pageRole1_1=ceil($totalRole1_1/$dataRole1_1);
      $pageRole1_1=isset($_GET["page"])?(int)$_GET["page"]:1;
      $awal_dataRole1_1=($pageRole1_1>1)?($pageRole1_1*$dataRole1_1)-$dataRole1_1:0;
      $queryUsers=mysqli_query($conn, "SELECT * FROM users JOIN users_role ON users.id_role=users_role.id_role JOIN users_status ON users.id_status=users_status.id_status WHERE users.id_user!='$id_user' ORDER BY users.id_user DESC LIMIT $awal_dataRole1_1, $dataRole1_1");
      if(isset($_POST['verifikasi-sekarang'])){
        if(verifikasi_sekarang($_POST)>0){
          $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['username']))));
          $_SESSION['message-success']="Kamu telah memverifikasi akun dari ".$username;
          $_SESSION['time-message']=time();
          header("Location: ./");
          return true;
        }
      }
      $selectKursus=mysqli_query($conn, "SELECT nama FROM kursus");
      if(isset($_POST['ubah-akun'])){
        if(ubah_akun($_POST)>0){
          $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['username']))));
          $_SESSION['message-success']="Kamu telah mengubah data akun dari ".$username;
          $_SESSION['time-message']=time();
          header("Location: ./");
          return true;
        }else{
          $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['username']))));
          $_SESSION['message-success']="Maaf, terjadi kesalahan saat kamu mengubah data ".$username;
          $_SESSION['time-message']=time();
          return false;
        }
      }
      if(isset($_POST['hapus-akun'])){
        if(hapus_akun($_POST)>0){
          $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['username']))));
          $_SESSION['message-success']="Kamu telah menghapus akun dari ".$username;
          $_SESSION['time-message']=time();
          header("Location: ./");
          return true;
        }
      }
      $lunas=mysqli_query($conn, "SELECT * FROM daftar_kursus WHERE id_status_bayar='2'");
      $count_lunas=mysqli_num_rows($lunas);
      $belumLunas=mysqli_query($conn, "SELECT * FROM daftar_kursus WHERE id_status_bayar='1'");
      $count_belumLunas=mysqli_num_rows($belumLunas);
      $manyKursus=mysqli_query($conn, "SELECT * FROM kursus");
      $count_kursus=mysqli_num_rows($manyKursus);
      $dataRole1_2=25;
      $resultRole1_2=mysqli_query($conn, "SELECT * FROM daftar_kursus");
      $totalRole1_2=mysqli_num_rows($resultRole1_2);
      $total_pageRole1_2=ceil($totalRole1_2/$dataRole1_2);
      $pageRole1_2=isset($_GET["page"])?(int)$_GET["page"]:1;
      $awal_dataRole1_2=($pageRole1_2>1)?($pageRole1_2*$dataRole1_2)-$dataRole1_2:0;
      $daftarKursus=mysqli_query($conn, "SELECT * FROM daftar_kursus JOIN users ON daftar_kursus.id_user=users.id_user JOIN kursus ON daftar_kursus.id_kursus=kursus.id_kursus JOIN metode_bayar ON daftar_kursus.id_metode_bayar=metode_bayar.id_metode JOIN status_bayar ON daftar_kursus.id_status_bayar=status_bayar.id_status_bayar ORDER BY daftar_kursus.id_daftar DESC LIMIT $awal_dataRole1_2, $dataRole1_2");
      if(isset($_POST['vadidasi-sekarang'])){
        if(validasi_sekarang($_POST)>0){
          $username=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['username']))));
          $_SESSION['message-success']="Kamu telah memvalidasi pembayaran dari ".$username;
          $_SESSION['time-message']=time();
          header("Location: ./");
          return true;
        }
      }
      $dataRole1_3=2;
      $resultRole1_3=mysqli_query($conn, "SELECT * FROM kursus");
      $totalRole1_3=mysqli_num_rows($resultRole1_3);
      $total_pageRole1_3=ceil($totalRole1_3/$dataRole1_3);
      $pageRole1_3=isset($_GET["page-kursus"])?(int)$_GET["page-kursus"]:1;
      $awal_dataRole1_3=($pageRole1_3>1)?($pageRole1_3*$dataRole1_3)-$dataRole1_3:0;
      $queryKursus=mysqli_query($conn, "SELECT * FROM kursus ORDER BY id_kursus DESC LIMIT $awal_dataRole1_3, $dataRole1_3");
      if(isset($_POST['ubah-kursus'])){
        if(ubah_kursus($_POST)>0){
          $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['name']))));
          $_SESSION['message-success']="Kamu telah mengubah data kursus ".$name;
          $_SESSION['time-message']=time();
          header("Location: ./");
          return true;
        }else{
          $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['name']))));
          $_SESSION['message-success']="Maaf, terjadi kesalahan saat kamu mengubah data kursus".$name;
          $_SESSION['time-message']=time();
          return false;
        }
      }
      if(isset($_POST['hapus-kursus'])){
        if(hapus_kursus($_POST)>0){
          $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['name']))));
          $_SESSION['message-success']="Kamu telah menghapus data kursus ".$name;
          $_SESSION['time-message']=time();
          header("Location: ./");
          return true;
        }else{
          $name=htmlspecialchars(addslashes(trim(mysqli_real_escape_string($conn, $_POST['name']))));
          $_SESSION['message-danger']="Maaf, terjadi kesalahan saat kamu ingin menghapus data kursus ".$name." dikarenakan data sedang digunakan";
          $_SESSION['time-message']=time();
          return false;
        }
      }
    }
    if($_SESSION['id-role']==2){
      // code next
    }
  }