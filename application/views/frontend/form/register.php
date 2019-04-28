<div id="breadcrumb" class="clearfix">
    <div class="container">
        <div class="breadcrumb clearfix">
            <ul class="ul-breadcrumb">
                <li><a href="<?= base_url()?>" title="Home">Home</a></li>
                <li><span>Register</span></li>
            </ul>
            <h2 class="bread-title">Register</h2>
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

        <div class="row">
            <div class="col-xs-12 col-sm-8 col-sm-offset-2 col-md-6 col-md-offset-3">
                <form action="<?= base_url();?>login/register" method="post" id="form-account-creation" class="form-horizontal box panel panel-default">
                    <h3 class="panel-heading">Create an account</h3>
                    <div class="form_content panel-body clearfix">
                        <div class="form-group required">
                            <div class="col-lg-12">
                                <label for="Username">Username <sup>*</sup></label>
                                <input type="text" class="form-control" id="Username" name="username">
                            </div>
                        </div>

                        <div class="form-group required">
                            <div class="col-lg-12">
                                <label for="password">Password <sup>*</sup></label>
                                <input type="password" class="form-control" id="passwd" name="password">
                            </div>
                        </div>

                        <div class="form-group required">
                            <div class="col-lg-12">
                                <label for="Re-Password">Re-Password <sup>*</sup></label>
                                <input type="password" class="form-control" id="Re-Password" name="repassword">
                            </div>
                        </div>

                        <div class="form-group required">
                            <div class="col-lg-12">
                                <label for="email">Email address <sup>*</sup></label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>
                        </div>

                        <div class="form-group required">
                            <div class="col-lg-12">
                                <label for="nama">Nama <sup>*</sup></label>
                                <input type="text" class="form-control" id="nama" name="nama">
                            </div>
                        </div>
                        
                        <div class="form-group required">
                            <div class="col-lg-12">
                                <label for="tel">Telepon <sup>*</sup></label>
                                <input type="tel" class="form-control" id="tel" name="tel">
                            </div>
                        </div>
                        
                        <div class="form-group required">
                            <div class="col-lg-12">
                                <label for="jk">Jenis Kelamin <sup>*</sup></label>
                                <select name="jk" class="form-control">
                                    <option value="L">Laki - Laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                        </div>

                        
                        <div class="form-group required">
                            <div class="col-lg-12">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" class="form-control"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-lg-12">
                                <button class="btn button btn-default" type="submit">Register</button>
                            </div>
                        </div>
                    </div>
                </form><!--end form -->
            </div>
        </div>
    </div> <!-- end container -->
</div><!--end columns -->
