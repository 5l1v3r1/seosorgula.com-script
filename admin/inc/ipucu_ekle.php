<?php echo !defined("ADMIN") ? die("Hacking?") : null; ?>
<article class="module width_full">
	<header><h3>İpucu Ekle</h3></header>
		<?php
		
			if ($_POST){
				
				$ipucu_icerik = p("ipucu_icerik");
				
				if (!$ipucu_icerik){
					echo '<h4 class="alert_error">İçerik girmelisiniz..</h4>';
				}else {
				
					$query = query("SELECT ipucu_id FROM ipuclari WHERE ipucu_icerik = '$ipucu_icerik'");
					if (mysql_affected_rows()){
						echo '<h4 class="alert_error">Böyle bir ipucu bulunuyor, başka bir ipucu yazmayı deneyin..</h4>';
					}else {
					
						$insert = query("INSERT INTO ipuclari SET
						ipucu_icerik = '$ipucu_icerik',
						ipucu_onay = 1");
						
						if ($insert){
							echo '<h4 class="alert_success">İpucu başarıyla eklendi.. Yönlendiriliyorsunuz..</h4>';
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
					<label>MESAJ İÇERİĞİ</label>
					<textarea rows="10" name="ipucu_icerik"></textarea>
				</fieldset>
			</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="İpucu Ekle" class="alt_btn">
				</div>
			</footer>
		</form>
</article>

<div class="spacer"></div>