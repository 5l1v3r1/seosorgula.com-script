<div class="row sorgulama">
	<div class="col-md-2"></div>
				<div class="col-md-8 text-center">
					<div class="row ">
						<h1><strong>Meta Tag Gösterici</strong></h1>
						<p class="col-md-offset-2 col-md-8">Sitenizi Meta Tag Gösterici İle Sorgulayabileceğiniz Sistem</p>
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
	<h4>Site Meta Tag Gösterici</h4>
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
				$htmlKod2 = "";
				$htmlKod2 = _CurlBaglan(p("tur").p("site"));

				## Site Title ##
				$title_get = explode("<title>",$htmlKod2);
				$title_get = explode("</title>",$title_get[1]);
				$siteBaslik = $title_get[0];
				if(strlen($siteBaslik) > 70 || strlen($siteBaslik) == 0){
					$siteBaslikDurum = '<span class="label label-info"><i class="fa fa-times"> Kötü</i></span>';
					$siteBaslikDurum2 = 'bg-info';
				}else{
					$siteBaslikDurum = '<span class="label label-info"><i class="fa fa-check"> İyi</i></span>';
					$siteBaslikDurum2 = 'bg-info';
				}
				
				## Site Açıklama ##
				$description = explode('name="description"',$htmlKod2);
				$description = explode('>',$description[1]);
				$dparca = $description[0];
				$dparca = str_replace('content="',"",$dparca);
				$dparca = str_replace('"',"",$dparca);
				$dparca = str_replace('itemprop="description"',"",$dparca);
				$dparca = str_replace('itemprop=description ',"",$dparca);
				$dparca = str_replace('/',"",$dparca);
				
				if (strlen($dparca) <= 160){
					$siteAciklamaDurum = '<span class="label label-info"><i class="fa fa-check"> İyi</i></span>';
					$siteAciklamaDurum2 = 'bg-info';
					$prog = $prog + 6;	
				} else {
					$siteAciklamaDurum = '<span class="label label-info"><i class="fa fa-times"> Kötü</i></span>';
					$siteAciklamaDurum2 = 'bg-info';
					$prog = $prog;	
				}
				
				## Site Keywords ##
				$keywords = explode('name="keywords"',$htmlKod2);
				$keywords = explode('>',$keywords[1]);
				$kparca = $keywords[0];
				$kparca = str_replace('content="',"",$kparca);
				$kparca = str_replace('"',"",$kparca);
				$kparca = str_replace('itemprop="keywords"',"",$kparca);
				$kparca = str_replace('itemprop=keywords ',"",$kparca);
				$kparca = str_replace('/',"",$kparca);
				if (strlen($kparca) <= 260){
					$siteKelimeAnahtariDurum = '<span class="label label-info"><i class="fa fa-check"> İyi</i></span>';
					$siteKelimeAnahtariDurum2 = 'bg-info';
				}else{
					$siteKelimeAnahtariDurum = '<span class="label label-info"><i class="fa fa-times"> Kötü</i></span>';
					$siteKelimeAnahtariDurum2 = 'bg-info';
				}
		?>
	
	<table class="table table-hover">
						<tbody>
							<tr style="background-color: #F3F4F5;">
								<th><b>Meta Etiketleri</b></th>
								<th></th>
								<th></th>
							</tr>
							<tr class="<?php echo $siteBaslikDurum2; ?>">
								<td>Site Başlığı (Title)</td>
								<td><?php echo $siteBaslik; ?></td>
								<th></th>
							</tr>
							<tr class="<?php echo $siteAciklamaDurum2; ?>">
								<td>Site Açıklama (Description)</td>
								<td><?php echo $dparca; ?></td>
								<th></th>
							</tr>
							<tr class="<?php echo $siteKelimeAnahtariDurum2; ?>">
								<td>Anahtar Kelimeler (Keywords)</td>
								<td><?php echo $kparca; ?></td>
								<th></th>
							</tr>
							<tr>
								<td colspan="3" style="background-color: #FFF;"></td>
							</tr>
							
						</tbody>
					</table>
</div>
<?php } ?>
<?php } ?>
