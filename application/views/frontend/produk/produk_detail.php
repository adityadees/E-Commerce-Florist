<div id="breadcrumb" class="clearfix">
    <div class="container">
        <div class="breadcrumb clearfix">
            <ul class="ul-breadcrumb">
                <li><a href="<?= base_url()?>" title="Home">Home</a></li>
                <li><a href="<?= base_url('produk')?>" title="Product">Product</a></li>
                <li><span><?= $prd_detail['produk_nama']; ?></span></li>
            </ul>
            <h2 class="bread-title">Products Detail</h2>
        </div>
    </div>
</div><!-- end breadcrumb -->


<?php 
$tgl=date("Y-m-d h:i:s");
$jtable=[
    'promo' => 'produk_kode',
    'produk' => 'produk_kode'
];
$where=[
    't1.promo_start <='=>$tgl,
    't1.promo_end >'=>$tgl,
    't2.produk_kode'=>$prd_detail['produk_kode'],
];
$promo = $this->Mymod->GetDataJoin($jtable,$where);
$gprom = $promo->row_array();
$newprc=($gprom['produk_harga']-(($gprom['produk_harga']*$gprom['promo_diskon'])/100));

$gsubkat = $this->Mymod->ViewDetail('sub_kategori','sk_id',$prd_detail['sk_id']);
$gkategori = $this->Mymod->ViewDetail('kategori','kategori_id',$gsubkat['kategori_id']);
?>


<div id="columns" class="columns-container">
    <!-- container -->
    <div class="container">
        <div class="row">
            <div class="pb-left-column col-xs-12 col-sm-12 col-md-5">
                <div id="image-block" class="clearfix">
                    <div id="view_full_size">
                        <img src="<?= base_url().'assets/images/product/'.$prd_detail['produk_gambar'];?>" alt="<?= $prd_detail['produk_nama']; ?>" class="img-responsive" width="470" height="627">
                    </div>
                </div><!-- end #image-block -->
            </div><!-- end pb-left-column -->
            <div class="pb-center-column col-xs-12 col-sm-12 col-md-7">
                <div class="pb-centercolumn">
                    <h1><?= $prd_detail['produk_nama']; ?></h1>
                    <div class="price clearfix">
                        <?php if($promo->row_array() > 0 ) {?>
                            <p class="our_price_display">
                                <?= "Rp. ".number_format($newprc); ?>
                            </p>
                            <p class="old_price">
                                <?= "Rp. ".number_format($prd_detail['produk_harga']); ?>
                            </p>
                        <?php } else { ?>
                            <p class="our_price_display">
                                <?= "Rp. ".number_format($prd_detail['produk_harga']); ?>
                            </p>
                        <?php } ?>

                    </div><!-- end price -->
                    <div class="product-boxinfo">  
                        <p id="product_reference">
                            <label>Reference: </label>
                            <span class="editable"><?= $gkategori['kategori_nama']; ?></span>
                            >  
                            <span class="editable"><?= $gsubkat['sk_nama']; ?></span> 
                        </p>

                        <?php if($promo->row_array() > 0 ) {?>
                            <span id="availability_value" class="label label-success">Diskon <?= $gprom['promo_diskon']."%"; ?></span>
                        <?php } else { ?>
                            <span id="availability_value" class="label label-danger">Tidak ada diskon</span>
                        <?php } ?>
                    </div><!-- end product-boxinfo -->
                    <div class="box-info-product clearfix">
                        <div id="quantity_wanted_p">
                            <label>Quantity</label>
                            <div class="group-quantity">
                                <input type="number" min="1" name="qty" id="quantity_wanted" class="text form-control" value="1">
                            </div>
                        </div>

                    </div><!-- end box-info-product -->
                    <div class="box-cart-bottom clearfix">
                      <?php if(isset($_SESSION['logged_in_user'])) { ?>
                        <input type="hidden" name="produk_kode" value="<?= $prd_detail['produk_kode'];?>">
                        <button id="add_to_cart" type="submit" name="Submit" class="exclusive btn button btn-primary" title="Add to cart">
                            Add to cart
                        </button>
                    <?php } else { ?>
                        <button id="add_to_cart" type="submit" name="Submit" class="exclusive btn button btn-primary"  disabled="disabled"  title="Add to cart">Add to Cart
                        </button>
                        <span class="text-danger">*Anda harus login terlebih dahulu</span>
                    <?php } ?>
                </div><!-- end box-cart-bottom -->
                <div class="share-social">
                    <span>Share:</span>
                    <ul class="links list-inline">
                        <li><a href="#"><em class="fa fa-facebook"></em></a></li>
                        <li><a href="#"><em class="fa fa-twitter"></em></a></li>
                        <li><a href="#"><em class="fa fa-google-plus"></em></a></li>
                        <li><a href="#"><em class="fa fa-linkedin"></em></a></li>
                        <li><a href="#"><em class="fa fa-pinterest"></em></a></li>
                        <li class="last"><a href="#"><em class="fa fa-instagram"></em></a></li>
                    </ul>
                </div><!-- end share-social -->
            </div><!-- end pb-centercolumn -->
        </div><!-- end pb-center-column -->
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="tabs-top accordion-info">
                <ul id="myTabs" class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#description" aria-controls="description" role="tab" data-toggle="tab">Description</a></li>
                </ul>
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="description">
                        <div class="panel-body">
                            <p><?= $prd_detail['produk_ket']; ?></p>
                        </div>
                    </div>
                </div><!-- end tab-content -->
            </div><!-- end  accordion-info-->
        </div>
    </div><!-- end row -->

    <div class="blockproductscategory block">
        <h4 class="title_block">Kategori Yang Berhubungan</h4>
        <div class="block_content">
            <div class="owl-row">
                <div class="blockproductscategory_grid">
                    <?php
                    $whr = [
                        'kategori.kategori_id' => $gkategori['kategori_id'],
                    ];
                    $related = $this->Mymod->related($whr)->result_array();
                    foreach ($related as  $arre) :

                        $jtable=[
                            'promo' => 'produk_kode',
                            'produk' => 'produk_kode'
                        ];
                        $where=[
                            't1.promo_start <='=>$tgl,
                            't1.promo_end >'=>$tgl,
                            't2.produk_kode'=>$arre['produk_kode'],
                        ];
                        $promo = $this->Mymod->GetDataJoin($jtable,$where);
                        $gprom = $promo->row_array();
                        $newprc=($gprom['produk_harga']-(($gprom['produk_harga']*$gprom['promo_diskon'])/100));
                        ?>
                        <div class="item">
                            <div class="product-container">
                                <div class="left-block">
                                    <div class="product-image-container">
                                        <a class="product_img_link" href="<?= base_url().'produk/detail/'.$arre['produk_kode'];?>" title="<?= $arre['produk_nama']; ?>">
                                            <img src="<?= base_url().'assets/images/product/'.$arre['produk_gambar'];?>" alt="<?= $arre['produk_nama']; ?>" class="img-responsive image-effect" width="480" height="640">
                                        </a>
                                        <?php if($promo->row_array() > 0 ) {?>
                                            <span class="label-reduction label">- <?= $gprom['promo_diskon']."%"; ?></span>
                                        <?php } else {} ?>
                                    </div>
                                    <div class="box-buttons">
                                        <form action="<?= base_url();?>frontendc/addtocart" method="POST" name="cartForm">
                                            <input type="hidden" min="1" name="qty" id="quantity_wanted" class="text form-control" value="1">
                                            <input type="hidden" name="produk_kode" value="<?= $arre['produk_kode'];?>">

                                            <?php if(isset($_SESSION['logged_in_user'])) { ?>
                                                <button class="ajax_add_to_cart_button button btn" title="Add to cart">
                                                    <i class="zmdi zmdi-shopping-cart"></i>
                                                </button>
                                            <?php } else { } ?>

                                            <a class="button btn quick-view" href="#" data-toggle="modal" data-target="#modal_box<?= $arre['produk_kode']; ?>" title="Quick view">
                                                <i class="zmdi zmdi-eye"></i>
                                            </a>
                                        </form>
                                    </div>
                                </div><!--end left block -->
                                <div class="right-block">
                                    <div class="product-box">
                                        <h5 class="name">
                                            <a class="product-name" href="<?= base_url().'produk/detail/'.$arre['produk_kode'];?>" title="<?= $arre['produk_nama']; ?>">
                                                <?= $arre['produk_nama']; ?>
                                            </a>
                                        </h5>
                                        <div class="content_price">
                                            <?php if($promo->row_array() > 0 ) {?>
                                                <span class="price product-price"><?= "Rp. ".number_format($newprc); ?></span>
                                                <span class="old-price product-price"><?= "Rp. ".number_format($arre['produk_harga']); ?></span>
                                            <?php } else { ?>
                                                <span class="price product-price"><?= "Rp. ".number_format($arre['produk_harga']); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div><!-- end product-box -->
                                </div><!--end right block -->
                            </div><!-- end product-container-->
                        </div>
                    <?php endforeach; ?>
                </div><!-- end blockproductscategory_grid -->
            </div><!-- end tabproduct-carousel -->
        </div>
    </div><!-- end blockproductscategory -->


    <div class="blockproductscategory block">
        <h4 class="title_block">Produk Serupa</h4>
        <div class="block_content">
            <div class="owl-row">
                <div class="blockproductscategory_grid">
                    <?php
                    $whr = [
                        'sub_kategori.sk_id' => $gsubkat['sk_id'],
                    ];
                    $serupa = $this->Mymod->related($whr)->result_array();
                    foreach ($serupa as  $srp) :

                        $jtable=[
                            'promo' => 'produk_kode',
                            'produk' => 'produk_kode'
                        ];
                        $where=[
                            't1.promo_start <='=>$tgl,
                            't1.promo_end >'=>$tgl,
                            't2.produk_kode'=>$srp['produk_kode'],
                        ];
                        $promo = $this->Mymod->GetDataJoin($jtable,$where);
                        $gprom = $promo->row_array();
                        $newprc=($gprom['produk_harga']-(($gprom['produk_harga']*$gprom['promo_diskon'])/100));
                        ?>
                        <div class="item">
                            <div class="product-container">
                                <div class="left-block">
                                    <div class="product-image-container">
                                        <a class="product_img_link" href="<?= base_url().'produk/detail/'.$srp['produk_kode'];?>" title="<?= $srp['produk_nama']; ?>">
                                            <img src="<?= base_url().'assets/images/product/'.$srp['produk_gambar'];?>" alt="<?= $srp['produk_nama']; ?>" class="img-responsive image-effect" width="480" height="640">
                                        </a>
                                        <?php if($promo->row_array() > 0 ) {?>
                                            <span class="label-reduction label">- <?= $gprom['promo_diskon']."%"; ?></span>
                                        <?php } else {} ?>
                                    </div>
                                    <div class="box-buttons">
                                        <form action="<?= base_url();?>frontendc/addtocart" method="POST" name="cartForm">
                                            <input type="hidden" min="1" name="qty" id="quantity_wanted" class="text form-control" value="1">
                                            <input type="hidden" name="produk_kode" value="<?= $srp['produk_kode'];?>">

                                            <?php if(isset($_SESSION['logged_in_user'])) { ?>
                                                <button class="ajax_add_to_cart_button button btn" title="Add to cart">
                                                    <i class="zmdi zmdi-shopping-cart"></i>
                                                </button>
                                            <?php } else { } ?>

                                            <a class="button btn quick-view" href="#" data-toggle="modal" data-target="#modal_box<?= $srp['produk_kode']; ?>" title="Quick view">
                                                <i class="zmdi zmdi-eye"></i>
                                            </a>
                                        </form>
                                    </div>
                                </div><!--end left block -->
                                <div class="right-block">
                                    <div class="product-box">
                                        <h5 class="name">
                                            <a class="product-name" href="<?= base_url().'produk/detail/'.$srp['produk_kode'];?>" title="<?= $srp['produk_nama']; ?>">
                                                <?= $srp['produk_nama']; ?>
                                            </a>
                                        </h5>
                                        <div class="content_price">
                                            <?php if($promo->row_array() > 0 ) {?>
                                                <span class="price product-price"><?= "Rp. ".number_format($newprc); ?></span>
                                                <span class="old-price product-price"><?= "Rp. ".number_format($srp['produk_harga']); ?></span>
                                            <?php } else { ?>
                                                <span class="price product-price"><?= "Rp. ".number_format($srp['produk_harga']); ?></span>
                                            <?php } ?>
                                        </div>
                                    </div><!-- end product-box -->
                                </div><!--end right block -->
                            </div><!-- end product-container-->
                        </div>
                    <?php endforeach; ?>
                </div><!-- end blockproductscategory_grid -->
            </div><!-- end tabproduct-carousel -->
        </div>
    </div><!-- end blockproductscategory -->


</div> <!-- end container -->
</div><!--end warp-->
