<div id="breadcrumb" class="clearfix">
  <div class="container">
    <div class="breadcrumb clearfix">
      <ul class="ul-breadcrumb">
        <li><a href="<?= base_url()?>" title="Home">Home</a></li>
        <li><span>shopping cart</span></li>
      </ul>
      <h2 class="bread-title">Shopping cart</h2>
    </div>
  </div>
</div><!-- end breadcrumb -->


<div id="columns" class="columns-container">
  <!-- container -->
  <form action="<?php echo base_url()?>frontendc/update_cart" method="POST">
    <div class="container">
      <div id="order-detail-content" class="table_block table-responsive">
        <table id="cart_summary" class="table table-bordered">
          <thead>
            <tr>
              <th class="cart_delete last_item">&nbsp;</th>
              <th class="cart_product first_item">Image</th>
              <th class="cart_description item">Product</th>
              <th class="cart_unit item text-right">Price</th>
              <th class="cart_quantity item text-center">Qty</th>
              <th class="cart_total item text-right">Bonus Qty</th>
              <th class="cart_total item text-right">Total</th>
            </tr>
          </thead>
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
              <td class="cart_delete text-center">
                <a title="Remove this item" class="remove" href="#" data-target="#delCart<?= $i['keranjang_id']; ?>" data-toggle="modal">
                  <i class="fa fa-times"></i>
                </a>
              </td>
              <td class="cart_product">
                <a href="<?= base_url('produk/detail/'.$i['produk_kode']) ?>">
                  <img width="80" height="107" alt="" class="img-responsive" src="<?php echo base_url();?>assets/images/product/<?= $i['produk_gambar'];?>">
                </a>
              </td>
              <td class="cart_description">
                <a href="<?= base_url('produk/detail/'.$i['produk_kode']) ?>"><?= $i['produk_nama']; ?></a>
              </td>
              <td class="cart_unit text-right">
                <span class="amount">
                  <?php
                  if($cek->num_rows()>0){ ?>
                   <span class="old_price">  <s><?= "Rp. ".number_format($i['produk_harga']);?></s>  </span><br>
                   <span class="new_price"><?= "Rp. ".number_format($newprc);?> </span>

                 <?php   } else { ?>
                   <span class="old_price"><?= "Rp. ".number_format($i['produk_harga']);?> </span><br>
                 <?php }?>
               </span>
             </td>
             <td class="cart_quantity text-center">                                     
              <div class="quantity">
                <input type="text" class="input-text qty text" min="1" max="100" title="Qty" value="<?= $i['keranjang_qty']; ?>" name="qtybutton">
              </div>
            </td>
            <td class="cart_total text-right">
              <span class="amount">  
                <?= floor($bonus);
                if($i['produk_up']=='yes'){ ?>

                  <sup title="Dapatkan bonus 1 produk setiap pembelian kelipatan 2">[*]</sup>

                <?php } ?>
              </span>
            </td>
            <td class="cart_total text-right">
              <span class="amount"><?= "Rp. ".number_format($ptotal); ?></span>
            </td>
          </tr>
        <?php endforeach; ?>

      </tbody>
      <tfoot>
        <tr>
          <td rowspan="3" colspan="4"></td>
          <td colspan="2" class="text-right">Total products</td>
          <td colspan="1" class="price text-right" id="total_product"><?= "Rp. ".number_format($total); ?></td>
        </tr>
        <tr class="cart_total_delivery">
          <td colspan="2" class="text-right">Total shipping</td>
          <td colspan="1" class="price text-right" id="total_shipping"><?php if($total<50000){ echo "Rp. ".number_format($ship);} else { echo "Rp. 0";} ?></td>
        </tr>
        <tr class="cart_total_price">
          <td colspan="2" class="total_price_container text-right">
            <span>Total</span>
            <div class="hookDisplayProductPriceBlock-price"></div>
          </td>
          <td colspan="1" class="price text-right" id="total_price_container">
            <span id="total_price"><?php if($total<50000){ echo "Rp. ".number_format($total+$ship); } else { echo "Rp. ".number_format($total); } ?></span>
          </td>
        </tr>
      </tfoot>
    </table>
  </div><!-- end order-detail-content -->
  <div class="cart_navigation">
    <div class="row">
      <div class="col-md-6">

        <div class="table_cart_button">
          <button type="submit" class="btn btn-success">update cart</button>
        </div> 
      </div>
      <div class="col-md-6">
        <a href="<?= base_url();?>checkout" class="button btn btn-primary standard-checkout pull-right" title="Proceed to checkout">
          <span>Proceed to checkout</span>
          <i class="fa fa-angle-right ml-xs"></i>
        </a>
      </div>
    </div>
  </div><!-- end cart_navigation -->
</div> <!-- end container -->
</form>

</div><!--end columns -->
<br>
<br>
<br>


<?php foreach($getCartData as $gcart): ?>
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
  <?php endforeach; ?>