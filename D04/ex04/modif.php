<?php
header('Location: ');

$username = $_POST['login'];
$oldpasswd = hash('ripemd160', $_POST['oldpw']);
$passwd = $_POST['passwd'];

if ($username && $oldpasswd && $passwd && $_POST['submit'] == 'OK')
{
	if (!file_exists('../private'))
		mkdir('../private');
	if (!file_exists('../private/passwd'))
		file_put_contents('../private/passwd', null);
	$file = unserialize(file_get_contents('../private/passwd'));
	if ($file) {
		foreach ($file as $k => $v) {
			if ($v['login'] === $username && $v['passwd'] == $oldpasswd){
				$file[$k]['passwd'] = hash('ripemd160', $passwd);
				file_put_contents('../private/passwd', serialize($file));
				header('Location: index.html');		
				echo "OK\n";
				exit();
			}
		}
	}
}
echo "ERROR\n";
?>
