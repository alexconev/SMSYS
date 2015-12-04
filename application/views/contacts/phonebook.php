<article>
	<h2>Указател</h2>  
	<div class="list">
		<?php foreach ($contacts as $contact): ?>
		<div class="item">
			<div class="number"><?php echo $contact['Phone'] ?></div>
			<div class="name"><?php echo $contact['Name'] ?></div>
			<div class="group"><?php echo $contact['Group'] ?></div>
			<div class="controls">
				<a class="delete" href="<?php echo base_url(); ?>contacts/delphone/<?php echo $contact['ID'] ?>">&nbsp;</a>
				<a class="edit" href="<?php echo base_url(); ?>contacts/editphone/<?php echo $contact['ID'] ?>">&nbsp;</a>
			</div>
			<div class="clear"></div>
		</div>
		<?php endforeach; ?>		      
		<div class="clear"></div>
	</div>            
	<?php echo $paging; ?>
	<div class="clear"></div>
</article>