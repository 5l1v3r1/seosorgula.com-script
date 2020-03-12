<div class="row sorgulama">
	<div class="col-md-2"></div>
				<div class="col-md-8 text-center">
					<div class="row ">
						<h1><strong>Site Hız</strong></h1>
						<p class="col-md-offset-2 col-md-8">Sitenizin Hızını Sorgulayabileceğiniz Sistem</p>
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
	<h4>Site Hız Bilgileri</h4>
	<div class="row box-header">
	<h3><?php echo ucwords(strtolower(p("site"))); ?> - Online</h3>
	</div>
	<?php
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
		$site = curl_exec($ch);
		$cinfo = curl_getinfo($ch); 
		curl_close($ch);
		$zaman = number_format($cinfo['total_time'], 2, '.', '');
		function curl_get_file_size( $url ) {
		  // Assume failure.
		  $result = -1;

		  $curl = curl_init( $url );

		  // Issue a HEAD request and follow any redirects.
		  curl_setopt($curl, CURLOPT_USERAGENT, 'Googlebot/2.1 (http://www.googlebot.com/bot.html)');
		  curl_setopt($curl, CURLOPT_REFERER, "http://www.google.com/bot.html"); 
		  curl_setopt($curl, CURLOPT_FAILONERROR, true);
		  curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		  curl_setopt($curl, CURLOPT_NOBODY, true );
		  curl_setopt($curl, CURLOPT_HEADER, true );
		  curl_setopt($curl, CURLOPT_TIMEOUT, 5);
		  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true );
		  $data = curl_exec( $curl );
		  curl_close( $curl );

		  if( $data ) {
			$content_length = "unknown";
			$status = "unknown";

			if( preg_match( "/^HTTP\/1\.[01] (\d\d\d)/", $data, $matches ) ) {
			  $status = (int)$matches[1];
			}

			if( preg_match( "/Content-Length: (\d+)/", $data, $matches ) ) {
			  $content_length = (int)$matches[1];
			}

			// http://en.wikipedia.org/wiki/List_of_HTTP_status_codes
			if( $status == 200 || ($status > 300 && $status <= 308) ) {
			  $result = $content_length;
			}
		  }

		  return $result;
		}
		$aaa = curl_get_file_size($url);
		function bytes($a) {
			$unim = array("B","KB","MB","GB","TB","PB");
			$c = 0;
			while ($a>=1024) {
				$c++;
				$a = $a/1024;
			}
			return number_format($a,($c ? 2 : 0),",",".")." ".$unim[$c];
		}	
		if ($aaa != ""){
		$filesize = bytes($aaa);
		}


		?>
	
		


		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr>
			<td><strong>Content Type</strong></td>
			<td width="19%"><strong>İstek Boyutu</strong></td>
			<td width="16%"><strong>Toplam S&uuml;re</strong></td>
			<td width="14%"><strong>Arama S&uuml;resi</strong></td>
			<td width="9%"><strong>Hız</strong></td>
		  </tr>
		  <tr>
			<td><?php echo $cinfo['content_type']; ?></td>
			<td><?php echo $cinfo['header_size']; ?></td>
			<td><?php echo $cinfo['total_time']; ?></td>
			<td><?php echo $cinfo['namelookup_time']; ?></td>
			<td><?php echo $zaman; ?></td>
		  </tr>
		</table>
	
</div>
<?php } ?>
<?php } ?>

