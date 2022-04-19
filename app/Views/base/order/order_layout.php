<!DOCTYPE html>
<html Content-Language="ID" lang="id" xml:lang="id">
  <head>
    <title>ONEWEDDING</title>
    <link rel="icon" href="<?php echo base_url() ?>/assets/base/img/logo3.JPEG?<?= date("Y-m-d"); ?>">

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Undangan digital berupa website untuk pernikahanmu. Lebih praktis, keren dan kekinian.">
    <meta name="keywords" content="Undangan digital, Website pernikahan, Undangan kekinian, Web undangan kren">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="theme-color" content="#6c5ce7" />
    <meta name="author" content="MC Project">

    <!-- Required CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/base/css/bootstrap.min.css?SIDOINIKAHV2" >
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/base/css/line-icons.css?SIDOINIKAHV2">
    <link type="text/css" href="<?php echo base_url() ?>/assets/base/css/froala_blocks.css?SIDOINIKAHV2" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:400,600|Roboto" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/base/css/pikaday.css?SIDOINIKAHV2">
    <link rel="stylesheet" href="<?php echo base_url() ?>/assets/base/css/croppie.min.css?SIDOINIKAHV2">

  </head>

  <body>
    <header>
        <div class="container">
          <nav class="navbar navbar-expand-md fixed-top">
            <div class="container">
              <a class="navbar-brand navbar-order" href="<?php echo base_url() ?>">
                <img src="<?php echo base_url() ?>/assets/base/img/logo.png?cache<?= date("Y-m-d"); ?>" height="35" alt="image">
              </a>
            </div>
          </nav>
        </div>
    </header>

    <?php 
      $jml_cerita = 2;
      if(isset($_SESSION['jml_cerita'])){
        if($_SESSION['jml_cerita'] > 2){
          $jml_cerita = $_SESSION['jml_cerita'];
        }
      }

    ?>

    <?php 

    echo view($view);

    ?>

    <footer class="fdb-block footer-small footer">
        <div class="container">
        <div class="col-12 text-lg-left">
            <p class="lead footer-social">
              <a href="https://twitter.com/mycodingxd" class="mx-2"><i class="lni-twitter-filled" aria-hidden="true"></i></a>
              <a href="https://facebook.com/mycodingxd" class="mx-2"><i class="lni-facebook-filled" aria-hidden="true"></i></a>
              <a href="https://instagram.com/mycodingxd" class="mx-2"><i class="lni-instagram-filled" aria-hidden="true"></i></a>
            </p>
          </div>
            <div class="row text-center">
            <div class="col">
                <p class="text-footer" style="color:#fff;">&#169;Copyright 2021 <a href="<?php echo base_url() ?>" rel="dofollow" target="_blank">Onewedding</a>.</p>
            </div>
            </div>
        </div>
    </footer>

    <!-- modal upload croppie -->
    <div class="modal" id="myModal">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Foto Mempelai</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <div id="resizer"></div>
                    <hr>
                    <button class="btn btn-block btn-dark" id="upload" > 
                    Upload</button>
                </div>
            </div>
        </div>
    </div>
      
    <script src="<?php echo base_url() ?>/assets/base/js/jquery-min.js"></script>
    <script src="<?php echo base_url() ?>/assets/base/js/popper.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/base/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url() ?>/assets/base/js/jquery.nav.js"></script>    
    <script src="<?php echo base_url() ?>/assets/base/js/jquery.easing.min.js"></script>     
    <script src="<?php echo base_url() ?>/assets/base/js/main.js"></script>
    <script src="<?php echo base_url() ?>/assets/base/js/moment-with-locales.js"></script>
    <script src="<?php echo base_url() ?>/assets/base/js/pikaday.js"></script>
    <script src="<?php echo base_url() ?>/assets/base/js/dropzone.js"></script>
    <script src="<?php echo base_url() ?>/assets/base/js/croppie.min.js"></script>
  </body>
</html>
<script type="text/javascript">

function nospaces(t){
      if(t.value.match(/\s/g)){
        t.value=t.value.replace(/\s/g,'');
      }
    }

$(function () {

  /** croppie shareurcodes.com **/
    var croppie = null;
    var el = document.getElementById('resizer');

    $.base64ImageToBlob = function(str) {
        /** extract content type and base64 payload from original string **/
        var pos = str.indexOf(';base64,');
        var type = str.substring(5, pos);
        var b64 = str.substr(pos + 8);
      
        /* decode base64 */
        var imageContent = atob(b64);
      
        /* create an ArrayBuffer and a view (as unsigned 8-bit) */
        var buffer = new ArrayBuffer(imageContent.length);
        var view = new Uint8Array(buffer);
      
        /* fill the view, using the decoded base64 */
        for (var n = 0; n < imageContent.length; n++) {
          view[n] = imageContent.charCodeAt(n);
        }
      
        /* convert ArrayBuffer to Blob */
        var blob = new Blob([buffer], { type: type });
      
        return blob;
    }

    $.getImage = function(input, croppie) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {  
                croppie.bind({
                    url: e.target.result,
                });
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    var fotonyasiapa = '';
    $(".file-upload").on("change", function(event) {
        $("#myModal").modal();
        fotonyasiapa = $(this).attr("id");
        console.log("foto_"+fotonyasiapa);
        /* Initailize croppie instance and assign it to global variable */
        croppie = new Croppie(el, {
                viewport: {
                    width: 200,
                    height: 200,
                    type: 'square'
                },
                boundary: {
                    width: 250,
                    height: 250
                },
                enableOrientation: true
            });
        $.getImage(event.target, croppie); 
    });

    $("#upload").on("click", function() {
        croppie.result('base64').then(function(base64) {
            $("#myModal").modal("hide"); 
            $("#profile-pic").attr("src","/images/ajax-loader.gif");

            var url = "<?php echo base_url('order/imgupload') ?>";
            var formData = new FormData();
            formData.append("foto_"+fotonyasiapa, $.base64ImageToBlob(base64));

            $.ajax({
                type: 'POST',
                url: url,
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                  console.log(data);
                    if (data == "uploadedbride") {
                        $("#profile-pic-bride").attr("src", base64); 
                    } else if(data == "uploadedgroom"){
                        $("#profile-pic-groom").attr("src", base64); 
                    } else if(data == "uploadedsampul"){
                        $("#profile-pic-sampul").attr("src", base64); 
                    } else {
                        $("#profile-pic").attr("src","/images/icon-cam.png"); 
                        console.log(data['profile_picture']);
                    }
                },
                error: function(error) {
                    console.log(error);
                    $("#profile-pic").attr("src","/images/icon-cam.png"); 
                }
            });
        });
    });

    /* To Rotate Image Left or Right */
    $(".rotate").on("click", function() {
        croppie.rotate(parseInt($(this).data('deg'))); 
    });

    $('#myModal').on('hidden.bs.modal', function (e) {
        /* This function will call immediately after model close */
        /* To ensure that old croppie instance is destroyed on every model close */
        setTimeout(function() { croppie.destroy(); }, 100);
    });

    $("#next").prop('disabled', true);

    moment.locale('id');
    var tanggalAkad_ = '<?php if(isset($_SESSION['tanggal_akad'])) echo $_SESSION['tanggal_akad']; else echo 0; ?>';
    if(tanggalAkad_ != '0'){
      $('#datepicker').val(moment(tanggalAkad_).format('dddd, Do MMMM YYYY'));
    }
    
    var picker = new Pikaday({ 
      
      field: $('#datepicker')[0],
      format: 'dddd, Do MMMM YYYY',
      onSelect: function() {
        $('#tanggal_akad').val(this.getMoment().format('YYYY/MM/DD'));
      }
    });

    var tanggalResepsi_ = '<?php if(isset($_SESSION['tanggal_resepsi'])) echo $_SESSION['tanggal_resepsi'];  else echo 0; ?>';
    if(tanggalResepsi_ != '0'){
      $('#datepicker2').val(moment(tanggalResepsi_).format('dddd, Do MMMM YYYY'));
    }
    
    var picker = new Pikaday({ 
      format: 'dddd, Do MMMM YYYY',
      field: $('#datepicker2')[0],
      onSelect: function() {
        $('#tanggal_resepsi').val(this.getMoment().format('YYYY/MM/DD'));
      }
    });

    $("#skipCerita").on('change', function() {
      if ($(this).prop('checked')) {
        $("#konten-cerita").hide();
        $("#addCerita").hide();
        $(".form-control").prop('required',false);
      }else{
        $("#konten-cerita").show();
        $("#addCerita").show();
        $("..form-control").prop('required',true);
      }
    });

    $("#skipGallery").on('change', function() {
      if ($(this).prop('checked')) {
        $("#konten-gallery").hide();
        $(".form-control").prop('required',false);
      }else{
        $("#konten-gallery").show(); 
        $("..form-control").prop('required',true);
      }
    });

    var i = <?php echo $jml_cerita ?>;

    $(document).on('click', '.btn_remove', function(){  

       var button_id = $(this).attr("id");
       $('#cerita'+button_id+'').remove();  
       i--;

       if(i == 0){
        $("..form-control").prop('required',true);
       }

     });  

    $('#addCerita').click(function(){  

      i++;  

      $('#konten-cerita').append('<div id="cerita'+i+'"><div class="row align-items-center mt-3"><div class="col-auto"><a style="color: #2c3e50;margin-bottom:0px;font-size: 20px;font-weight: 600;display: flex;">#'+i+'</a></div><div class="col"><a id="'+i+'" class="btn btn-sm btn_remove" style="background-color: #dc3545;padding: 5px;font-size: 12px;border-radius: 5px;">Hapus</a></div></div><div class="row align-items-center"><div class="col"><label>Tanggal</label><input name="tanggal_cerita[]" type="text" class="form-control" placeholder="Contoh : 14 Januari 2020 " required></div></div><div class="row align-items-center mt-3"><div class="col"><label>Judul</label><input name="judul_cerita[]" type="text" class="form-control" placeholder="Contoh : Pertama Bertemu" required></div></div><div class="row align-items-center mt-3"><div class="col"><label>Isi Cerita</label><textarea name="isi_cerita[]" type="text" class="form-control" placeholder="Maximal 500 Karakter" maxlength="500" rows="4" required></textarea></div></div></div>');  
        $(".form-control").prop('required',false);
    });

var myDropzone = new Dropzone(document.body, { 
  url: "<?php echo base_url('order/upload'); ?>", 
  paramName: "file",
  acceptedFiles: 'image/*',
  autoQueue: true,
  maxFilesize: 2,  //ukuran maksimal foto 
  clickable: ".do-add-btn" 
});

myDropzone.on("success", function(file,response){
    if(response == ""){
      $('.dz-preview').remove();
      alert('Batas Upload 10 Foto!');

    }else{
      var aql = JSON.parse(response);
      $('.dz-preview').remove();
      $("#previewss").prepend('<div id="preview'+aql.no+'" class="file-row preview-uploads"><div class="preview-uploads-img"><span class="preview"><img id="img3" src="<?= base_url() ?>/assets/users/'+aql.dummy+'/album'+aql.no+'.png"  style="height: 100%;object-position: center;object-fit: cover;width: 100%;" /></span></div><div class="preview-uploads-name"><p class="name" style="line-height: revert;font-size: 12px;" data-dz-name>album'+aql.no+'</p><strong class="error text-danger" style="line-height: revert;font-size: 12px;"  ></strong><p class="size" style="line-height: revert;font-size: 12px;" >-</p></div><div  class="preview-uploads-delete"><button id="'+aql.no+'" class="btn btn-danger delete btnhehe">Hapus</button></div></div>');
    }
    $('#loading').hide();
});

myDropzone.on("sending", function(file, xhr, formData) {
  $('.dz-preview').remove();
  formData.append("data", "<?php if(isset($_SESSION['dummy'])){ echo $_SESSION['dummy']; } ?>");
  $('#loading').show();
});


myDropzone.on("error", function(file, response) {
  $('.dz-preview').remove();
  alert('Maximal File = 2MB!');
  $('#loading').hide();
});

$(document).on('click', '.btnhehe', function(){  

  var button_id = $(this).attr("id");
  var dummy = "<?php if(isset($_SESSION['dummy'])){ echo $_SESSION['dummy']; } ?>";
  $.ajax({
     type: 'POST',
     url: '<?= base_url('order/del') ?>',
     data: {id: button_id,dummy: dummy},
     success: function(data){
        console.log('success: ' + data);
        $('#preview'+button_id).remove();
     }
  });
   
     

});
    
});
</script>