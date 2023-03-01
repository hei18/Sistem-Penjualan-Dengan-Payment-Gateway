<!DOCTYPE html>
<html>

<head>
	<title>404</title>



	<style>
		html,
		body {
			height: 100%;
		}

		body {
			margin: 0;
			padding: 0;
			width: 100%;
			color: #B0BEC5;
			display: table;
			font-weight: 100;

		}

		.container {
			text-align: center;
			display: table-cell;
			vertical-align: middle;
		}

		.content {
			text-align: center;
			display: inline-block;
		}

		.title {
			color: red;
			font-size: 72px;
			margin-bottom: 40px;
		}

		.text-maintenance {
			color: black;
			font-size: 25px;
			margin-bottom: 40px;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="content">
			<div class="title">Oops..404 Not Found</div>
			<p class="text-maintenance">You Have Downloaded Your File!!</p>
			<h3>
				<a href="<?= base_url('publics'); ?>">BACK TO HOME</a>
			</h3>
		</div>
	</div>
</body>

</html>