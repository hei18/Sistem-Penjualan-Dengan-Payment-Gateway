   <!-- ##### Footer Area Start ##### -->
   <footer class=" footer-area fixed-bottom">
   	<div class="container">
   		<div class="row d-flex flex-wrap align-items-center">
   			<div class="col-12 col-md-6">
   				<a href="#"><img src="img/core-img/logo.png" alt=""></a>
   				<p class="copywrite-text"><a href="#">
   						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
   						Copyright &copy;<script>
   							document.write(new Date().getFullYear());
   						</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
   						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
   				</p>
   			</div>

   			<div class="col-12 col-md-6">
   				<div class="footer-nav">
   					<ul>
   						<li><a href="#">Home</a></li>
   						<li><a href="#">Albums</a></li>
   						<li><a href="#">Events</a></li>
   						<li><a href="#">News</a></li>
   						<li><a href="#">Contact</a></li>
   					</ul>
   				</div>
   			</div>
   		</div>
   	</div>
   </footer>
   <!-- ##### Footer Area Start ##### -->

   <!-- ##### All Javascript Script ##### -->
   <!-- jQuery-2.2.4 js -->
   <script src="<?= base_url('assets/'); ?>js/jquery/jquery-2.2.4.min.js"></script>
   <!-- Popper js -->
   <script src="<?= base_url('assets/'); ?>js/bootstrap/popper.min.js"></script>
   <!-- Bootstrap js -->
   <script src="<?= base_url('assets/'); ?>js/bootstrap/bootstrap.min.js"></script>
   <!-- All Plugins js -->
   <script src="<?= base_url('assets/'); ?>js/plugins/plugins.js"></script>
   <!-- Active js -->
   <script src="<?= base_url('assets/'); ?>js/active.js"></script>
   <script src="<?= base_url('assets/'); ?>plugins/sweetalert2/sweetalert2.min.js"></script>
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
   	$('#myModal').on('shown.bs.modal', function() {
   		$('#myInput').trigger('focus')
   	})
   </script>

   </body>

   </html>