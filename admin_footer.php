<footer>
  <div class=" container-fluid">
    <div class="row">
      <div class="col-sm-12" >
		<p align="center">Copyright &copy; UDD PMI Kota Padang</p>
      </div><!-- col-sm-6 -->
    </div><!-- row -->
  </div><!-- content container -->
</footer>
<script src="js/jquery.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery-ui.js"></script>
<script>
	$(document).ready(function() {
  	$(".DATES").datepicker({ 
      dateFormat: "yy-mm-dd",
      changeMonth: true,
      changeYear: true,
      yearRange: '1900:' + new Date().getFullYear()
    }).val();
    $('.select-dua').select2();
  });
</script>
