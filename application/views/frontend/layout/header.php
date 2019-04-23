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
  <link rel="shortcut icon" href="<?= base_url();?>assets/frontend/img/favicon.ico" type="image/x-icon">

  <!-- Mobile Meta -->
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

  <!-- Google Fonts -->
  <link href='https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700' rel='stylesheet' type='text/css'>
  <!-- Vendor CSS -->
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <!-- <link rel="stylesheet" href="<?= base_url();?>assets/frontend/vendor/bootstrap/css/bootstrap-theme.css"> -->
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


    <header id="top-header">
      <div class="header-topbar">
        <div class="container">
          <div class="row">
            <div class="col-lg-5 col-md-5 col-sm-6 col-xs-8">
              <div class="block-callus pull-left hidden-xs">
                <span>Call us now: 0123-456-789</span>
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
                <a href="<?= base_url()?>" title="Tiva byHands">
                  <img class="img-responsive" src="<?= base_url();?>assets/frontend/img/logo.png" alt="">
                </a>
              </div><!--end logo-->
            </div>
            <div class="col-lg-10 col-md-10 col-sm-7 col-xs-7">
              <div class="topheader-navholder">
                <div class="topheader-navholder-lf">
                  <div id="block-cart" class="block-cart dropdown-over pull-right">
                    <div data-toggle="dropdown" class="dropdown-title">
                      <a href="#" title="Shopping cart">
                        <span class="title-cart"><i class="zmdi zmdi-shopping-basket"></i></span>
                        <span class="ajax_cart_quantity">2</span>
                      </a>
                    </div>   
                    <div class="dropdown-content">
                      <div class="cart_block_list">
                        <table class="cart">
                          <tbody>
                            <tr>
                              <td class="product-thumbnail">
                                <a href="page-detail.html">
                                  <img width="80" height="107" alt="" class="img-responsive" src="<?= base_url();?>assets/frontend/img/product/1.jpg">
                                </a>
                              </td>
                              <td class="product-name">
                                <a href="page-detail.html">Tulipa floriade - red</a>
                                <br><span class="amount"><strong>$28.98</strong></span>
                              </td>
                              <td class="product-actions">
                                <a title="Remove this item" class="remove" href="#">
                                  <i class="fa fa-times"></i>
                                </a>
                              </td>
                            </tr>
                            <tr>
                              <td class="product-thumbnail">
                                <a href="page-detail.html">
                                  <img width="80" height="107" alt="" class="img-responsive" src="<?= base_url();?>assets/frontend/img/product/2.jpg">
                                </a>
                              </td>
                              <td class="product-name">
                                <a href="page-detail.html">Tulipa floriade - red</a>
                                <br><span class="amount"><strong>$28.98</strong></span>
                              </td>
                              <td class="product-actions">
                                <a title="Remove this item" class="remove" href="#">
                                  <i class="fa fa-times"></i>
                                </a>
                              </td>
                            </tr>
                            <tr>
                              <td class="actions" colspan="3">
                                <div class="actions-continue">
                                  <button type="submit" class="btn btn-default">View All</button>
                                  <button type="submit" class="btn pull-right btn-primary">Checkout<i class="fa fa-angle-right ml-xs"></i></button>
                                </div>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                    </div><!-- end dropdown-content -->
                  </div><!-- end blockcart_top -->

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



