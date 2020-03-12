<?php
	
	echo !defined("ADMIN") ? die("Hacking?") : null;
	$query = query("SELECT * FROM ayarlar");
	$row = row($query);
	
?>

<article class="module width_full">
	<header><h3>Genel Ayarlar</h3></header>
		<?php
		
			if ($_POST){
				
				$site_url = p("site_url", true);
				$site_baslik = p("site_baslik", true);
				$site_desc = p("site_desc", true);
				$site_keyw = p("site_keyw", true);
				$site_durum = p("site_durum", true);
				$site_mail = p("site_mail", true);
				$site_telefon = p("site_telefon", true);
				$site_bakim_mesaj = p("site_bakim_mesaj", true);
				$site_footer_icerik = p("site_footer_icerik", true);
				$site_logo_url = p("site_logo_url", true);
				$site_favicon_url = p("site_favicon_url", true);
				$site_author = p("site_author", true);
				$site_publisher = p("site_publisher", true);
				$site_google_kod = p("site_google_kod", true);
				$site_alexa_kod = p("site_alexa_kod", true);
				
				
				if (!$site_url || !$site_baslik){
					echo '<h4 class="alert_error">Gerekli alanları doldurmanız gerekiyor..</h4>';
				}else {
				
					$update = query("UPDATE ayarlar SET
					site_url = '$site_url',
					site_baslik = '$site_baslik',
					site_desc = '$site_desc',
					site_keyw = '$site_keyw',
					site_durum = '$site_durum',
					site_mail = '$site_mail',
					site_telefon = '$site_telefon',
					site_bakim_mesaj = '$site_bakim_mesaj',
					site_footer_icerik = '$site_footer_icerik',
					site_logo_url = '$site_logo_url',
					site_favicon_url = '$site_favicon_url',
					site_author = '$site_author',
					site_publisher = '$site_publisher',
					site_google_kod = '$site_google_kod',
					site_alexa_kod = '$site_alexa_kod' WHERE site_id = 1
					");
					
					if ($update){
						echo '<h4 class="alert_success">Yeni ayarlar başarıyla kaydedildi.. Yönlendiriliyorsunuz..</h4>';
						go(URL."/admin/index.php?do=".g("do"), 1);
					}else {
						echo '<h4 class="alert_error">Mysql Hatası: '.mysql_Error().'</h4>';
					}
				
				}
				
			}
		
		?>
		<form action="" method="post">
			<div class="module_content">
					<fieldset>
						<label>SİTE URL</label>
						<input type="text" name="site_url" value="<?php echo $row["site_url"]; ?>" />
					</fieldset>
					<fieldset>
						<label>SİTE BAŞLIK</label>
						<input type="text" name="site_baslik" value="<?php echo ss($row["site_baslik"]); ?>" />
					</fieldset>
					<fieldset>
						<label>SİTE AÇIKLAMASI</label>
						<textarea rows="3" name="site_desc"><?php echo ss($row["site_desc"]); ?></textarea>
					</fieldset>
					<fieldset>
						<label>SİTE KEYWORDS</label>
						<textarea rows="3" name="site_keyw"><?php echo ss($row["site_keyw"]); ?></textarea>
					</fieldset>
					<fieldset>
						<label>SİTE LOGO URL</label>
						<input type="text" name="site_logo_url" value="<?php echo ss($row["site_logo_url"]); ?>" />
					</fieldset>
					<fieldset>
						<label>SİTE FAVICON URL</label>
						<input type="text" name="site_favicon_url" value="<?php echo ss($row["site_favicon_url"]); ?>" />
					</fieldset>
					<fieldset>
						<label>GOOGLE+ AUTHOR KOD</label>
						<input type="text" name="site_author" value="<?php echo ss($row["site_author"]); ?>" />
					</fieldset>
					<fieldset>
						<label>GOOGLE+ PUBLISHER KOD</label>
						<input type="text" name="site_publisher" value="<?php echo ss($row["site_publisher"]); ?>" />
					</fieldset>
					<fieldset>
						<label>GOOGLE WEBMAS. ONAY KOD</label>
						<input type="text" name="site_google_kod" value="<?php echo ss($row["site_google_kod"]); ?>" />
					</fieldset>
					<fieldset>
						<label>ALEXA ONAY KOD</label>
						<input type="text" name="site_alexa_kod" value="<?php echo ss($row["site_alexa_kod"]); ?>" />
					</fieldset>
					<fieldset>
						<label>SİTE MAİL</label>
						<input type="text" name="site_mail" value="<?php echo ss($row["site_mail"]); ?>" />
					</fieldset>
					<fieldset>
						<label>SİTE TELEFON</label>
						<input type="text" name="site_telefon" value="<?php echo ss($row["site_telefon"]); ?>" />
					</fieldset>
					<fieldset>
						<label>SİTE FOOTER İÇERİK</label>
						<textarea class="OEditor" rows="3" name="site_footer_icerik"><?php echo ss($row["site_footer_icerik"]); ?></textarea>
					</fieldset>
					<fieldset>
						<label>SİTE DURUMU</label>
						<select name="site_durum">
							<option value="1" <?php echo $row["site_durum"] ? 'selected' : null; ?>>Online</option>
							<option value="0" <?php echo !$row["site_durum"] ? 'selected' : null; ?>>Offline</option>
						</select>
					</fieldset>
					<fieldset>
						<label>SİTE BAKIM MESAJI</label>
						<textarea rows="3" name="site_bakim_mesaj"><?php echo ss($row["site_bakim_mesaj"]); ?></textarea>
					</fieldset>
			</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="Ayarları Güncelle" class="alt_btn">
				</div>
			</footer>
		</form>
</article>

<div class="spacer"></div>