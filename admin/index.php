<?php
	define("GUVENLIK", true);
	require_once "../sistem/ayar.php";
	require_once "../sistem/fonksiyon.php";
	define("ADMIN", true);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title><?php echo SITE_BASLIK; ?> - YÖNETİM PANELİ</title>
	<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo TEMA_URL; ?>/assets/images/icon.ico" />
    <link rel="icon" type="image/png" href="<?php echo TEMA_URL; ?>/assets/images/icon.ico">
	<link rel="stylesheet" href="css/layout.css" type="text/css" media="screen" />
	<script src="js/jquery-1.5.2.min.js" type="text/javascript"></script>
	<script src="ckeditor/ckeditor.js" type="text/javascript"></script>
	<script src="ckeditor/adapters/jquery.js" type="text/javascript"></script>
	<script src="js/hideshow.js" type="text/javascript"></script>
	<script src="js/jquery.tablesorter.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="js/jquery.equalHeight.js"></script>
	<script type="text/javascript">
	$(document).ready(function() 
    	{ 
      	  $(".tablesorter").tablesorter(); 
   	 } 
	);
	$(document).ready(function() {
	
	$("textarea.OEditor").ckeditor();

	//When page loads...
	$(".tab_content").hide(); //Hide all content
	$("ul.tabs li:first").addClass("active").show(); //Activate first tab
	$(".tab_content:first").show(); //Show first tab content

	//On Click Event
	$("ul.tabs li").click(function() {

		$("ul.tabs li").removeClass("active"); //Remove any "active" class
		$(this).addClass("active"); //Add "active" class to selected tab
		$(".tab_content").hide(); //Hide all tab content

		var activeTab = $(this).find("a").attr("href"); //Find the href attribute value to identify the active tab + content
		$(activeTab).fadeIn(); //Fade in the active ID content
		return false;
	});

});
    </script>
    <script type="text/javascript">
    $(function(){
        $('.column').equalHeight();
    });
</script>
<script language="javascript">
	function ChangeCode(){
		var NewSecurity= "<img src='security.php?rnd="+Math.random()+"' alt='guvenlik' style='border: 1px solid #999999;' />";
		$("#security").html(NewSecurity);
		return false;
	}
</script>
</head>
<body>
<?php

	if (session("login") && session("uye_rutbe") == 1){
		require_once "inc/default.php";
	}else {
		
	if($_POST){
		session_start();

		$girilen_kod	= trim(strip_tags($_POST['security']));
		$guvenlik_kodu	= trim(strip_tags($_SESSION['koruma']));

		if($girilen_kod != $guvenlik_kodu)
		{
			$sonuc = '<span style="color:darkred;">Güvenlik Kodu Yanlış</span>';
		}
		else
		{
			
			$eposta = p("eposta");
			$sifre = md5("seo_".p("sifre"));
			
			if (!$eposta || !$sifre){
				$sonuc = '<span style="color:darkred;">Kullanıcı adı ve Şifre Boş Bırakılamaz..</span>';
			}else {
				$query = query("SELECT * FROM uyeler WHERE uye_eposta = '$eposta' && uye_sifre = '$sifre' && uye_rutbe = 1");
				if (mysql_affected_rows()){
					$row = row($query);
					$session = array(
								"login" => true,
								"uye_id" => $row["uye_id"],
								"uye_rutbe" => $row["uye_rutbe"],
								"uye_adi" => $row["uye_adi"],
								"uye_eposta" => $row["uye_eposta"]
									);
					session_olustur($session);
					$sonuc = '<span style="color:darkgreen;">Başarılı bir şekilde giriş yaptınız..</span>';
					go(URL."/admin",1);
				}else {
						$sonuc = '<span style="color:darkred;">Eposta veya Şifre Hatalı!</span>';
						go(URL."/admin");
				}
			}
		}
	}
?>
		<div id="giris_yap">
		<form action="" method="POST">
			<table cellpadding="0" cellspacing="0">
				<tr>
					<td style="font-weight:bold;">Eposta:</td>
					<td><input type="text" name="eposta" /></td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Şifre:</td>
					<td><input type="password" name="sifre" /></td>
				</tr>
				<tr>
					<td style="font-weight:bold;">Güvenlik:</td>
					<td>
					<div id="security"><img src="security.php" alt="guvenlik" style="border: 1px solid #999999;"></div>
					</td>
				</tr>
				<tr>
					<th></th>
					<td><input type="text" name="security"/></td>
				</tr>
				<tr>
					<td><button type="submit" name="giris">Giriş Yap</button></td>
					<td><?php echo $sonuc; ?></td>
				</tr>
			</table>
		</form>
		</div>
<?php } ?>
</body>
</html>