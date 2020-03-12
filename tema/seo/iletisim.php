<?php 

	if($_POST){
		
		$adSoyad = p("adSoyad");
		$eposta = p("eposta");
		$konu = p("konu");
		$icerik = p("icerik");
		
		
			if(!$adSoyad || !$eposta || !$konu || !$icerik){
				$sonuc = '<div class="alert alert-danger" role="alert">(*) olan tüm alanları doldurmanız gerekiyor..</div>';
			}else{
				if(strpos($eposta,"@")){
					$ip_adresi = IP();
					
					$query = query("INSERT INTO iletisim_kutusu SET
					iletisim_adsoyad = '$adSoyad',
					iletisim_eposta = '$eposta',
					iletisim_konu = '$konu',
					iletisim_icerik = '$icerik',
					iletisim_ip = '$ip_adresi'
					");
					
					if(mysql_affected_rows()){
						$sonuc = '<div class="alert alert-success" role="alert">Mesajınız başarıyla gönderildi.. İlginiz için teşekkür ederiz.</div>';
					}else{
						$sonuc = '<div class="alert alert-warning" role="alert">Mesajınız gönderilemedi..</div>';
					}
				
				}else{
					$sonuc = '<div class="alert alert-danger" role="alert">Eposta biçiminiz doğru değildir..</div>';
				}	
			}
	}

?>
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8">
	<div class="contact">
		<h2>İletişim | <?php echo SITE_TITLE; ?></h2>
		
		<?php
			/*if(!empty(SITE_MAIL)){
				echo '<strong style="font-size:14px">Eposta Adresimiz: </strong> <span style="font-size:14px">'.SITE_MAIL.'</span>';
				echo '<br/>';
				echo '<br/>';
			}
			if(!empty(SITE_TELEFON)){
				echo '<strong style="font-size:14px">Telefon Adresimiz: </strong> <span style="font-size:14px">'.SITE_TELEFON.'</span>';
				echo '<br/>';
				echo '<br/>';
			}*/
		?>
		<div class="alert alert-info" role="alert" style="font-size:15px">
			<strong>Bilgi!</strong> Burada vereceğiniz bilgiler hiçbir kimseyle paylaşılmaz. (*) alanları doldurmalısınız.
		</div>
		<?php echo $sonuc; ?>
		<form action="" method="POST">
			<ul>
				<li><strong>Ad Soyad</strong>(*)</li>
				<li>
					<div class="input-group col-md-5">
					  <input type="text" name="adSoyad" class="form-control textbox" placeholder="Adınız ve Soyadınız" aria-describedby="basic-addon1">
					</div>
				</li>
				<li><strong>Eposta</strong>(*)</li>
				<li>
					<div class="input-group col-md-5">
					  <input type="text" name="eposta" class="form-control textbox" placeholder="Eposta Adresiniz" aria-describedby="basic-addon1">
					</div>
				</li>
				<li><strong>Konu</strong>(*)</li>
				<li>
					<select name="konu" class="form-control textbox">
						<option value="Reklam">Reklam</option>
						<option value="Hata(Bug)">Hata(Bug)</option>
						<option value="Diğer">Diğer</option>
					</select>
				</li>
				<li><strong>Mesaj</strong>(*)</li>
				<li>
					 <textarea style="width:100%" name="icerik" class="form-control textbox" rows="6" placeholder="Mesaj İçeriğiniz"></textarea>
				</li>
				<li><button type="submit" class="btn btn-primary">Gönder</button></li>
			</ul>
		</form>
	</div>
</div>
	<div class="col-md-2"></div>
</div>	