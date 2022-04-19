<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
        <div>
        <a href="<?= SITE_UNDANGAN ?>/<?= $order[0]->domain ?>" class="btn btn-primary btn-sm">Lihat Website</a>
        </div>
    </div> 

    <div class="row mb-3">

        <div class="col-xl-6 col-lg-6 mb-4">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Data Cerita</h6>
                </div>
                <div class="card-body">
                   
                    <form method="post" action="<?php echo base_url('user/update_cerita'); ?>">
                    <div id="konten-cerita" >
                    
                        <?php 
                            $jml_cerita = count($cerita);
                            for($i=0;$i < $jml_cerita;$i++){ 
                        ?>

                            <div id="cerita<?php echo $i+1 ?>">
                                <div class="row align-items-center mt-3">
                                    <div class="col-auto">
                                        <a style="color: #2c3e50;margin-bottom:0px;font-size: 20px;font-weight: 600;display: flex;">#<?php echo $i+1 ?></a>
                                    </div>
                                    <div class="col">
                                        <a id="<?php echo $i+1 ?>" class="btn btn-sm btn_remove" style="background-color: #dc3545;padding: 5px;font-size: 12px;border-radius: 5px;color:#fff">Hapus</a>
                                    </div>
                                </div>

                                <div class="row align-items-center">
                                    <div class="col">
                                        <label>Tanggal</label>
                                        <input name="tanggal_cerita[]" type="text" class="form-control" placeholder="Contoh : 20 Februari 2020" value="<?= $cerita[$i]->tanggal_cerita ?>" required>
                                    </div>
                                </div>

                                <div class="row align-items-center mt-3">
                                    <div class="col">
                                        <label>Judul</label>
                                        <input name="judul_cerita[]" type="text" class="form-control" placeholder="Contoh : Ta'aruf" value="<?= $cerita[$i]->judul_cerita  ?>" required>
                                    </div>
                                </div>

                                <div class="row align-items-center mt-3">
                                    <div class="col">
                                        <label>Isi Cerita</label>
                                        <textarea name="isi_cerita[]" type="text" class="form-control" placeholder="Maximal 500 Karakter" maxlength="500" rows="4" required><?= $cerita[$i]->isi_cerita ?></textarea>
                                    </div>
                                </div>
                            </div>  

                        <?php 
                            }
                        ?>

                    </div>

                    <div class="row mt-2" >
                        <div class="col text-center">
                            <a id="addCerita" class="btn btn-primary btn-order btn-order-secondary btn-block" style="color:#fff">Tambah Cerita</a>
                        </div>
                    </div>

                    <div class="col mt-3">
                        <button class="btn btn-primary" type="submit">Simpan</button>
                    </div>
                    </form>        
                </div>
                


            </div>
        </div>

    </div>
    <!--Row-->
</div>

<script>

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

</script>