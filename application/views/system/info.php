	    	<article>
	    		<h2>Информация за системата</h2>
	    		<form action="success" metho="POST">
					<div class="field">
	                    <div class="label"><label for="modem">Статус</label></div>
	                    <div class="inp">
	    					<span class="green">Aктивен</span>
						</div>
	                </div> 	  
                	<div class="field">
	                    <div class="label"><label for="modem"><strong>CPU</strong></label></div>
	                    <div class="inp"><?php exec("lscpu",$cpu); echo (isset($cpu[0])?$cpu[0]."<br/>":"").(isset($cpu[7])?$cpu[7]."<br/>":"").(isset($cpu[8])?$cpu[8]."<br/>":""); ?></div>
	                </div>		                
                	<div class="field">
	                    <div class="label"><label for="modem"><strong>Network</strong></label></div>
	                    <div class="inp"><?php exec("gammu monitor 1",$network); for($i = 6; $i < 21; $i++) echo (isset($network[$i])?$network[$i]:"")."<br/>"; ?></div>
	                </div>	                  		
					<div class="field">
	                    <div class="label"><label for="modem"><strong>OS</strong></label></div>
	                    <div class="inp"><?php exec("cat /etc/*release*",$os); echo implode("<br/>",$os); ?></div>
	                </div> 
					<div class="field">
	                    <div class="label"><label for="modem"><strong>PHP</strong></label></div>
	                    <div class="inp"><?php exec("php -v",$php); echo implode("<br/>",$php); ?></div>
	                </div>  
                	<div class="field">
	                    <div class="label"><label for="modem"><strong>MySQL</strong></label></div>
	                    <div class="inp"><?php exec("mysql -V",$mysql); echo implode("<br/>",$mysql); ?></div>
	                </div>  
	    		</form>
	    		<div class="clear"></div>
	    	</article>
