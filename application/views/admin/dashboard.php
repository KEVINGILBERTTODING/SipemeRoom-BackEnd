<!-- Main Content -->
<div class="main-content">
  <section class="section">
    <div class="section-header">
      <h1>Dashboard</h1>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-primary">
            <i class="fas fa-user"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Data Ruang</h4>
            </div>
            <div class="card-body">
              <?= $mobil; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-danger">
            <i class="fas fa-users"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Customers</h4>
            </div>
            <div class="card-body">
              <?= $customer; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-warning">
            <i class="far fa-file"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Laporan</h4>
            </div>
            <div class="card-body">
              <?= $laporan; ?>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6 col-12">
        <div class="card card-statistic-1">
          <div class="card-icon bg-success">
            <i class="fas fa-random"></i>
          </div>
          <div class="card-wrap">
            <div class="card-header">
              <h4>Transaksi</h4>
            </div>
            <div class="card-body">
              <?= $transaksi; ?>
            </div>
          </div>
        </div>
      </div>
    </div>

  </section>
</div>
      
