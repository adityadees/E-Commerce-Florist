<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie ie9" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <!--<![endif]-->
<html lang="en">
<head>
  <!-- Basic Page Needs -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?= $title; ?></title>

  <meta name="keywords" content="Responsive HTML Template">
  <meta name="description" content="Scara Responsive HTML Template">
  <meta name="author" content="tivatheme">

  <!-- Favicon -->
  <link rel="shortcut icon" href="<?= base_url();?>assets/images/logo/favicon.ico" type="image/x-icon">

  <!-- Mobile Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700' rel='stylesheet' type='text/css'>
  <!-- Vendor CSS -->
  
  <!-- <link rel="stylesheet" href="<?= base_url();?>assets/frontend/vendor/bootstrap/css/bootstrap-theme.css"> -->
  <link rel="stylesheet" href="<?= base_url();?>assets/frontend/vendor/bootstrap/css/bootstrap3.4.0.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/frontend/vendor/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/frontend/vendor/font-material/css/material-design-iconic-font.min.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/frontend/vendor/owl.carousel/assets/owl.carousel.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/frontend/vendor/magnific-popup/magnific-popup.css">

  <link rel="stylesheet" href="<?= base_url();?>assets/frontend/vendor/nivo-slider/css/nivo-slider.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/frontend/vendor/nivo-slider/css/animate.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/frontend/vendor/nivo-slider/css/style.css">

  <link rel="stylesheet" href="<?= base_url();?>assets/frontend/vendor/slider-range/css/jslider.css">

  <!-- Template CSS -->
  <link rel="stylesheet" href="<?= base_url();?>assets/frontend/css/theme-global.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/frontend/css/theme-animate.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/frontend/css/theme-product.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/frontend/css/theme-product-list.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/frontend/css/theme-blog.css">
  <link rel="stylesheet" href="<?= base_url();?>assets/frontend/css/theme-responsive.css">

  <!-- Template Custom CSS -->
  <link rel="stylesheet" href="<?= base_url();?>assets/frontend/css/custom.css">
</head>
<body class="index home-1">
  <div id="all">
    <?php 

    function readmore($string){
     $string = substr($string, 0, 300); 
     $string = $string . "..."; 
     return $string; 
   }


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


   ?>


   <header id="top-header">
    <div class="header-topbar">
      <div class="container">
        <div class="row">
          <div class="col-lg-5 col-md-5 col-sm-6 col-xs-8">
            <div class="block-callus pull-left hidden-xs">
              <span>Call us now: 0813-6824-6866</span>
            </div><!-- end call us -->
          </div>
          <div class="col-lg-7 col-md-7 col-sm-6 col-xs-4">
            <div class="header_user_info pull-right">
              <div data-toggle="dropdown" class="dropdown-title">
                <a href="#" title="My account"><i class="fa fa-user"></i></a>
              </div>   
              <ul class="links">
                <?php if(!isset($_SESSION['logged_in_user'])) {?>

                  <li>
                    <a href="<?= base_url('Register')?>" title="Register">Register</a>
                  </li>
                  <li>
                    <a href="<?= base_url('Login')?>" title="Login">Login</a>
                  </li>
                <?php }else {?>
                  <li>
                    <a href="<?= base_url();?>myaccount" title="Account">Account</a>
                  </li>
                  <li>
                    <a href="<?= base_url();?>Logout" title="Logout">Logout</a>
                  </li>
                <?php } ?>

              </ul>
            </div><!-- end header_user_info -->
          </div>
        </div>
      </div>
    </div>
    <div class="header-main">
      <div class="container">
        <div class="row">
          <div class="col-lg-2 col-md-2 col-sm-5 col-xs-5">
            <div class="logo">
              <a href="<?= base_url()?>" title="ORM FLORIST">
                <img class="img-responsive" src="<?= base_url();?>assets/images/logo/tes.png" alt="" width="160px" height="50px">
              </a>
            </div><!--end logo-->
          </div>

          <div class="col-lg-10 col-md-10 col-sm-7 col-xs-7">
            <div class="topheader-navholder">
              <div class="topheader-navholder-lf">
                <?php if(isset($_SESSION['logged_in_user'])) {?>

                  <div id="block-cart" class="block-cart dropdown-over pull-right">
                    <div data-toggle="dropdown" class="dropdown-title">
                      <a href="#" title="Shopping cart">
                        <span class="title-cart"><i class="zmdi zmdi-shopping-basket"></i></span>
                        <span class="ajax_cart_quantity"><?= $countcart;?></span>
                      </a>
                    </div>   
                    <div class="dropdown-content">
                      <div class="cart_block_list">
                        <table class="cart">
                          <tbody>
                           <?php
                           $total=0;
                           $ship=5000;
                           $ptotal=0;
                           $subtotal=0;
                           $tgl=date('Y-m-d H:i:s');
                           foreach($getCartData as $i):
                            if($i['keranjang_qty']>1 && $i['produk_up']=='yes'){
                              $bonus=($i['keranjang_qty']/2);

                            }else {
                              $bonus=0;
                            }
                            $data = [
                              'produk_kode' => $i['produk_kode'],
                              'promo_start <='=>$tgl,
                              'promo_end >'=>$tgl,
                            ];
                            $cek = $this->Mymod->CekDataRows('promo',$data);

                            if($cek->num_rows()>0){
                              $je=$cek->row_array();
                              $newprc=($i['produk_harga']-(($i['produk_harga']*$je['promo_diskon'])/100));
                              $ptotal=$newprc*$i['keranjang_qty'];
                            } else {
                              $ptotal=$i['produk_harga']*$i['keranjang_qty'];
                            }

                            $total +=$ptotal;
                            ?>
                            <tr>
                              <td class="product-thumbnail">
                                <a href="page-detail.html">
                                  <img width="80" height="107" alt="" class="img-responsive" src="<?php echo base_url();?>assets/images/product/<?= $i['produk_gambar'];?>">
                                </a>
                              </td>
                              <td class="product-name">
                                <a href="<?= base_url('produk/detail/'.$i['produk_kode'])?>"><?= $i['produk_nama']; ?></a>
                                <br>
                                <?php
                                if($cek->num_rows()>0){ ?>
                                  <span class="amount text-danger"><strong><s><?= "Rp. ".number_format($i['produk_harga']);?></s></strong></span><br>
                                  <span class="amount"><strong><?= "Rp. ".number_format($newprc);?></strong></span>
                                <?php   } else { ?>
                                  <span class="amount"><strong><?= "Rp. ".number_format($i['produk_harga']);?></strong></span>
                                <?php }?>
                                <br>
                                <span class="quantity">Qty: <?= $i['keranjang_qty'];?></span><br>

                              </td>
                              <td class="product-actions">
                                <a title="Remove this item" class="remove" href="#" data-target="#delCart<?= $i['keranjang_id']; ?>" data-toggle="modal">
                                  <i class="fa fa-times"></i>
                                </a>
                              </td>
                            </tr>
                          <?php endforeach; ?>
                          <tr>
                            <td colspan="3">
                              <hr>
                            </td>
                          </tr>
                          <tr>
                            <td>Total</td>
                            <td colspan="2">
                              <span class="text-danger text-right bold pull-right">  <?= "Rp. ".number_format($total); ?> </span><br>
                            </td>
                          </tr>
                          <tr>
                            <td class="actions" colspan="3">
                              <div class="actions-continue">
                                <a href="<?= base_url();?>cart" class="btn btn-default">View All</a>
                                <a href="<?= base_url();?>checkout" class="btn pull-right btn-primary">Checkout<i class="fa fa-angle-right ml-xs"></i></a>
                              </div>
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div><!-- end dropdown-content -->
                </div><!-- end blockcart_top -->
              <?php } else {}?>

              <div id="search_block_top" class="block-search dropdown-over pull-right">
                <div data-toggle="dropdown" class="dropdown-title">
                  <a href="#" title="Search"><i class="zmdi zmdi-search"></i></a>
                </div>
                <div class="dropdown-content">
                  <form id="searchbox" action="#">
                    <div class="input-group">
                      <input class="search_query form-control" type="text" id="search_query_top" name="search_query" placeholder="Search" value="" autocomplete="off">
                      <div class="input-group-btn">
                        <button type="submit" name="submit_search" class="btn button btn-primary">Search</button> 
                      </div>
                    </div>
                  </form>
                </div>
              </div><!-- end #search_block_top -->
            </div><!-- end topheader-navholder-lf -->
            <div class="topheader-navholder-rg">
              <span id="btn-menu"><i class="zmdi zmdi-menu"></i></span>
              <nav id="main-nav">
                <ul class="nav navbar-nav megamenu">
                  <li class="dropdown">
                    <a href="<?= base_url()?>">Home</a>
                  </li>

                  <li class="dropdown aligned-fullwidth">
                    <a href='#'>Shop <b class="caret"></b></a>
                    <div id="dropdown-menu2" class="dropdown-menu">
                      <div class="row">

                        <?php 
                        foreach ($kategori as $kat): 
                          $where=[
                            't1.kategori_id'=>$kat['kategori_id'],
                          ];
                          $jtable=[
                            'kategori' => 'kategori_id',
                            'sub_kategori' => 'kategori_id',
                          ];
                          $cek = $this->Mymod->GetDataJoin($jtable,$where);
                          ?>
                          <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
                            <div class="block-subcategories">
                              <div class="menu-title">
                                <b><a href="<?= base_url()?>produk/kat/<?= $kat['kategori_id'];?>" title="<?= $kat['kategori_nama']; ?>"><?= $kat['kategori_nama']; ?></a></b>
                              </div>
                              <ul>
                               <?php 
                               $table='sub_kategori';
                               $where=[
                                'kategori_id'=>$kat['kategori_id'],
                              ];
                              $gsubkat=$this->Mymod->ViewDataWhere($table,$where); 
                              foreach ($gsubkat as $subkat):
                                ?>
                                <li><a href="<?= base_url();?>produk/subkat/<?= $subkat['sk_id'];?>" title="<?= $subkat['sk_nama'];?>"><?= $subkat['sk_nama'];?></a></li>
                              <?php endforeach; ?>

                            </ul>
                          </div>
                        </div>
                      <?php endforeach; ?>

                    </div>
                  </div>
                </li>

                <li class="dropdown">
                  <a href="<?= base_url('aboutus')?>">About Us</a>
                </li>

                <li class="dropdown">
                  <a href="<?= base_url('contactus')?>">Contact Us</a>
                </li>

              </ul>
            </nav><!-- end main-nav -->
          </div><!-- end topheader-navholder-rg -->
        </div><!-- end topheader-navholder -->
      </div>
    </div><!-- end row -->
  </div><!-- end container -->
</div>
</header><!-- end header -->



<?php
if(isset($_SESSION['logged_in_user'])){

 foreach($getCartData as $gcart): ?>
  <div class="modal fade text-left" id="delCart<?= $gcart['keranjang_id']; ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel34" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h3 class="modal-title" id="myModalLabel34">Konfirmasi</h3>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php echo base_url()?>frontendc/delete_cart" method="POST">
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <input type="hidden" name="keranjang_id" value="<?php echo $gcart['keranjang_id'];?>">
                  <label class="text-center">Anda yakin ingin menghapus produk <b><?php echo $gcart['produk_nama']; ?></b> ?</label>
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
  <?php endforeach; }?>