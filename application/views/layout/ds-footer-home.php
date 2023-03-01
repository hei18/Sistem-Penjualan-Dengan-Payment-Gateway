<section class="contact-area section-padding-100 bg-img bg-overlay bg-fixed has-bg-img" style="background-color: black;">
    <div class="container">
        <div class="row">
            <div class="col">
                <h4 class="text-white">Informasi</h4>
                <p style="font-size: 18px;  margin-bottom: 0px;">
                    <a href="<?= base_url('publics/about'); ?>" class="text-white">Tentang Kami</a>
                </p>
                <p style="font-size: 18px;  margin-bottom: 0px;">
                    <a href="<?= base_url('publics/terms'); ?>" class="text-white">Syarat Dan Ketentuan</a>
                </p>
                <p style="font-size: 18px;  margin-bottom: 0px;">
                    <a href="<?= base_url('publics/contact'); ?>" class="text-white">Kontak Kami</a>
                </p>
                <p style="font-size: 18px;  margin-bottom: 0px;">
                    <a href="<?= base_url('publics/refund'); ?>" class="text-white">Kebijakan Pengembalian</a>
                </p>



            </div>
            <div class="col">
                <h4 class="text-white">Bantuan</h4>
                <p style="font-size: 18px;  margin-bottom: 0px;">
                    <a href="<?= base_url('publics/sell'); ?>" class="text-white">Cara Menjual</a>
                </p>
                <p style="font-size: 18px;  margin-bottom: 0px;">
                    <a href="<?= base_url('publics/buy'); ?>" class="text-white">Cara Membeli dan Membayar</a>
                </p>


            </div>

        </div>


    </div>
</section>
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
                        <li><a href="<?= base_url('publics'); ?>">Halaman Utama</a></li>
                        <li><a href="<?= base_url('publics/instrumental'); ?>">Instrumental</a></li>
                        <li><a href="<?= base_url('publics/about'); ?>">Tentang Kami</a></li>

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
<script src="<?= base_url('assets/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url('assets/'); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
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
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,

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
</script>

<script>
    <?php if ($this->session->flashdata('onecart')) { ?>
        var insider = <?= json_encode($this->session->flashdata('onecart')); ?>

        swal.fire({
            text: insider,
            title: 'berhasil',
            icon: 'success',
            //    showConfirmButton: false,
            //    timer: 2500
        });
    <?php  } ?>
    <?php if ($this->session->flashdata('error')) { ?>
        var insider = <?= json_encode($this->session->flashdata('error')); ?>

        swal.fire({
            text: insider,
            title: 'Opps...',
            icon: 'error',
            //    showConfirmButton: false,
            //    timer: 2500
        });
    <?php  } ?>
</script>
</body>

</html>