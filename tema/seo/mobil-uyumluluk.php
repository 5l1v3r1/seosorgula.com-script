<div class="row sorgulama">
	<div class="col-md-2"></div>
				<div class="col-md-8 text-center">
					<div class="row ">
						<h1><strong>Site Mobil Uyumluluk</strong></h1>
						<p class="col-md-offset-2 col-md-8">Site Mobil Uyumluluk Sistemi</p>
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<div class="col-md-12">
									<form method="POST">
										<div class="input-group input-group-lg">
											<span class="input-group-addon" style="padding:0px;margin:0px;border:none;">
												<select name="tur" class="form-control" style="padding:0px;width:100px;height:46px;border-top-left-radius:5px;border-bottom-left-radius:5px;">
													<option selected="">http://</option>
													<option>https://</option>
												</select>
											</span>
											<input type="text" name="site" class="form-control" placeholder="seosorgula.com">
											<span class="input-group-btn">
												<input type="submit" class="btn btn-primary" name="sorgula" value="Sorgula" title="Sorgula">
											</span>
										</div>
									</form> 
								</div>
							</div>
						</div>
					</div>
				</div>
	<div class="col-md-2"></div>
</div>	
<?php if(isset($_POST["sorgula"])){ ?>
<?php if(p("site") == ""){
	echo '<div class="sonuclar container" style="text-align: center;"><br/><pre><strong class="text-center" style="color:darkred">Lütfen geçerli bir adres giriniz..</strong></pre></div>';
}else{ ?>
<div class="sonuclar container">
	<h4>Site Mobil Uyumluluk</h4>
	<div class="row box-header">
	<h3><?php echo ucwords(strtolower(p("site"))); ?> - Online</h3>
	</div>
	<div class="container">
		<ul class="nav nav-tabs">
		  <li class="active"><a href="#telefon" data-toggle="tab" aria-expanded="true">Telefon</a></li>
		  <li class=""><a href="#tablet" data-toggle="tab" aria-expanded="false">Tablet</a></li>
		</ul>
	</div>
	
	<div class="container-fluid">
		<div class="tab-content" id="tabs">
			<div class="tab-pane active" id="telefon"><iframe class="iframe-res" width="480" height="640" border="0" frameborder="0" allowtransparency="true" src="<?php echo p("tur").p("site"); ?>"></iframe></div>
			<div class="tab-pane" id="tablet"><iframe class="iframe-res w768" width="768" height="1024" border="0" frameborder="0" allowtransparency="true" src="<?php echo p("tur").p("site"); ?>"></iframe></div>
		</div>
	</div>
</div>
<?php } ?>
<?php } ?>

