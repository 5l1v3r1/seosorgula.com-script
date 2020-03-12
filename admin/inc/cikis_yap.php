<?php
	echo !defined("ADMIN") ? die("Hacking?") : null;
	session_destroy();
	go(URL."/admin",1);
?>
<h4 class="alert_success">Başarıyla çıkış yaptınız.. Yönlendiriliyorsunuz..</h4>