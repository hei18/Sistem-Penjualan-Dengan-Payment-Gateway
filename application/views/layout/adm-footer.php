<footer class="main-footer">
	<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
	All rights reserved.
	<div class="float-right d-none d-sm-inline-block">
		<b>Version</b> 3.2.0
	</div>
</footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="<?= base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?= base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?= base_url('assets/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url('assets/'); ?>dist/js/adminlte.js"></script>
<script src="<?= base_url('assets/'); ?>js/simple.money.format.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="<?= base_url('assets/'); ?>plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/raphael/raphael.min.js"></script>

<!-- ChartJS -->
<script src="<?= base_url('assets/'); ?>plugins/chart.js/Chart.min.js"></script>

<script src="<?= base_url('assets/'); ?>plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/pdfmake/vfs_fonts.js"></script>
<!-- <script src="https://cdn.datatables.net/responsive/2.4.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script> -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR KEY"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/bs4/dt-1.13.1/datatables.min.js"></script> -->
<script type="text/javascript">
	$('#pay-button').click(function(event) {
		var amount = $(this).data('amount')

		event.preventDefault();
		$(this).attr("disabled", "disabled");

		$.ajax({

			url: '<?= base_url() ?>cs/snap/token',

			cache: false,
			data: {
				amount: amount
			},
			success: function(data) {
				//location = data;

				console.log('token = ' + data);

				var resultType = document.getElementById('result-type');
				var resultData = document.getElementById('result-data');

				function changeResult(type, data) {
					$("#result-type").val(type);
					$("#result-data").val(JSON.stringify(data));
					//resultType.innerHTML = type;
					//resultData.innerHTML = JSON.stringify(data);
				}

				snap.pay(data, {

					onSuccess: function(result) {
						changeResult('success', result);
						console.log(result.status_message);
						console.log(result);
						$("#payment-form").submit();
					},
					onPending: function(result) {
						changeResult('pending', result);
						console.log(result.status_message);
						$("#payment-form").submit();
					},
					onError: function(result) {
						changeResult('error', result);
						console.log(result.status_message);
						$("#payment-form").submit();
					}
				});
			}
		});
	});
</script>
<script>
	$('.custom-file-input').on('change', function() {
		let fileName = $(this).val().split('\\').pop();
		$(this).next('.custom-file-label').addClass("selected").html(fileName);
	});
	$(function() {
		$("#example1").DataTable({
			"responsive": true,
			"lengthChange": false,
			"autoWidth": false,
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
		$('#example2').DataTable({
			"paging": true,
			"lengthChange": false,
			"searching": false,
			"ordering": true,
			"info": true,
			"autoWidth": false,
			"responsive": true,
		});
	});

	$(document).ready(function() {
		$(".money").simpleMoneyFormat();

		$(document).on("keypress", ".numberOnly", function(e) {
			if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
				return false;
			}
		});
	});
</script>
<script>
	$(document).ready(function() {
		$('#example').DataTable({
			responsive: true
		});
	});
</script>


<script>
	window.addEventListener("play", function(evt) {
		if (window.$_currentlyPlaying && window.$_currentlyPlaying != evt.target) {
			window.$_currentlyPlaying.pause();

			window.$_currentlyPlaying.currentTime = 0;
		}
		window.$_currentlyPlaying = evt.target;
	}, true);
</script>

<script>
	var image = document.getElementById('image');
	if (image.addEventListener) {
		image.addEventListener('change', function(event) {
			for (var i = 0; i < $(this).get(0).files.length; ++i) {
				image = $(this).get(0).files[i].size;
				if (image) {
					var image_size = $(this).get(0).files[i].size;
					if (image_size > 2097152) {
						$('#file-result3').html("max file upload for image is 2MB");
						$('button[name="submit"]').prop('disabled', true);

					} else {
						$('button[name="submit"]').prop('disabled', false);
					}
				}
			}
		});
	}
</script>

<!-- AdminLTE for demo purposes -->
<!-- <script src="<?= base_url('assets/'); ?>dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="<?= base_url('assets/'); ?>dist/js/pages/dashboard2.js"></script> -->

</body>

</html>