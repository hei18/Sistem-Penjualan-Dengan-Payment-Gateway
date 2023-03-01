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


<!-- ChartJS -->
<script src="<?= base_url('assets/'); ?>plugins/chart.js/Chart.min.js"></script>
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
<!-- Select2 -->

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
   const pasteBox = document.getElementById("price");
   pasteBox.onpaste = e => {
      e.preventDefault();
      return false;
   };
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
   $(function() {
      $('#myBank').change(function() {
         $('#bank_number').val($('#myBank option:selected').attr('data-number'));
      });

   });
</script>
<script>
   $('select').change(function() {
      var op = $(this).val();
      if (op != '') {
         $('input[name="submit"]').prop('disabled', false);
      } else {
         $('input[name="submit"]').prop('disabled', true);
      }
   });
</script>
<!-- <script>
   $(document).ready(function() {
      $("body").on('change', '#full_version', '#demo_version', function() {
         for (var i = 0; i < $(this).get(0).files.length; ++i) {
            var file1 = $(this).get(0).files[i].size;
            if (file1) {
         }

      });
      // $('#full_version').on('change', function() {
      //    for (var i = 0; i < $(this).get(0).files.length; ++i) {
      //       var file1 = $(this).get(0).files[i].size;
      //       if (file1) {
      //          var file_size = $(this).get(0).files[i].size;
      //          if (file_size > 104857600) {
      //             $('#file-result1').html("max file upload is 100MB");
      //             $('input[name="submit"]').prop('disabled', true);
      //          } else {
      //             $('#demo_version').on('change', function() {
      //                for (var i = 0; i < $(this).get(0).files.length; ++i) {
      //                   var file2 = $(this).get(0).files[i].size;
      //                   if (file2) {
      //                      var file_size = $(this).get(0).files[i].size;
      //                      if (file_size > 104857600) {
      //                         $('#file-result2').html("max file upload is 100MB");
      //                         $('input[name="submit"]').prop('disabled', true);
      //                      } else {
      //                         $('input[name="submit"]').prop('disabled', false);
      //                      }
      //                   }
      //                }
      //             });
      //          }
      //       }
      //    }
      // });

   });
</script> -->
<script>
   var full_version = document.getElementById('full_version');
   var demo_version = document.getElementById('demo_version');
   var thumbnail = document.getElementById('thumbnail');
   if (full_version.addEventListener || demo_version.addEventListener || thumbnail.addEventListener) {
      full_version.addEventListener('change', function(event) {
         for (var i = 0; i < $(this).get(0).files.length; ++i) {
            full_version = $(this).get(0).files[i].size;
            if (full_version) {
               var file_full = $(this).get(0).files[i].size;
               if (file_full > 104857600) {
                  $('#file-result1').html("Maksimal file full versi adalah 100MB");
                  $('input[name="submit"]').prop('disabled', true);

               } else {
                  $('input[name="submit"]').prop('disabled', false);
               }
            }
         }
      });

      demo_version.addEventListener('change', function(event) {
         for (var i = 0; i < $(this).get(0).files.length; ++i) {
            demo_version = $(this).get(0).files[i].size;
            if (demo_version) {
               var file_demo = $(this).get(0).files[i].size;
               if (file_demo > 104857600) {
                  $('#file-result2').html("Maksimal file demo versi adalah 100MB");
                  $('input[name="submit"]').prop('disabled', true);

               } else {
                  $('input[name="submit"]').prop('disabled', false);
               }
            }
         }
      });

      thumbnail.addEventListener('change', function(event) {
         for (var i = 0; i < $(this).get(0).files.length; ++i) {
            thumbnail = $(this).get(0).files[i].size;
            if (thumbnail) {
               var image = $(this).get(0).files[i].size;
               if (image > 2097152) {
                  $('#file-result3').html("Maksimal file gambar adalah 2MB");
                  $('input[name="submit"]').prop('disabled', true);

               } else {
                  $('input[name="submit"]').prop('disabled', false);
               }
            }
         }
      });
   }
</script>
</body>

</html>