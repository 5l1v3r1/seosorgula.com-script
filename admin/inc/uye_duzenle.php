<?php echo !defined("ADMIN") ? die("Hacking?") : null; ?>

<?php

	$id = g("id");
	$query = query("SELECT * FROM uyeler WHERE uye_id = '$id'");
	if (mysql_affected_rows() < 1){
		go(URL."/admin");
		exit;
	}
	
	$row = row($query);

?>
<article class="module width_full">
	<header><h3>Üye Düzenle</h3></header>
		<?php
		
			if ($_POST){
				
				$uye_kadi = p("uye_kadi");
				$uye_link = sef_link($uye_kadi);
				if (p("uye_sifre")){
					$uye_sifre = md5("seo_".p("uye_sifre"));
				}else {
					$uye_sifre = $row["uye_sifre"];
				}
				$uye_eposta = p("uye_eposta");
				$uye_avatar = p("uye_avatar");
				$uye_cinsiyet = p("uye_cinsiyet");
				$uye_hakkinda = p("uye_hakkinda");
				$uye_website = p("uye_website");
				$uye_rutbe = p("uye_rutbe");
				$uye_onay = p("uye_onay");
				$uye_adi = p("uye_adi");
				
				if (!$uye_kadi || !$uye_sifre || !$uye_eposta || !$uye_adi){
					echo '<h4 class="alert_error">Tüm alanları doldurmanız gerekiyor..</h4>';
				}else {
				
					$varmi = query("SELECT * FROM uyeler WHERE uye_link = '$uye_link' && uye_id != '$id'");
					if (mysql_affected_rows()){
						echo '<h4 class="alert_error"><strong>'.ss($uye_kadi).'</strong> adlı üye zaten bulunuyor, başka bir tane deneyin.</h4>';
					}else {
					
						$update = query("UPDATE uyeler SET
						uye_kadi = '$uye_kadi',
						uye_link = '$uye_link',
						uye_sifre = '$uye_sifre',
						uye_eposta = '$uye_eposta',
						uye_avatar = '$uye_avatar',
						uye_cinsiyet = '$uye_cinsiyet',
						uye_hakkinda = '$uye_hakkinda',
						uye_rutbe = '$uye_rutbe',
						uye_website = '$uye_website',
						uye_adi = '$uye_adi',
						uye_onay = '$uye_onay'
						WHERE uye_id = '$id'");
						
						if ($update){
							echo '<h4 class="alert_success">Üye başarıyla güncellendi.. Yönlendiriliyorsunuz..</h4>';
							go(URL."/admin/index.php?do=uyeler", 1);
						}else {
							echo '<h4 class="alert_error">Mysql Hatası: '.mysql_Error().'</h4>';
						}
					
					}
				
				}
				
			}
		
		?>
		<form action="" method="post">
			<div class="module_content">
				<fieldset>
					<label>ÜYE ADI SOYADI</label>
					<input type="text" name="uye_adi" value="<?php echo ss($row["uye_adi"]); ?>" />
				</fieldset>
				<fieldset>
					<label>ÜYE KULLANICI ADI</label>
					<input type="text" name="uye_kadi" value="<?php echo ss($row["uye_kadi"]); ?>" />
				</fieldset>
				<fieldset>
					<label>ÜYE ŞİFRE</label>
					<input type="text" name="uye_sifre" />
				</fieldset>
				<fieldset>
					<label>ÜYE E-POSTA</label>
					<input type="text" name="uye_eposta" value="<?php echo ss($row["uye_eposta"]); ?>" />
				</fieldset>
				<fieldset>
					<label>ÜYE AVATAR(link)</label>
					<input type="text" name="uye_avatar" value="<?php echo ss($row["uye_avatar"]); ?>" />
				</fieldset>
				<fieldset>
					<label>ÜYE CİNSİYET</label>
					<select name="uye_cinsiyet">
						<option value="1" <?php echo $row["uye_cinsiyet"] == 1 ? 'selected' : null; ?>>Erkek</option>
						<option value="2" <?php echo $row["uye_cinsiyet"] == 2 ? 'selected' : null; ?>>Kadın</option>
					</select>
				</fieldset>
				<fieldset>
					<label>Üye Hakkında</label>
					<textarea rows="5" name="uye_hakkinda"><?php echo ss($row["uye_hakkinda"]); ?></textarea>
				</fieldset>
				<fieldset>
					<label>ÜYE WEBSITE</label>
					<input type="text" name="uye_website" value="<?php echo ss($row["uye_website"]); ?>" />
				</fieldset>
				<fieldset>
					<label>ÜYE RÜTBE</label>
					<select name="uye_rutbe">
						<option value="1" <?php echo $row["uye_rutbe"] == 1 ? 'selected' : null; ?>>Yönetici</option>
						<option value="2" <?php echo $row["uye_rutbe"] == 2 ? 'selected' : null; ?>>Üye</option>
					</select>
				</fieldset>
				<fieldset>
					<label>ÜYE ONAY</label>
					<select name="uye_onay">
						<option value="1" <?php echo $row["uye_onay"] == 1 ? 'selected' : null; ?>>Onaylı</option>
						<option value="0" <?php echo $row["uye_onay"] == 0 ? 'selected' : null; ?>>Onaylı Değil</option>
					</select>
				</fieldset>
			</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="Düzenlemeyi Bitir" class="alt_btn">
				</div>
			</footer>
		</form>
</article>

<div class="spacer"></div>