<?php

echo requireJs( themeUrl() . "js/ajax-form/functionAddEvent.js" );
echo requireJs( themeUrl() . "js/ajax-form/contact.js" );
echo requireJs( themeUrl() . "js/ajax-form/xmlHttp.js" );



?>
<div class="section">
    <h1 class="icon"><span>Say Hello</span></h1>
    <p>Simply fill out the form below and I'll get back to you asap,<br/>
    if forms are not your thing please email <strong>hello [at] michaelmartin.ca</strong></p>
</div>

<br/>

<div id="contactFormArea">
	<form action="<? echo themeUrl() ?>js/ajax-form/contact.php" method="post" id="cForm">
		<div id="loadBar" class="message" style="display: none;">
			Saying hello. Hold on just a sec&#8230;<br/>
			<img src="<? echo themeUrl() ?>css/global/loader.gif" alt="Loading..." title="Sending Email" />
		</div>
		<div id="emailSuccess" class="message success" style="display:none;">
			<br/><strong>Success. Your Email has been sent.</strong>
		</div>
		
		
		<fieldset>
		<ol>
			<li>
				<label for="posName">Name</label>
				<input name="posName" id="posName" type="text" 
				placeholder="First and last name" required autofocus/>
			</li>
			
			<li>
				<label for="posEmail">Email</label>
				<input name="posEmail" id="posEmail" type="email" 
				placeholder="example@domain.com" required/>
			</li>
		</ol>
		</fieldset>
		
		<fieldset>	
		<ol>
			<li>
				<label for="posRegard">Regarding</label>
				<input name="posRegard" id="posRegard" type="text" />
			</li>
			<li>
				<label for="posText">Message</label>
				<textarea name="posText" id="posText" rows="5" required></textarea>
			</li>
			
			<li>
				<label for="selfCC">Cc myself</label>
				<input name="selfCC" id="selfCC" type="checkbox" value="send" /> 
			</li>
		</ol>
		</fieldset>
		
		<fieldset>	
				<button type="submit" name="sendContactEmail" id="sendContactEmail">Send</button>
		</fieldset>
	</form>
</div>