<?php echo !defined("ADMIN") ? die("Hacking?") : null; ?>
<?php 		
	$query = query("SELECT * FROM iletisim_kutusu WHERE iletisim_durumu = 0");		
		while($row = row($query)){				
			$mesajSayisi = mysql_num_rows($query);		
		}		
		if($mesajSayisi > 0){				
			$var = " - ( <font color='green'>".$mesajSayisi." Mesaj var!</font> )";		
		}
?>
<header id="header">	
	<hgroup>		
		<h1 class="site_title"><a href="<?php echo URL; ?>/admin"><?php echo SITE_TITLE; ?></a></h1>		
		<h2 class="section_title">Yönetim Paneli</h2>
		
		<div class="btn_view_site">
			<a style="position:relative;top:15px" target="_blank" href="<?php echo URL; ?>">Siteyi Göster</a>
		</div>
	</hgroup>
</header> 

<section id="secondary_bar">	
	<div class="user">		
		<p><?php echo session("uye_adi"); ?> <a href="index.php?do=mesajlar"><?php echo $var; ?></a></p>		
		<a class="logout_user" href="index.php?do=cikis_yap" title="Çıkış Yap">Çıkış Yap</a> 	
	</div>	
	<div class="breadcrumbs_container">		
		<article class="breadcrumbs">
			<a href="index.php">Anasayfa</a> 
			<div class="breadcrumb_divider"></div> 
			<a class="current"></a>
		</article>	
	</div>
</section>

<aside id="sidebar" class="column">	
	<hr/>
	<h3>Son Yapılan Sorgular</h3>	
	<ul class="toggle">				
		<li class="icn_folder"><a href="index.php?do=sorgular">Sorgular</a></li>
	</ul>
	<hr/>
	<h3>Gelen kutusu</h3>	
	<ul class="toggle">				
		<li class="icn_folder"><a href="index.php?do=mesajlar">Mesajlar</a> <?php echo $var; ?></li>
	</ul>	
	<hr/>
	<h3>KULLANICILAR</h3>
	<ul class="toggle">					
		<li class="icn_add_user"><a href="index.php?do=uye_ekle">Yeni Üye Ekle</a></li>				
		<li class="icn_view_users"><a href="index.php?do=uyeler">Üyeleri Düzenle</a></li>				
		<li class="icn_view_users">
			<a href="index.php?do=onay_bekleyen_uyeler">		
			<?php 				
				$query = query("SELECT * FROM uyeler WHERE uye_onay = 0"); 				
				if (mysql_affected_rows()){				
					echo "Onay Bekleyen Üyeler <font color='red'>#</font>";				
				}else { 				
					echo "Onay Bekleyen Üyeler"; 				
				} 		?>		
			</a>		
		</li>
	</ul>	
	<hr/>
	<h3>ANASAYFA MESAJ YÖNETİMİ</h3>	
	<ul class="toggle">				
		<li class="icn_folder"><a href="index.php?do=anasayfa_mesaj_ekle">Anasayfa Mesaj Ekle</a></li>				
		<li class="icn_photo"><a href="index.php?do=anasayfa_mesajlar">Anasayfa Mesajları Düzenle</a></li>	
	</ul>	
	<hr/>
	<h3>Ipucları</h3>	
	<ul class="toggle">				
		<li class="icn_folder"><a href="index.php?do=ipucu_ekle">İpucu Ekle</a></li>				
		<li class="icn_photo"><a href="index.php?do=ipuclari">İpucları Düzenle</a></li>	
	</ul>	
	
	<hr/>	
	<h3>Admin</h3>		
	<ul class="toggle">				
		<li class="icn_settings"><a href="index.php?do=ayarlar">Genel Ayarlar</a></li>			
		<li class="icn_jump_back"><a href="index.php?do=cikis_yap">Çıkış Yap</a></li>		
	</ul>		
	
	<footer>		
		<hr />		
		<p><strong>Copyright &copy; 2015 - <?php echo SITE_BASLIK; ?></strong></p>		
		<p><strong>Site Kodlayan <a target="_blank" href="http://hatosbilisim.com/>">Osman Yavuz</a></strong></p>			
	</footer>
	
</aside>

<section id="main" class="column">	
	<?php			
		$do = g("do");		
		if (file_exists("inc/{$do}.php")){			
			require("inc/{$do}.php");		
		}else {			
			require("inc/anasayfa.php");		
		}		
	?>
</section>

<div class="spacer"></div>