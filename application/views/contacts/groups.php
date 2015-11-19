		    <article>
		      <h2>Групи</h2>  
		      <div class="list">
				<?php foreach ($groups as $item): ?>
				<div class="item">
					<div class="group"><?php echo $item['Title'] ?></div>
					<div class="message"><?php echo $item['Description'] ?></div>
					<div class="controls">
						<a class="delete" href="#">&nbsp;</a>
						<a class="edit" href="groupform">&nbsp;</a>
					</div>
					<div class="clear"></div>
				</div>
				<?php endforeach; ?>		      
		      </div>            
		      <?php echo $paging; ?>
		      <div class="clear"></div>
		    </article>
