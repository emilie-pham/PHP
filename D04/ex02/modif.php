<?php
$username = $_POST['login'];
$oldpasswd = hash('ripemd160', $_POST['oldpw']);
$passwd = $_POST['passwd'];
if ($username && $oldpasswd && $passwd && $_POST['submit'] == 'OK')
{
//  Check if private folder exists and if not creates it
	if (!file_exists('../private'))
		mkdir('../private');
// Check if passwd file exists and if not creates it ans append username and passwd values
	if (!file_exists('../private/passwd'))
		file_put_contents('../private/passwd', null);
// Get content of passwd file
	$file = unserialize(file_get_contents('../private/passwd'));
// If file exists, check if username exists in file with current passwd
	if ($file) {
		foreach ($file as $k => $v) {
			if ($v['login'] === $username && $v['passwd'] == $oldpasswd){
				$file[$k]['passwd'] = hash('ripemd160', $passwd);
				file_put_contents('../private/passwd', serialize($file));
				echo "OK\n";
				exit();
			}
		}
	}
}
echo "ERROR\n";
?>
