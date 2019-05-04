<style>
    .custom-radios div {
      display: inline-block;
  }
  .custom-radios input[type="radio"] {
      display: none;
  }
  .custom-radios input[type="radio"] + label {
      color: #333;
      font-family: Arial, sans-serif;
      font-size: 14px;
  }
  .custom-radios input[type="radio"] + label span {
      display: inline-block;
      width: 40px;
      height: 40px;
      margin: -1px 4px 0 0;
      vertical-align: middle;
      cursor: pointer;
      border-radius: 50%;
      border: 2px solid #fff;
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.33);
      background-repeat: no-repeat;
      background-position: center;
      text-align: center;
      line-height: 44px;
  }
  .custom-radios input[type="radio"] + label span img {
      opacity: 0;
      transition: all 0.3s ease;
  }
  .custom-radios input[type="radio"]#color-1 + label span {
      background-color: #2ecc71;
  }
  .custom-radios input[type="radio"]#color-2 + label span {
      background-color: #3498db;
  }
  .custom-radios input[type="radio"]#color-3 + label span {
      background-color: #f1c40f;
  }
  .custom-radios input[type="radio"]#color-4 + label span {
      background-color: #e74c3c;
  }
  .custom-radios input[type="radio"]:checked + label span img {
      opacity: 1;
  }

/*
.input-hidden {
  position: absolute;
  left: -9999px;
  }*/

</style>

<div id="breadcrumb" class="clearfix">
    <div class="container">
        <div class="breadcrumb clearfix">
            <ul class="ul-breadcrumb">
                <li><a href="<?= base_url()?>" title="Home">Home</a></li>
                <li><span>Checkout</span></li>
            </ul>
            <h2 class="bread-title">Checkout</h2>
        </div>
    </div>
</div><!-- end breadcrumb -->


<div id="columns" class="columns-container">
    <!-- container -->
    <div class="container">


        <?php if($this->session->flashdata('success')){ ?>
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Sukses!</strong> <?php echo $this->session->flashdata('success'); ?>
            </div>
        <?php } else if($this->session->flashdata('error')){?>
            <div class="alert alert-warning">
                <a href="#" class="close" data-dismiss="alert">&times;</a>
                <strong>Error!</strong> <?php echo $this->session->flashdata('error'); ?>
            </div>
        <?php }?>

        <?php
        if(isset($_SESSION['logged_in_user'])){
            $ses_user=$_SESSION['user_id'];
            $join='user';
            $where=[
                't1.user_id'=>$ses_user,
            ];

            $jtable=[
                'keranjang' => 'produk_kode',
                'produk' => 'produk_kode'
            ];
            $kategori = $this->Mymod->ViewData('kategori');
            $getcart = $this->Mymod->GetDataJoin($jtable,$where);

            $countcart=$getcart->num_rows();
            $getCartData=$getcart->result_array();
        }else {}

        if($countcart > 0){
            ?>

            <form method="POST" action="<?php base_url();?>frontendc/save_checkout">
                <div class="page-checkout">
                    <div class="row">
                        <div class="checkoutleft col-lg-9 col-md-9 col-sm-9 col-xs-12">
                            <div class="panel-group" id="accordion">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
                                                Address
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseOne" class="accordion-body collapse in">
                                        <div class="panel-body">
                                            <div class="panel-group" id="acc">
                                                <div class="panel panel-default">
                                                    <div class="custom-radios">
                                                        <div>
                                                            <input type="radio" id="color-1" name="infoakun" value="sesuai" data-target="createp_account">
                                                            <label for="color-1" data-toggle="collapse" data-target="#collapsepayment" aria-controls="collapsepayment">
                                                                <span>
                                                                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg" alt="Checked Icon" />
                                                                </span>
                                                                Sesuai data akun anda?
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <div id="collapsepayment" class="collapse one" data-parent="#acc">
                                                        <br>
                                                        <div class="panel panel-default">
                                                            <div class="panel-heading">
                                                                <h4 class="panel-title">
                                                                    Identitas Anda
                                                                </h4>
                                                            </div>
                                                            <div class="panel-body">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label>Nama</label>
                                                                    </div> 
                                                                    <div class="col-md-9">
                                                                        <label><?= $user['user_nama'];?></label>
                                                                        <input type="hidden" name="user_nama" value="<?= $user['user_nama'];?>">

                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label>Email</label>
                                                                    </div> 
                                                                    <div class="col-md-9">
                                                                        <label><?= $user['user_email'];?></label>
                                                                        <input type="hidden" name="user_email" value="<?= $user['user_email'];?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label>Telepon</label>
                                                                    </div> 
                                                                    <div class="col-md-9">
                                                                        <label><?= $user['user_tel'];?></label>
                                                                        <input type="hidden" name="user_tel" value="<?= $user['user_tel'];?>">
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <label>Alamat</label>
                                                                    </div> 
                                                                    <div class="col-md-9">
                                                                        <label><?= $user['user_alamat'];?></label>
                                                                        <input type="hidden" name="user_alamat" value="<?= $user['user_alamat'];?>">
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <br>


                                                    <div class="panel-default">
                                                        <div class="custom-radios">
                                                            <div>
                                                                <input type="radio" id="color-2" name="infoakun" value="berbeda" data-target="createp_account" >
                                                                <label for="color-2"  data-toggle="collapse" data-target="#collapsedefult" aria-controls="collapsedefult">
                                                                    <span>
                                                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg" alt="Checked Icon" />
                                                                    </span>
                                                                    Kirim ke alamat yang berbeda ?
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="collapsedefult" class="collapse one" data-parent="#acc">

                                                            <br>
                                                            <div class="panel panel-default">
                                                                <div class="panel-heading">
                                                                    <h4 class="panel-title">
                                                                        Masukan Identitas Anda
                                                                    </h4>
                                                                </div>
                                                                <div class="panel-body">

                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <label>Nama</label>
                                                                            <input type="text" name="ps_nama" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <label>Email</label>
                                                                            <input type="email" name="ps_email" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <label>Telepon</label>
                                                                            <input type="tel" name="ps_tel" class="form-control">
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <div class="col-md-12">
                                                                            <label>Alamat</label>
                                                                            <textarea name="ps_alamat" class="form-control"></textarea>
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
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                                                Payment
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseTwo" class="accordion-body collapse">
                                        <div class="panel-body">
                                            <div class="card-bodyfive">
                                                <div class="checkout_coupon_code">
                                                    <input type="hidden" name="user_id" value="<?= $user['user_id'];?>">
                                                    <div class="custom-radios">
                                                        <div>
                                                            <input type="radio" id="color-3" name="pembayaran_method" value="ditempat" data-target="createp_account">
                                                            <label for="color-3" data-toggle="collapse" data-target="#collapsepayment" aria-controls="collapsepayment">
                                                                <span>
                                                                    <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg" alt="Checked Icon" />
                                                                </span>
                                                                Bayar ditempat
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="panel-default">
                                                        <div class="custom-radios">
                                                            <div>
                                                                <input type="radio" id="color-4" name="pembayaran_method" value="transfer" data-target="createp_account" >
                                                                <label for="color-4"  data-toggle="collapse" data-target="#collspembayaran" aria-controls="collspembayaran">
                                                                    <span>
                                                                        <img src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/242518/check-icn.svg" alt="Checked Icon" />
                                                                    </span>
                                                                    Transfer
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div id="collspembayaran" class="collapse one" data-parent="#accbank">
                                                            <div class="card-bodyfive">
                                                                <h3>Bank yang tersedia :</h3><br>
                                                                <div class="row">
                                                                    <?php foreach($rekening as $rek):?>
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <div class="col-md-6">
                                                                                    <img src="<?= base_url().'assets/images/'.$rek['rekening_gambar'];?>" height="50px">
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                    <h5><?= $rek['rekening_nama']; ?></h5>
                                                                                    <h5><?= $rek['rekening_nomor']; ?></h5>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    <?php endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                                Order Review
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapseThree" class="accordion-body collapse">
                                        <div class="panel-body">
                                            <table class="table table-bordered shop_tablecart">
                                                <thead>
                                                    <tr>
                                                        <th class="product-thumbnail text-center">
                                                            Product
                                                        </th>
                                                        <th class="product-name">
                                                            Nama
                                                        </th>
                                                        <th class="product-price text-right">
                                                            Harga
                                                        </th>
                                                        <th class="product-quantity text-center">
                                                            Qty
                                                        </th>
                                                        <th class="product-quantity text-center">
                                                            Bonus Qty
                                                        </th>
                                                        <th class="product-quantity text-center">
                                                            Diskon
                                                        </th>
                                                        <th class="product-subtotal text-right">
                                                            Subtotal
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <input type="hidden" name="user_id" value="<?= $user['user_id'];?>">
                                                    <?php
                                                    $tgl=date('myd');
                                                    $kd="INV";
                                                    $ran1=rand(0,999);
                                                    $ran2=rand(0,99);
                                                    $pemesanan_kode=$kd.$ran1.$tgl.$ran2;
                                                    $total=0;
                                                    $ship=5000;
                                                    $ptotal=0;
                                                    $tgl=date('Y-m-d H:i:s');
                                                    $cid=0;
                                                    foreach($getCartData as $gcart):
                                                        $cid++;
                                                        if($gcart['keranjang_qty']>1 && $gcart['produk_up']=='yes'){
                                                          $bonus=($gcart['keranjang_qty']/2);

                                                      }else {
                                                          $bonus=0;
                                                      }
                                                      $data = [
                                                          'produk_kode' => $gcart['produk_kode'],
                                                          'promo_start <='=>$tgl,
                                                          'promo_end >'=>$tgl,
                                                      ];
                                                      $cek = $this->Mymod->CekDataRows('promo',$data);

                                                      if($cek->num_rows()>0){
                                                          $je=$cek->row_array();
                                                          $newprc=($gcart['produk_harga']-(($gcart['produk_harga']*$je['promo_diskon'])/100));
                                                          $ptotal=$newprc*$gcart['keranjang_qty'];
                                                      } else {
                                                          $ptotal=$gcart['produk_harga']*$gcart['keranjang_qty'];
                                                      }

                                                      $total +=$ptotal;
                                                      ?>
                                                      <tr class="cart_table_item">
                                                        <td class="product-thumbnail text-center">
                                                            <a href="page-detail.html">
                                                                <img width="80" height="107" alt="" class="img-responsive" src="<?= base_url('assets/images/product/'.$gcart['produk_gambar'])?>">
                                                            </a>
                                                        </td>
                                                        <td class="product-name">
                                                            <input type="text" name="cid" value="<?= $cid; ?>">
                                                            <a href="<?= base_url('produk/detail/'.$gcart['produk_kode'])?>"><?= $gcart['produk_nama']; ?></a>
                                                        </td>
                                                        <td class="product-price text-right">
                                                            <span class="amount">
                                                                <?php
                                                                if($cek->num_rows()>0){ ?>
                                                                    <span class="old_price">  <s><?= "Rp. ".number_format($gcart['produk_harga']);?></s>  </span><br>
                                                                    <span class="new_price"><?= "Rp. ".number_format($newprc);?> </span>
                                                                    <input type="hidden" name="pdp_harga[]" value="<?= $newprc;?>">

                                                                <?php   } else { ?>
                                                                    <input type="hidden" name="pdp_harga[]" value="<?= $gcart['produk_harga'];?>">
                                                                    <span class="old_price"><?= "Rp. ".number_format($gcart['produk_harga']);?> </span><br>
                                                                <?php }?>
                                                            </span>
                                                        </td>
                                                        <td class="product-quantity text-center">
                                                            <input type="text" name="produk_kode[]" value="<?= $gcart['produk_kode'];?>">
                                                            <input type="hidden" name="pdp_qty[]" value="<?= $gcart['keranjang_qty'];?>">
                                                            <?= $gcart['keranjang_qty']; ?>
                                                        </td>
                                                        <td class="product-quantity text-center">
                                                            <span class="amount">
                                                                <input type="hidden" name="pdp_bonus[]" value="<?= floor($bonus);?>">
                                                                <?= floor($bonus);
                                                                if($gcart['produk_up']=='yes'){ ?>

                                                                    <sup title="Dapatkan bonus 1 produk setiap pembelian kelipatan 2">[*]</sup>

                                                                <?php } ?>
                                                            </span>
                                                        </td>
                                                        <td class="product-quantity text-center">
                                                            <?php
                                                            if($cek->num_rows()>0){ 
                                                                echo $je['promo_diskon']." %";
                                                                ?>
                                                                <input type="hidden" name="pdp_diskon[]" value="<?= $je['promo_diskon'];?>">
                                                            <?php } else { 
                                                                echo "-"; ?>
                                                                <input type="hidden" name="pdp_diskon[]" value="0">
                                                            <?php }
                                                            ?>
                                                        </td>

                                                        <td class="product-subtotal text-right">
                                                            <input type="hidden" name="pdp_subtotal[]" value="<?= $ptotal;?>">
                                                            <p><?= "Rp. ".number_format($ptotal); ?></p>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                        <hr class="tall">
                                        <h4 class="heading-primary">Cart Totals</h4>
                                        <table class="table cart-totals">
                                            <tbody>
                                                <tr class="cart-subtotal">
                                                    <th>
                                                        <strong>Cart Subtotal</strong>
                                                    </th>
                                                    <td>
                                                        <strong><span class="amount"><?= "Rp. ".number_format($total);?></span></strong>
                                                        <input type="hidden" name="pemesanan_subtotal" value="<?= $total;?>">
                                                    </td>
                                                </tr>
                                                <tr class="shipping">
                                                    <th>
                                                        Ongkir
                                                    </th>
                                                    <td>
                                                        <?php if($total<50000){ 
                                                            echo "Rp. ".number_format($ship);
                                                            ?>
                                                            <input type="hidden" name="pemesanan_ongkir" value="<?= $ship;?>">
                                                            <?php 
                                                        } else { 
                                                            echo "Rp. 0";
                                                            ?>
                                                            <input type="hidden" name="pemesanan_ongkir" value="0">
                                                            <?php 
                                                        } ?>
                                                    </td>
                                                </tr>
                                                <tr class="total">
                                                    <th>
                                                        <strong>Order Total</strong>
                                                    </th>
                                                    <td>
                                                        <strong><span class="amount">

                                                            <input type="hidden" name="pemesanan_kode" value="<?= $pemesanan_kode;?>">

                                                            <?php if($total<50000){ 
                                                                echo "Rp. ".number_format($total+$ship); 
                                                                ?>
                                                                <input type="hidden" name="pemesanan_total" value="<?= $total+$ship;?>">
                                                            <?php } else { 
                                                                echo "Rp. ".number_format($total); 
                                                                ?>
                                                                <input type="hidden" name="pemesanan_total" value="<?= $total;?>">
                                                            <?php } ?>
                                                        </span></strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        <hr class="tall">

                                        <div class="actions-continue pull-right">
                                            <input type="submit" value="I confirm my order" name="proceed" class="btn btn-primary">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="checkoutright col-lg-3 col-md-3 col-sm-3 col-xs-12">
                        <h4 class="title_block">Cart Totals</h4>
                        <table class="table cart-totals">
                            <tbody>
                                <tr class="cart-subtotal">
                                    <th>
                                        <strong>Cart Subtotal</strong>
                                    </th>
                                    <td>
                                        <strong><span class="amount">
                                            <?= "Rp. ".number_format($total);?>
                                        </span></strong>
                                    </td>
                                </tr>
                                <tr class="shipping">
                                    <th>
                                        Ongkir
                                    </th>
                                    <td>
                                        <?php if($total<50000){ 
                                            echo "Rp. ".number_format($ship);
                                            ?>
                                            <input type="hidden" name="pemesanan_ongkir" value="<?= $ship;?>">
                                            <?php 
                                        } else { 
                                            echo "Rp. 0";
                                            ?>
                                            <input type="hidden" name="pemesanan_ongkir" value="0">
                                            <?php 
                                        } ?>
                                    </td>
                                </tr>
                                <tr class="total">
                                    <th>
                                        <strong>Order Total</strong>
                                    </th>
                                    <td>
                                        <strong>
                                            <?php if($total<50000){ 
                                                echo "Rp. ".number_format($total+$ship); 
                                                ?>
                                            <?php } else { 
                                                echo "Rp. ".number_format($total); 
                                                ?>
                                            <?php } ?>
                                        </strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <hr class="tall">
                        <span>
                            <a href="<?= base_url('cart')?>">
                                Ingin merubah pesanan anda?
                            </a>
                        </span>
                    </div>
                </div>
            </div>
        </form>
    <?php } else { ?>

        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Keranjang anda masih kosong!</h4>
            <p>
                Silahkan berbelanja terlebih dahulu untuk melakukan checkout. 
                <br>
                <a href="<?= base_url('produk')?>" class="btn btn-primary">Belanja sekarang</a>
            </p>
        </div>
    <?php } ?>
    <br>
</div> <!-- end container -->
</div><!--end columns -->
