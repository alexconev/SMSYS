	    	<article>
	    		<h2>Настройки</h2>
	    		<form action="success" metho="POST">
					<div class="field">
	                    <div class="label"><label for="phone">Номер:</label></div>
	                    <div class="inp">
	                    	<input type="tel" name="phone" id="phone" class="f_input" placeholder="+359883111444" />             	
	                    </div>
	                </div>
					<div class="field">
	                    <div class="label"><label for="carrier">Оператор:</label></div>
	                    <div class="inp">
	                    	<input type="text" name="carrier" id="carrier" class="f_input" placeholder="M-tel" />             	
	                    </div>
	                </div>
					<div class="field">
	                    <div class="label"><label for="smss">Месечен лимит:</label></div>
	                    <div class="inp">
	                    	<input type="text" name="smss" id="smss" class="f_input" placeholder="500"/>             	
	                    </div>
	                </div>	  
  					<div class="field">
	                    <div class="label"><label for="port">Порт:</label></div>
	                    <div class="inp">
			    			<select name="port" id="port" class="f_input">
			    				<option value="/dev/ttyUSB0">/dev/ttyUSB0</option>
			    				<option value="/dev/ttyUSB1">/dev/ttyUSB1</option>
			    				<option value="/dev/ttyS1">/dev/ttyS1</option>
			    				<option value="/dev/ttyS2">/dev/ttyS2</option>
			    			</select>          	
	                    </div>
	                </div>
					<div class="field">
	                    <div class="label"><label for="modem">Модем</label></div>
	                    <div class="inp">
	    					<textarea name="message" id="message" class="f_input"></textarea>
						</div>
	                </div>  	
					<div class="field">
	                    <div class="label"><label for="modem">Статус</label></div>
	                    <div class="inp">
	    					<span class="green">Неактивен</span>
						</div>
	                </div>  	                
					<div class="field">
	                    <div class="label">&nbsp;</div>
	                    <div class="inp">                		
	    					<input class="s_input blue" type="submit" value="Запази">
	    				</div>
	    			</div>
	    		</form>
	    		<div class="clear"></div>
	    	</article>
