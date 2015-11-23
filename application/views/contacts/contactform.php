	    	<article>
	    		<h2>Контакт</h2>
	    		<?php echo $error;?>
				<?php echo form_open_multipart('contacts/savephone');?>
					<div class="field">
	                    <div class="label"><label for="Name">Име:</label></div>
	                    <div class="inp">
	                    	<input type="text" name="Name" id="Name" class="f_input" value="<?php if(isset($Name)) echo $Name; ?>"/>              	
	                    </div>
	                </div>	    		
					<div class="field">
	                    <div class="label"><label for="Phone">Номер:</label></div>
	                    <div class="inp">
	                    	<input type="text" name="Phone" id="Phone" class="f_input" value="<?php if(isset($Phone)) echo $Phone; ?>"/>              	
	                    </div>
	                </div>
	    			<div class="field">
	                    <div class="label"><label for="GroupID">Група</label></div>
	                    <div class="inp">
			    			<select name="GroupID" id="GroupID" class="f_input">
			    				<?php if(isset($arGroups) && is_array($arGroups))
			    						foreach ($arGroups as $item) {
			    							echo '<option value="'.$item['ID'].'" '.(isset($GroupID)&&$GroupID==$item['ID']?"selected":"").'>'.$item['Title'].'</option>';
				    					}
			    				?>
			    			</select>   
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
	    		</form><br/>
		        <div class="clear"></div>	
	    	</article><br/>
