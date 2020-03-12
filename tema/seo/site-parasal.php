<div class="row sorgulama">
	<div class="col-md-2"></div>
				<div class="col-md-8 text-center">
					<div class="row ">
						<h1><strong>Site Parasal Değeri</strong></h1>
						<p class="col-md-offset-2 col-md-8">Sitenizin Parasal Değerini Ölçebiceğiniz Sistem</p>
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<div class="col-md-12">
									<form method="POST">
										<div class="input-group input-group-lg">
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
	<h4>Site Parasal Değeri</h4>
	<div class="row box-header">
	<h3><?php echo ucwords(strtolower(p("site"))); ?> - Online</h3>
	</div>
	<?php
		
		
		$site = _CurlBaglan('http://www.1pagerank.com/'.p("site"));
		preg_match('#<h5>(.*?)</h5>#', $site, $para);
		$veri =  iconv('utf-8', 'UTF-8', $para[0]);
		
		echo "<pre><center>Sitenizin parasal degeri <strong>".$veri."</strong></center></pre>";
		
		?>

	
</div>
<?php } ?>
<?php } ?>

