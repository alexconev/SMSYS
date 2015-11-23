<article>
	<h2>Потребители</h2>  
	<div class="list">
		<?php foreach ($users as $user): ?>
		<div class="item">
			<div class="name"><?php echo $user['Name'] ?></div>
			<div class="name"><?php echo $user['Family'] ?></div>
			<div class="group"><?php echo $user['username'] ?></div>
			<div class="controls">
				<a class="delete" href="<?php echo base_url(); ?>users/delete/<?php echo $user['ID'] ?>">&nbsp;</a>
				<a class="edit" href="<?php echo base_url(); ?>users/edit/<?php echo $user['ID'] ?>">&nbsp;</a>
			</div>
			<div class="clear"></div>
		</div>
		<?php endforeach; ?>		      
	</div>            
	<?php echo $paging; ?>
	<div class="clear"></div>
</article>