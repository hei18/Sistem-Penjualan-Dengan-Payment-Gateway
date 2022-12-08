<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<!-- Title -->
	<title>One Music - Modern Music HTML5 Template</title>

	<!-- Favicon -->
	<link rel="icon" href="<?= base_url('assets/'); ?>img/core-img/favicon.ico">

	<!-- Stylesheet -->
	<link rel="stylesheet" href="<?= site_url('assets/style.css'); ?>">
	<link rel="stylesheet" href="<?= site_url('assets/new-style.css'); ?>">
	<link rel="stylesheet" href="<?= base_url('assets/'); ?>plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

</head>

<body>


	<!-- ##### Header Area Start ##### -->
	<header class="header-area">
		<!-- Navbar Area -->
		<div class="oneMusic-main-menu">
			<div class="classy-nav-container breakpoint-off">
				<div class="container">
					<!-- Menu -->
					<nav class="classy-navbar justify-content-between" id="oneMusicNav">

						<!-- Nav brand -->
						<a href="index.html" class="nav-brand"><img src="<?= base_url('assets/'); ?>img/core-img/logoss.png" alt=""></a>

						<!-- Navbar Toggler -->
						<div class="classy-navbar-toggler">
							<span class="navbarToggler"><span></span><span></span><span></span></span>
						</div>

						<!-- Menu -->
						<div class="classy-menu">

							<!-- Close Button -->
							<div class="classycloseIcon">
								<div class="cross-wrap"><span class="top"></span><span class="bottom"></span></div>
							</div>

							<!-- Nav Start -->
							<div class="classynav">
								<ul>
									<li><a href="<?= base_url('publics'); ?>">Home</a></li>
									<li><a href="<?= base_url('publics/instrumental'); ?>">Instrumental</a></li>
									<li><a href="#">Pages</a>
										<ul class="dropdown">
											<li><a href="<?= base_url('publics'); ?>">Home</a></li>
											<li><a href="<?= base_url('publics'); ?>">Instrumental</a></li>
											<li><a href="event.html">Events</a></li>
											<li><a href="blog.html">News</a></li>
											<li><a href="contact.html">Contact</a></li>
											<li><a href="elements.html">Elements</a></li>
											<li><a href="<?= base_url('auth'); ?>">Login</a></li>
											<li><a href="#">Dropdown</a>
												<ul class="dropdown">
													<li><a href="#">Even Dropdown</a></li>
													<li><a href="#">Even Dropdown</a></li>
													<li><a href="#">Even Dropdown</a></li>
													<li><a href="#">Even Dropdown</a>
														<ul class="dropdown">
															<li><a href="#">Deeply Dropdown</a></li>
															<li><a href="#">Deeply Dropdown</a></li>
															<li><a href="#">Deeply Dropdown</a></li>
															<li><a href="#">Deeply Dropdown</a></li>
															<li><a href="#">Deeply Dropdown</a></li>
														</ul>
													</li>
													<li><a href="#">Even Dropdown</a></li>
												</ul>
											</li>
										</ul>
									</li>
									<li><a href="event.html">Events</a></li>
									<li><a href="blog.html">News</a></li>
									<li><a href="contact.html">Contact</a></li>
								</ul>
								<?php if ($this->session->userdata('email')) : ?>
									<!-- Login/Register & Cart Button -->
									<ul>
										<li class="login-register-cart-button">
											<a href="#"> <?= $user['beatmaker_name']; ?></a>
											<ul class="dropdown">
												<?php if ($this->session->userdata('role') == 'customer') : ?>
													<li><a href="<?= base_url('cs/dashboard'); ?>">Dashboard</a></li>

												<?php elseif ($this->session->userdata('role') == 'beatmaker') : ?>
													<li><a href="<?= base_url('bm/channel'); ?>">BeatAudio Studio</a></li>
												<?php endif; ?>
												<li><a href="<?= base_url('auth/logout'); ?>">Logout</a></li>
											</ul>
										</li>

									</ul>
									<?php
									$itemCount = 0;
									foreach ($this->cart->contents() as $c) {
										$itemCount = $c['qty'];
									?>
										<li class="nav-item dropdown">
											<a class="nav-link" data-toggle="dropdown" href="#">
												<i class="fa-solid fa-cart-shopping"></i>
												<span class="badge badge-danger navbar-badge"><?= $itemCount; ?></span>
											</a>
											<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
												<a href="#" class="dropdown-item">

													<div class="media">

														<div class="media-body">
															<h5 class="dropdown-item-title">
																<?= $c['name']; ?>

															</h5>
															<p class="text-sm"><?= $c['qty']; ?> x <?= idr($c['price']); ?></p>
															<p class="text-sm fa fa-calculator">&nbsp;<?= idr($c['subtotal']); ?></p>
														</div>
													</div>
													<!-- Message End -->
												</a>
												<a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
											</div>
										</li>
									<?php } ?>
								<?php else : ?>
									<div class="login-register-cart-button d-flex align-items-center">
										<!-- Login/Register -->
										<div class="login-register-btn mr-50">
											<a href="<?= base_url('auth'); ?>" id="loginBtn">Login / Register</a>
										</div>
									</div>
								<?php endif; ?>
							</div>
							<!-- Nav End -->

						</div>
					</nav>
				</div>
			</div>
		</div>
	</header>
	<!-- ##### Header Area End ##### -->