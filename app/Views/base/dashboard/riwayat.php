<!-- Container Fluid-->
<div class="container-fluid" id="container-wrapper">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800"><?= $title; ?></h1>
    </div>

    <div class="row mb-3">
        <!-- New User Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pengunjung Hari Ini</div> 
                            <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800"><?php if($total_pengunjung_today == '') echo '0'; else echo $total_pengunjung_today  ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-info"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pending Requests Card Example -->
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card h-100">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-uppercase mb-1">Total Pengunjung</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?= $total_pengunjung ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-warning"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Area Chart -->
        <div class="col-xl-12 col-lg-12">
            <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Pengunjung 7 Hari Terakhir</h6>
                </div>
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="myAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- Invoice Example -->
        <div class="col-lg-12">
              <div class="card mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Data Pengunjung</h6>
                </div>
                <div class="table-responsive p-3">
                  <table class="table align-items-center table-flush" id="dataTable">
                    <thead class="thead-light">
                      <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>Tanggal</th>
                        <th>Nama</th>
                      </tr>
                    </tfoot>
                    <tbody>
                    <?php 
                    foreach($pengunjung as $row){ 
                    ?>
                      <tr>
                        <td><?= date( "d M Y", strtotime($row->created_at)) ?></td>
                        <td><?= $row->nama_pengunjung ?></td>
                      </tr>
                    <?php } ?> 
                    </tbody>
                  </table>
                </div>
              </div>
        </div>
        <!-- Message From Customer-->
       
    </div>
    <!--Row-->
</div>
<!---Container Fluid-->

<script>

    var jumlah = [];
    var tanggal = [];
    moment.locale('id');
    var namaBulan  = moment().format('MMMM');
    
    <?php foreach($total_mingguan as $row){ ?>
        jumlah.push(<?= $row->jumlah ?>);
        tanggal.push(<?= $row->tanggal ?>+' '+namaBulan);
    <?php } ?>
    


</script>