 <footer id="footer">
  <div class="footer-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 col-sp-12">
          <div class="block-keep block">
            <h4 class="title_block">About us</h4>
            <div class="block_content">
              <p>Lorem Khaled Ipsum is a major key to success. To be successful you’ve got to work hard, to make history, simple, you’ve got to make it. You do know</p>
            </div>
          </div>
          <div class="social_block">
            <ul class="links">
              <li><a href="#"><em class="fa fa-facebook"></em><span class="unvisible">facebook</span> </a></li>
              <li><a href="#"><em class="fa fa-twitter"></em><span class="unvisible">twitter</span> </a></li>
              <li><a href="#"><em class="fa fa-google-plus"></em><span class="unvisible">google</span> </a></li>
              <li><a href="#"><em class="fa fa-linkedin"></em><span class="unvisible">linkedin</span> </a></li>
              <li><a href="#"><em class="fa fa-pinterest"></em><span class="unvisible">pinterest</span> </a></li>
              <li class="last"><a href="#"><em class="fa fa-instagram"></em><span class="unvisible">instagram</span> </a></li>
            </ul>
          </div><!-- end social_block -->
        </div>
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-sp-12">
          <div class="footer-block block">
            <h4 class="title_block">Services</h4>
            <ul class="toggle-footer list-group bullet">
              <li><a href="#" title="Our Policy">Our Policy</a></li>
              <li><a href="#" title="Gurantees">Gurantees</a></li>
              <li><a href="#" title="Terms & Conditions">Terms & Conditions</a></li>
              <li><a href="#" title="Shipping & Returns">Shipping & Returns</a></li>
              <li><a href="#" title="F.A.Qs">F.A.Qs</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-4 col-xs-12 col-sp-12">
          <div class="footer-block block">
            <h4 class="title_block">Account</h4>
            <ul class="toggle-footer list-group bullet">
              <li><a href="page-login.html" title="Login">Login</a></li>
              <li><a href="page-register.html" title="Register">Register</a></li>
              <li><a href="#" title="Wishlist">Wishlist</a></li>
              <li><a href="#" title="Order History">Order History</a></li>
              <li><a href="page-checkout.html" title="Checkout">Checkout</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-sp-12">
          <div class="block-html block">
            <h4 class="title_block">Opening time</h4>
            <div class="block_content">
              <p>Monday to Friday ....... 8 am - 10 pm</p>
              <p>Saturday & Sunday ....... 10 am - 9 pm</p>
              <p>Holiday is off</p>
            </div>
          </div><!-- end block-gallery -->
        </div>
      </div><!-- end row -->
    </div>
  </div><!-- end footer-center -->

  <div class="footer-copyright">
    <div class="container">
      <div class="row">
        <div class="text-center col-lg-12 col-md-12 col-sm-12 col-xs-12 col-sp-12">
          Copyright © 2019 Florist. All Right Reserved
        </div>
      </div>
    </div>
  </div><!-- end footer-copyright -->
</footer><!-- end footer -->



<div class="go-up">
  <a href="#"><i class="fa fa-chevron-up"></i></a>    
</div><!-- end go-up -->
</div> <!-- end all -->

<!-- Multi-color -->
<div id="multi-color" class="multi-color">
  <span class="handle" title="Style Settings"><i class="fa fa-sun-o"></i></span>

  <h4>Setting</h4>

  <p class="underline"><i class="fa fa-paint-brush"></i>Template color</p>
  <div class="group-handle multi-groupcolor">
    <span class="color color1" id="color1"></span>
    <span class="color color2" id="color2"></span>
    <span class="color color3" id="color3"></span>
    <span class="color color4" id="color4"></span>
    <span class="color color5" id="color5"></span>
  </div>

  <p class="underline"><i class="fa fa-toggle-on"></i>Fixed header</p>
  <div class="group-handle"> 
    <div class="btn-fixedheader">
      <span class="button yes" data-value="1">Yes</span> 
      <span class="button no active" data-value="0">No</span>
    </div>
  </div>

  <p class="view-demos"><i class="fa fa-hand-o-right"></i><a href="http://tivatheme.com/html/landing-page/byhands/" title="View Other Demos">View All Demos</a></p>
</div><!-- end multi-color -->



<?php if(isset($produk)){
  $tgl=date("Y-m-d h:i:s");
  foreach($produk as $i) :
    $jtable=[
      'promo' => 'produk_kode',
      'produk' => 'produk_kode'
    ];
    $where=[
      't1.promo_start <='=>$tgl,
      't1.promo_end >'=>$tgl,
      't2.produk_kode'=>$i['produk_kode'],
    ];
    $promo = $this->Mymod->GetDataJoin($jtable,$where);
    $gprom = $promo->row_array();
    $newprc=($gprom['produk_harga']-(($gprom['produk_harga']*$gprom['promo_diskon'])/100));
    ?> 

    <div class="modal fade" id="modal_box<?= $i['produk_kode']; ?>" tabindex="-1" role="dialog"  aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
          <div class="modal_body mt-10">
            <div class="content">
              <div class="row">
                <div class="col-md-12" style="margin-top: 50px;margin-bottom: 50px;">
                  <div class="pb-left-column col-xs-12 col-sm-12 col-md-5">
                    <div id="image-blocks" class="clearfix">
                      <div id="view_full_size">
                        <img src="<?= base_url().'assets/images/product/'.$i['produk_gambar'];?>" alt="The Cottage Bouquet" class="img-responsive" width="470" height="627">
                      </div>
                    </div>
                  </div>
                  <div class="pb-center-column col-xs-12 col-sm-12 col-md-7">
                    <div class="pb-centercolumn">
                      <h1><?= $i['produk_nama']; ?></h1>
                      <div class="price clearfix">

                        <?php 
                        if($promo->row_array() > 0 ) {?>
                          <p class="our_price_display">
                            <?= "Rp. ".number_format($newprc); ?>
                          </p>
                          <p class="old_price">
                            <?= "Rp. ".number_format($i['produk_harga']); ?>
                          </p>
                        <?php } else { ?>
                          <p class="our_price_display">
                            <?= "Rp. ".number_format($i['produk_harga']); ?>
                          </p>
                        <?php }?> 

                      </div><!-- end price -->
                      <div class="product-boxinfo">
                        <p id="availability_statut">
                          <label>Info : </label>
                          <?php if($promo->row_array() > 0 ) {?>
                            <span id="availability_value" class="label label-success">Diskon <?= $gprom['promo_diskon']."%"; ?></span>
                          <?php } else { ?>
                            <span id="availability_value" class="label label-danger">Tidak ada diskon</span>
                          <?php } ?>

                        </p>
                      </div><!-- end product-boxinfo -->
                      <div id="short_description_block">
                        <p>
                          <?php 
                          $long_string = $i['produk_ket'];
                          $limited_string = limit_words($long_string, 24);
                          echo $limited_string;
                          ?>
                        </p>
                      </div><!-- end short_description_block -->
                      <div class="box-info-product clearfix">
                        <div id="quantity_wanted_p">
                          <label>Quantity</label>
                          <div class="group-quantity">
                            <input type="number" min="1" name="qty" id="quantity_wanted" class="text form-control" value="1">
                          </div>
                        </div>
                      </div><!-- end box-info-product -->
                      <div class="box-cart-bottom clearfix">
                        <button id="add_to_cart" type="submit" name="Submit" class="exclusive btn button btn-primary" title="Add to cart">
                          Add to cart
                        </button>
                      </div><!-- end box-cart-bottom -->
                    </div><!-- end pb-centercolumn -->
                  </div><!-- end pb-center-column -->
                </div><!-- end row -->

              </div>
            </div>
          </div> 

          <div class="modal-footer">
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
          </div>   
        </div>
      </div>
    </div> 
  <?php endforeach; } else {}?>




  <!-- Vendor JS -->
  <script src="<?= base_url();?>assets/frontend/vendor/jquery/jquery.min.js"></script>
  <script src="<?= base_url();?>assets/frontend/vendor/owl.carousel/owl.carousel.min.js"></script>
  <script src="<?= base_url();?>assets/frontend/vendor/magnific-popup/jquery.magnific-popup.js"></script>
  <script src="<?= base_url();?>assets/frontend/vendor/bootstrap/js/bootstrap.min.js"></script>

  <script src="<?= base_url();?>assets/frontend/vendor/nivo-slider/js/jquery.nivo.slider.js"></script>

  <script src="<?= base_url();?>assets/frontend/vendor/slider-range/js/tmpl.js"></script>
  <script src="<?= base_url();?>assets/frontend/vendor/slider-range/js/jquery.dependClass-0.1.js"></script>
  <script src="<?= base_url();?>assets/frontend/vendor/slider-range/js/draggable-0.1.js"></script>
  <script src="<?= base_url();?>assets/frontend/vendor/slider-range/js/jquery.slider.js"></script>

  <!-- Template Base, Components and Settings -->
  <script src="<?= base_url();?>assets/frontend/js/theme.js"></script>

  <!-- Template Custom -->
  <script src="<?= base_url();?>assets/frontend/js/custom.js"></script>
  <script src="http://maps.google.com/maps/api/js?key=AIzaSyBd1UJcqm8K9sZ4p9xloWUHSzsFaovKxuM"></script>

  <script src="<?= base_url();?>assets/frontend/vendor/jquery.elevatezoom/jquery.elevatezoom.js"></script>

</body>
</html>
