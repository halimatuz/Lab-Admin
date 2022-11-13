<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!-- General JS Scripts -->
<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>

<!-- JS Libraies -->
<?php
if ($this->uri->segment(2) == "" || $this->uri->segment(2) == "index") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "index_0") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/simple-weather/jquery.simpleWeather.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "bootstrap_card") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "bootstrap_modal") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/prism/prism.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "layout_transparent") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/sticky-kit.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "components_gallery") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "components_multiple_upload") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/dropzonejs/min/dropzone.min.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "components_statistic") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/maps/jquery.vmap.indonesia.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "components_table") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "list_users") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <?php
} elseif ($this->uri->segment(1) == "D_superadmin") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/cleave-js/dist/cleave.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/cleave-js/dist/addons/cleave-phone.us.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/select2/dist/js/select2.full.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "forms_editor") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/codemirror/lib/codemirror.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/codemirror/mode/javascript/javascript.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "gmaps_advanced_route" || $this->uri->segment(2) == "gmaps_draggable_marker" || $this->uri->segment(2) == "gmaps_geocoding" || $this->uri->segment(2) == "gmaps_geolocation" || $this->uri->segment(2) == "gmaps_marker" || $this->uri->segment(2) == "gmaps_multiple_marker" || $this->uri->segment(2) == "gmaps_route" || $this->uri->segment(2) == "gmaps_simple") {
  ?>
  <script src="http://maps.google.com/maps/api/js?key=AIzaSyB55Np3_WsZwUQ9NS7DP-HnneleZLYZDNw&amp;sensor=true"></script>
  <script src="<?php echo base_url(); ?>assets/modules/gmaps.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "" || $this->uri->segment(2) == "index") {
  ?>
  
  <?php
} elseif ($this->uri->segment(1) == "D_superadmin") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/js/page/modules-chartjs.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "modules_datatables" || $this->uri->segment(2) == "") {
  ?>
  <?php
} elseif ($this->uri->segment(2) == "modules_owl_carousel") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "modules_sparkline") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "modules_sweet_alert") {
  ?>
  
  <?php
} elseif ($this->uri->segment(2) == "modules_toastr") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "modules_vector_map") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jquery.vmap.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/maps/jquery.vmap.indonesia.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "add_user") {
  ?>
  
  <?php
} elseif ($this->uri->segment(2) == "features_post_create") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "features_posts") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "features_profile") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "features_setting_detail") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/codemirror/lib/codemirror.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/codemirror/mode/javascript/javascript.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "features_tickets") {
  ?>
  <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
  <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "utilities_contact") {
  ?>
  <script src="http://maps.google.com/maps/api/js?key=AIzaSyB55Np3_WsZwUQ9NS7DP-HnneleZLYZDNw&amp;sensor=true"></script>
  <script src="<?php echo base_url(); ?>assets/modules/gmaps.js"></script>
  <?php
} ?>

<!-- Page Specific JS File -->
<?php
if ($this->uri->segment(2) == "" || $this->uri->segment(2) == "index") {
  ?>
  <?php
} elseif ($this->uri->segment(2) == "index_0") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/index-0.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "bootstrap_modal") {
  ?>
  
  <?php
} elseif ($this->uri->segment(2) == "components_chat_box") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/components-chat-box.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "components_multiple_upload") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/components-multiple-upload.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "components_statistic") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/components-statistic.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "components_table") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/components-table.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "list_users") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/components-user.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "forms_advanced_form" || $this->uri->segment(2) == "add_coa") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/forms-advanced-forms.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "gmaps_advanced_route") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/gmaps-advanced-route.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "gmaps_draggable_marker") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/gmaps-draggable-marker.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "gmaps_geocoding") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/gmaps-geocoding.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "gmaps_geolocation") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/gmaps-geolocation.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "gmaps_marker") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/gmaps-marker.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "gmaps_multiple_marker") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/gmaps-multiple-marker.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "gmaps_route") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/gmaps-route.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "gmaps_simple") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/gmaps-simple.js"></script>
  <?php
} elseif ($this->uri->segment(1) == "D_superadmin" && $this->uri->segment(2) == "") {
  ?>
  <?php
} elseif ($this->uri->segment(1) == "D_superadmin") {
  ?>

  <?php
} elseif ($this->uri->segment(2) == "modules_datatables" || $this->uri->segment(2) == "") {
  ?>
  
  <?php
} elseif ($this->uri->segment(2) == "modules_ion_icons") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/modules-ion-icons.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "modules_owl_carousel") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/modules-slider.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "modules_sparkline") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/modules-sparkline.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "modules_sweet_alert") {
  ?>
  
  <?php
} elseif ($this->uri->segment(2) == "modules_toastr") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/modules-toastr.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "modules_vector_map") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/modules-vector-map.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "auth_register") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/auth-register.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "features_post_create") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/features-post-create.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "features_posts") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/features-posts.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "features_setting_detail") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/features-setting-detail.js"></script>
  <?php
} elseif ($this->uri->segment(2) == "utilities_contact") {
  ?>
  <script src="<?php echo base_url(); ?>assets/js/page/utilities-contact.js"></script>
  <?php
} ?>
<!-- Sweet Alert -->
<script src="<?php echo base_url(); ?>assets/modules/sweetalert/sweetalert.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/page/modules-sweetalert.js"></script>
<!-- Full Calendar -->
<script src="<?php echo base_url(); ?>assets/modules/fullcalendar/fullcalendar.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/page/modules-calendar.js"></script>
<!-- Modal -->
<script src="<?php echo base_url(); ?>assets/js/page/bootstrap-modal.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
<!-- Template JS File -->
<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
<!-- DataTables -->
<script src="<?php echo base_url(); ?>assets/modules/datatables/datatables.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>
<script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/page/modules-datatables.js"></script>
<!-- Lottie -->
<script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
<!-- Zxing Scanner -->
<script type="text/javascript" src="<?php echo base_url()?>assets/modules/zxing/zxing.min.js"></script>
<!-- Sweet Alert -->
<script>
    var ctx = document.getElementById("myChart2").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: ["<?= date('D, dS M Y', strtotime(date('Y-m-d') .' -6 day')) ?>", "<?= date('D, dS M Y', strtotime(date('Y-m-d') .' -5 day')) ?>", "<?= date('D, dS M Y', strtotime(date('Y-m-d') .' -4 day')) ?>", "<?= date('D, dS M Y', strtotime(date('Y-m-d') .' -3 day')) ?>", "<?= date('D, dS M Y', strtotime(date('Y-m-d') .' -2 day')) ?>", "Yesterday, <?= date('dS M Y', strtotime(date('Y-m-d') .' -1 day')) ?>", "Today, <?= date('dS M Y') ?>"],
        datasets: [{
          label: 'Statistics',
          data: [<?= $yesterday6[0]["count(*)"] . ',' . $yesterday5[0]["count(*)"] . ',' . $yesterday4[0]["count(*)"] . ',' . $yesterday3[0]["count(*)"] . ',' . $yesterday2[0]["count(*)"] . ',' . $yesterday[0]["count(*)"] . ',' . $today[0]["count(*)"] ?>],
          borderWidth: 2,
          backgroundColor: '#6777ef',
          borderColor: '#6777ef',
          borderWidth: 2.5,
          pointBackgroundColor: '#ffffff',
          pointRadius: 4
        }]
      },
      options: {
        legend: {
          display: false
        },
        scales: {
          yAxes: [{
            gridLines: {
              drawBorder: false,
              color: '#f2f2f2',
            },
            ticks: {
              beginAtZero: true,
            }
          }],
          xAxes: [{
            ticks: {
              display: false
            },
            gridLines: {
              display: false
            }
          }]
        },
      }
    });
    
    var ctx = document.getElementById("myChart3").getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        datasets: [{
          data: [
            <?= $approve[0]["count(*)"] ?>,
            <?= $nonapprove[0]["count(*)"] ?>,
          ],
          backgroundColor: [
            '#63ed7a',
            '#fc544b',
          ],
          label: 'Dataset 1'
        }],
        labels: [
          'Approved',
          'Not Yet Approved',
        ],
      },
      options: {
        responsive: true,
        legend: {
          position: 'bottom',
        },
      }
    });
</script>
<script>

  const flashData = $('.flash-data').data('flashdata');
  const flashDataLogin = $('.flash-data-login').data('flashdata');

  if (flashDataLogin) {
        swal({
            position: 'top-end',
            title: 'You have successfully logged in',
            text: flashDataLogin,
            icon: 'success',
            showConfirmButton: false,
            timer: 1500
        })
  }

  if (flashData) {
        swal({
            title: 'Success!',
            text: flashData,
            icon: 'success',
            timer: 1500,
            progressBar: true,
        })
  }

  $('.tombol-hapus').on('click', function(e) {
          e.preventDefault();
          const href = $(this).attr('href');

          swal({
          title: 'Are you sure?',
          text: "Data will be deleted!",
          icon: 'warning',
          confirmButtonColor: '#6777EF',
          cancelButtonColor: '#FC544B',
          confirmButtonText: 'Yes, delete data',
          cancelButtonText: 'Cancel',
          buttons: true,
        }).then((willDelete) => {
          if (willDelete) {
            document.location.href = href;
          }
        })
  });

  $('.tombol-generate').on('click', function(e) {
          e.preventDefault();
          const href = $(this).attr('href');

          swal({
          title: 'Do you want to generate SK Number?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#6777EF',
          cancelButtonColor: '#FC544B',
          confirmButtonText: 'Yes, Generate',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            document.location.href = href;
          }
        })
  });

  $('.tombol-generate-rev').on('click', function(e) {
          e.preventDefault();
          const href = $(this).attr('href');

          swal({
          title: 'Do you want to generate Revision?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#6777EF',
          cancelButtonColor: '#FC544B',
          confirmButtonText: 'Yes, Generate',
          cancelButtonText: 'Cancel'
        }).then((result) => {
          if (result.isConfirmed) {
            document.location.href = href;
          }
        })
  });

  window.addEventListener('load', function () {
    let selectedDeviceId;
    let audio = new Audio("assets/audio/beep.mp3");
    const codeReader = new ZXing.BrowserQRCodeReader()
    console.log('ZXing code reader initialized')
    codeReader.getVideoInputDevices()
    .then((videoInputDevices) => {
        const sourceSelect = document.getElementById('sourceSelect')
        selectedDeviceId = videoInputDevices[0].deviceId
        if (videoInputDevices.length >= 1) {
            videoInputDevices.forEach((element) => {
                const sourceOption = document.createElement('option')
                sourceOption.text = element.label
                sourceOption.value = element.deviceId
                sourceSelect.appendChild(sourceOption)
            })
            sourceSelect.onchange = () => {
                selectedDeviceId = sourceSelect.value;
            };
            const sourceSelectPanel = document.getElementById('sourceSelectPanel')
            sourceSelectPanel.style.display = 'block'
        }
        codeReader.decodeFromInputVideoDevice(selectedDeviceId, 'video').then((result) => {
            console.log(result)
            document.getElementById('result').textContent = result.text
            if(result != null){
                audio.play();
            }
            $('#button').submit();
        }).catch((err) => {
            console.error(err)
            document.getElementById('result').textContent = err
        })
        console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
    })
    .catch((err) => {
        console.error(err)
    })
})


const flashDataError = $('.flash-data-error').data('flashdata');
  if (flashDataError) {
        swal({
            title: 'Error!',
            text: flashDataError,
            icon: 'error'
        })
  }
        
</script>
</body>
</html>