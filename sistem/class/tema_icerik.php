<?php

	## Tema İçerik Fonksiyonu ##
	function tema_icerik(){
	
		$do = g("do");
		Switch ($do){
		
			case "son-analizler":
				require_once TEMA."/son-analizler.php";
			break;
			case "http-header-bilgisi":
				require_once TEMA."/http-header-bilgisi.php";
			break;	
			
			case "dns-lookup-bilgisi":
				require_once TEMA."/dns-lookup-bilgisi.php";
			break;	
			
			case "site-test-ping":
				require_once TEMA."/site-test-ping.php";
			break;	
			
			case "dns-lookup-bilgisi":
				require_once TEMA."/dns-lookup-bilgisi.php";
			break;	
			
			case "sunucu-tarama":
				require_once TEMA."/sunucu-tarama.php";
			break;	
			
			case "google-bot-goruntusu":
				require_once TEMA."/google-bot-goruntusu.php";
			break;	
			
			case "iletisim":
				require_once TEMA."/iletisim.php";
			break;	
			
			case "whois":
				require_once TEMA."/whois.php";
			break;
			
			case "site-hiz":
				require_once TEMA."/site-hiz.php";
			break;	
			
			case "link-cikartici":
				require_once TEMA."/link-cikartici.php";
			break;	
			
			case "meta-tag-gosterici":
				require_once TEMA."/meta-tag-gosterici.php";
			break;	
			
			case "site-parasal":
				require_once TEMA."/site-parasal.php";
			break;	
			
			case "mobil-uyumluluk":
				require_once TEMA."/mobil-uyumluluk.php";
			break;
			
			case "sira-bulucu":
				require_once TEMA."/sira-bulucu.php";
			break;	
			
			default:
			if (!g("do")){
				require_once TEMA."/default.php";
			}else {
				$hata = "Böyle bir sayfa bulunmuyor!";
				require_once TEMA."/hata.php";
			}
			break;
		
		}
	
	}
	
 ?>