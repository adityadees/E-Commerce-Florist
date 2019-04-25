<style type="text/css">
	.invoice-title h2, .invoice-title h3 {
		display: inline-block;
	}

	.table > tbody > tr > .no-line {
		border-top: none;
	}

	.table > thead > tr > .no-line {
		border-bottom: none;
	}

	.table > tbody > tr > .thick-line {
		border-top: 2px solid;
	}
</style>

<div id="breadcrumb" class="clearfix">
	<div class="container">
		<div class="breadcrumb clearfix">
			<ul class="ul-breadcrumb">
				<li><a href="<?= base_url()?>" title="Home">Home</a></li>
				<li><span>Invoice</span></li>
			</ul>
			<h2 class="bread-title">Invoice</h2>
		</div>
	</div>
</div><!-- end breadcrumb -->


<div id="columns" class="columns-container">
	<div class="container">
		<div class="content-body">
			<section class="card">
				<div id="invoice-template" class="card-body">
					<div id="invoice-company-details" class="row">
						<div class="col-md-6 col-sm-12 text-center text-md-left">
							<div class="media">
								<img src="<?php echo base_url();?>assets/images/logo/thumbnail.png" width="150px" height="150px" alt="company logo" class=""/>
								<div class="media-body">
									<ul class="ml-2 px-0 list-unstyled">
										<li class="text-bold-800">ORM FLORIST</li>
										<li>Jl. Suhada No.122, Lorok Pakjo, Ilir Bar. I, Kota Palembang, Sumatera Selatan 30137</li>
										<li>(+62) 813-6824-6866 / (+62) 821-7511-1777</li>
									</ul>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-12 text-center text-md-right">
							<h2>INVOICE</h2>
							<p class="pb-3">#<?= $data['pemesanan_kode']; ?></p>
							<ul class="px-0 list-unstyled">
								<li>Total Pembelian</li>
								<li class="lead text-bold-800">Rp. <?= number_format($data['pemesanan_total']);?></li>
							</ul>
						</div>
					</div>
					<!--/ Invoice Company Details -->
					<hr>
					<!-- Invoice Customer Details -->
					<div id="invoice-customer-details" class="row pt-2">
						<div class="col-md-6 col-sm-12 text-left text-md-left">
							<ul class="px-0 list-unstyled">
								<li class="bold"><b>Informasi Pengiriman</b></li>
								<li><?= $data['ps_nama'];?></li>
								<li><?= $data['ps_tel'];?></li>
								<li><?= $data['ps_email'];?></li>
								<li><?= $data['ps_alamat'];?></li>
							</ul>
						</div>
						<div class="col-md-6 col-sm-12 text-center text-md-right">
							<p><span class="text-muted">Tanggal Pemesanan :</span> <?= date('d/m/Y',strtotime($data['pemesanan_tanggal']));?></p>
							<p><span class="text-muted">Metode Pembayaran :</span> <?= ucfirst($data['pembayaran_method']);?></p>
						</div>
					</div>
					<!--/ Invoice Customer Details -->

					<!-- Invoice Items Details -->
					<div id="invoice-items-details" class="pt-2">
						<div class="row">
							<div class="table-responsive col-sm-12">
								<table class="table">
									<thead>
										<tr>
											<th>Kode</th>
											<th>Nama</th>
											<th>Harga</th>
											<th>Qty</th>
											<th>Bonus Qty </th>
											<th>Diskon</th>
											<th>Subtotal</th>
										</tr>
									</thead>
									<tbody>
										<?php
										$total=0;
										$ship=5000;
										$ptotal=0;
										$cid=0;

										$pemesanan_kode=$data['pemesanan_kode'];


										$jtable=[
											'pemesanan_detailp' => 'produk_kode',
											'produk' => 'produk_kode'
										];

										$where=[
											't1.pemesanan_kode'=>$pemesanan_kode,
										];

										$getdata = $this->Mymod->GetDataJoin($jtable,$where);

										foreach($getdata->result_array() as $gcart):
											$cid++;
											if($gcart['pdp_qty']>1 && $gcart['produk_up']=='yes'){
												$bonus=($gcart['pdp_qty']/2);

											}else {
												$bonus=0;
											}
											?>
											<tr>
												<th scope="row"><?= $gcart['produk_kode']; ?></th>
												<td><p><?= $gcart['produk_nama']; ?></p> </td>
												<td><?= "Rp. ".number_format($gcart['pdp_harga']); ?></td>
												<td><?= $gcart['pdp_qty']; ?></td>
												<td><?= $gcart['pdp_bonus']; ?></td>
												<td><?= $gcart['pdp_diskon']." %"; ?></td>
												<td><?= "Rp. ".number_format($gcart['pdp_subtotal']); ?></td>
											</tr>
										<?php endforeach; ?>

									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-md-7 col-sm-12 text-center text-md-left">
							</div>
							<div class="col-md-5 col-sm-12">
								<p class="lead">Total due</p>
								<div class="table-responsive">
									<table class="table">
										<tbody>
											<tr>
												<td>Sub Total</td>
												<td class="text-right"><?= "Rp. ".number_format($data['pemesanan_subtotal']); ?></td>
											</tr>
											<tr>
												<td>Ongkir</td>
												<td class="text-right"><?= "Rp. ".number_format($data['pemesanan_ongkir']); ?></td>
											</tr>
											<tr>
												<td class="text-bold-800">Total</td>
												<td class="text-bold-800 text-right"><?= "Rp. ".number_format($data['pemesanan_total']); ?></td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="text-center">
									<p>Authorized person</p>
									<img src="<?= base_url()?>assets/backend/images/pages/signature-scan.png" alt="signature" class="height-100"/>
									<h6>Engga</h6>
									<p class="text-muted">Owner</p>
								</div>
							</div>
						</div>
					</div>

					<div id="invoice-footer">
						<div class="row">
							<div class="col-md-7 col-sm-12">
								<h6>Terms & Condition</h6>
								<p>Barang yang sudah dibeli tidak dapat dikembalikan.</p>
							</div>
						</div>
					</div>

				</div>
			</section>
		</div>
	</div>
</div>
