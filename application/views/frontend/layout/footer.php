 <footer id="footer">
  <div class="footer-center">
    <div class="container">
      <div class="row">
        <div class="col-lg-5 col-md-5 col-sm-12 col-xs-12 col-sp-12">
          <div class="block-keep block">
            <h4 class="title_block">About us</h4>
            <div class="block_content">
              <p>
                Menyediakan flower box, bunga tangan, bunga wisuda, bunga untuk hadiah ulang tahun, bunga papan, dll
              </p>
              <ul class="toggle-footer list-group bullet">
                <li>
                  <img src="<?= base_url('assets/images/logo/linemessager.png')?>" width="15px" height="15px">
                  <a href="#" title="Our Policy">
                    enggakp99 / diannelviariza
                  </a>
                </li>
                <li>
                  <img src="<?= base_url('assets/images/logo/telefono.png')?>" width="15px" height="15px">
                  <a href="#" title="Our Policy">
                    081368246866 / 082175111777
                  </a>
                </li>
              </ul>
            </div>
          </div>
          <div class="social_block">
            <ul class="links">
              <li><a href="#"><em class="fa fa-facebook"></em><span class="unvisible">facebook</span> </a></li>
              <li><a href="#"><em class="fa fa-twitter"></em><span class="unvisible">twitter</span> </a></li>
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
              <li><a href="<?= base_url('Login')?>" title="Login">Login</a></li>
              <li><a href="<?= base_url('Register')?>" title="Register">Register</a></li>
              <li><a href="<?= base_url('contactus')?>" title="Register">Contact Us</a></li>
              <li><a href="<?= base_url('aboutus')?>" title="Register">About Us</a></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12 col-sp-12">
          <div class="block-html block">
            <h4 class="title_block">Opening time</h4>
            <div class="block_content">
              <p>Senin - Sabtu : 08.00 - 20.00</p>
              <p>Minggu : 09.00 - 17.00</p>
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
          Copyright © 2019 ORM Florist. All Right Reserved
        </div>
      </div>
    </div>
  </div><!-- end footer-copyright -->
</footer><!-- end footer -->



<div class="go-up">
  <a href="#"><i class="fa fa-chevron-up"></i></a>    
</div><!-- end go-up -->
</div> <!-- end all -->


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
                      <form action="<?= base_url();?>frontendc/addtocart" method="POST" name="cartForm">
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
                            <input type="hidden" name="produk_kode" value="<?= $i['produk_kode'];?>">
                            <button id="add_to_cart" type="submit" name="Submit" class="exclusive btn button btn-primary" title="Add to cart">
                              Add to cart
                            </button>
                          <?php } else { ?>
                            <button id="add_to_cart" type="submit" name="Submit" class="exclusive btn button btn-primary"  disabled="disabled"  title="Add to cart">Add to cart
                            </button>
                            <span class="text-danger">*Anda harus login terlebih dahulu</span>
                          <?php } ?>
                        </div><!-- end box-cart-bottom -->
                      </form>
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
