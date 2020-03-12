<?php echo !defined("ADMIN") ? die("Hacking?") : null; ?>

<?php

	$id = g("id");
	$query = query("SELECT * FROM anasayfa_mesaj WHERE id = '$id'");
	if (mysql_affected_rows() < 1){
		go(URL."/admin/index.php?do=anasayfa_mesajlar");
		exit;
	}
	
	$row = row($query);

?>
<article class="module width_full">
	<header><h3>Mesaj Duzenle</h3></header>
		<?php
		
			if ($_POST){
				
				$icerik = p("icerik");
				$mesaj_onay = p("mesaj_onay");
				
				if (!$icerik){
					echo '<h4 class="alert_error">Gerekli alanları doldurmalısınız..</h4>';
				}else {
				
					$query = query("SELECT id FROM anasayfa_mesaj WHERE icerik = '$icerik' && id != '$id'");
					if (mysql_affected_rows()){
						echo '<h4 class="alert_error">Böyle bir mesaj bulunuyor, başka bir mesaj yazmayı deneyin..</h4>';
					}else {
					
						$insert = query("UPDATE anasayfa_mesaj SET
						icerik = '$icerik',
						mesaj_onay = '$mesaj_onay'
						WHERE id = '$id'");
						
						if ($insert){
							echo '<h4 class="alert_success">Mesaj başarıyla güncellendi.. Yönlendiriliyorsunuz..</h4>';
							go(URL."/admin/index.php?do=anasayfa_mesajlar", 1);
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
					<textarea rows="6" name="icerik"><?php echo ss($row["icerik"]) ?></textarea>
				</fieldset>
				<fieldset>
						<select name="mesaj_onay" >
							<option value="1" <?php echo $row["mesaj_onay"] == 1 ? 'selected' : null; ?>>Onaylı</option>
							<option value="2" <?php echo $row["mesaj_onay"] == 2 ? 'selected' : null; ?>>Onaylı Değil</option>
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