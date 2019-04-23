<div id="breadcrumb" class="clearfix">
    <div class="container">
        <div class="breadcrumb clearfix">
            <ul class="ul-breadcrumb">
                <li><a href="<?= base_url()?>" title="Home">Home</a></li>
                <li><span>Login</span></li>
            </ul>
            <h2 class="bread-title">Login</h2>
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
            <div class="col-lg-6">
                <form action="#" id="create-account-form" class="form-horizontal box panel panel-default">
                    <h3 class="panel-heading">Create an account</h3>
                    <div class="form_content panel-body clearfix">
                        <p>Registration is quick and easy. It allows you to be able to order from our shop. To start shopping click register.</p>
                        <a href="<?= base_url('Register')?>" class="btn button btn-default" title="Create an account" rel="nofollow"><i class="fa fa-user left"></i> Create an account</a>
                    </div>
                </form><!--end form -->
            </div>
            <div class="col-lg-6">
                <form  action="<?= base_url();?>login/auth" method="post" id="form-login" class="form-horizontal box panel panel-default">
                    <h3 class="panel-heading">Already registered?</h3>
                    <div class="form_content panel-body clearfix">
                        <div class="form-group">
                            <div class="col-lg-12">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" id="username" name="username">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <label for="passwd">Password</label>
                                <input type="password" class="form-control" id="passwd" name="password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-lg-12">
                                <button class="btn button btn-default" type="submit"><i class="fa fa-lock left"></i> Sing in</button>
                            </div>
                        </div>
                    </div>
                </form><!--end form -->
            </div>
        </div>
    </div> <!-- end container -->
</div><!--end columns -->

