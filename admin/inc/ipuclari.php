<?php echo !defined("ADMIN") ? die("Hacking?") : null; ?>

<article  class="module width_3_quarter" style="padding-bottom: 20px; width: 95%">
<header>
<div style="float: right; font-size: 14px; font-weight: bold; padding: 6px 10px">
	<a href="<?php echo URL; ?>/admin/index.php?do=ipucu_ekle">İpucu Ekle</a>
</div>
<h3 class="tabs_involved">
İpucları
</h3></header>
<div class="tab_container">
	
	<?php
	$query = query("SELECT * FROM ipuclari ORDER BY ipucu_id DESC");
	if (mysql_affected_rows()){
	?>
	
	<div id="tab1" class="tab_content">
	<table class="tablesorter" cellspacing="0"> 
	<thead> 
		<tr> 
			<th width="20px"></th> 
			<th>İçeriği</th>
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
			<td width="400"><?php echo ss($row["ipucu_icerik"]); ?></td>
			<td>
				<?php echo $row["ipucu_onay"] == 1 ? '<font color=green>Onaylı</font>' : null; ?>
				<?php echo $row["ipucu_onay"] == 2 ? '<font color=red>Onaylı Değil</font>' : null; ?>
			</td>
			<td><?php echo $row["ipucu_tarih"]; ?></td> 
			<td>
				<a href="<?php echo URL; ?>/admin/index.php?do=ipucu_duzenle&id=<?php echo $row["ipucu_id"]; ?>" title="Düzenle"><img src="images/icn_edit.png" alt=""/></a>
				<a onclick="return confirm('İpucunu Silmek İstediğinize Emin misiniz?');" style="margin-left: 10px" href="<?php echo URL; ?>/admin/index.php?do=ipucu_sil&id=<?php echo $row["ipucu_id"]; ?>" title="Sil"><img src="images/icn_trash.png" alt=""/></a>
			</td> 
		</tr>
		<?php } ?>
	</tbody> 
	</table>
	</div>
	
	<?php }else { ?>
	<h4 class="alert_info">Siteye henüz hiç ipucu eklenmemiş.</h4>
	<?php } ?>
	
</div>
</article>