	    	<article>
	    		<h2>Потребител</h2>
	    		<?php echo $error;?>
				<?php echo form_open_multipart('users/save');?>
					<div class="field">
	                    <div class="label"><label for="Name">Име:</label></div>
	                    <div class="inp">
	                    	<input type="text" name="Name" id="Name" class="f_input" value="<?php if(isset($Name)) echo $Name; ?>"/>              	
	                    </div>
	                </div>	
					<div class="field">
	                    <div class="label"><label for="Family">Фамилия:</label></div>
	                    <div class="inp">
	                    	<input type="text" name="Family" id="Family" class="f_input" value="<?php if(isset($Family)) echo $Family; ?>"/>              	
	                    </div>
	                </div>		                
					<div class="field">
	                    <div class="label"><label for="username">Потребителско име</label></div>
	                    <div class="inp">
	    					<input type="text" name="username" id="username" class="f_input" value="<?php if(isset($username)) echo $username; ?>"/>
						</div>
	                </div> 	
					<div class="field">
	                    <div class="label"><label for="pass">Парола</label></div>
	                    <div class="inp">
	    					<input type="password" name="pass" id="pass" class="f_input" />
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
