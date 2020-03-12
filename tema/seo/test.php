
<?php
	if(isset($_POST["sorgula"])){

		## Post Edilenler ##
		$site = p("site");
		$tur = p("tur");
		
		if(strlen($site) == 0){
			echo '<div class="sonuclar" style="text-align: center;"><br/><pre><strong class="text-center" style="color:darkred">Lütfen geçerli bir adres giriniz..</strong></pre></div>';
		}else{
			
			## Sorgu Kayıt ##
			$sorgu_url = $tur.$site;
			$query = query("SELECT * FROM sorgular WHERE sorgu_url = '$sorgu_url'");
			if(mysql_affected_rows()){
				$row = row($query);
				$sorgu_id = $row["sorgu_id"];
				$sorgu_resim = 'http://img.bitpixels.com/getthumbnail?code=76182&size=200&url='.$sorgu_url.'';
				$sorgu_ip = IP();
				$sorgu_tekrar = $row["sorgu_tekrar"] + 1;
				$sorgu_tarih = date("Y-m-d H:i:s");
				$update = query("UPDATE sorgular SET
						sorgu_url = '$sorgu_url',
						sorgu_resim = '$sorgu_resim',
						sorgu_ip = '$sorgu_ip',
						sorgu_tekrar = '$sorgu_tekrar',
						sorgu_tarih = '$sorgu_tarih'
						WHERE sorgu_id = '$sorgu_id'");
			}else{
				$sorgu_resim = 'http://img.bitpixels.com/getthumbnail?code=76182&size=200&url='.$sorgu_url.'';
				$sorgu_ip = IP();
				$sorgu_tekrar = 1;
				$sorgu_tarih = date("Y-m-d H:i:s");
				$insert = query("INSERT INTO sorgular SET
				sorgu_url = '$sorgu_url',
				sorgu_resim = '$sorgu_resim',
				sorgu_ip = '$sorgu_ip',
				sorgu_tekrar = '$sorgu_tekrar',
				sorgu_tarih = '$sorgu_tarih'
				");
			}
			
			/*## Site Kontrol ##
			$response = _CurlBaglan($tur.$site);
			$httpCode = curl_getinfo($ch2, CURLINFO_HTTP_CODE);
			$httpTime = curl_getinfo($ch2, CURLINFO_TOTAL_TIME);
			$httpHTML = htmlspecialchars($response);
			*/
			//Content-Encoding: gzip
			
			/*if ( $httpCode != 200 ){
				echo '<div class="sonuclar" style="text-align: center;"><br/><pre><strong class="text-center" style="color:darkred">Sayfa içeriğine ulaşılamadı. Sayfa linkini yanlış girdiniz yada site isteğe cevap vermiyor.</strong></pre></div>';
			} else {*/
				
				//echo $httpTime; 
				$prog = 0;
				## Curl Bağlantı ##
				/*$url = $tur.$site;
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

				$htmlKod2 = curl_exec($ch);

				$cinfo = curl_getinfo($ch); 
				curl_close($ch);*/
				
				$htmlKod2 = _CurlBaglan($tur.$site);
				
				## Site Kaynak Kod ##
				$htmlKod = _CurlBaglan($tur.$site);
				
				## Site Title ##
				$title_get = explode("<title>",$htmlKod);
				$title_get = explode("</title>",$title_get[1]);
				$siteBaslik = $title_get[0];
				if(strlen($siteBaslik) > 70 || strlen($siteBaslik) == 0){
					$siteBaslikDurum = '<span class="label label-danger"><i class="fa fa-times"> Kötü</i></span>';
					$siteBaslikDurum2 = 'bg-danger';
				}else{
					$siteBaslikDurum = '<span class="label label-success"><i class="fa fa-check"> İyi</i></span>';
					$siteBaslikDurum2 = 'bg-success';
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
					$siteAciklamaDurum = '<span class="label label-success"><i class="fa fa-check"> İyi</i></span>';
					$siteAciklamaDurum2 = 'bg-success';
					$prog = $prog + 6;	
				} else {
					$siteAciklamaDurum = '<span class="label label-danger"><i class="fa fa-times"> Kötü</i></span>';
					$siteAciklamaDurum2 = 'bg-danger';
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
					$siteKelimeAnahtariDurum = '<span class="label label-success"><i class="fa fa-check"> İyi</i></span>';
					$siteKelimeAnahtariDurum2 = 'bg-success';
				}else{
					$siteKelimeAnahtariDurum = '<span class="label label-danger"><i class="fa fa-times"> Kötü</i></span>';
					$siteKelimeAnahtariDurum2 = 'bg-danger';
				}
				
				## Favicon Kontrolü ##
				if(stristr($htmlKod, 'rel="shortcut icon"') || stristr($htmlKod, 'rel="icon"')){
					$siteFavicon = "Sitede favicon bulunmaktadır.";
					$siteFaviconDurum = '<span class="label label-success"><i class="fa fa-check"> İyi</i></span>';
					$siteFaviconDurum2 = 'bg-success';
				}else{
					$siteFavicon = "Sitede favicon bulunmamaktadır!";
					$siteFaviconDurum = '<span class="label label-danger"><i class="fa fa-times"> Kötü</i></span>';
					$siteFaviconDurum2 = 'bg-danger';
				}
				
				## Canonical Link Kontrolü ##
				if(stristr($htmlKod, 'rel="canonical"')){
					$siteCanonical = "Sitede Canonical link bulunmaktadır.";
					$siteCanonicalDurum = '<span class="label label-success"><i class="fa fa-check"> İyi</i></span>';
					$siteCanonicalDurum2 = 'bg-success';
				}else{
					$siteCanonical = "Sitede Canonical link bulunmamaktadır!";
					$siteCanonicalDurum = '<span class="label label-danger"><i class="fa fa-times"> Kötü</i></span>';
					$siteCanonicalDurum2 = 'bg-danger';
				}
				
				## Meta Yazar Etiketi ##
				if(stristr($htmlKod, 'name="author"')){
					$siteMetaYazar = "Sitede Meta Yazar Etiketi bulunmaktadır.";
					$siteMetaYazarDurum = '<span class="label label-success"><i class="fa fa-check"> İyi</i></span>';
					$siteMetaYazarDurum2 = 'bg-success';
				}else{
					$siteMetaYazar = "Sitede Meta Yazar Etiketi bulunmamaktadır!";
					$siteMetaYazarDurum = '<span class="label label-danger"><i class="fa fa-times"> Kötü</i></span>';
					$siteMetaYazarDurum2 = 'bg-danger';
				}
				
				## Meta Dil Etiketi ##
				if(stristr($htmlKod, 'name="language"')){
					$siteMetaDil = "Sitede Meta Dil Etiketi bulunmaktadır.";
					$siteMetaDilDurum = '<span class="label label-success"><i class="fa fa-check"> İyi</i></span>';
					$siteMetaDilDurum2 = 'bg-success';
				}else{
					$siteMetaDil = "Sitede Meta Dil Etiketi bulunmamaktadır!";
					$siteMetaDilDurum = '<span class="label label-danger"><i class="fa fa-times"> Kötü</i></span>';
					$siteMetaDilDurum2 = 'bg-danger';
				}
				
				## Meta Mobil Viewport Etiketi ##
				if(stristr($htmlKod, 'name="viewport"')){
					$siteMetaMobil = "Sitede Meta Mobil Viewport Etiketi bulunmaktadır.";
					$siteMetaMobilDurum = '<span class="label label-success"><i class="fa fa-check"> İyi</i></span>';
					$siteMetaMobilDurum2 = 'bg-success';
				}else{
					$siteMetaMobil = "Sitede Meta Mobil Viewport Etiketi bulunmamaktadır!";
					$siteMetaMobilDurum = '<span class="label label-danger"><i class="fa fa-times"> Kötü</i></span>';
					$siteMetaMobilDurum2 = 'bg-danger';
				}
				
				## Sitemap Kontrolü ##
				if(url_var($tur.$site."/sitemap.xml") || url_var($tur.$site."/feed/")){
					$siteHaritasi = "Sitemap dosyası bulundu.";
					$siteHaritasiDurum = '<span class="label label-success"><i class="fa fa-check"> İyi</i></span>';
					$siteHaritasiDurum2 = 'bg-success';
				}else{
					$siteHaritasi = "Sitemap dosyası bulunamadı.";
					$siteHaritasiDurum = '<span class="label label-danger"><i class="fa fa-times"> Kötü</i></span>';
					$siteHaritasiDurum2 = 'bg-danger';
				}
				
				## Robots.txt Konrolü ##
				if(url_var($tur.$site."/robots.txt"))
				{
					$robotsTXT = "Robots.txt dosyası bulundu.";
					$robotsTXTDurum = '<span class="label label-success"><i class="fa fa-check"> İyi</i></span>';
					$robotsTXTDurum2 = 'bg-success';
				}else{
					$robotsTXT = "Robots.txt dosyası bulunamadı.";
					$robotsTXTDurum = '<span class="label label-danger"><i class="fa fa-times"> Kötü</i></span>';
					$robotsTXTDurum2 = 'bg-danger';
				}
				
				## Heading Tags Etiketi ##
				preg_match_all('/<h2>(.*?)<\/h2>/s', $htmlKod, $h2);
				preg_match_all('/<h1>(.*?)<\/h1>/s', $htmlKod, $h1);
				if (count($h2[0]) > 0 and count($h1[0]) > 0){
					$toplam = count($h2[0]) + count($h1[0]);
					$siteHtags = 'Siteniz H etiketi kriterlerine uyum sağlıyor. Toplam <strong>'.$toplam.'</strong> adet etiket bulunmuştur';
					$siteHtagsDurum = '<span class="label label-success"><i class="fa fa-check"> İyi</i></span>';
					$siteHtagsDurum2 = 'bg-success';
					$prog = $prog + 6;
				} else {
					$siteHtags = "Siteniz H etiketi kriterlerine uyum sağlamıyor. Sitede H Etiketi bulunmamaktadır!";
					$siteHtagsDurum = '<span class="label label-danger"><i class="fa fa-times"> Kötü</i></span>';
					$siteHtagsDurum2 = 'bg-danger';
					$prog = $prog;	
				}
				
				## Alt Etiketi Bulunmayan Resimler ##
				$doc = new DOMDocument(); 
				libxml_use_internal_errors(true);
				$doc->loadHTML($htmlKod2); 
				libxml_clear_errors();
				$xml = simplexml_import_dom($doc); 
				$images = $xml->xpath('//img'); 
				$s = 0;
				$e = 0;
				$jj = 0;
				foreach ($images as $img) { $jj++; if ($img['alt'] == "" ){ $e++; } else { $s++; }  }
				if ($s == $jj){
					$siteALTtag = 'Sitedeki resimlerde alt etiketi mevcuttur.';
					$siteALTtagDurum = '<span class="label label-success"><i class="fa fa-check"> İyi</i></span>';
					$siteALTtagDurum2 = 'bg-success';
					$prog = $prog + 6;	
				} else {
					$siteALTtag = 'Sitede toplam <strong>'.$e.'</strong> resim alt etiketine sahip değil.<br/><br/>';
					$siteALTtagDurum = '<span class="label label-danger"><i class="fa fa-times"> Kötü</i></span>';
					$siteALTtagDurum2 = 'bg-danger';
					$prog = $prog;	
				}
				
				## Resimlerin Genişlik ve Yükseklik Değerleri ##
				$doc = new DOMDocument(); 
				$doc->loadHTML($htmlKod2); 
				$xml = simplexml_import_dom($doc); 
				$images = $xml->xpath('//img'); 
				$s = 0;
				$e = 0;
				$jj = 0;
				foreach ($images as $img) { $jj++; if ($img['width'] == "" || $img['height'] == ""){ $e++; } else { $s++; }  }
				if ($s == $jj){
					$siteResimler = 'Sitedeki resimlerde genişlik ve yükseklik değeri mevcuttur.';
					$siteResimlerDurum = '<span class="label label-success"><i class="fa fa-check"> İyi</i></span>';
					$siteResimlerDurum2 = 'bg-success';
					$prog = $prog + 6;	
				} else {
					$siteResimler = 'Sitede toplam <strong>'.$e.'</strong> resim genişlik ve yükseklik değerine sahip değil.<br/><br/>';
					$siteResimlerDurum = '<span class="label label-danger"><i class="fa fa-times"> Kötü</i></span>';
					$siteResimlerDurum2 = 'bg-danger';
					$prog = $prog;	
				}
				
				## Toplam Resim Sayısı ##
				if ($jj != 0){
					$siteToplamResimler = 'Sitede bulunan resimler.';
					$siteToplamResimlerDurum = '<span class="label label-info"><i class="fa fa-info "> Bilgi</i></span>';
					$siteToplamResimlerDurum2 = 'bg-info';
					$prog = $prog + 6;	
				} else {
					$siteToplamResimler = 'Sitede bulunan resimler.<br/><br/>';
					$siteToplamResimlerDurum = '<span class="label label-info"><i class="fa fa-info "> Bilgi</i></span>';
					$siteToplamResimlerDurum2 = 'bg-info';
					$prog = $prog;	
				}
				
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
				
				## Nofollow Linkler ##
				$kl = 0;
				$doc = new DOMDocument(); 
				$doc->loadHTML($htmlKod2); 
				$xml = simplexml_import_dom($doc); 
				$images = $xml->xpath('//a'); 
				$s = 0;
				$e = 0;	
				foreach ($images as $img) { 
					if ($img['rel'] == "nofollow"){
						$kl++;  
					}
				}
				if ($kl != 0){	
					$siteNOLınk = 'Sitede bulunan nofollow linkler.';
					$siteNOLınkDurum = '<span class="label label-info"><i class="fa fa-info "> Bilgi</i></span>';
					$siteNOLınkDurum2 = 'bg-info';
					$prog = $prog + 6;	
				} else {	
					$siteNOLınk = 'Sitede nofollow link bulunmamaktadır.<br/><br/>';
					$siteNOLınkDurum = '<span class="label label-info"><i class="fa fa-info "> Bilgi</i></span>';
					$siteNOLınkDurum2 = 'bg-info';
				}
				
				
				## css ve javascript dosyası ##
				$doc = new DOMDocument(); 
				$doc->loadHTML($htmlKod2); 
				$xml = simplexml_import_dom($doc); 
				$images = $xml->xpath('//script'); 
				$sayac1 = 0;	
				foreach ($images as $img) { 
					$sayac1++;
				}
				$doc = new DOMDocument(); 
				$doc->loadHTML($htmlKod2); 
				$xml = simplexml_import_dom($doc); 
				$images = $xml->xpath('//link'); 
				$sayac2 = 0;
				foreach ($images as $img) { 
					$sayac2++;
				}
				$sayac = $sayac1 + $sayac2;
				if ($sayac != 0){
					$siteCssJs = 'Sitede bulunan stil ve javascript dosyaları.';
					$siteCssJsDurum = '<span class="label label-info"><i class="fa fa-info "> Bilgi</i></span>';
					$siteCssJsDurum2 = 'bg-info';
				} else {	
					$siteCssJs = 'Sitenizde stil ve javascript dosyası bulunmamaktadır.<br/><br/>';
					$siteCssJsDurum = '<span class="label label-info"><i class="fa fa-info "> Bilgi</i></span>';
					$siteCssJsDurum2 = 'bg-info';
				}
				
				## CSS Hataları ##
				$url2 = str_replace($tur,"",$site);
				$url2 = str_replace("www.","",$url2);
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_USERAGENT, 'Googlebot/2.1 (http://www.googlebot.com/bot.html)');
				curl_setopt ($ch, CURLOPT_REFERER, "http://www.google.com/bot.html"); 
				curl_setopt($ch, CURLOPT_FAILONERROR, true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_HEADER, true);
				curl_setopt($ch, CURLOPT_URL, "http://validator.w3.org/check?uri=$url2");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_TIMEOUT, 5);
				$site2 = curl_exec($ch);
				$site2 = iconv("UTF-8","ISO-8859-9",$site2);
				$cinfo = curl_getinfo($ch); 
				curl_close($ch);
				$ex = explode('<td colspan="2" class="invalid">',$site2);
				$ex = explode('Errors',$ex[0]);
				$w3c = $ex[0];
				
				//Css2
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_USERAGENT, 'Googlebot/2.1 (http://www.googlebot.com/bot.html)');
				curl_setopt ($ch, CURLOPT_REFERER, "http://www.google.com/bot.html"); 
				curl_setopt($ch, CURLOPT_FAILONERROR, true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_HEADER, true);
				curl_setopt($ch, CURLOPT_URL, "http://jigsaw.w3.org/css-validator/validator?uri=$url2&profile=css2");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_TIMEOUT, 5);
				$site2 = curl_exec($ch);
				curl_close($ch);
				$ex = explode('a href="#errors">Errors (',$site2);
				$ex = explode(')</a>',$ex[0]);
				$css2 = $ex[0];
				
				//Css3
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_USERAGENT, 'Googlebot/2.1 (http://www.googlebot.com/bot.html)');
				curl_setopt ($ch, CURLOPT_REFERER, "http://www.google.com/bot.html"); 
				curl_setopt($ch, CURLOPT_FAILONERROR, true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_HEADER, true);
				curl_setopt($ch, CURLOPT_URL, "http://jigsaw.w3.org/css-validator/validator?uri=$url2&profile=css3");
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
				curl_setopt($ch, CURLOPT_TIMEOUT, 5);
				$site2 = curl_exec($ch);
				curl_close($ch);
				$ex = explode('a href="#errors">Errors (',$site2);
				$ex = explode(')</a>',$ex[1]);
				$css3 = $ex[0];
				
				if ($w3c == "" and $css2 == "" and $css3 == ""){
					$prog = $prog + 6;
				}
				
				$sitew3c = 'Bulunan W3C sonuçlarınız.';
				$sitew3c2 = '■ <a href="http://jigsaw.w3.org/css-validator/validator?uri='.$url2.'&profile=css2" target="_blank">CSS 2 hatalarınız</a><br/>■ <a href="http://jigsaw.w3.org/css-validator/validator?uri='.$url2.'&profile=css3" target="_blank">CSS 3 hatalarınız</a>';
				$sitew3cDurum = '<span class="label label-info"><i class="fa fa-info"> Bilgi</i></span>';
				$sitew3cDurum2 = 'bg-info';
				
				
				## Sayfa Hızı ##
				$zaman = number_format($cinfo['total_time'], 2, '.', '');
				if ($zaman >= 5){	
					$siteHiz = 'Sitenin sayfa açılış hızı: <strong>'.$zaman.'</strong> sn';
					$siteHizDurum = '<span class="label label-danger"><i class="fa fa-times "> Kötü</i></span>';
					$siteHizDurum2 = 'bg-danger';
				} else {
					$siteHiz = 'Sitenin sayfa açılış hızı: <strong>'.$zaman.'</strong> sn';
					$siteHizDurum = '<span class="label label-success"><i class="fa fa-check "> İyi</i></span>';
					$siteHizDurum2 = 'bg-success';
					$prog = $prog + 6;
				}
				
				## CSS Standartizasyonu ##
				$sonuc = strpos($site,"@import url");
				$sonuc2 = strpos($site,"@importurl");
				if ($sonuc === false || $sonuc2) {
					$siteCSS = 'Sitenin CSS kodları standarta uygun.';
					$siteCSSDurum = '<span class="label label-success"><i class="fa fa-check"> İyi</i></span>';
					$siteCSSDurum2 = 'bg-success';
					$prog = $prog + 6;	
				} else {
					$siteCSS = 'Sitenin CSS kodları standarta uygun değil!';
					$siteCSSDurum = '<span class="label label-danger"><i class="fa fa-times"> Kötü</i></span>';
					$siteCSSDurum2 = 'bg-danger';					
				}
?>		
				<div class="sonuclar">
					<h4>Site Bilgileri</h4>
					<div class="row box-header">
						<h3><?php echo ucwords(strtolower($site)); ?> - Online</h3>
					</div>
					
					<div class="row">
						<div class="col-md-4">
							<img src="<?php echo $sorgu_resim; ?>" width="300" height="250" alt=""/>
						</div>
						<?php
							$xml = simplexml_load_file('http://data.alexa.com/data?cli=10&dat=snbamz&url='.$site);
							$sira=isset($xml->SD[1]->POPULARITY)?$xml->SD[1]->POPULARITY->attributes()->TEXT:0;
							$siteadi=(string)$xml->SD[0]->attributes()->HOST;
							$link=isset($xml->SD[0]->LINKSIN)?$xml->SD[0]->LINKSIN->attributes()->NUM:0;
							$ulkesira=isset($xml->SD[1]->COUNTRY)?$xml->SD[1]->COUNTRY->attributes()->RANK:0;
							$ulke=isset($xml->SD[1]->COUNTRY)?$xml->SD[1]->COUNTRY->attributes()->NAME:0;
						?>
						<?php
							function getwhois($domain, $tld){                                                   
								require_once(TEMA."/class.whois.php");

								$whois = new Whois();

									if( !$whois->ValidDomain($domain.'.'.$tld) ){
										   return 'Belirlenemiyor';
									}

								if( $whois->Lookup($domain.'.'.$tld) )
								{
									return $whois->GetData(1);
								}else{
									return 'Belirlenemiyor';
								}
							}
							
							$domain = p("site");
							$dot = strpos($domain, '.');
							$sld = substr($domain, 0, $dot);
							$tld = substr($domain, $dot+1); 
							if(substr($domain , -3) == ".tr"){
								$site = file_get_contents("http://www.whois.com.tr/?q=$domain");
								$aa = explode('<td colspan="2" class="ptd full"><pre>',$site);
								$aa = explode('</pre></td>',$aa[1]);
							?>	
								<pre><?php echo $aa[0]; ?></pre>
						<?php 
							} else { 
								$whois = getwhois($sld, $tld); 
							} 
							preg_match('/Creation Date: ([a-z0-9-]+)/si', $whois, $p);
							
							if(empty($p[1])){
								$gunfarki = "bilinmiyor.";
							}
							else
							{
								$ilk = str_replace("T18","",$p[1]);
								$tarih1 = strtotime($ilk); 
								$tarih2 = strtotime(date('d-m-Y')); 
								$gunfarki = round(($tarih2 - $tarih1) / (60*60*24))." gün.";
							}
						?>
						<div class="col-md-4 siteBilgi">
							<h1><?php echo ucwords(strtolower($site)); ?></h1>
							<p>Bu site Alexa.com değerlendirmesine göre <?php echo $ulke;?> sıralamasında <?php echo $ulkesira; ?> sırada, dünya sıralamasında ise <?php echo $sira; ?> sırasında. Sitenin Domain yaşı <?php echo $gunfarki; ?></p>
							<br/>
							<a href="<?php echo $tur.$site; ?>" class="btn btn-primary" role="button" target="_blank" rel="nofollow">Siteyi Ziyaret Et</a>
						</div>
						<div class="col-md-4">
							<a href="#">
								<img class="img-responsive" src="http://seosorgula.com/uploads/300x250.jpg" alt="reklam"/>
							</a>
						</div>
					</div>
					<br/>
					<table class="table table-hover">
						<tbody>
							<tr style="background-color: #F3F4F5;">
								<th><b>Meta Etiketleri</b></th>
								<th></th>
								<th><b>Durum</b></th>
							</tr>
							<tr class="<?php echo $siteBaslikDurum2; ?>">
								<td>Site Başlığı (Title)</td>
								<td><?php echo $siteBaslik; ?></td>
								<td><?php echo $siteBaslikDurum; ?></td>
							</tr>
							<tr class="<?php echo $siteAciklamaDurum2; ?>">
								<td>Site Açıklama (Description)</td>
								<td><?php echo $dparca; ?></td>
								<td><?php echo $siteAciklamaDurum; ?></td>
							</tr>
							<tr class="<?php echo $siteKelimeAnahtariDurum2; ?>">
								<td>Anahtar Kelimeler (Keywords)</td>
								<td><?php echo $kparca; ?></td>
								<td><?php echo $siteKelimeAnahtariDurum; ?></td>
							</tr>
							<tr class="<?php echo $siteFaviconDurum2; ?>">
								<td>Site Favicon</td>
								<td><?php echo $siteFavicon; ?></td>
								<td><?php echo $siteFaviconDurum; ?></td>
							</tr>
							<tr class="<?php echo $siteCanonicalDurum2; ?>">
								<td>Site Canonical Link</td>
								<td><?php echo $siteCanonical; ?></td>
								<td><?php echo $siteCanonicalDurum; ?></td>
							</tr>
							<tr class="<?php echo $siteMetaYazarDurum2; ?>">
								<td>Meta Yazar Etiketi</td>
								<td><?php echo $siteMetaYazar; ?></td>
								<td><?php echo $siteMetaYazarDurum; ?></td>
							</tr>
							<tr class="<?php echo $siteMetaDilDurum2; ?>">
								<td>Meta Dil Etiketi</td>
								<td><?php echo $siteMetaDil; ?></td>
								<td><?php echo $siteMetaDilDurum; ?></td>
							</tr>
							<tr class="<?php echo $siteMetaMobilDurum2; ?>">
								<td>Meta Mobil ViewPort Etiketi</td>
								<td><?php echo $siteMetaMobil; ?></td>
								<td><?php echo $siteMetaMobilDurum; ?></td>
							</tr>
							<tr>
								<td colspan="3" style="background-color: #FFF;"></td>
							</tr>
							<tr style="background-color: #F3F4F5;">
								<th><b>Genel Bilgiler</b></th>
								<th></th>
								<th><b>Durum</b></th>
							</tr>
							<tr class="<?php echo $siteCssJsDurum2; ?>">
								<td>Google Arama Sonucu Görüntüsü</td>
								<td>
									<pre>
										<div style="color:#1a0dab;font-size:16px;"><?php echo $siteBaslik; ?></div><div style="font-size:13px;color:#006621;"><?php echo $site; ?></div><div style="font-size:13px;padding-bottom:5px;"><?php echo $dparca; ?></div>
									</pre>
								</td>
								<td><?php echo $siteCssJsDurum; ?></td>
							</tr>
							<tr class="<?php echo $siteHtagsDurum2; ?>">
								<td>H (Heading Tags) Etiketleri</td>
								<td><?php echo $siteHtags; ?> </td>
								<td><?php echo $siteHtagsDurum; ?></td>
							</tr>
							<tr class="<?php echo $siteALTtagDurum2; ?>">
								<td>Alt Etiketi Bulunmayan Resimler</td>
								<td>
									<?php echo $siteALTtag; ?> 
									<!--<span style="font:size:10px;color:darkred"><label for="kutucuk">Hatalı Olanları Göster / Gizle</label></span>
									<input type="checkbox" id="kutucuk" class="ackapa" checked>
									<pre class="gizle">-->
									<pre>
									<?php  
										echo "<br/>";
										$doc = new DOMDocument(); 
										$doc->loadHTML($htmlKod2); 
										$xml = simplexml_import_dom($doc); 
										$images = $xml->xpath('//img'); 
										$s = 0;
										$e = 0;
										foreach ($images as $img) { 
											if ($img['alt'] == "" ){ 
												if(!empty($img['src'])){
													echo "<span style='font-size:12px'>■ ".$img['src']."</span><br/>"; 
												}
											}
										}
									?>
									</pre>
								</td>
								<td><?php echo $siteALTtagDurum; ?></td>
							</tr>
							<tr class="<?php echo $siteResimlerDurum2; ?>">
								<td>Resimlerin Genişlik ve Yükseklik Değerleri</td>
								<td>
									<?php echo $siteResimler; ?> 
									<?php  
										$doc = new DOMDocument(); 
										$doc->loadHTML($htmlKod2); 
										$xml = simplexml_import_dom($doc); 
										$images = $xml->xpath('//img'); 
										$s = 0;
										$e = 0;
										echo "<pre>";
										foreach ($images as $img) { 
											if ($img['width'] == "" || $img['height'] == ""){
												if(!empty($img['src'])){
													echo "<span style='font-size:12px'>■ ".$img['src']."</span><br/>"; 
												}
											}
										}
										echo "</pre>";
									?>
								</td>
								<td><?php echo $siteResimlerDurum; ?></td>
							</tr>
							<tr class="<?php echo $siteToplamResimlerDurum2; ?>">
								<td>Toplam Resim Sayısı</td>
								<td>
									<?php echo $siteToplamResimler; ?> 
									<?php  
										echo "<br/>";
										$doc = new DOMDocument(); 
										$doc->loadHTML($htmlKod2); 
										$xml = simplexml_import_dom($doc); 
										$images = $xml->xpath('//img'); 
										$s = 0;
										$e = 0;
										echo "<pre>";
										foreach ($images as $img) { 
											if(!empty($img['src'])){
												echo "<span style='font-size:12px'>■ ".$img['src']."</span><br/>"; 
											}										
										}
										echo "</pre>";
									?>
								</td>
								<td><?php echo $siteToplamResimlerDurum; ?></td>
							</tr>	
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
							<tr class="<?php echo $siteNOLınkDurum2; ?>">
								<td>Nofollow Linkler</td>
								<td>
									<?php echo $siteNOLınk; ?> 
									<?php  
										$doc = new DOMDocument(); 
										$doc->loadHTML($htmlKod2); 
										$xml = simplexml_import_dom($doc); 
										$images = $xml->xpath('//a'); 
										$s = 0;
										$e = 0;	
										echo "<pre>";
										foreach ($images as $img) { 
											if ($img['rel']== "nofollow"){
												if(!empty($img['href'])){
													echo "<span style='font-size:12px'>■ ".$img['href']."</span><br/>"; 
												}
											}
										}
										echo "</pre>";
									?>
								</td>
								<td><?php echo $siteCssJsDurum; ?></td>
							</tr>
							<tr class="<?php echo $siteNOLınkDurum2; ?>">
								<td>CSS ve JavaScript Dosyaları</td>
								<td>
									<?php echo $siteCssJs; ?> 
									<?php  
										echo "<pre>";
										if ($sayac1 == 0){
											echo 'Javascript dosyası bulunmamaktadır.';	
										}else{
											$doc = new DOMDocument(); 
											$doc->loadHTML($htmlKod2); 
											$xml = simplexml_import_dom($doc); 
											$images = $xml->xpath('//script'); 
											
											foreach ($images as $img) { 
												
													echo htmlentities($img['src'])."<br>";
												
											}
										}
										if ($sayac2 == 0){
											echo 'Stil dosyası bulunmamaktadır.';	
										} else {
											$doc = new DOMDocument(); 
											$doc->loadHTML($htmlKod2); 
											$xml = simplexml_import_dom($doc); 
											$images = $xml->xpath('//link'); 
											foreach ($images as $img) { 
													echo htmlentities($img['href'])."<br>";
												
											}
										}	
										echo "</pre>";
									?>
								</td>
								<td><?php echo $siteCssJsDurum; ?></td>
							</tr>
							<tr class="<?php echo $sitew3cDurum2; ?>">
								<td>W3C Hataları</td>
								<td>
									<?php echo $sitew3c; ?> 
									<?php  
										echo "<pre>";
										echo $sitew3c2;
										echo "</pre>";
									?>
								</td>
								<td><?php echo $sitew3cDurum; ?></td>
							</tr>
							<tr class="<?php echo $siteHizDurum2; ?>">
								<td>Site Açılış Hızı</td>
								<td>
									<?php echo $siteHiz; ?> 
								</td>
								<td><?php echo $siteHizDurum; ?></td>
							</tr>
							<tr class="<?php echo $siteCSSDurum2; ?>">
								<td>CSS Standartizasyonu</td>
								<td>
									<?php echo $siteCSS; ?> 
								</td>
								<td><?php echo $siteCSSDurum; ?></td>
							</tr>
							<tr>
								<td colspan="3" style="background-color: #FFF;"></td>
							</tr>
							<tr style="background-color: #F3F4F5;">
								<th><b>Dosya Taramaları</b></th>
								<th></th>
								<th><b>Durum</b></th>
							</tr>
							<tr class="<?php echo $siteHaritasiDurum2; ?>">
								<td>XML Sitemap</td>
								<td><?php echo $siteHaritasi; ?></td>
								<td><?php echo $siteHaritasiDurum; ?></td>
							</tr>
							<tr class="<?php echo $robotsTXTDurum2; ?>">
								<td>Robots.txt</td>
								<td><?php echo $robotsTXT; ?></td>
								<td><?php echo $robotsTXTDurum; ?></td>
							</tr>
							<tr>
								<td colspan="3" style="background-color: #FFF;"></td>
							</tr>
							
						</tbody>
					</table>
				</div>
			
<?php 
			
			}
			curl_close($ch2);
		} 
	//}
?>