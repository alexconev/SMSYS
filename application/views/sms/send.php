	    	<article>
	    		<h2>Изпрати SMS</h2>
	    		<?php echo $error;?>
				<?php echo form_open('sms/dosend');?>
	    		<form action="success" metho="POST">
					<div class="field">
	                    <div class="label"><label for="phone">Номер:</label></div>
	                    <div class="inp">
	                    	<input type="tel" name="phone" id="phone" class="s_input" />
							<select name="phone2" id="phone2" class="m_input right">
								<?php
									if(isset($arConts) && is_array($arConts))
										foreach ($arConts as $arCont)
											echo "<option value='".$arCont['Phone']."'>".$arCont['Name']."</option>";
								?>
			    			</select>                 	
	                    </div>
	                </div>
	    			<!-- <div class="field">
	                    <div class="label"><label for="group">Група</label></div>
	                    <div class="inp">
			    			<select name="group" id="group" class="f_input">
			    				<option value="+359883481987">Групата ми</option>
			    				<option value="+359883481987">Семейство</option>
			    				<option value="+359883481987">Бизнес</option>
			    			</select>   
	                    </div>
	                </div>  -->		
					<div class="field">
	                    <div class="label"><label for="Content">Съобщение</label></div>
	                    <div class="inp">
	    					<textarea name="Content" id="Content" class="f_input"></textarea>
						</div>
	                </div> 
					<div class="field">
	                    <div class="label">&nbsp;</div>
	                    <div class="inp">
	                    	<div class="h_input left">
	                    		<label for="LeftSym">Оставащи символи</label>
	    						<input type="text" class="xs_input" id="LeftSym" name="LeftSym" value="">
	                    	</div>
	    					<div class="h_input left">
			    				<label for="SmsNum">Брой съобщения</label>
	    						<input type="text" class="xs_input" id="SmsNum" name="SmsNum" value="">
							</div>	
						</div>
	                </div>    	
					<div class="field">
	                    <div class="label">&nbsp;</div>
	                    <div class="inp">                		
	    					<input class="s_input blue" type="submit" value="Изпрати">
	    				</div>
	    			</div>
	    		</form>
	    		<div class="clear"></div>
	    	</article>
