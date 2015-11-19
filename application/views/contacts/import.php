	    	<article>
				<h2>Импорт на контакти</h2>
				<?php echo $error;?>
				<?php echo form_open_multipart('contacts/do_import');?>
	    		<!-- <form action="success" metho="POST"> -->
					<div class="field">
	                    <div class="label"><label for="message">Контакти (*.vcf)</label></div>
	                    <div class="inp">
	                    	<input type="file" name="filepath" id="filepath" size="20" class="h_input"/>
	    					<input class="h_input blue" type="submit" value="Импортирай">
	    				</div>
	    			</div>
	    			<div class="field" id="process">&nbsp;</div>
	    		</form>
	    		<div class="clear"></div>
	    	</article>