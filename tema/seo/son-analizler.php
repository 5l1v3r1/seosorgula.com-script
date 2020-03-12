<br/>
<br/>
<div class="row sonSorgular" style="background:lightblue">
			<div class="container">
                    <h2 class="text-center"><strong style="border-bottom:1px solid #eee">Son Analizler</strong></h2>
                    <div class="row">
						<?php 
							
							$query = query("SELECT * FROM sorgular ORDER BY sorgu_tarih DESC LIMIT 20");
							if(mysql_affected_rows()){
								while($row = row($query)){
									$baslik = str_replace("http://","",$row["sorgu_url"]);
									$baslik = str_replace("https://","",$baslik);
									$baslik = ucwords(strtolower($baslik));
						?>
					
                        <div class="col-md-3">
                            <div class="thumbnail">
                                <img title="<?php echo $baslik; ?>" class="img-responsive" src="<?php echo $row["sorgu_resim"]; ?>" alt="<?php echo $row["sorgu_url"]; ?>">
                                <div class="caption  text-center">
                                    <h3><?php echo $baslik; ?></h3>
                                    <div class="butonlar">
                                        <a href="<?php echo $row["sorgu_url"]; ?>" class="btn btn-primary" role="button" target="_blank" rel="nofollow">Siteyi Ziyaret Et</a>
										<br/>
										<span>Şuana kadar <b><?php echo $row["sorgu_tekrar"]; ?></b> kere sorgulandı.</span>
									</div>
                                </div>
                            </div>
                        </div>
						
						<?php }
							
							}else{ ?>
						
						<?php } ?>
                    </div>
                </div>
		</div>