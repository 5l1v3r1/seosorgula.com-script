<?php echo !defined("ADMIN") ? die("Hacking?") : null; ?>
<h4 class="alert_info">Hoşgeldiniz! Yönetici Paneline Admin Olarak Giriş Yaptınız.</h4>

<h4 class="alert_info">Toplam Kullanıcı: <?php echo rows(query("SELECT * FROM uyeler WHERE uye_onay = 1")); ?></h4>

<h4 class="alert_info">Toplam Sorgulanan Site: <?php echo rows(query("SELECT * FROM sorgular")); ?></h4>

<?php 

	$son = query("SELECT * FROM sorgular ORDER BY sorgu_tarih DESC LIMIT 1"); 
	$row = row($son);
?>
<h4 class="alert_info">Son Sorgulanan Site: <?php echo $row["sorgu_url"]; ?> - <?php echo $row["sorgu_tarih"]; ?> </h4>

