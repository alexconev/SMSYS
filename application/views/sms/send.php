	    	<article>
	    		<h2>Изпрати SMS</h2>
	    		<form action="success" metho="POST">
					<div class="field">
	                    <div class="label"><label for="phone">Номер:</label></div>
	                    <div class="inp">
	                    	<input type="tel" name="phone" id="phone" class="s_input" />
							<select name="phone2" id="phone2" class="m_input right">
			    				<option value="+359883481987">Иван Петров</option>
			    				<option value="+359883481987">Петър Стоянов</option>
			    				<option value="+359883481987">Илиан Георгиев</option>
			    			</select>                 	
	                    </div>
	                </div>
	    			<div class="field">
	                    <div class="label"><label for="group">Група</label></div>
	                    <div class="inp">
			    			<select name="group" id="group" class="f_input">
			    				<option value="+359883481987">Групата ми</option>
			    				<option value="+359883481987">Семейство</option>
			    				<option value="+359883481987">Бизнес</option>
			    			</select>   
	                    </div>
	                </div> 		
					<div class="field">
	                    <div class="label"><label for="message">Съобщение</label></div>
	                    <div class="inp">
	    					<textarea name="message" id="message" class="f_input"></textarea>
						</div>
	                </div> 
					<div class="field">
	                    <div class="label">&nbsp;</div>
	                    <div class="inp">
	                    	<div class="h_input left">
	                    		<label for="LeftSym">Оставащи символи</label>
	    						<input type="text" class="xs_input" id="LeftSym" name="LeftSym" value="23">
	                    	</div>
	    					<div class="h_input left">
			    				<label for="SmsNum">Брой SMS-и</label>
	    						<input type="text" class="xs_input" id="SmsNum" name="SmsNum" value="2">
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
