<?php
function auth($login, $passwd){
	if (file_get_contents('../private/users'));{
		$file = unserialize(file_get_contents('../private/users'));
		if ($file){
			foreach ($file as $key => $value){
				if ($value['login'] == $login && $value['passwd'] == hash('ripemd160', $passwd))
					return (TRUE);
			}
		}
	}
	return (FALSE);
};

function	is_admin($login, $file) {
	foreach ($file as $key => $value) {
		if ($value['login'] === $login)	{
			if ($value['admin'])
				return (1);
			return (0);
		}
	}
};
?>