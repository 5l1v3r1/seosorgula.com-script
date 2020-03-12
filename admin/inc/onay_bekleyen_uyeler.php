<?php echo !defined("ADMIN") ? die("Hacking?") : null; ?>
<article  class="module width_3_quarter" style="padding-bottom: 20px; width: 95%">
<header>
<div style="float: right; font-size: 14px; font-weight: bold; padding: 6px 10px">
	<a href="<?php echo URL; ?>/admin/index.php?do=uye_ekle">Üye Ekle</a>
</div>
<h3 class="tabs_involved">
ONAY BEKLEYEN ÜYELER
</h3></header>
<div class="tab_container">
	
	<?php
	$sayfa = g("s") ? g("s") : 1;
	$ksayisi = rows(query("SELECT uye_id FROM uyeler WHERE uye_onay = 0"));
	$limit = 10;
	$ssayisi = ceil($ksayisi/$limit);
	$baslangic = ($sayfa * $limit) - $limit;
	$query = query("SELECT * FROM uyeler WHERE uye_onay = 0 ORDER BY uye_id DESC LIMIT $baslangic, $limit");
	if (mysql_affected_rows()){
	?>
	<form action="" method="post">
	<div id="tab1" class="tab_content">
	<table class="tablesorter" cellspacing="0"> 
	<thead> 
		<tr> 
			<th width="20px"></th> 
			<th>Kullanıcı Adı</th> 
			<th>E-Posta</th> 
			<th>Cinsiyet</th>
			<th>Rütbe</th>
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
			<td><input type="checkbox" name="yorumid[]" value="<?php echo $row["uye_id"]; ?>" ></td> 
			<td><?php echo ss($row["uye_kadi"]); ?></td> 
			<td><?php echo ss($row["uye_eposta"]); ?></td> 
			<td>
				<?php 
				
					if(ss($row["uye_cinsiyet"]) == 1){
						echo "Erkek";
					}else {
						echo "Kadın";
					}
					
				?>
			</td> 
			<td>
				<?php 
				
					if(ss($row["uye_rutbe"]) == 1){
						echo "Yönetici";
					}else {
						echo "Üye";
					}
					
				?>
			</td>
			<td>
				<?php 
				
					if(ss($row["uye_onay"]) == 1){
						echo "Onaylı";
					}else {
						echo "Onaylı Değil";
					}
					
				?>
			</td>
			<td><?php echo $row["uye_tarih"]; ?></td> 
			<td>
				<a href="<?php echo URL; ?>/admin/index.php?do=uye_duzenle&id=<?php echo $row["uye_id"]; ?>" title="Düzene"><img src="images/icn_edit.png" alt=""/></a>
				<a onclick="return confirm('<?php echo $row["uye_kadi"]; ?> İsimli Kullanıcıyı Silmek İstediğinize Emin misiniz?');" style="margin-left: 10px" href="<?php echo URL; ?>/admin/index.php?do=uye_sil&id=<?php echo $row["uye_id"]; ?>" title="Sil"><img src="images/icn_trash.png" alt=""/></a>
			</td> 
		</tr>
		<?php } ?>
	</tbody> 
	</table>
	<?php
		if ($_POST){
		
			$yorumid = $_POST["yorumid"];
			if (p("onay")){
				foreach ($yorumid as $id){
					$update = query("UPDATE uyeler SET 
					uye_onay = 1
					WHERE uye_id = '$id'");
				}
				echo '<h4 class="alert_success">Üye başarıyla onaylandı..</h4>';
				go(URL."/admin/index.php?do=uyeler",1);
			}elseif (p("sil")){
				foreach ($yorumid as $id){
					$delete = query("DELETE FROM uyeler WHERE uye_id = '$id'");
				}
				echo '<h4 class="alert_success">Üye başarıyla silindi..</h4>';
				go(URL."/admin/index.php?do=onay_bekleyen_uyeler",1);
			}
		
		}
	?>
	<div style="padding-top: 15px; padding-left: 15px">
		<button type="submit" name="onay" value="1">Seçilenleri Onayla</button>
		<button type="submit" name="sil" value="1">Seçilenleri Sil</button>
	</div>
	</form>
	<?php if ($ksayisi > $limit){ ?>
	<form action="" method="get">
		<input type="hidden" value="<?php echo g("do"); ?>" name="do" />
		<ul class="sayfala">
			<li><select name="s">
				<?php
					for ($i = 1; $i <= $ssayisi; $i++){
						echo '<option ';
						echo $i == $sayfa ? 'selected ' : null;
						echo 'value="'.$i.'">'.$i.'. Sayfa</option>';
					}
				?>
			</select></li>
			<li><button type="submit">GÖSTER</button></li>
		</ul>
		
	</form>
	<?php } ?>
	
	</div>
	
	<?php }else { ?>
	<h4 class="alert_info">Onay bekleyen üye bulunmuyor.</h4>
	<?php } ?>
	
</div>
</article>