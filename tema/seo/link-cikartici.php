<div class="row sorgulama">
	<div class="col-md-2"></div>
				<div class="col-md-8 text-center">
					<div class="row ">
						<h1><strong>Link Çıkartıcı</strong></h1>
						<p class="col-md-offset-2 col-md-8">Sitenizde Bulunan Tüm Linkleri Çıkartan Sistem</p>
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
	<h4>Site Link Çıkartıcı</h4>
	<div class="row box-header">
	<h3><?php echo p("site"); ?> - Online</h3>
	</div>
	<?php
				## Curl Bağlantı ##
				$url = p("tur").p("site");
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

				//$htmlKod2 = curl_exec($ch);

				$cinfo = curl_getinfo($ch); 
				curl_close($ch);
				
				$htmlKod2 = _CurlBaglan(p("tur").p("site"));
				
				## İç Linkler ##
				$kl2 = 0;
				$doc = new DOMDocument(); 
				$doc->loadHTML($htmlKod2); 
				$xml = simplexml_import_dom($doc); 
				$images = $xml->xpath('//a'); 
				$s = 0;
				$e = 0;	
				foreach ($images as $img) { 
					if (substr($img['href'],0,7) == "http://" || substr($img['href'],0,7) == "https://"){
					
					} else { 
						if(!empty($img['href'])){
							$kl2++; 
						} 
					}
				}
				if ($kl2 != 0){	
					$siteIcLınk = 'Sitede bulunan dış linkler.';
					$siteIcLınkDurum = '<span class="label label-info"><i class="fa fa-info "> Bilgi</i></span>';
					$siteIcLınkDurum2 = 'bg-info';
					$prog = $prog + 6;	
				} else {
					$siteIcLınk = 'Sitede hiç dış link bulunmamaktadır.<br/><br/>';
					$siteIcLınkDurum = '<span class="label label-info"><i class="fa fa-info "> Bilgi</i></span>';
					$siteIcLınkDurum2 = 'bg-info';
					$prog = $prog;	
				}
				
				## Dış Linkler ##
				$kl = 0;
				$doc = new DOMDocument(); 
				$doc->loadHTML($htmlKod2); 
				$xml = simplexml_import_dom($doc); 
				$images = $xml->xpath('//a'); 
				$s = 0;
				$e = 0;	
				foreach ($images as $img) { 
					if (substr($img['href'],0,7) == "http://" || substr($img['href'],0,7) == "https://"){
					
					} else { 
						if(!empty($img['href'])){
							$kl++; 
						}
					}
				}
				if ($kl != 0){	
					$siteDısLınk = 'Sitede bulunan iç linkler.';
					$siteDısLınkDurum = '<span class="label label-info"><i class="fa fa-info "> Bilgi</i></span>';
					$siteDısLınkDurum2 = 'bg-info';
					$prog = $prog + 6;	
				} else {
					$siteDısLınk = 'Sitede hiç iç link bulunmamaktadır.<br/><br/>';
					$siteDısLınkDurum = '<span class="label label-info"><i class="fa fa-info "> Bilgi</i></span>';
					$siteDısLınkDurum2 = 'bg-info';
					$prog = $prog;	
				}
		?>
	
		<table class="table table-hover">
			<tbody>
				<tr class="<?php echo $siteDısLınkDurum2; ?>">
								<td>İç Linkler</td>
								<td>
									<?php echo $siteDısLınk; ?> 
									<?php  
										echo "<br/>";
										$doc = new DOMDocument(); 
										$doc->loadHTML($htmlKod2); 
										$xml = simplexml_import_dom($doc); 
										$images = $xml->xpath('//a'); 
										$s = 0;
										$e = 0;	
										echo "<pre>";
										foreach ($images as $img) { 
											if (substr($img['href'],0,7) == "http://" || substr($img['href'],0,7) == "https://"){
												if (strpos($img['href'], $tur.$site)){
													
												} else {
													if(!empty($img['href'])){
														echo "<span style='font-size:12px'>■ ".$img['href']."</span><br/>"; 
													}
												}	
											}
										}
										echo "</pre>";
									?>
								</td>
								<td><?php echo $siteDısLınkDurum; ?></td>
							</tr>	
							<tr class="<?php echo $siteIcLınkDurum2; ?>">
								<td>Dış Linkler</td>
								<td>
									<?php echo $siteIcLınk; ?> 
									<?php  
										echo "<br/>";
										$doc = new DOMDocument(); 
										$doc->loadHTML($htmlKod2); 
										$xml = simplexml_import_dom($doc); 
										$images = $xml->xpath('//a'); 
										$s = 0;
										$e = 0;	
										echo "<pre>";
										foreach ($images as $img) { 
											if (substr($img['href'],0,7) == "http://" || substr($img['href'],0,7) == "https://"){
												
											} else { 
												if(!empty($img['href'])){
													echo "<span style='font-size:12px'>■ ".$img['href']."</span><br/>"; 
												}												
											}
										}
										echo "</pre>";
									?>
								</td>
								<td><?php echo $siteIcLınkDurum; ?></td>
							</tr>
							<tr>
								<td colspan="3" style="background-color: #FFF;"></td>
							</tr>
							
						</tbody>
					</table>
</div>
<?php } ?>
<?php } ?>

