<footer>
	<p class='text-center'>UDD PMI Kota Padang</p>
</footer>
<script>
	$(document).ready(function() {
		$.noConflict();
	    $("#datatable").DataTable();
		$(".DATES").datepicker({ 
			dateFormat: "yy-mm-dd",
			changeMonth: true,
			changeYear: true,
			yearRange: '1900:' + new Date().getFullYear()
			 }).val();
		    $('.select-dua').select2();
	});
		
</script>


