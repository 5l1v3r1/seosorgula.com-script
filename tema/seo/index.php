<!doctype html>
<html lang="tr-TR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="<?php echo TEMA_URL; ?>/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo TEMA_URL; ?>/assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo TEMA_URL; ?>/assets/css/font-awesome.min.css">
    <?php tdk(); ?>
	
	<style type="text/css">
		input.ackapa{display:none;}
		label.ackapa{cursor:pointer; display:block;} 
		input.ackapa:checked+ .gizle{display:none;} 
		
		input.ackapa2{display:none;}
		label.ackapa2{cursor:pointer; display:block;} 
		input.ackapa2:checked+ .gizle2{display:none;} 
		.iframe-res {
		  border-radius: 20px;
		  border-color: #000;
		  border-style: solid;
		  border-width: 45px 35px;
		  display: block;
		  margin: 20px auto 30px auto;
		  overflow: auto;
		  -moz-box-shadow: 4px 4px 14px #000;
		  -webkit-box-shadow: 4px 4px 14px #000;
		  box-shadow: 4px 4px 14px #000;
		}
	</style>

</head>
<body>

	<!-- Header Start -->
	<header>
		<div class="row top">
			<div class="col-md-2"></div>
			
			<div class="col-md-8">
				<!-- Menüler -->
				<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
					<div class="container">
						<!-- Telefonlar için Menü -->
						<div class="navbar-header">
							<img title="Seo Sorgula" width="20%" height="52" alt="Seo Sorgula Logo" src="http://www.thewholebraingroup.com/wbcntnt/wp-content/uploads/WBG_icon_seo-300px.png">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<!-- Normal Menü -->
						<div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li class="<?php echo !g("do") ? 'active' : null; ?>"><a href="<?php echo URL; ?>" title="Ana Sayfa">Ana Sayfa</a></li>
								<li class="<?php echo g("do") == "sira-bulucu" ? 'active' : null; ?>"><a href="<?php echo URL; ?>/sira-bulucu" title="Sıra Bulucu">Sıra Bulucu</a></li>
								<li class="<?php echo g("do") == "sunucu-tarama" ? 'active' : null; ?>"><a href="<?php echo URL; ?>/sunucu-tarama" title="Sunucu Tarama">Sunucu Tarama</a></li>
								<li class="<?php echo g("do") == "son-analizler" ? 'active' : null; ?>"><a href="<?php echo URL; ?>/son-analizler" title="Son Analizler">Son Analizler</a></li>
								<li class="dropdown">
								  <a href="#" class="dropdown-toggle" data-hover="dropdown">Site Araçları <span class="caret"></span></a>
								  <ul class="dropdown-menu dropdown-menu-left" role="menu">
									<li><a href="<?php echo URL; ?>/whois" title="Whois Sorgusu">Whois Sorgusu</a></li>
									<li><a href="<?php echo URL; ?>/site-hiz" title="Site Hız Testi">Site Hız Testi</a></li>
									<li><a href="<?php echo URL; ?>/link-cikartici" title="Link Çıkartıcı">Link Çıkartıcı</a></li>
									<li><a href="<?php echo URL; ?>/meta-tag-gosterici" title="Meta Tag Gösterici">Meta Tag Gösterici</a></li>
									<li><a href="<?php echo URL; ?>/site-parasal" title="Site Parasal Değeri">Site Parasal Değeri</a></li>
									<li><a href="<?php echo URL; ?>/mobil-uyumluluk" title="Site Mobil Uyumluluk">Site Mobil Uyumluluk</a></li>
									<li><a href="<?php echo URL; ?>/google-bot-goruntusu" title="Google Bot Görünütüsü">Google Bot Görünütüsü</a></li>
								 	<li><a href="<?php echo URL; ?>/http-header-bilgisi" title="HTTP Header Bilgisi">HTTP Header Bilgisi</a></li>			 
 									<li><a href="<?php echo URL; ?>/dns-lookup-bilgisi" title="DNS Lookup Bilgisi">DNS Lookup Bilgisi</a></li>			 
 									<li><a href="<?php echo URL; ?>/site-test-ping" title="Site Test Ping">Site Test Ping</a></li>			 

								  </ul>
								</li>
								<li class="<?php echo g("do") == "iletisim" ? 'active' : null; ?>" ><a href="<?php echo URL; ?>/iletisim" title="İletişim">İletişim</a></li>
							</ul>
						</div>
					</div>
				</nav>
				<!-- #Menüler -->
			</div>
			
			<div class="col-md-2"></div>
		</div>
	</header>
	<!-- #Header End -->

	<div class="clear"></div>
	<div class="row" style="position:relative; top:50px;font-size:15px;background:#eee">
		<div class="">
			<?php 
				$query = query("SELECT * FROM anasayfa_mesaj WHERE mesaj_onay = 1 ORDER BY id DESC LIMIT 1");
				if(mysql_affected_rows()){
					$row = row($query);
			?>
				<div class="row text-center alert alert-info" role="alert" style="font-size:15px">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					
					<i class="fa fa-bullhorn" style="font-size:20px"></i> <?php echo $row["icerik"]; ?>
				</div>
			<?php } ?>		
		</div>
	</div>		
	<div class="clear"></div>
	
	<!-- Middle Start -->
	<div class="middle">
		<?php tema_icerik(); ?>
		
	</div>	
	
<div class="row sorguIcerik">
	<div class="container">
		<center>
			<a href="#">
				<img class="img-responsive" src="http://seosorgula.com/uploads/728x90.jpg" alt="reklam"/>
			</a>	
		</center>	
	</div>
	<br/>
	<div class="container">
		<p>Seo Sorgulama ile sitesi whois sorgusu, site mobil uyumluluk kontrolü, meta-tag oluşturucu ve göstericisi, site kaynak kod çıktısı, tarayıcı detayları, link çıkartıcı, site dns bilgileri, google bot görüntüsü gibi işlemleri kolayca yapabilirsiniz.</p>
	</div>
</div>
		
		<div class="row araclar">
		 <h2 class="text-center"><strong style="border-bottom:1px solid #eee;font-size:20px">Site Araçları</strong></h2>
			<div class="container" style="text-align:center;">
				<div class="col-md-3 araclarKutu">
					<a href="<?php echo URL; ?>/site-hiz" class="btn btn-app" style="color:dodgerblue" title="Site Hız Testi">
						<i class="fa fa-rocket"></i>						
						<h4>Site Hız Testi</h4>
					</a>
					<p>Web sitesinin hızını test edin.</p>
				</div>
				<div class="col-md-3 araclarKutu">
					<a href="<?php echo URL; ?>/whois" class="btn btn-app" style="color:darkgreen" title="Pagerank Sorgula">
						<i class="fa fa-star"></i>						
						<h4>Whois Sorgusu</h4>
					</a>
					<p>Web sitesinin whois bilgisini sorgulayarak öğrenebilirsiniz.</p>
				</div>
				<div class="col-md-3 araclarKutu">
					<a href="<?php echo URL; ?>/google-bot-goruntusu" class="btn btn-app" style="color:purple" title="Google Bot Görünütüsü">
						<i class="fa fa-bug"></i>						
						<h4>Google Bot Görünütüsü</h4>
					</a>
					<p>Web sitesinin Google bot tarafından nasıl göründüğüne bakın.</p>
				</div>
				<div class="col-md-3 araclarKutu">
					<a href="<?php echo URL; ?>/mobil-uyumluluk" class="btn btn-app" style="color:#bd1f26" title="Mobil Uyumluluk">
						<i class="fa fa-mobile"></i>						
						<h4>Mobil Uyumluluk</h4>
					</a>
					<p>Web sitesinin mobil kullanıcılar tarafından nasıl göründüğüne bakın.</p>
				</div>
				<div class="col-md-3 araclarKutu">
					<a href="<?php echo URL; ?>/link-cikartici" class="btn btn-app" style="color:#101010" title="Link Çıkartıcı">
						<i class="fa fa-chain-broken"></i>						
						<h4>Link Çıkartıcı</h4>
					</a>
					<p>Web sitesinin içinde bulunan tüm linkleri çıkartın.</p>
				</div>
				<div class="col-md-3 araclarKutu">
					<a href="<?php echo URL; ?>/meta-tag-gosterici" class="btn btn-app" style="color:#d97240" title="Meta Tag Gösterici">
						<i class="fa fa-tag"></i>						
						<h4>Meta Tag Gösterici</h4>
					</a>
					<p>Web sitesinin meta tag bilgisini görüntüleyin.</p>
				</div>
				<div class="col-md-3 araclarKutu">
					<a href="<?php echo URL; ?>/site-parasal" class="btn btn-app" style="color:gold" title="Site Parasal Değeri">
						<i class="fa fa-try"></i>						
						<h4>Site Parasal Değeri</h4>
					</a>
					<p>Web sitesinin parasal değerini ölçün.</p>
				</div>
				<div class="col-md-3 araclarKutu">
					<a href="<?php echo URL; ?>/sira-bulucu" class="btn btn-app" style="color:#1fa67a" title="Site Sıra Bulucu">
						<i class="fa fa-list-ol"></i>						
						<h4>Site Sıra Bulucu</h4>
					</a>
					<p>Web sitesinin aranılan kelimede google sırasını bulun.</p>
				</div>
			</div>
		</div>
		
		<?php
			$ipucu = query("SELECT * FROM ipuclari WHERE ipucu_onay = 1 ORDER BY RAND() LIMIT 1");
			if(mysql_affected_rows()){
				$row2 = row($ipucu);
		?>
			<div class="row sonSorgular" style="background-color:lightblue">
				<div class="container">
					<strong style="font-size:14px"><i class="fa fa-exclamation-circle" style="font-size:20px"></i> İpucu:</strong><span style="font-size:14px"><?php echo $row2["ipucu_icerik"]; ?></span>
				</div>
			</div>	
		<?php } ?>
		
		
		<div class="row sonSorgular" style="margin-top:0;">
			<div class="container">
                    <h2 class="text-center"><i class="fa fa-star" style="font-size:13px"></i><i class="fa fa-star"></i> <strong>En Çok Sorgulanan Siteler</strong> <i class="fa fa-star"></i><i class="fa fa-star" style="font-size:13px"></i></h2>
                    <div class="row">
                        <?php 
							
							$query = query("SELECT * FROM sorgular ORDER BY sorgu_tekrar DESC LIMIT 4");
							if(mysql_affected_rows()){
								while($row = row($query)){
									$baslik = str_replace("http://","",$row["sorgu_url"]);
									$baslik = str_replace("https://","",$baslik);
									$baslik = ucwords(strtolower($baslik));
						?>
					
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img title="<?php echo $baslik; ?>" class="img-responsive" src="<?php echo $row["sorgu_resim"]; ?>" alt="<?php echo $row["sorgu_url"]; ?>">
                                <div class="caption  text-center">
                                    <h3><?php echo $baslik; ?></h3>
                                    <div class="butonlar">
                                        <a href="<?php echo $row["sorgu_url"]; ?>" class="btn btn-primary" role="button" target="_blank" rel="nofollow">Siteyi Ziyaret Et</a>
										<br/>
										<span>Şuana kadar <b><?php echo $row["sorgu_tekrar"]; ?></b> kere sorgulandı.</span>
									</div>
                                </div>
                            </div>
                        </div>
						
						<?php }
							
							}else{ ?>
						
						<?php } ?>
                    </div>
                </div>
		</div>
	
	</div>
	<!-- #Middle End -->
	
	<!-- Footer Start -->
	<div class="row col-sm-12 striped" style="height:5px;"></div>
		<div class="row footer">
			<div class="container">
				<div class="col-lg-4 col-md-4 col-sm-4 links">
					<h6 style="color:lightblue">Bağlantılar</h6>
					<ul>
						<li><a href="<?php echo URL; ?>">Ana Sayfa</a></li>
						<li><a href="<?php echo URL; ?>/sira-bulucu">Sıra Bulucu</a></li>
						<li><a href="<?php echo URL; ?>/sunucu-tarama">Sunucu Tarama</a></li>
						<li><a href="<?php echo URL; ?>/son-analizler">Son Analizler</a></li>
						<li><a href="<?php echo URL; ?>/iletisim">İletişim</a></li>
					</ul>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 links2">
					<h6 style="color:yellow">Site Araçları</h6>
					<ul>
						<li><a href="<?php echo URL; ?>/whois" title="Whois Sorgusu">Whois Sorgusu</a></li>
									<li><a href="<?php echo URL; ?>/site-hiz" title="Site Hız Testi">Site Hız Testi</a></li>
									<li><a href="<?php echo URL; ?>/link-cikartici" title="Link Çıkartıcı">Link Çıkartıcı</a></li>
									<li><a href="<?php echo URL; ?>/meta-tag-gosterici" title="Meta Tag Gösterici">Meta Tag Gösterici</a></li>
									<li><a href="<?php echo URL; ?>/site-parasal" title="Site Parasal Değeri">Site Parasal Değeri</a></li>
									<li><a href="<?php echo URL; ?>/mobil-uyumluluk" title="Site Mobil Uyumluluk">Site Mobil Uyumluluk</a></li>
									<li><a href="<?php echo URL; ?>/google-bot-goruntusu" title="Google Bot Görünütüsü">Google Bot Görünütüsü</a></li>
									<li><a href="<?php echo URL; ?>/http-header-bilgisi" title="HTTP Header Bilgisi">HTTP Header Bilgisi</a></li>			 
									<li><a href="<?php echo URL; ?>/dns-lookup-bilgisi" title="DNS Lookup Bilgisi">DNS Lookup Bilgisi</a></li>			 
					 				<li><a href="<?php echo URL; ?>/site-test-ping" title="Site Test Ping">Site Test Ping</a></li>			 

					</ul>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-4 links">
					<h6 style="color:lightgreen">Reklam</h6>
					<a href="#">
						<img class="img-responsive" src="http://seosorgula.com/uploads/300x250.jpg" alt="reklam"/>
					</a>
				</div>
			</div>
	</div>
	<div class="footer2">
		<div class="container">
		  <div class="row">
			<div style="float:left;font-size:12px">
			  Tüm Haklarımız Saklıdır © <a href="http://seosorgula.com">SEO Sorgula</a>
			</div>
			<div style="float:right; font-size:12px">
			  Bu site <a href="http://hatosbilisim.com">HatOS Bilişim</a> Tarafından Yapılmıştır.
			</div>
		  </div>
		</div>
	</div>
	<!-- #Footer End -->

    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="<?php echo TEMA_URL; ?>/assets/js/bootstrap.js"></script>
    <script src="<?php echo TEMA_URL; ?>/assets/js/bootstrap-hover-dropdown.js"></script>
</body>
</html>