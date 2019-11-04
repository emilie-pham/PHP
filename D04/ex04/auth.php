<?php
function auth($login, $passwd){
	if (file_exists('../private/passwd'));{
		$file = unserialize(file_get_contents('../private/passwd'));
		if ($file){
			foreach ($file as $key => $value){
				if ($value['login'] == $login && $value['passwd'] == hash('ripemd160', $passwd))
					return (TRUE);
			}
		}
	}
	return (FALSE);
};
?>