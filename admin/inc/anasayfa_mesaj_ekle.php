<?php echo !defined("ADMIN") ? die("Hacking?") : null; ?>
<article class="module width_full">
	<header><h3>Anasayfa Mesaj Ekle</h3></header>
		<?php
		
			if ($_POST){
				
				$icerik = p("icerik");
				$mesaj_onay = p("mesaj_onay");
				
				if (!$icerik){
					echo '<h4 class="alert_error">Mesaj girmelisiniz..</h4>';
				}else {
				
					$query = query("SELECT id FROM anasayfa_mesaj WHERE icerik = '$icerik'");
					if (mysql_affected_rows()){
						echo '<h4 class="alert_error">Böyle mesaj bulunuyor, başka bir mesaj yazmayı deneyin..</h4>';
					}else {
					
						$insert = query("INSERT INTO anasayfa_mesaj SET
						icerik = '$icerik'");
						
						if ($insert){
							echo '<h4 class="alert_success">Mesaj başarıyla eklendi.. Yönlendiriliyorsunuz..</h4>';
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
					<label>MESAJ İÇERİĞİ</label>
					<textarea rows="10" name="icerik"></textarea>
				</fieldset>
			</div>
			<footer>
				<div class="submit_link">
					<input type="submit" value="Mesajı Ekle" class="alt_btn">
				</div>
			</footer>
		</form>
</article>

<div class="spacer"></div>