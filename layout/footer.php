</div>
</div>

<script src="assets/js/popper.min.js"></script>
<script src="assets/js/bootstrap.min-edit.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/moment.min.js"></script>
<script src="assets/vendor/bootstrap/popper.min.js"></script>
<script src="assets/vendor/bootstrap/bootstrap.min-edit.js"></script>
<script src="assets/vendor/select2/select2.min.js "></script>
<script src="assets/vendor/owlcarousel/owl.carousel.min.js"></script>
<script src="assets/vendor/stellar/jquery.stellar.js" type="text/javascript" charset="utf-8"></script>
<script src="assets/js/featherlight.min.js"></script>
<script src="assets/js/tempusdominus-bootstrap-4.min.js"></script>
<script src="assets/js/app.min.js "></script>
<script>
  const messageSuccess = $('.message-success').data('message-success');
  const messageInfo = $('.message-info').data('message-info');
  const messageWarning = $('.message-warning').data('message-warning');
  const messageDanger = $('.message-danger').data('message-danger');

  if(messageSuccess){
    Swal.fire({
      icon: 'success',
      title: 'Berhasil Terkirim',
      text: messageSuccess,
    })
  }

  if(messageInfo){
    Swal.fire({
      icon: 'info',
      title: 'For your information',
      text: messageInfo,
    })
  }
  if(messageWarning){
    Swal.fire({
      icon: 'warning',
      title: 'Peringatan!!',
      text: messageWarning,
    })
  }
  if(messageDanger){
    Swal.fire({
      icon: 'error',
      title: 'Kesalahan',
      text: messageDanger,
    })
  }
</script>