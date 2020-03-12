<?
include '../guvenlik.php';
$url = guvenlik($_POST['url']);
echo '<img src="http://img.bitpixels.com/getthumbnail?code=76182&size=200&url='.$url.'" width="198">';
?>