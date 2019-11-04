<?php
$user = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];
$image = base64_encode(file_get_contents('../img/42.png'));
if ($user === 'zaz' && $password === 'jaimelespetitsponeys'){
	echo "<html><body>
	Bonjour ".ucfirst($user)."<br/>
	<img src='data:image/42.png;base64,".$image."'>
	</body></html>\n";
}
else{
	header('HTTP/1.0 401 Unauthorized');
	header('WWW-Authenticate: Basic realm="mymembers"');
	echo "<html><body>Cette zone est accessible uniquement aux membres du site</body></html>\n";
}
?>
