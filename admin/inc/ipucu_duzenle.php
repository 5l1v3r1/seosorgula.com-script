<?php echo !defined("ADMIN") ? die("Hacking?") : null; ?>

<?php

	$id = g("id");
	$query = query("SELECT * FROM ipuclari WHERE ipucu_id = '$id'");
	if (mysql_affected_rows() < 1){
		go(URL."/admin/index.php?do=ipuclari");
		exit;
	}
	
	$row = row($query);

?>
<article class="module width_full">
	<header><h3>İpucu Duzenle</h3></header>
		<?php
		
			if ($_POST){
				
				$ipucu_icerik = p("ipucu_icerik");
				$ipucu_onay = p("ipucu_onay");
				
				if (!$ipucu_icerik){
					echo '<h4 class="alert_error">Gerekli alanları doldurmalısınız..</h4>';
				}else {
				
					$query = query("SELECT ipucu_id FROM ipuclari WHERE ipucu_icerik = '$ipucu_icerik' && ipucu_id != '$id'");
					if (mysql_affected_rows()){
						echo '<h4 class="alert_error">Böyle bir ipucu bulunuyor, başka bir ipucu yazmayı deneyin..</h4>';
					}else {
					
						$insert = query("UPDATE ipuclari SET
						ipucu_icerik = '$ipucu_icerik',
						ipucu_onay = '$ipucu_onay'
						WHERE ipucu_id = '$id'");
						
						if ($insert){
							echo '<h4 class="alert_success">İpucu başarıyla güncellendi.. Yönlendiriliyorsunuz..</h4>';
							go(URL."/admin/index.php?do=ipuclari", 1);
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
					<label>Mesaj İçerik</label>
					<textarea rows="6" name="ipucu_icerik"><?php echo ss($row["ipucu_icerik"]) ?></textarea>
				</fieldset>
				<fieldset>
						<select name="ipucu_onay" >
							<option value="1" <?php echo $row["ipucu_onay"] == 1 ? 'selected' : null; ?>>Onaylı</option>
							<option value="2" <?php echo $row["ipucu_onay"] == 2 ? 'selected' : null; ?>>Onaylı Değil</option>
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