<style type="text/css">
    .sakatabs { border-bottom: 2px solid #DDD; }
    .sakatabs > li.active > a, .sakatabs > li.active > a:focus, .sakatabs > li.active > a:hover { border-width: 0; }
    .sakatabs > li > a { border: none; color: #ffffff;background: #5a4080; }
    .sakatabs > li.active > a, .sakatabs > li > a:hover { border: none;  color: #5a4080 !important; background: #fff; }
    .sakatabs > li > a::after { content: ""; background: #5a4080; height: 2px; position: absolute; width: 100%; left: 0px; bottom: -1px; transition: all 250ms ease 0s; transform: scale(0); }
    .sakatabs > li.active > a::after, .sakatabs > li:hover > a::after { transform: scale(1); }
    .tab-nav > li > a::after { background: ##5a4080 none repeat scroll 0% 0%; color: #fff; }
    .tab-pane { padding: 15px 0; }
    .tab-content{padding:20px}
    .sakatabs > li  {width:20%; text-align:center;}
    .card {background: #FFF none repeat scroll 0% 0%; box-shadow: 0px 1px 3px rgba(0, 0, 0, 0.3); margin-bottom: 30px; }

    @media all and (max-width:724px){
        .sakatabs > li > a > span {display:none;}   
        .sakatabs > li > a {padding: 5px 5px;}
    }
</style>
<div id="breadcrumb" class="clearfix">
    <div class="container">
        <div class="breadcrumb clearfix">
            <ul class="ul-breadcrumb">
                <li><a href="<?= base_url()?>" title="Home">Home</a></li>
                <li><span>My Account</span></li>
            </ul>
            <h2 class="bread-title">My Account</h2>
        </div>
    </div>
</div><!-- end breadcrumb -->

<div id="columns" class="columns-container">
    <div class="container">
        <div class="row">
            <div class="col-md-12"> 
                <div class="card">
                    <ul class="nav nav-tabs sakatabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#dashboard" aria-controls="dashboard" role="tab" data-toggle="tab">
                                <i class="fa fa-home"></i>  <span>Dashboard</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">
                                <i class="fa fa-user"></i>  <span>Personal Informations</span>
                            </a>
                        </li>
                        <li role="presentation">
                            <a href="#orders" aria-controls="orders" role="tab" data-toggle="tab">
                                <i class="fa fa-first-order"></i>  <span>My Orders</span>
                            </a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="dashboard">
                            <?php if($belumbayar->num_rows()>0){ ?>
                                <div class="alert alert-danger" role="alert">
                                    Anda memiliki
                                    <span class="alert-link text-success">  
                                        <?php 
                                        echo $belumbayar->num_rows();
                                        ?> 
                                    </span>
                                    pesanan yang belum di bayar! <a href="<?= base_url();?>upload/pembayaran" class="alert-link text-primary">Bayar sekarang</a>
                                </div>
                            <?php } else {} ?>

                            <?php if($belumdikirim->num_rows()>0){ ?>
                                <div class="alert alert-info" role="alert">
                                    Anda memiliki 
                                    <span class="alert-link text-success">  
                                        <?php 
                                        echo $belumdikirim->num_rows();
                                        ?> 
                                    </span>
                                    pesanan yang belum di dikirim.
                                </div>
                            <?php } else {} ?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="profile">
                            <div class="card">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#myinfo" aria-controls="myinfo" role="tab" data-toggle="tab">
                                            <i class="fa fa-info"></i>  <span>Edit your account information</span>
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#mypassword" aria-controls="mypassword" role="tab" data-toggle="tab">
                                            <i class="fa fa-key"></i>  <span>Password</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="myinfo">
                                        <form method="POST" action="<?= base_url();?>frontendc/update_user">
                                            <div class="billing-information-wrapper">
                                                <div class="account-info-wrapper">
                                                    <h5>Your Personal Details</h5>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-12">
                                                        <div class="col-lg-6 col-md-6">
                                                            <label>Username</label>
                                                            <input type="text" class="form-control" value="<?= $user['user_username'];?>" readonly>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6">
                                                            <label>Nama Lengkap</label>
                                                            <input type="text" class="form-control" name="user_nama" value="<?= $user['user_nama']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <div class="col-lg-6 col-md-6">
                                                            <label>Telephone</label>
                                                            <input type="tel" class="form-control" name="user_tel" value="<?= $user['user_tel']; ?>">
                                                        </div>

                                                        <div class="col-lg-6 col-md-6">
                                                            <label>Email</label>
                                                            <input type="email" class="form-control" name="user_email" value="<?= $user['user_email']; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-12">
                                                        <div class="col-lg-12 col-md-12">
                                                            <label>Alamat</label>
                                                            <textarea class="form-control" name="user_alamat"><?= $user['user_alamat']; ?></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="billing-back-btn">
                                                    <div class="billing-btn"><br>
                                                        <button type="submit" class="btn btn-primary">Save</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="mypassword">
                                        <form method="POST" action="<?= base_url();?>frontendc/update_password">
                                            <div class="panel-body">
                                                <div class="billing-information-wrapper">
                                                    <div class="account-info-wrapper">
                                                        <h4>Change Password</h4>
                                                        <h5>Your Password</h5>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="billing-info">
                                                                <label>Password</label>
                                                                <input type="password" class="form-control" name="password">
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12 col-md-12">
                                                            <div class="billing-info">
                                                                <label>Password Confirm</label>
                                                                <input type="password" class="form-control" name="repassword">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="billing-back-btn">
                                                        <div class="billing-btn"><br>
                                                            <button type="submit" class="btn btn-primary">Continue</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="orders">
                            <div class="card">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active">
                                        <a href="#belumbayar" aria-controls="belumbayar" role="tab" data-toggle="tab">
                                            <i class="fa fa-money"></i>  <span>Belum Bayar</span>
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#belumdikirim" aria-controls="belumdikirim" role="tab" data-toggle="tab">
                                            <i class="fa fa-truck"></i>  <span>Belum Dikirim</span>
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#selesai" aria-controls="selesai" role="tab" data-toggle="tab">
                                            <i class="fa fa-flag-checkered"></i>  <span>Selesai</span>
                                        </a>
                                    </li>
                                </ul>

                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="belumbayar">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Invoice</th>
                                                    <th class="text-center">Total Biaya</th>
                                                    <th class="text-center">Tanggal</th>
                                                    <th class="text-center">Aksi</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                if(isset($belumbayar)){
                                                    foreach ($belumbayar->result_array() as $i) : ?>
                                                        <tr>
                                                            <td><a href="<?= base_url();?>invoice/cetak/<?= $i['pemesanan_kode']; ?>" target="_blank"><?= $i['pemesanan_kode']; ?></a></td>
                                                            <td class="text-center"><?= "Rp. ".number_format($i['pemesanan_total']); ?></td>
                                                            <td class="text-center"><?= date('d-m-Y',strtotime($i['pemesanan_tanggal'])); ?></td>
                                                            <td class="text-center">
                                                                <a href="" class="btn btn-primary text-white">Bayar</a>
                                                                <a href="" class="btn btn-danger text-white" data-target="#batalOrders<?= $i['pemesanan_kode']; ?>" data-toggle="modal">Batal</a>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; 
                                                } else {}?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="belumdikirim">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Invoice</th>
                                                    <th>Total Biaya</th>
                                                    <th>Tanggal</th>
                                                    <th>Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php 
                                              if(isset($belumdikirim)){
                                                foreach ($belumdikirim->result_array() as $i) : ?>
                                                    <tr>
                                                        <td><a href="<?= base_url();?>invoice/cetak/<?= $i['pemesanan_kode']; ?>" target="_blank"><?= $i['pemesanan_kode']; ?></a></td>
                                                        <td><?= "Rp. ".number_format($i['pemesanan_total']); ?></td>
                                                        <td><?= date('d-m-Y',strtotime($i['pemesanan_tanggal'])); ?></td>
                                                        <td><?php if($i['pembayaran_status']=='pending') {echo "
                                                        <span class='text-warning'>Waiting</span>";} else if($i['pembayaran_status']=='belumbayar'){echo "<span class='text-danger'>Belum Bayar</span>";} else {echo "<span class='text-primary'>Delivery</span>";}?></td>
                                                    </tr>
                                                <?php endforeach; } else {}?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="selesai">
                                        <table class="table table-striped">
                                            <thead>
                                                <tr>
                                                    <th>Invoice</th>
                                                    <th>Total Biaya</th>
                                                    <th>Tanggal</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                              <?php 
                                              if(isset($selesai)){
                                                foreach ($selesai->result_array() as $i) : ?>
                                                    <tr>
                                                        <td><a href="<?= base_url();?>invoice/cetak/<?= $i['pemesanan_kode']; ?>" target="_blank"><?= $i['pemesanan_kode']; ?></a></td>
                                                        <td><?= "Rp. ".number_format($i['pemesanan_total']); ?></td>
                                                        <td><?= date('d-m-Y',strtotime($i['pemesanan_tanggal'])); ?></td>
                                                    </tr>
                                                <?php endforeach; } else {}?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php foreach($belumbayar->result_array() as $i): ?>
    <div class="modal fade text-left" id="batalOrders<?= $i['pemesanan_kode']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
        <div class="modal-dialog modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="modal-title" id="myModalLabel34">Konfirmasi</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?php echo base_url()?>frontendc/batal_pemesanan" method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <input type="hidden" name="pemesanan_kode" value="<?php echo $i['pemesanan_kode'];?>">
                                    <label class="text-center">Anda yakin ingin membatalkan pesanan <b><?php echo $i['pemesanan_kode']; ?></b> ?</label>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="reset" class="btn btn-outline-secondary btn-lg" data-dismiss="modal" value="close">
                        <input type="submit" class="btn btn-outline-primary btn-lg" value="Submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
