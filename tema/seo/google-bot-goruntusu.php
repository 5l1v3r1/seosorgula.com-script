<div class="row sorgulama">
	<div class="col-md-2"></div>
				<div class="col-md-8 text-center">
					<div class="row ">
						<h1><strong>Google Bot Görüntüsü (Kaynak Kod)</strong></h1>
						<p class="col-md-offset-2 col-md-8">Sitenizin Google Botları Tafaından Nasıl Göründüğünü Gösteren Sistem.</p>
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
	<h4>Google Bot Görüntüsü (Kaynak Kod)</h4>
	<div class="row box-header">
	<h3><?php echo ucwords(strtolower(p("site"))); ?> - Online</h3>
	</div>
	<?php
		/*$url = p("tur").p("site");
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_USERAGENT, 'Googlebot/2.1 (http://www.googlebot.com/bot.html)');
		curl_setopt ($ch, CURLOPT_REFERER, "http://www.google.com/bot.html"); 
		curl_setopt($ch, CURLOPT_FAILONERROR, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_HEADER, true);
		curl_setopt($ch, CURLOPT_URL, "$url");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($ch, CURLOPT_TIMEOUT, 5);
		$site = curl_exec($ch);
		$cinfo = curl_getinfo($ch); 
		curl_close($ch);*/
		
			$site = _CurlBaglan(p("tur").p("site"));

		  echo '<pre>'.htmlspecialchars($site).'</pre>';


		?>
</div>
<?php } ?>
<?php } ?>

