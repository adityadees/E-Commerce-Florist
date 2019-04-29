<div class="tiva-slideshow-wrapper">
  <div id="tiva-slideshow" class="nivoSlider">
    <?php $no=0; 
    foreach ($slider as $slide) : $no++;?>
      <a href="#" title="Slideshow image">
        <img class="img-responsive" src="<?= base_url()?>assets/images/slider/<?= $slide['slider_gambar']; ?>" title="#caption<?= $no; ?>" alt="Slideshow image">
      </a>
    <?php endforeach; ?>
  </div>

  <?php $no=0; 
  foreach ($slider as $slide) : $no++;?>
    <div id="caption<?= $no; ?>" class="nivo-html-caption">
      <div class="tiva-caption">
        <div class="left-right hidden-xs normal very_large_60"><?= $slide['slider_judul']; ?></div>
        <div class="left-right  hidden-md hidden-sm hidden-xs slow medium_16">
          <?= $slide['slider_ket']; ?>
        </div>
      </div>
    </div>
  <?php endforeach; ?>
</div>

<div id="columns" class="columns-container">
  <div class="section section-tabsproduct">
    <div class="container">
      <!-- tabs-top -->
      <div class="tabs-top block">
        <div class="block-title">
          <h4 class="title_block">Shop By Collection</h4>
          <!-- Nav tabs -->
          <ul id="myTabs" class="nav nav-tabs" role="tablist">
           <?php 
           $no=0;
           foreach ($kategori as $i) : 
            $no++;
            ?>
            <li role="presentation" class="<?php if($no==1) { echo 'active';} else {}?>"><a href="#kat<?= $i['kategori_id']; ?>" aria-controls="<?= $i['kategori_nama']; ?>" role="tab" data-toggle="tab"><?= $i['kategori_nama']; ?></a></li>
          <?php endforeach; ?>

        </ul>
      </div><!--end title -->

      <!-- Tab panes -->


      <div class="tab-content">
        <?php  $no=0;   foreach ($kategori as $i) :  $no++;  ?>
        <div role="tabpanel" class="tab-pane <?php if($no==1) { echo 'active';} else {}?>" id="kat<?= $i['kategori_id']; ?>">
          <div class="block_content">
            <div class="row">


             <?php 
             $tgl=date("Y-m-d h:i:s");
             $where = [
              'kategori_id'=>$i['kategori_id'],
            ];
            $get_subkat=$this->db->get_where('sub_kategori',$where)->result_array();

            foreach ($get_subkat as $gsubkat) :
              ?>
              <?php 
              $where = [
                'sk_id'=>$gsubkat['sk_id'],
              ];
              $get_prod=$this->db->get_where('produk',$where)->result_array();
              $gkdlmt = 0;
              foreach ($get_prod as $gprod) :
                $gkdlmt++;
                $jtable=[
                  'promo' => 'produk_kode',
                  'produk' => 'produk_kode'
                ];
                $where=[
                  't1.promo_start <='=>$tgl,
                  't1.promo_end >'=>$tgl,
                  't2.produk_kode'=>$gprod['produk_kode'],
                ];
                $promo = $this->Mymod->GetDataJoin($jtable,$where);
                $gprom = $promo->row_array();
                $newprc=($gprom['produk_harga']-(($gprom['produk_harga']*$gprom['promo_diskon'])/100));

                if($gkdlmt<=8){
                  ?>

                  <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6 col-sp-12">
                    <div class="product-container">
                      <div class="left-block">
                        <div class="product-image-container">
                          <a class="product_img_link" href="<?= base_url();?>produk/detail/<?= $gprod['produk_kode']; ?>" title="<?= $gprod['produk_nama']; ?>">
                            <img src="<?= base_url().'assets/images/product/'.$gprod['produk_gambar'];?>" alt="<?= $gprod['produk_nama']; ?>" class="img-responsive" width="480" height="640">
                          </a>
                          <?php if($promo->row_array() > 0 ) {?>

                            <span class="label-reduction label">- <?= $gprom['promo_diskon']."%"; ?></span>
                          <?php } else {} ?>
                        </div>
                        <div class="box-buttons">
                          <form action="<?= base_url();?>frontendc/addtocart" method="POST" name="cartForm">
                            <input type="hidden" min="1" name="qty" id="quantity_wanted" class="text form-control" value="1">
                            <input type="hidden" name="produk_kode" value="<?= $gprod['produk_kode'];?>">

                            <?php if(isset($_SESSION['logged_in_user'])) { ?>
                              <button class="ajax_add_to_cart_button button btn" title="Add to cart">
                                <i class="zmdi zmdi-shopping-cart"></i>
                              </button>
                            <?php } else { } ?>

                            <a class="button btn quick-view" href="#" data-toggle="modal" data-target="#modal_box<?= $gprod['produk_kode']; ?>" title="Quick view">
                              <i class="zmdi zmdi-eye"></i>
                            </a>
                          </form>
                        </div>
                      </div><!--end left block -->
                      <div class="right-block">
                        <div class="product-box">
                          <h5 class="name">
                            <a class="product-name" href="<?= base_url();?>produk/detail/<?= $gprod['produk_kode']; ?>" title="<?= $gprod['produk_nama']; ?>">
                             <?php 
                             $long_string = $gprod['produk_nama'];
                             $limited_string = limit_words($long_string, 4);
                             echo $limited_string;
                             ?>
                           </a>
                         </h5>
                         <div class="content_price">
                           <?php if($promo->row_array() > 0 ) {?>

                            <span class="price product-price"><?= "Rp. ".number_format($newprc); ?></span>
                            <span class="old-price product-price"><?= "Rp. ".number_format($gprod['produk_harga']); ?></span>
                          <?php } else { ?>

                            <span class="new_price"> <?= "Rp. ".number_format($gprod['produk_harga']); ?> </span>

                          <?php } ?>
                        </div>
                      </div><!-- end product-box -->
                    </div><!--end right block -->
                  </div><!-- end product-container-->
                </div>

              <?php } endforeach; ?>
            <?php endforeach; ?>


          </div><!-- end row -->
        </div><!-- end block_content -->
      </div>
    <?php endforeach; ?>

  </div>


</div><!-- end tabs-top -->
</div><!-- end container -->
</div><!-- end section-tabsproduct -->


<div class="section section-testimoniol">
  <div class="container">
    <div class="testimoniol-slider">
      <div class="testimoniol-items">
        <div class="item">
          <img class="img-responsive" src="<?= base_url();?>assets/images/testimonial/andrewa.jpg" alt="" width="100px" height="100px">
          <p>
            Layanan bagus dan respons cepat 👍👍 (Asli) Good services and fast response 👍👍
          </p>
          <a href="#" title="">Andrew A</a><br>
        </div>
      </div>
    </div><!-- end testimoniol-slider -->
  </div><!-- end container -->
</div><!--end section-testimoniol-->


<div class="section section-bestsellers">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="tiva-prolist">
          <h4 class="title_block">Best sellers</h4>
          <div class="block_content">
            <div class="bestsellers-owlcaousel owl-carousel">
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
                <div class="item">
                  <div class="product-container">
                    <div class="left-block">
                      <div class="product-image-container">
                        <a class="product_img_link" href="<?= base_url();?>produk/detail/<?= $gc['produk_kode']; ?>" title="<?= $gc['produk_nama'];?>">
                          <img src="<?= base_url();?>assets/images/product/<?= $gc['produk_gambar']; ?>" alt="<?= $gc['produk_nama'];?>" class="img-responsive" width="480" height="640">
                        </a>
                        <?php if($promo->row_array() > 0 ) {?>
                          <span class="label-reduction label"><?= $gprom['promo_diskon']."% -"; ?></span>
                        <?php } else {} ?>
                      </div>
                      <div class="box-buttons">
                        <form action="<?= base_url();?>frontendc/addtocart" method="POST" name="cartForm">
                          <input type="hidden" min="1" name="qty" id="quantity_wanted" class="text form-control" value="1">
                          <input type="hidden" name="produk_kode" value="<?= $gc['produk_kode'];?>">

                          <?php if(isset($_SESSION['logged_in_user'])) { ?>
                            <button class="ajax_add_to_cart_button button btn" title="Add to cart">
                              <i class="zmdi zmdi-shopping-cart"></i>
                            </button>
                          <?php } else { } ?>

                          <a class="button btn quick-view" href="#" data-toggle="modal" data-target="#modal_box<?= $gc['produk_kode']; ?>" title="Quick view">
                            <i class="zmdi zmdi-eye"></i>
                          </a>
                        </form>
                      </div>
                    </div><!--end left block -->
                    <div class="right-block">
                      <div class="product-box">
                        <h5 class="name">
                          <a class="product-name" href="<?= base_url();?>produk/detail/<?= $gc['produk_kode']; ?>" title="<?= $gc['produk_nama'];?>">
                            <?= $gc['produk_nama'];?>
                          </a>
                        </h5>
                        <div class="content_price">
                          <?php if($promo->row_array() > 0 ) {?>
                            <span class="price product-price"><?= "Rp. ".number_format($newprc); ?> </span>
                            <span class="old-price product-price"> <?= "Rp. ".number_format($gc['produk_harga']); ?> </span>
                          <?php } else { ?>
                            <span class="price product-price"><?= "Rp. ".number_format($gc['produk_harga']); ?> </span>
                          <?php } ?>
                        </div>
                      </div><!-- end product-box -->
                    </div><!--end right block -->
                  </div><!-- end product-container-->
                </div>
              <?php endforeach; ?>

            </div><!-- end bestsellers-owlcaousel -->
          </div><!-- end bock_content -->
        </div><!-- end tiva-prolist -->
      </div>
      <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="banner-item effect">
          <a class="image-wrap" href="#" title=""><img class="img-responsive" src="<?= base_url();?>assets/images/banner/thumblogo.jpg" alt=""></a>
        </div>
      </div>
    </div><!-- end row -->
  </div><!-- end container -->
</div><!-- end section-bestsellers -->

<section class="section section-gallery" style="background: #fafafa">
  <div class="container">
    <div class="block-gallery block">
      <h4 class="title_block">Gallery</h4>
      <!-- <p class="des-text">desc</p> -->
      <div class="block_content">
        <div class="row no-gutters">
          <?php foreach($ig as $da) :
//print_r($da['images']['thumbnail']['url']);
           ?>
           <div class="image-item col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-4">
            <a href="<?= $da['images']['standard_resolution']['url'] ?>"><img class="img-responsive" src="<?= $da['images']['thumbnail']['url'] ?>" alt="" width="600px" height="600px"></a>
          </div>
        <?php endforeach; ?>
          <!-- 
          <div class="image-item col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-4">
            <a href="<?= base_url();?>assets/images/gallery/img2.jpg"><img class="img-responsive" src="<?= base_url();?>assets/images/gallery/img2.jpg" alt="" width="600px" height="600px"></a>
          </div>
          <div class="image-item col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-4">
            <a href="<?= base_url();?>assets/images/gallery/img3.jpg"><img class="img-responsive" src="<?= base_url();?>assets/images/gallery/img3.jpg" alt="" width="600px" height="600px"></a>
          </div>
          <div class="image-item col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-4">
            <a href="<?= base_url();?>assets/images/gallery/img4.jpg"><img class="img-responsive" src="<?= base_url();?>assets/images/gallery/img4.jpg" alt="" width="600px" height="600px"></a>
          </div>
          <div class="image-item col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-4">
            <a href="<?= base_url();?>assets/images/gallery/img5.jpg"><img class="img-responsive" src="<?= base_url();?>assets/images/gallery/img5.jpg" alt="" width="600px" height="600px"></a>
          </div>
          <div class="image-item col-lg-2 col-md-2 col-sm-2 col-xs-2 col-sp-4">
            <a href="<?= base_url();?>assets/images/gallery/img6.jpg"><img class="img-responsive" src="<?= base_url();?>assets/images/gallery/img6.jpg" alt="" width="600px" height="600px"></a>
          </div> -->
        </div>
      </div>
    </div><!-- end block-gallery -->
  </div><!-- end container -->
</section><!-- end section-gallery -->


</div><!--end columns -->

