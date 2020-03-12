<?php 

	## Tema BAŞLIK - DESC - KEYW Fonksiyonu ##
	function tdk(){
	
		$do = g("do");
		Switch ($do){
			
			case "iletisim":
				$title = "İletişim : ".SITE_TITLE;
				$desc = ss(SITE_DESC);
				$keyw = ss(SITE_KEYW);
				$canonical = ss(URL)."/iletisim";
			break;
			
			case "google-bot-goruntusu":
				$title = "Google Bot Görüntüsü : ".SITE_TITLE;
				$desc = ss(SITE_DESC);
				$keyw = ss(SITE_KEYW);
				$canonical = ss(URL)."/google-bot-goruntusu";
			break;
			case "dns-lookup-bilgisi":
				$title = "DNS Lookup Bilgisi : ".SITE_TITLE;
				$desc = ss(SITE_DESC);
				$keyw = ss(SITE_KEYW);
				$canonical = ss(URL)."/dns-lookup-bilgisi";
			break;
			case "site-test-ping":
				$title = "Site Test Ping : ".SITE_TITLE;
				$desc = ss(SITE_DESC);
				$keyw = ss(SITE_KEYW);
				$canonical = ss(URL)."/site-test-ping";
			break;
			
			case "http-header-bilgisi":
				$title = "HTTP Header Bilgisi : ".SITE_TITLE;
				$desc = ss(SITE_DESC);
				$keyw = ss(SITE_KEYW);
				$canonical = ss(URL)."/http-header-bilgisi";
			break;
			
			case "son-analizler":
				$title = "Son Analizler : ".SITE_TITLE;
				$desc = ss(SITE_DESC);
				$keyw = ss(SITE_KEYW);
				$canonical = ss(URL)."/son-analizler";
			break;
			
			case "sunucu-tarama":
				$title = "Sunucu Tarama : ".SITE_TITLE;
				$desc = ss(SITE_DESC);
				$keyw = ss(SITE_KEYW);
				$canonical = ss(URL)."/sunucu-tarama";
			break;
			
			case "whois":
				$title = "Whois Sorgusu : ".SITE_TITLE;
				$desc = ss(SITE_DESC);
				$keyw = ss(SITE_KEYW);
				$canonical = ss(URL)."/whois";
			break;
			
			case "site-hiz":
				$title = "Site Hız Testi : ".SITE_TITLE;
				$desc = ss(SITE_DESC);
				$keyw = ss(SITE_KEYW);
				$canonical = ss(URL)."/site-hiz";
			break;
			
			case "link-cikartici":
				$title = "Link Çıkartıcı : ".SITE_TITLE;
				$desc = ss(SITE_DESC);
				$keyw = ss(SITE_KEYW);
				$canonical = ss(URL)."/link-cikartici";
			break;
			
			case "meta-tag-gosterici":
				$title = "Meta Tag Gösterici : ".SITE_TITLE;
				$desc = ss(SITE_DESC);
				$keyw = ss(SITE_KEYW);
				$canonical = ss(URL)."/meta-tag-gosterici";
			break;
			
			case "site-parasal":
				$title = "Site Parasal Değeri : ".SITE_TITLE;
				$desc = ss(SITE_DESC);
				$keyw = ss(SITE_KEYW);
				$canonical = ss(URL)."/site-parasal";
			break;
			
			case "mobil-uyumluluk":
				$title = "Site Mobil Uyumluluk Testi : ".SITE_TITLE;
				$desc = ss(SITE_DESC);
				$keyw = ss(SITE_KEYW);
				$canonical = ss(URL)."/mobil-uyumluluk";
			break;
			
			case "sira-bulucu":
				$title = "Google Sıra Bulucu : ".SITE_TITLE;
				$desc = ss(SITE_DESC);
				$keyw = ss(SITE_KEYW);
				$canonical = ss(URL)."/sira-bulucu";
			break;
			
			default:
				$title = ss(SITE_TITLE);
				$desc = ss(SITE_DESC);
				$keyw = ss(SITE_KEYW);
				$canonical = ss(URL);
			break;
		
		}
		
		echo '<title>'.$title.'</title>'."\n";
		echo '<meta name="description" content="'.$desc.'"/>';
		echo "\n";
		echo '<meta name="keywords" content="'.$keyw.'"/>';
		echo "\n";
		echo '<link rel="canonical" href="'.$canonical.'"/>';
		
	}

?>