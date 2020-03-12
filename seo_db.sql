-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 28 Haz 2015, 00:26:40
-- Sunucu sürümü: 5.6.24
-- PHP Sürümü: 5.6.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `seo_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anasayfa_mesaj`
--

CREATE TABLE IF NOT EXISTS `anasayfa_mesaj` (
  `id` int(11) NOT NULL,
  `icerik` text NOT NULL,
  `mesaj_onay` int(11) NOT NULL DEFAULT '2',
  `tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `anasayfa_mesaj`
--

INSERT INTO `anasayfa_mesaj` (`id`, `icerik`, `mesaj_onay`, `tarih`) VALUES
(3, 'deneme', 2, '2015-06-22 09:48:36');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ayarlar`
--

CREATE TABLE IF NOT EXISTS `ayarlar` (
  `site_id` int(11) NOT NULL,
  `site_url` varchar(250) NOT NULL,
  `site_baslik` varchar(250) NOT NULL,
  `site_desc` varchar(300) NOT NULL,
  `site_keyw` varchar(300) NOT NULL,
  `site_tema` varchar(150) NOT NULL,
  `site_durum` int(11) NOT NULL,
  `site_mail` varchar(255) NOT NULL,
  `site_telefon` varchar(255) NOT NULL,
  `site_bakim_mesaj` text NOT NULL,
  `site_footer_icerik` text NOT NULL,
  `site_logo_url` text NOT NULL,
  `site_favicon_url` text NOT NULL,
  `site_author` text NOT NULL,
  `site_publisher` text NOT NULL,
  `site_google_kod` text NOT NULL,
  `site_alexa_kod` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ayarlar`
--

INSERT INTO `ayarlar` (`site_id`, `site_url`, `site_baslik`, `site_desc`, `site_keyw`, `site_tema`, `site_durum`, `site_mail`, `site_telefon`, `site_bakim_mesaj`, `site_footer_icerik`, `site_logo_url`, `site_favicon_url`, `site_author`, `site_publisher`, `site_google_kod`, `site_alexa_kod`) VALUES
(1, 'http://localhost', 'SİTE BAŞLIK', 'SİTE AÇIKLAMASI', 'SİTE KEYWORDS', 'seo', 1, 'SİTE MAİL', 'SİTE TELEFON', 'SİTE BAKIM MESAJI', 'SİTE FOOTER İÇERİK', 'SİTE LOGO URL', 'SİTE FAVICON URL', 'GOOGLE+ AUTHOR KOD', 'GOOGLE+ PUBLISHER KOD', 'GOOGLE WEBMAS. ONAY KOD', 'ALEXA ONAY KOD');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `iletisim_kutusu`
--

CREATE TABLE IF NOT EXISTS `iletisim_kutusu` (
  `iletisim_id` int(11) NOT NULL,
  `iletisim_adsoyad` varchar(255) NOT NULL,
  `iletisim_konu` varchar(255) NOT NULL,
  `iletisim_eposta` varchar(255) NOT NULL,
  `iletisim_icerik` text NOT NULL,
  `iletisim_durumu` int(11) NOT NULL DEFAULT '0',
  `iletisim_ip` varchar(255) NOT NULL,
  `iletisim_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ipuclari`
--

CREATE TABLE IF NOT EXISTS `ipuclari` (
  `ipucu_id` int(11) NOT NULL,
  `ipucu_icerik` text NOT NULL,
  `ipucu_onay` int(11) NOT NULL DEFAULT '0',
  `ipucu_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `ipuclari`
--

INSERT INTO `ipuclari` (`ipucu_id`, `ipucu_icerik`, `ipucu_onay`, `ipucu_tarih`) VALUES
(1, 'wera', 1, '2015-06-22 10:11:52');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sorgular`
--

CREATE TABLE IF NOT EXISTS `sorgular` (
  `sorgu_id` int(11) NOT NULL,
  `sorgu_url` text NOT NULL,
  `sorgu_resim` text NOT NULL,
  `sorgu_ip` varchar(255) NOT NULL,
  `sorgu_tekrar` int(11) NOT NULL,
  `sorgu_tarih` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sorgular`
--

INSERT INTO `sorgular` (`sorgu_id`, `sorgu_url`, `sorgu_resim`, `sorgu_ip`, `sorgu_tekrar`, `sorgu_tarih`) VALUES
(1, 'http://hatosbilisim.com', 'http://img.bitpixels.com/getthumbnail?code=76182&size=200&url=http://hatosbilisim.com', '::1', 9, '2015-06-28 00:54:25'),
(2, 'http://seksvine.com', 'http://img.bitpixels.com/getthumbnail?code=76182&size=200&url=http://seksvine.com', '::1', 1, '2015-06-28 00:47:28'),
(3, 'http://mybbtemalari.com', 'http://img.bitpixels.com/getthumbnail?code=76182&size=200&url=http://mybbtemalari.com', '::1', 3, '2015-06-28 01:04:16'),
(4, 'http://myb', 'http://img.bitpixels.com/getthumbnail?code=76182&size=200&url=http://myb', '::1', 1, '2015-06-28 01:03:51'),
(5, 'http://google.com', 'http://img.bitpixels.com/getthumbnail?code=76182&size=200&url=http://google.com', '::1', 1, '2015-06-28 01:04:24'),
(6, 'http://teacherseo.com', 'http://img.bitpixels.com/getthumbnail?code=76182&size=200&url=http://teacherseo.com', '::1', 1, '2015-06-28 01:05:04'),
(7, 'http://gununtahminleri.com', 'http://img.bitpixels.com/getthumbnail?code=76182&size=200&url=http://gununtahminleri.com', '::1', 1, '2015-06-28 01:09:51');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sorgu_modulleri`
--

CREATE TABLE IF NOT EXISTS `sorgu_modulleri` (
  `modul_id` int(11) NOT NULL,
  `modul_baslik` text NOT NULL,
  `modul_aciklama` text NOT NULL,
  `modul_cozum` text NOT NULL,
  `modul_onay` int(11) NOT NULL DEFAULT '2',
  `modul_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sorgu_modulleri`
--

INSERT INTO `sorgu_modulleri` (`modul_id`, `modul_baslik`, `modul_aciklama`, `modul_cozum`, `modul_onay`, `modul_tarih`) VALUES
(1, 'Site Başlığı (Title)', 'Site başlığı', 'Head tagları arasına eklenmesi gerek. Örnek: <title>Site Başlık</title>', 1, '2015-06-22 11:09:23');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE IF NOT EXISTS `uyeler` (
  `uye_id` int(11) NOT NULL,
  `uye_adi` varchar(255) NOT NULL,
  `uye_kadi` varchar(255) NOT NULL,
  `uye_link` varchar(255) NOT NULL,
  `uye_eposta` varchar(255) NOT NULL,
  `uye_sifre` varchar(255) NOT NULL,
  `uye_avatar` text NOT NULL,
  `uye_cinsiyet` int(11) NOT NULL DEFAULT '1',
  `uye_hakkinda` text NOT NULL,
  `uye_website` varchar(255) NOT NULL,
  `uye_rutbe` int(11) NOT NULL DEFAULT '2',
  `uye_onay` int(11) NOT NULL DEFAULT '0',
  `uye_tarih` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `uyeler`
--

INSERT INTO `uyeler` (`uye_id`, `uye_adi`, `uye_kadi`, `uye_link`, `uye_eposta`, `uye_sifre`, `uye_avatar`, `uye_cinsiyet`, `uye_hakkinda`, `uye_website`, `uye_rutbe`, `uye_onay`, `uye_tarih`) VALUES
(24, 'Osman Yavuz', 'dangerousman32', 'dangerousman32', 'dangerousman32@gmail.com', '4b16fc8c8d9338c00cf242b2259e8260', '', 1, 'Web Developer', 'http://hatosbilisim.com', 1, 1, '2015-06-22 08:49:38');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `anasayfa_mesaj`
--
ALTER TABLE `anasayfa_mesaj`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `ayarlar`
--
ALTER TABLE `ayarlar`
  ADD PRIMARY KEY (`site_id`);

--
-- Tablo için indeksler `iletisim_kutusu`
--
ALTER TABLE `iletisim_kutusu`
  ADD PRIMARY KEY (`iletisim_id`);

--
-- Tablo için indeksler `ipuclari`
--
ALTER TABLE `ipuclari`
  ADD PRIMARY KEY (`ipucu_id`);

--
-- Tablo için indeksler `sorgular`
--
ALTER TABLE `sorgular`
  ADD PRIMARY KEY (`sorgu_id`);

--
-- Tablo için indeksler `sorgu_modulleri`
--
ALTER TABLE `sorgu_modulleri`
  ADD PRIMARY KEY (`modul_id`);

--
-- Tablo için indeksler `uyeler`
--
ALTER TABLE `uyeler`
  ADD PRIMARY KEY (`uye_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `anasayfa_mesaj`
--
ALTER TABLE `anasayfa_mesaj`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `ayarlar`
--
ALTER TABLE `ayarlar`
  MODIFY `site_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `iletisim_kutusu`
--
ALTER TABLE `iletisim_kutusu`
  MODIFY `iletisim_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- Tablo için AUTO_INCREMENT değeri `ipuclari`
--
ALTER TABLE `ipuclari`
  MODIFY `ipucu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- Tablo için AUTO_INCREMENT değeri `sorgular`
--
ALTER TABLE `sorgular`
  MODIFY `sorgu_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
--
-- Tablo için AUTO_INCREMENT değeri `sorgu_modulleri`
--
ALTER TABLE `sorgu_modulleri`
  MODIFY `modul_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- Tablo için AUTO_INCREMENT değeri `uyeler`
--
ALTER TABLE `uyeler`
  MODIFY `uye_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=28;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
