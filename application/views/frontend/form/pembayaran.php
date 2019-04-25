<div id="breadcrumb" class="clearfix">
    <div class="container">
        <div class="breadcrumb clearfix">
            <ul class="ul-breadcrumb">
                <li><a href="<?= base_url()?>" title="Home">Home</a></li>
                <li><span>Pembayaran</span></li>
            </ul>
            <h2 class="bread-title">Pembayaran</h2>
        </div>
    </div>
</div><!-- end breadcrumb -->


<div id="columns" class="columns-container">
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
        
        <div class="contact-us">
            <div class="row">

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 text-center">
                    <div class="row">
                        <h2 class="title_block">Upload Bukti Transfer</h2>
                        <div class="col-md-6 col-md-offset-3">
                            <form action="<?= base_url();?>frontendc/upbukti" method="POST" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label>Invoice</label>
                                    <input type="text" name="pemesanan_kode" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Nama</label>
                                    <input type="text" name="pembayaran_nama" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Bukti Transfer</label>
                                    <input type="file" name="filefoto" class="form-control">
                                </div>
                                <input type="submit" name="" value="Submit" class="form-control btn btn-primary">
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div><!-- end contact-us -->
    </div><!-- end container -->
</div><!--end columns-->
<br>
<br>