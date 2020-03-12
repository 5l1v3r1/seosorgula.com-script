<?php echo !defined("ADMIN") ? die("Hacking?") : null; ?>

<article  class="module width_3_quarter" style="padding-bottom: 20px; width: 95%">
<header>
<div style="float: right; font-size: 14px; font-weight: bold; padding: 6px 10px">
	<a href="<?php echo URL; ?>/admin/index.php?do=modul_ekle">Modül Ekle</a>
</div>
<h3 class="tabs_involved">
Sorgu Modülleri
</h3></header>
<div class="tab_container">
	
	<?php
	$query = query("SELECT * FROM sorgu_modulleri ORDER BY modul_id DESC");
	if (mysql_affected_rows()){
	?>
	
	<div id="tab1" class="tab_content">
	<table class="tablesorter" cellspacing="0"> 
	<thead> 
		<tr> 
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
			<td width="400"><?php echo ss($row["modul_baslik"]); ?></td>
			<td>
				<?php echo $row["modul_onay"] == 1 ? '<font color=green>Onaylı</font>' : null; ?>
				<?php echo $row["modul_onay"] == 2 ? '<font color=red>Onaylı Değil</font>' : null; ?>
			</td>
			<td><?php echo $row["modul_tarih"]; ?></td> 
			<td>
				<a href="<?php echo URL; ?>/admin/index.php?do=modul_duzenle&id=<?php echo $row["modul_id"]; ?>" title="Düzenle"><img src="images/icn_edit.png" alt=""/></a>
				<a onclick="return confirm('Modulu Silmek İstediğinize Emin misiniz?');" style="margin-left: 10px" href="<?php echo URL; ?>/admin/index.php?do=modul_sil&id=<?php echo $row["modul_id"]; ?>" title="Sil"><img src="images/icn_trash.png" alt=""/></a>
			</td> 
		</tr>
		<?php } ?>
	</tbody> 
	</table>
	</div>
	
	<?php }else { ?>
	<h4 class="alert_info">Siteye henüz hiç modül eklenmemiş.</h4>
	<?php } ?>
	
</div>
</article>