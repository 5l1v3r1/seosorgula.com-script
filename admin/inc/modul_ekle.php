<?php echo !defined("ADMIN") ? die("Hacking?") : null; ?>
<article class="module width_full">
	<header><h3>Modül Ekle</h3></header>
		<?php
		
			if ($_POST){
				
				$modul_baslik = p("modul_baslik");
				$modul_aciklama = p("modul_aciklama");
				$modul_cozum = p("modul_cozum");
				$modul_onay = p("modul_onay");
				
				if (!$modul_baslik){
					echo '<h4 class="alert_error">Gerekli alanları doldurmalısınız..</h4>';
				}else {
				
					$query = query("SELECT modul_id FROM sorgu_modulleri WHERE modul_baslik = '$modul_baslik'");
					if (mysql_affected_rows()){
						echo '<h4 class="alert_error">Böyle Modül bulunuyor, başka bir Modül yazmayı deneyin..</h4>';
					}else {
					
						$insert = query("INSERT INTO sorgu_modulleri SET
						modul_baslik = '$modul_baslik',
						modul_aciklama = '$modul_aciklama',
						modul_cozum = '$modul_cozum',
						modul_onay = '$modul_onay'
						");
						
						if ($insert){
							echo '<h4 class="alert_success">Modül başarıyla eklendi.. Yönlendiriliyorsunuz..</h4>';
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
					<input type="text" name="modul_baslik" value="" />
				</fieldset>
				<fieldset>
					<label>Modül Açıklama</label>
					<textarea rows="6" name="modul_aciklama"></textarea>
				</fieldset>
				<fieldset>
					<label>Modül Çözüm</label>
					<textarea rows="6" name="modul_cozum"></textarea>
				</fieldset>
				<fieldset>
						<select name="modul_onay" >
							<option value="1">Onaylı</option>
							<option value="2">Onaylı Değil</option>
						</select>
				</fieldset>
			</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="Modül Ekle" class="alt_btn">
				</div>
			</footer>
		</form>
</article>

<div class="spacer"></div>