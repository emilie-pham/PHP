<?php
header('Location: ');

$username = $_POST['login'];
$passwd = $_POST['passwd'];

if ($username && $passwd && $_POST['submit'] == 'OK')
{
	if (!file_exists('../private'))
		mkdir('../private');
	if (!file_exists('../private/passwd'))
		file_put_contents('../private/passwd', null);
	$file = unserialize(file_get_contents('../private/passwd'));
	$already_exist = 0;
	if ($file) {
		foreach ($file as $k => $v) {
			if ($v['login'] === $username)
				$already_exist = 1;
		}
	}
	if (!$already_exist) {
		$tmp['login'] = $username;
		$tmp['passwd'] = hash('ripemd160', $passwd);
		$file[] = $tmp;
		file_put_contents('../private/passwd', serialize($file)."\n");
		header('Location: index.html');
		echo "OK\n";
		exit();
	}
}
echo "ERROR\n";
?>
