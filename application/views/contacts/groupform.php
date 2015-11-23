	    	<article>
	    		<h2>Група</h2>
	    		<?php echo $error;?>
				<?php echo form_open_multipart('contacts/savegroup');?>
					<div class="field">
	                    <div class="label"><label for="Title">Име:</label></div>
	                    <div class="inp">
	                    	<input type="text" name="Title" id="Title" class="f_input" value="<?php if(isset($Title) && isset($ID)) echo $Title; ?>"/>              	
	                    </div>
	                </div>	
					<div class="field">
	                    <div class="label"><label for="Description">Описание</label></div>
	                    <div class="inp">
	    					<input type="text" name="Description" id="Description" class="f_input" value="<?php if(isset($Description) && isset($ID)) echo $Description; ?>"/>
						</div>
	                </div> 	
					<div class="field">
	                    <div class="label">&nbsp;</div>
	                    <div class="inp">   
							<?php if(isset($ID)) {?>
	    						<input type="hidden" name="ID" value="<?php echo $ID; ?>">
	    					<?php } ?>	                                 		
	    					<input class="s_input blue" type="submit" value="Запази">
	    				</div>
	    			</div>
	    		</form>   		        
	    	</article><br/>
