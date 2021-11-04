<h2>Login</h2>
<form action="login.php" method="post">
	<p><label class="label" for="email">Email Address: </label>
		<input type="text" id="email" name="email" size="30" maxlength="60"
		value="<?php (isset($_POST['email']) ? $_POST['email']:'');?>" 
		>
	</p>
</form>