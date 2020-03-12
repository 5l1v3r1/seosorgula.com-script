<div class="row sorgulama">
	<div class="col-md-2"></div>
				<div class="col-md-8 text-center">
					<div class="row ">
						<h1><strong>Whois Sorgulama</strong></h1>
						<p class="col-md-offset-2 col-md-8">Whois Sorgulama Sistemi</p>
						<div class="row">
							<div class="col-md-10 col-md-offset-1">
								<div class="col-md-12">
									<form method="POST">
										<div class="input-group input-group-lg">
											<span class="input-group-addon" style="padding:0px;margin:0px;border:none;">
												<select name="tur" class="form-control" style="padding:0px;width:100px;height:46px;border-top-left-radius:5px;border-bottom-left-radius:5px;">
													<option selected="">http://</option>
													<option>https://</option>
												</select>
											</span>
											<input type="text" name="site" class="form-control" placeholder="seosorgula.com">
											<span class="input-group-btn">
												<input type="submit" class="btn btn-primary" name="sorgula" value="Whois Sorgula" title="Whois Sorgula">
											</span>
										</div>
									</form> 
								</div>
							</div>
						</div>
					</div>
				</div>
	<div class="col-md-2"></div>
</div>	
<?php if(isset($_POST["sorgula"])){ ?>
<?php if(p("site") == ""){
	echo '<div class="sonuclar container" style="text-align: center;"><br/><pre><strong class="text-center" style="color:darkred">Lütfen geçerli bir adres giriniz..</strong></pre></div>';
}else{ ?>
<div class="sonuclar container">
	<h4>Whois Bilgileri</h4>
	<div class="row box-header">
	<h3><?php echo ucwords(strtolower(p("site"))); ?> - Online</h3>
	</div>
<?php
	/*function getwhois($domain, $tld){                                                   
        require_once(TEMA."/class.whois.php");

        $whois = new Whois();

            if( !$whois->ValidDomain($domain.'.'.$tld) ){
                   return 'Belirlenemiyor';
            }

        if( $whois->Lookup($domain.'.'.$tld) )
        {
            return $whois->GetData(1);
        }else{
            return 'Belirlenemiyor';
        }
    }
	
	$domain = p("site");
	$dot = strpos($domain, '.');
	$sld = substr($domain, 0, $dot);
	$tld = substr($domain, $dot+1); 
	if(substr($domain , -3) == ".tr"){
		$site = file_get_contents("http://www.whois.com.tr/?q=$domain");
		$aa = explode('<td colspan="2" class="ptd full"><pre>',$site);
		$aa = explode('</pre></td>',$aa[1]);
	?>	
		<pre><?php echo $aa[0]; ?></pre>
<?php } else { $whois = getwhois($sld, $tld); ?>
		<pre><?php echo $whois; ?></pre>
		
<?php } } }?>*/


		$kaynak = file_get_contents("http://api.hackertarget.com/whois/?q=".p("site"));
		echo '<pre>'.htmlspecialchars($kaynak).'</pre>';
		?>
<?php  } } ?>
</div>