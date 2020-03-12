<div class="row sorgulama">
	<div class="col-md-2"></div>
				<div class="col-md-8 text-center">
					<div class="row ">
						<h1><strong>Sıra Bulucu</strong></h1>
						<p class="col-md-offset-2 col-md-8">Google Sıra Bulucu. <br/> <span style="color:white; font-weight:700; font-size:14px">Sorgularınızda sitenin başında www olması sonuçlarda değişiklik gösterebilir.</span></p>
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
											<input type="text" name="site" class="form-control" placeholder="www.seosorgula.com">
											<input type="text" name="kelime" class="form-control" placeholder="seo sorgula">
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
	<h4>Sıra Bulucu</h4>
	<div class="row box-header">
	<h3><?php echo p("site"); ?> - Online</h3>
	</div>
	<?
	function file_get_contents_curl($url) { 
		$ch = curl_init(); 
		curl_setopt($ch, CURLOPT_HEADER, 0); 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url); 
		$data = curl_exec($ch); 
		curl_close($ch); 
		return $data; 
	} 

	$sonuclar = array();
	$tumu = array();
	$sirano = 0;
	$toplam = 0;
	$kac = 100;
	
	$url = p("site");
	$url2 = p("site");
    $url = "http://".$url;
	$url = str_replace("http://http://","http://",$url);	
	
	$url2 = "http://".$url2;
	$url2 = str_replace("http://http://","http://",$url2);	
	$kelime = p("kelime");
	$kelime = str_replace(" ", "+",$kelime);
	$kackarakter = strlen($url);
	$uri = str_replace("http://www.","",$url);

	if ($kac == 100){
		
		$url = 'https://www.google.com.tr/search?num=500&q='.$kelime; 
		$v = file_get_contents_curl($url); 
		preg_match_all('/class="r"><a href=(.*?)sa/si',$v,$r);
		foreach($r[1] as $tum){
			$tt = str_replace('"/url?q=','',$tum);
			$tt = str_replace('/&','',$tt);
			$tt = str_replace('amp;','',$tt);
			$tumu [] = $tt;
		}
		
	} else if ($kac == 200){
		
		$url = 'https://www.google.com.tr/search?num=500&q='.$kelime.''; 
		$v = file_get_contents_curl($url); 
		 preg_match_all('/class="r"><a href=(.*?)sa/si',$v,$r);
		foreach($r[1] as $tum){
			$tt = str_replace('"/url?q=','',$tum);
			$tt = str_replace('/&','',$tt);
			$tt = str_replace('amp;','',$tt);
			$tumu [] = $tt;
		}
		
		$url = 'https://www.google.com.tr/search?num=500&q='.$kelime.'&start=100'; 
		$v = file_get_contents_curl($url); 
		 preg_match_all('/class="r"><a href=(.*?)sa/si',$v,$r);
		foreach($r[1] as $tum){
			$tt = str_replace('"/url?q=','',$tum);
			$tt = str_replace('/&','',$tt);
			$tt = str_replace('amp;','',$tt);
			$tumu [] = $tt;
		}
		
	} else if ($kac == 300){
		
		$url = 'https://www.google.com.tr/search?num=500&q='.$kelime.''; 
		$v = file_get_contents_curl($url); 
		preg_match_all('/class="r"><a href=(.*?)sa/si',$v,$r);
		foreach($r[1] as $tum){
			$tt = str_replace('"/url?q=','',$tum);
			$tt = str_replace('/&','',$tt);
			$tt = str_replace('amp;','',$tt);
		
			$tumu [] = $tt;
			
		}
		
		$url = 'https://www.google.com.tr/search?num=500&q='.$kelime.'&start=100'; 
		$v = file_get_contents_curl($url); 
		preg_match_all('/class="r"><a href=(.*?)sa/si',$v,$r);
		foreach($r[1] as $tum){
			$tt = str_replace('"/url?q=','',$tum);
			$tt = str_replace('/&','',$tt);
			$tt = str_replace('amp;','',$tt);
		
			$tumu [] = $tt;
		}
		
		$url = 'https://www.google.com.tr/search?num=500&q='.$kelime.'&start=200'; 
		$v = file_get_contents_curl($url); 
		preg_match_all('/class="r"><a href=(.*?)sa/si',$v,$r);
		foreach($r[1] as $tum){
			$tt = str_replace('"/url?q=','',$tum);
			$tt = str_replace('/&','',$tt);
			$tt = str_replace('amp;','',$tt);
		
			$tumu [] = $tt;
			
		}
	} else if ($kac == 400){
		
		$url = 'https://www.google.com.tr/search?num=500&q='.$kelime.''; 
		$v = file_get_contents_curl($url); 
		 preg_match_all('/class="r"><a href=(.*?)sa/si',$v,$r);
		foreach($r[1] as $tum){
			$tt = str_replace('"/url?q=','',$tum);
			$tt = str_replace('/&','',$tt);
			$tt = str_replace('amp;','',$tt);
			$tumu [] = $tt;
		}
		
		$url = 'https://www.google.com.tr/search?num=500&q='.$kelime.'&start=100'; 
		$v = file_get_contents_curl($url); 
		 preg_match_all('/class="r"><a href=(.*?)sa/si',$v,$r);
		foreach($r[1] as $tum){
			$tt = str_replace('"/url?q=','',$tum);
			$tt = str_replace('/&','',$tt);
			$tt = str_replace('amp;','',$tt);
			$tumu [] = $tt;
		}
		
		$url = 'https://www.google.com.tr/search?num=500&q='.$kelime.'&start=200'; 
		$v = file_get_contents_curl($url); 
		 preg_match_all('/class="r"><a href=(.*?)sa/si',$v,$r);
		foreach($r[1] as $tum){
			$tt = str_replace('"/url?q=','',$tum);
			$tt = str_replace('/&','',$tt);
			$tt = str_replace('amp;','',$tt);
			$tumu [] = $tt;
		}
		
		$url = 'https://www.google.com.tr/search?num=500&q='.$kelime.'&start=300'; 
		$v = file_get_contents_curl($url); 
		 preg_match_all('/class="r"><a href=(.*?)sa/si',$v,$r);
		foreach($r[1] as $tum){
			$tt = str_replace('"/url?q=','',$tum);
			$tt = str_replace('/&','',$tt);
			$tt = str_replace('amp;','',$tt);
			$tumu [] = $tt;
		}	
	} else if ($kac == 500){
		
		$url = 'https://www.google.com.tr/search?num=500&q='.$kelime.''; 
		 preg_match_all('/class="r"><a href=(.*?)sa/si',$v,$r);
		foreach($r[1] as $tum){
			$tt = str_replace('"/url?q=','',$tum);
			$tt = str_replace('/&','',$tt);
			$tt = str_replace('amp;','',$tt);
			$tumu [] = $tt;
		}
		
		$url = 'https://www.google.com.tr/search?num=500&q='.$kelime.'&start=100'; 
		$v = file_get_contents_curl($url); 
		preg_match_all('/class="r"><a href=(.*?)sa/si',$v,$r);
		foreach($r[1] as $tum){
			$tt = str_replace('"/url?q=','',$tum);
			$tt = str_replace('/&','',$tt);
			$tt = str_replace('amp;','',$tt);
			$tumu [] = $tt;
		}
		
		$url = 'https://www.google.com.tr/search?num=500&q='.$kelime.'&start=200'; 
		$v = file_get_contents_curl($url); 
		preg_match_all('/class="r"><a href=(.*?)sa/si',$v,$r);
		foreach($r[1] as $tum){
			$tt = str_replace('"/url?q=','',$tum);
			$tt = str_replace('/&','',$tt);
			$tt = str_replace('amp;','',$tt);
			$tumu [] = $tt;
		}
		
		$url = 'https://www.google.com.tr/search?num=500&q='.$kelime.'&start=300'; 
		$v = file_get_contents_curl($url); 
		 preg_match_all('/class="r"><a href=(.*?)sa/si',$v,$r);
		foreach($r[1] as $tum){
			$tt = str_replace('"/url?q=','',$tum);
			$tt = str_replace('/&','',$tt);
			$tt = str_replace('amp;','',$tt);
			$tumu [] = $tt;
		}
		
		$url = 'https://www.google.com.tr/search?num=500&q='.$kelime.'&start=400'; 
		$v = file_get_contents_curl($url); 
		preg_match_all('/q=related:(.*?)">/si',$v,$r);
		 preg_match_all('/class="r"><a href=(.*?)sa/si',$v,$r);
		foreach($r[1] as $tum){
			$tt = str_replace('"/url?q=','',$tum);
			$tt = str_replace('/&','',$tt);
			$tt = str_replace('amp;','',$tt);
			$tumu [] = $tt;
		}
	}
	
	$islems = 1;
	foreach($tumu as $veriler){
		
		$e = explode("+",$veriler);
		$parca = substr($e[0],0,$kackarakter);
		$parca = str_replace("http://","",$parca);
		$parca = str_replace("www.","",$parca);
		
		$url2 = str_replace("http://","",$url2);
		$url2 = str_replace("www.","",$url2);
		
		$url2 = str_replace("/","",$url2);
		$parca = str_replace("/","",$parca);
		
		if ($parca == $url2){
			
			if ($sirano == 0){ 
				$sirano = $islems; 
			}
				$toplam++;
				$sonuclar [] = "
				<tr>
				<td width=\"40\" height=\"28\">$islems.</td>
				<td><a href=\"$e[0]\" style=\"color:red; font-weight:bold\">$e[0]</a></td>
				</tr>";
		} else {
				$sonuclar [] = "
				<tr>
				<td width=\"40\" height=\"28\">$islems.</td>
				<td><a href=\"$e[0]\" style=\"color:#000\">$e[0]</a></td>
				</tr>";	
		}
		
		$islems++;	
	}
	
	   echo '<pre>Google ın <span style="color:red">'.p("kelime").'</span> kelimesinde <span style="color:red">'.p("site").'</span> sitesinin sonuçları.</pre>';
	   echo '<pre>Sorgulanan web adresi <strong>'.$sirano.'</strong> s&#305;rada bulundu.</pre>';
	   echo '<pre>Toplamda ise <strong>'.$toplam.'</strong> sonu&#231; i&#231;erisinde yer al&#305;yor.</pre>';
	
	echo '<pre><table width="700" border="0" cellspacing="0" cellpadding="0" align="center">';
	foreach($sonuclar as $sonuc){
		$sonuc = str_replace("www.","",$sonuc);
		echo $sonuc;	
	}
	echo '</table></pre>';
?>
</div>
<?php } ?>
<?php } ?>
