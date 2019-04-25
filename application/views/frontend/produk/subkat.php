<div id="breadcrumb" class="clearfix">
    <div class="container">
        <div class="breadcrumb clearfix">
            <ul class="ul-breadcrumb">
                <li><a href="<?= base_url()?>" title="Home">Home</a></li>
                <li><a href="<?= base_url()?>produk/kat/<?= $nprd[0]['kategori_id'];?>" title="Kategori">Kategori</a></li>
                <li><span>Sub Kategori</span></li>
            </ul>
            <h2 class="bread-title"><?= $nprd[0]['sk_nama']; ?></h2>
        </div>
    </div>
</div><!-- end breadcrumb -->

<div id="columns" class="columns-container">
    <!-- container -->
    <div class="container">
        <div class="row">
            <div id="left_column" class="sidebar col-lg-3 col-md-3">
                <div id="categories_block_left" class="block">
                    <h4 class="title_block">Kategori</h4>
                    <div class="block_content">
                        <ul class="list-block">
                            <li>
                                <a href="<?= base_url();?>produk" title="All Products">
                                    All Products
                                </a>
                            </li>

                            <?php 
                            foreach ($kategori as $i) : 
                                $cc = $this->Mymod->countkat($i['kategori_id'])->row_array();
                                ?>
                                <li class="parent">
                                    <a href="<?= base_url()?>produk/kat/<?= $i['kategori_id'];?>" title="<?= $i['kategori_nama']; ?>">
                                        <?= $i['kategori_nama']; ?>
                                        <span class="count">(<?= $cc['Total']; ?>)</span>
                                        <span class="arrow"></span>
                                    </a>
                                    <ul>
                                        <?php 
                                        $table='sub_kategori';
                                        $where=[
                                            'kategori_id'=>$i['kategori_id'],
                                        ];
                                        $gsubkat=$this->Mymod->ViewDataWhere($table,$where); 
                                        foreach ($gsubkat as $subkat):
                                            ?>
                                            <li>
                                                <a href="<?= base_url();?>produk/subkat/<?= $subkat['sk_id'];?>" title="<?= $subkat['sk_nama'];?>"><?= $subkat['sk_nama'];?></a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </li>
                            <?php endforeach; ?>

                        </ul>
                    </div>
                </div><!-- end categories_block_left -->
                <div id="block_featured_product" class="block">
                    <h4 class="title_block">Best sellers</h4>
                    <div class="block_content">
                        <ul class="product_list_block">
                            <?php 
                            $tgl=date("Y-m-d h:i:s");
                            foreach($best as $i): 
                                $gtable='produk';
                                $gwhere='produk_kode';
                                $gdata=$i['produk_kode'];

                                $gc= $this->Mymod->ViewDetail($gtable,$gwhere,$gdata);

                                $jtable=[
                                  'promo' => 'produk_kode',
                                  'produk' => 'produk_kode'
                              ];
                              $where=[
                                  't1.promo_start <='=>$tgl,
                                  't1.promo_end >'=>$tgl,
                                  't2.produk_kode'=>$gc['produk_kode'],
                              ];
                              $promo = $this->Mymod->GetDataJoin($jtable,$where);
                              $gprom = $promo->row_array();
                              $newprc=($gprom['produk_harga']-(($gprom['produk_harga']*$gprom['promo_diskon'])/100));
                              ?>
                              <li>
                                <div class="product-container media">
                                    <div class="product-image-container pull-left">
                                        <a class="product_img_link" href="<?= base_url().'produk/detail/'.$gc['produk_kode'];?>" title="<?= $gc['produk_nama'];?>">
                                            <img src="<?= base_url();?>assets/images/product/<?= $gc['produk_gambar']; ?>" alt="<?= $gc['produk_nama'];?>" class="img-responsive" width="86" height="115">
                                        </a>
                                        <?php if($promo->row_array() > 0 ) {?>
                                            <span class="label-reduction label"><?= " -".$gprom['promo_diskon']."%"; ?></span>
                                        <?php } else {} ?>
                                    </div>
                                    <div class="media-body">
                                        <h5 class="name">
                                            <a class="product-name" href="<?= base_url().'produk/detail/'.$gc['produk_kode'];?>" title="<?= $gc['produk_nama'];?>">
                                                <?= $gc['produk_nama'];?>
                                            </a>
                                        </h5>
                                        <div class="content_price">
                                         <?php if($promo->row_array() > 0 ) {?>
                                            <span class="price product-price"><?= "Rp. ".number_format($newprc); ?> </span><br>
                                            <span class="old-price product-price"> <?= "Rp. ".number_format($gc['produk_harga']); ?> </span>
                                        <?php } else { ?>
                                          <span class="price product-price"><?= "Rp. ".number_format($gc['produk_harga']); ?> </span>
                                      <?php } ?>
                                  </div>
                              </div>
                          </div>
                      </li>
                  <?php endforeach; ?>

              </ul>
          </div>
      </div><!-- end block_featured_product -->
  </div><!-- end left_column -->
  <div id="center_column" class="col-lg-9 col-md-9">
    <div class="content_sortPagiBar top clearfix">
        <div class="pull-left hidden-xs">
            <nav class="tiva-nav-tabs-box">
                <ul class="nav tiva-nav-tabs" role="tablist">
                    <li class="active"><a href="#tiva-grid" data-toggle="tab" aria-expanded="true"><i class="fa fa-th"></i></a></li>
                    <li class=""><a href="#tiva-list" data-toggle="tab" aria-expanded="false"><i class="fa fa-list-ul"></i></a></li>
                </ul>
            </nav>
        </div>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="tiva-grid">
            <div class="row">

              <?php 
              $tgl=date("Y-m-d h:i:s");
              foreach ($nprd as $prod) :

                $jtable=[
                    'promo' => 'produk_kode',
                    'produk' => 'produk_kode'
                ];
                $where=[
                    't1.promo_start <='=>$tgl,
                    't1.promo_end >'=>$tgl,
                    't2.produk_kode'=>$prod['produk_kode'],
                ];
                $promo = $this->Mymod->GetDataJoin($jtable,$where);
                $gprom = $promo->row_array();
                $newprc=($gprom['produk_harga']-(($gprom['produk_harga']*$gprom['promo_diskon'])/100));
                ?>


                <div class="type_block_product col-sp-12 col-xs-6 col-sm-4 col-md-4 col-lg-4">
                    <div class="product-container">
                        <div class="left-block">
                            <div class="product-image-container">
                                <a class="product_img_link" href="<?= base_url().'produk/detail/'.$prod['produk_kode'];?>" title="<?= $prod['produk_nama']; ?>">
                                    <img src="<?= base_url().'assets/images/product/'.$prod['produk_gambar'];?>" alt="<?= $prod['produk_nama']; ?>" class="img-responsive image-no-effect" width="480" height="640">
                                </a>
                                <?php if($promo->row_array() > 0 ) {?>
                                    <span class="label-reduction label"><?= " -".$gprom['promo_diskon']."%"; ?></span>
                                <?php } else {} ?>
                            </div>
                            <div class="box-buttons">
                                <form action="<?= base_url();?>frontendc/addtocart" method="POST" name="cartForm">
                                    <input type="hidden" min="1" name="qty" id="quantity_wanted" class="text form-control" value="1">
                                    <input type="hidden" name="produk_kode" value="<?= $prod['produk_kode'];?>">

                                    <?php if(isset($_SESSION['logged_in_user'])) { ?>
                                        <button class="ajax_add_to_cart_button button btn" title="Add to cart">
                                            <i class="zmdi zmdi-shopping-cart"></i>
                                        </button>
                                    <?php } else { } ?>

                                    <a class="button btn quick-view" href="#" data-toggle="modal" data-target="#modal_box<?= $prod['produk_kode']; ?>" title="Quick view">
                                        <i class="zmdi zmdi-eye"></i>
                                    </a>
                                </form>
                            </div>
                        </div><!--end left block -->
                        <div class="right-block">
                            <div class="product-box">
                                <h5 class="name">
                                    <a class="product-name" href="<?= base_url().'produk/detail/'.$prod['produk_kode'];?>" title="<?= $prod['produk_nama']; ?>">
                                        <?= $prod['produk_nama']; ?>
                                    </a>
                                </h5>
                                <div class="content_price">
                                    <?php if($promo->row_array() > 0 ) {?>

                                        <span class="price product-price"><?= "Rp. ".number_format($newprc); ?></span>
                                        <span class="old-price product-price"><?= "Rp. ".number_format($prod['produk_harga']); ?></span>
                                    <?php } else { ?>

                                        <span class="new_price"> <?= "Rp. ".number_format($prod['produk_harga']); ?> </span>

                                    <?php } ?>
                                </div>
                            </div><!--end right block -->
                        </div>
                    </div><!-- end product-container-->
                </div><!-- end type_block_product -->
            <?php endforeach; ?>


        </div><!-- end row -->
    </div><!-- end tiva-grid -->
    <div class="tab-pane fade" id="tiva-list">
        <div class="row">
            <?php 
            $tgl=date("Y-m-d h:i:s");
            foreach ($nprd as $prod) :

                $jtable=[
                    'promo' => 'produk_kode',
                    'produk' => 'produk_kode'
                ];
                $where=[
                    't1.promo_start <='=>$tgl,
                    't1.promo_end >'=>$tgl,
                    't2.produk_kode'=>$prod['produk_kode'],
                ];
                $promo = $this->Mymod->GetDataJoin($jtable,$where);
                $gprom = $promo->row_array();
                $newprc=($gprom['produk_harga']-(($gprom['produk_harga']*$gprom['promo_diskon'])/100));
                ?>

                <div class="type_block_product col-sp-12 col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="product-container">
                        <div class="row">
                            <div class="col-lg-4 col-md-4">
                                <div class="left-block">
                                    <div class="product-image-container">
                                        <a class="product_img_link" href="<?= base_url().'produk/detail/'.$prod['produk_kode'];?>" title="<?= $prod['produk_nama']; ?>">
                                            <img src="<?= base_url().'assets/images/product/'.$prod['produk_gambar'];?>" alt="<?= $prod['produk_nama']; ?>" class="img-responsive image-no-effect" width="480" height="640">
                                        </a>
                                        <?php if($promo->row_array() > 0 ) {?>
                                            <span class="label-reduction label"><?= " -".$gprom['promo_diskon']."%"; ?></span>
                                        <?php } else {} ?>
                                    </div>
                                    <div class="box-buttons">
                                        <form action="<?= base_url();?>frontendc/addtocart" method="POST" name="cartForm">
                                            <input type="hidden" min="1" name="qty" id="quantity_wanted" class="text form-control" value="1">
                                            <input type="hidden" name="produk_kode" value="<?= $prod['produk_kode'];?>">

                                            <?php if(isset($_SESSION['logged_in_user'])) { ?>
                                                <button class="ajax_add_to_cart_button button btn" title="Add to cart">
                                                    <i class="zmdi zmdi-shopping-cart"></i>
                                                </button>
                                            <?php } else { } ?>

                                            <a class="button btn quick-view" href="#" data-toggle="modal" data-target="#modal_box<?= $prod['produk_kode']; ?>" title="Quick view">
                                                <i class="zmdi zmdi-eye"></i>
                                            </a>
                                        </form>
                                    </div>
                                </div><!--end left block -->
                            </div>
                            <div class="col-lg-8 col-md-8">
                                <div class="right-block">
                                    <div class="product-box">
                                        <h5 class="name">
                                            <a class="product-name" href="<?= base_url().'produk/detail/'.$prod['produk_kode'];?>" title="<?= $prod['produk_nama']; ?>">
                                                <?= $prod['produk_nama']; ?>
                                            </a>
                                        </h5>
                                        <div class="product-des">
                                            <?php 
                                            $long_string = $prod['produk_ket'];
                                            $limited_string = limit_words($long_string, 24);
                                            echo $limited_string;
                                            ?>
                                        </div>
                                        <div class="content_price">
                                            <?php if($promo->row_array() > 0 ) {?>
                                                <span class="price product-price"><?= "Rp. ".number_format($newprc); ?></span>
                                                <span class="old-price product-price"><?= "Rp. ".number_format($prod['produk_harga']); ?></span>
                                            <?php } else { ?>
                                                <span class="new_price"> <?= "Rp. ".number_format($prod['produk_harga']); ?> </span>
                                            <?php } ?>
                                        </div>
                                    </div><!--end product-box -->
                                </div><!-- end right block -->
                            </div>
                        </div>
                    </div><!-- end product-container-->
                </div><!-- end type_block_product -->
            <?php endforeach; ?>

        </div><!-- end row -->
    </div><!-- end tiva-list -->
</div>
</div><!-- end center_column -->
</div>
</div> <!-- end container -->
</div><!--end columns-->
