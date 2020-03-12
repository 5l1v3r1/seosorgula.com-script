<?php echo !defined("ADMIN") ? die("Hacking?") : null; ?>
<?php

	$id = g("id");
	$query = query("SELECT * FROM iletisim_kutusu WHERE iletisim_id = '$id'");
	if (mysql_affected_rows() < 1){
		go(URL."/admin/index.php?do=mesajlar");
		exit;
	}
	
	$row = row($query);

?>
<article class="module width_full">
	<header><h3>Gelen Mesaj</h3></header>
	<?php
		
			if ($_POST){
				
				
				$iletisim_durumu = p("iletisim_durumu");
				
			
						$insert = query("UPDATE iletisim_kutusu SET
						iletisim_durumu = '$iletisim_durumu'
						WHERE iletisim_id = '$id'");
						
						if ($insert){
							echo '<h4 class="alert_success">Mesaj başarıyla güncellendi.. Yönlendiriliyorsunuz..</h4>';
							go(URL."/admin/index.php?do=mesajlar", 1);
						}else {
							echo '<h4 class="alert_error">Mysql Hatası: '.mysql_Error().'</h4>';
						}
				
			}
		
		?>
	<form action="" method="post">
			<div class="module_content">
				<fieldset>
					<label>Gönderen Adı Soyadı</label>
					<input type="text" value="<?php echo ss($row["iletisim_adsoyad"]) ?>" />
				</fieldset>
				<fieldset>
					<label>Konusu</label>
					<input type="text" value="<?php echo ss($row["iletisim_konu"]) ?>" />
				</fieldset>
				<fieldset>
					<label>Gönderen E-posta</label>
					<input type="text" value="<?php echo ss($row["iletisim_eposta"]) ?>" />
				</fieldset>
				<fieldset>
					<label>Mesaj İçerik</label>
					<textarea rows="6" name="icerik"><?php echo ss($row["iletisim_icerik"]) ?></textarea>
				</fieldset>
				<fieldset>
					<label>IP Adresi</label>
					<input type="text" value="<?php echo ss($row["iletisim_ip"]) ?>" />
				</fieldset>
				<fieldset>
					<label>Tarih</label>
					<input type="text" value="<?php echo ss($row["iletisim_tarih"]) ?>" />
				</fieldset>
				<fieldset>
				<label>Mesajı Okundu Olarak Seç</label>
						<select name="iletisim_durumu" >
							<option value="1" <?php echo $row["iletisim_durumu"] == 1 ? 'selected' : null; ?>>Okudum</option>
							<option value="0" <?php echo $row["iletisim_durumu"] == 0 ? 'selected' : null; ?>>Okumadım!</option>
						</select>
				</fieldset>
			</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="Mesajı Güncelle" class="alt_btn">
				</div>
			</footer>
			</form>
</article>

<div class="spacer"></div>