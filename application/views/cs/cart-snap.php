<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>

<body>
	<div class="card-body">
		<div class="table-responsive">
			<table class=" table table-bordered" width="100%">
				 <thead>
					<tr class="bg-light">
						<th>Title</th>
						<th>Qty</th>

						<th>Subtotal</th>

						<th>Action</th>

					</tr>
				</thead>
				<tbody>
					<?php if ($cart == null) : ?>
						<tr>
							<td colspan="4">
								<div class="alert alert-info" role="alert">
									No Data
								</div>
							</td>
						</tr>
					<?php else : ?>
					<?php endif; ?>
					<?php
					$total = 0;
					foreach ($cart as $c) : ?>
						<tr>

							<th><?= $c['title']; ?></th>
							<th><?= $c['qty']; ?></th>

							<th><?= idr($c['subtotal']); ?></th>

							<th class="text-right">
								<a class="btn btn-sm btn-danger" onclick="return confirm('Are you sure want to delete <?= $c['title']; ?> ?')" href="<?= base_url('cs/dashboard/deleted/' . $c['id_cart']); ?>"><i class="far fa-trash-alt"></i></a>

							</th>
						</tr>


					<?php
						$total += $c['qty'] * $c['selling_price'];
					endforeach; ?>
					<tr>
						<th colspan="3" class="bg-light">Total Payment</th>
						<th class="text-right bg-light">
							<?= idr($total); ?>

						</th>
					</tr>
				</tbody>

			</table>
			<form id="payment-form" method="post" action="<?= site_url() ?>cs/snap/finish">
				<input type="hidden" name="result_type" id="result-type" value="">
				<input type="hidden" name="result_data" id="result-data" value="">
			</form>
			<?php if ($cart == null) : ?>
			<?php else : ?>
				<button class="col-12 btn-info" id="pay-button" data-amount="<?= $total; ?>">Pay!</button>
			<?php endif; ?>


		</div>

	</div>
	<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="SB-Mid-client-Ms9Ny7jiWGiF4bGL"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript">
		$('#pay-button').click(function(event) {
			var amount = $(this).data('amount')

			event.preventDefault();
			$(this).attr("disabled", "disabled");

			$.ajax({

				url: '<?= site_url() ?>cs/snap/token',

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
</body>

</html>