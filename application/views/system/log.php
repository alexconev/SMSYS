	    	<article>
	    		<h2>Системен лог</h2>
	    		<div class="logs">
					<?php foreach ($logs as $item): ?>
						<div class="item"><span><?php echo date("H:i d.m.Y", strtotime($item['Date'])); ?></span><a><?php echo $item['Message'] ?></a></div>
					<?php endforeach; ?>	    		
	    		</div>
	    		<?php echo $paging; ?>  
	    		<div class="clear"></div>
	    	</article>
