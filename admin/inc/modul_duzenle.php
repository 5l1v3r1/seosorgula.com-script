<?php echo !defined("ADMIN") ? die("Hacking?") : null; ?>

<?php

	$id = g("id");
	$query = query("SELECT * FROM sorgu_modulleri WHERE modul_id = '$id'");
	if (mysql_affected_rows() < 1){
		go(URL."/admin/index.php?do=moduller");
		exit;
	}
	
	$row = row($query);

?>
<article class="module width_full">
	<header><h3>Modül Duzenle</h3></header>
		<?php
		
			if ($_POST){
				
				$modul_baslik = p("modul_baslik");
				$modul_aciklama = p("modul_aciklama");
				$modul_cozum = p("modul_cozum");
				$modul_onay = p("modul_onay");
				
				if (!$modul_baslik){
					echo '<h4 class="alert_error">Gerekli alanları doldurmalısınız..</h4>';
				}else {
				
					$query = query("SELECT modul_id FROM sorgu_modulleri WHERE modul_baslik = '$modul_baslik' && modul_id != '$id'");
					if (mysql_affected_rows()){
						echo '<h4 class="alert_error">Böyle bir modül bulunuyor, başka bir modül yazmayı deneyin..</h4>';
					}else {
					
						$insert = query("UPDATE sorgu_modulleri SET
						modul_baslik = '$modul_baslik',
						modul_aciklama = '$modul_aciklama',
						modul_cozum = '$modul_cozum',
						modul_onay = '$modul_onay'
						WHERE modul_id = '$id'");
						
						if ($insert){
							echo '<h4 class="alert_success">Modül başarıyla güncellendi.. Yönlendiriliyorsunuz..</h4>';
							go(URL."/admin/index.php?do=moduller", 1);
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
					<label>Modül Başlık</label>
					<input type="text" name="modul_baslik" value="<?php echo ss($row["modul_baslik"]); ?>" />
				</fieldset>
				<fieldset>
					<label>Modül Açıklama</label>
					<textarea rows="6" name="modul_aciklama"><?php echo ss($row["modul_aciklama"]) ?></textarea>
				</fieldset>
				<fieldset>
					<label>Modül Çözüm</label>
					<textarea rows="6" name="modul_cozum"><?php echo ss($row["modul_cozum"]) ?></textarea>
				</fieldset>
				<fieldset>
						<select name="modul_onay" >
							<option value="1" <?php echo $row["modul_onay"] == 1 ? 'selected' : null; ?>>Onaylı</option>
							<option value="2" <?php echo $row["modul_onay"] == 2 ? 'selected' : null; ?>>Onaylı Değil</option>
						</select>
				</fieldset>
			</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="Modül Güncelle" class="alt_btn">
				</div>
			</footer>
		</form>
</article>

<div class="spacer"></div>