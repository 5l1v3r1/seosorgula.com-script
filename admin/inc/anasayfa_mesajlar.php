<?php echo !defined("ADMIN") ? die("Hacking?") : null; ?>

<article  class="module width_3_quarter" style="padding-bottom: 20px; width: 95%">
<header>
<div style="float: right; font-size: 14px; font-weight: bold; padding: 6px 10px">
	<a href="<?php echo URL; ?>/admin/index.php?do=anasayfa_mesaj_ekle">Anasayfa Mesaj Ekle</a>
</div>
<h3 class="tabs_involved">
Anasayfa Mesajlar
</h3></header>
<div class="tab_container">
	
	<?php
	$query = query("SELECT * FROM anasayfa_mesaj ORDER BY id DESC");
	if (mysql_affected_rows()){
	?>
	
	<div id="tab1" class="tab_content">
	<table class="tablesorter" cellspacing="0"> 
	<thead> 
		<tr> 
			<th width="20px"></th> 
			<th>Başlığı</th>
			<th>Onay Durumu</th>
			<th>Tarih</th> 
			<th>İşlemler</th> 
		</tr> 
	</thead> 
	<tbody> 
		<?php
			while ($row = row($query)){
		?>
		<tr> 
			<td><input type="checkbox"></td> 
			<td width="400"><?php echo ss($row["icerik"]); ?></td>
			<td>
				<?php echo $row["mesaj_onay"] == 1 ? 'Onaylı' : null; ?>
				<?php echo $row["mesaj_onay"] == 2 ? '<font color=red>Onaylı Değil</font>' : null; ?>
			</td>
			<td><?php echo $row["tarih"]; ?></td> 
			<td>
				<a href="<?php echo URL; ?>/admin/index.php?do=anasayfa_mesaj_duzenle&id=<?php echo $row["id"]; ?>" title="Düzenle"><img src="images/icn_edit.png" alt=""/></a>
				<a onclick="return confirm('Mesajı Silmek İstediğinize Emin misiniz?');" style="margin-left: 10px" href="<?php echo URL; ?>/admin/index.php?do=anasayfa_mesaj_sil&id=<?php echo $row["id"]; ?>" title="Sil"><img src="images/icn_trash.png" alt=""/></a>
			</td> 
		</tr>
		<?php } ?>
	</tbody> 
	</table>
	</div>
	
	<?php }else { ?>
	<h4 class="alert_info">Siteye henüz hiç mesaj eklenmemiş.</h4>
	<?php } ?>
	
</div>
</article>