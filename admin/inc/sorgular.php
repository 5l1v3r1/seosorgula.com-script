<?php echo !defined("ADMIN") ? die("Hacking?") : null; ?>
<article  class="module width_3_quarter" style="padding-bottom: 20px; width: 95%">
<header>
<div style="float: right; font-size: 14px; font-weight: bold; padding: 6px 10px">
</div>
<h3 class="tabs_involved">
Son Sorgular
</h3></header>
<div class="tab_container">
<?php
	$query = query("SELECT * FROM sorgular ORDER BY sorgu_tarih DESC LIMIT 1000");
	if (mysql_affected_rows()){
	?>
	<div id="tab1" class="tab_content">
	<table class="tablesorter" cellspacing="0"> 
	<thead> 
		<tr> 
			<th>URL Adresi</th>
			<th>Sorgulayan IP</th>
			<th>Sorgu Sayac</th>
			<th>Tarihi</th>
			<th>İşlemler</th> 
		</tr> 
	</thead> 
	<tbody> 
		<?php
			while ($row = row($query)){
		?>
		<tr> 
			<td><?php echo $row["sorgu_url"]; ?></td>
			<td><?php echo ss($row["sorgu_ip"]); ?></td>
			<td><?php echo $row["sorgu_tekrar"]; ?></td> 
			<td><?php echo $row["sorgu_tarih"]; ?></td> 
			<td>
				<a onclick="return confirm('Sorguyu Silmek İstediğinize Emin misiniz?');" style="margin-left: 10px" href="<?php echo URL; ?>/admin/index.php?do=sorgu_id&id=<?php echo $row["sorgu_id"]; ?>" title="Sil"><img src="images/icn_trash.png" alt=""/></a>
			</td> 
		</tr>
		<?php } ?>
	</tbody> 
	</table>
	</div>
	
	<?php }else { ?>
	<h4 class="alert_info">Hiç sorgu yapılmamış.</h4>
	<?php } ?>
	
</div>
</article>