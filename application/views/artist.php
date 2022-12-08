 <!-- ##### Breadcumb Area Start ##### -->
 <section class="breadcumb-area bg-img bg-overlay mb-70" style="background-image: url(<?= base_url('assets/'); ?>img/bg-img/breadcumb3.jpg);">

 </section>

 <section class="">
 	<div class="one-music-songs-area ">
 		<div class="container">
 			<?= $this->session->flashdata('message'); ?>

 			<div class="row">

 				<div class="col-12 col-lg-3">
 					<div class="blog-sidebar-area">
 						<!-- Widget Area -->
 						<div class="single-widget-area mb-30">
 							<div class="widget-title">
 								<h5><?= $artist['nickname'] ?></h5>
 							</div>
 							<div class="widget-content">
 								<img src="<?= base_url('files/new-image/') . $artist['image'] ?>" alt="">
 							</div>
 						</div>
 					</div>
 				</div>
 				<div class="col-12 col-lg-9">
 					<div class="card">
 						<div class="card-header">
 							Featured
 						</div>
 						<div class="card-body">
 							<div class="table-responsive">
 								<table id="example1" class="table table-bordered table-striped">
 									<thead>
 										<tr>


 											<th scope="col">Title</th>
 											<th scope="col">Instrumental</th>
 											<th scope="col">Genre</th>
 											<th scope="col">Price</th>
 											<th scope="col">Action</th>

 										</tr>
 									</thead>
 									<tbody>
 										<?php foreach ($beat as $b) : ?>

 											<tr>

 												<td>
 													<?= $b['title']; ?>
 												</td>
 												<td>
 													<audio controls preload="auto" controlsList="nodownload noplaybackrate">
 														<source src="<?= base_url('files/demo/') . $b['demo_version']; ?>">
 													</audio>
 												</td>
 												<td>
 													<?= $b['genre']; ?>
 												</td>
 												<td>
 													<?= idr($b['selling_price']); ?>
 												</td>
 												<td>




 													<?php if ($this->session->userdata('role') == 'customer') : ?>
 														<?php if ($this->session->userdata('id_cs')) : ?>
 															<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal<?= $b['id_product']; ?>">
 																<?= idr($b['selling_price']) ?>
 															</a>
 														<?php endif ?>
 													<?php elseif ($this->session->userdata('role') == 'beatmaker') : ?>
 														<?php if ($this->session->userdata('id_user')) : ?>
 															<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal2">
 																<?= idr($b['selling_price']) ?>
 															</a>
 														<?php endif ?>
 													<?php elseif ($this->session->userdata('role') == NULL) : ?>
 														<a type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
 															<?= idr($b['selling_price']) ?>
 														</a>
 													<?php endif; ?>


 												</td>
 											</tr>



 										<?php endforeach; ?>
 									</tbody>
 								</table>



 							</div>
 						</div>
 					</div>
 				</div>


 			</div>
 		</div>
 	</div>
 </section>
 <?php foreach ($beat as $b) :
		$id = $b['id_product'] ?>
 	<div class="modal fade" id="exampleModal<?= $b['id_product']; ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 		<div class="modal-dialog" role="document">
 			<div class="modal-content">
 				<div class="modal-header">
 					<h5 class="modal-title" id="exampleModalLabel"><?= $b['title'] ?></h5>
 					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 						<span aria-hidden="true">&times;</span>
 					</button>
 				</div>
 				<div class="modal-body">
 					<div class="card mb-3">
 						<img class="card-img-top" src="<?= base_url('files/thumbnail/') . $b['thumbnail']; ?>" alt="Card image cap" style="width: 150px; height: 150px;">

 						<div class="card-body">
 							<h5 class="card-title">Description</h5>
 							<p class="card-text">
 								<?= $b['description']; ?>
 							</p>

 						</div>

 					</div>
 				</div>
 				<div class="modal-footer">
 					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
 					<form action="<?= base_url('publics/artist/' . $b['id_user']); ?>" method="post">

 						<input type="hidden" name="id_product" id="id_product" value="<?= $b['id_product']; ?>">
 						<input type="hidden" name="title" id="title" value="<?= $b['title']; ?>">
 						<input type="hidden" name="full_version" id="full_version" value="<?= $b['full_version']; ?>">
 						<input type="hidden" name="selling_price" id="selling_price" value="<?= $b['selling_price']; ?>">
 						<button type="submit" name="submit" id="submit" value="submit" class="btn btn-primary">Add To Cart</button>
 					</form>
 				</div>
 			</div>
 		</div>
 	</div>
 <?php endforeach; ?>

 <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 	<div class="modal-dialog modal-dialog-centered">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title" id="exampleModalLabel">Create Customer account to buy</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<div class="row">
 					<div class="col">
 						<h5>If you have account</h5>
 						<a href="<?= base_url('auth'); ?>" class="btn btn-primary">Login</a>
 					</div>
 					<div class="col">
 						<h5>If you don't have account</h5>
 						<a href="<?= base_url('auth/register'); ?>" class="btn btn-warning">Register</a>
 					</div>
 				</div>


 			</div>
 			<div class="modal-footer">
 				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

 			</div>
 		</div>
 	</div>
 </div>
 <section class="contact-area section-padding-100 bg-img bg-overlay bg-fixed has-bg-img" style="background-image: url(<?= base_url('assets/'); ?>img/bg-img/bg-2.jpg);">
 	<div class="container">
 		<div class="row">
 			<div class="col-12">
 				<div class="section-heading white">
 					<p>See what’s new</p>
 					<h2>Get In Touch</h2>
 				</div>
 			</div>
 		</div>

 		<div class="row">
 			<div class="col-12">
 				<!-- Contact Form Area -->
 				<div class="contact-form-area">
 					<form action="#" method="post">
 						<div class="row">
 							<div class="col-md-6 col-lg-4">
 								<div class="form-group">
 									<input type="text" class="form-control" id="name" placeholder="Name">
 								</div>
 							</div>
 							<div class="col-md-6 col-lg-4">
 								<div class="form-group">
 									<input type="email" class="form-control" id="email" placeholder="E-mail">
 								</div>
 							</div>
 							<div class="col-lg-4">
 								<div class="form-group">
 									<input type="text" class="form-control" id="subject" placeholder="Subject">
 								</div>
 							</div>
 							<div class="col-12">
 								<div class="form-group">
 									<textarea name="message" class="form-control" id="message" cols="30" rows="10" placeholder="Message"></textarea>
 								</div>
 							</div>
 							<div class="col-12 text-center">
 								<button class="btn oneMusic-btn mt-30" type="submit">Send <i class="fa fa-angle-double-right"></i></button>
 							</div>
 						</div>
 					</form>
 				</div>
 			</div>
 		</div>
 	</div>
 </section>

 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
 	<div class="modal-dialog modal-dialog-centered">
 		<div class="modal-content">
 			<div class="modal-header">
 				<h5 class="modal-title" id="exampleModalLabel">Create Customer account to buy</h5>
 				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
 					<span aria-hidden="true">&times;</span>
 				</button>
 			</div>
 			<div class="modal-body">
 				<div class="row">
 					<div class="col">
 						<h5>If you have account</h5>
 						<a href="<?= base_url('auth'); ?>" class="btn btn-primary">Login</a>
 					</div>
 					<div class="col">
 						<h5>If you don't have account</h5>
 						<a href="<?= base_url('auth/register'); ?>" class="btn btn-warning">Register</a>
 					</div>
 				</div>


 			</div>
 			<div class="modal-footer">
 				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

 			</div>
 		</div>
 	</div>
 </div>
 <!-- ##### Song Area End ##### -->