<html>
	<?php
		require __DIR__ . '/lib/openid.php';

		define('STEAM_REDIRECT', 'https://steam-api-omega.vercel.app/');

		try {
			$openid = new LightOpenID(STEAM_REDIRECT); // здесь константа со ссылкой на этот скрипт
			if (!$openid->mode) {
				$openid->identity = 'http://steamcommunity.com/openid/?l=russian';
				header('Location: '.$openid->authUrl());
			}
			elseif ($openid->mode == 'cancel') {
				header('Location: /'); // здесь можно редиректить пользователя, если он начал процесс авторизации через steam, но отказался от него
			}
			elseif ($openid->validate()) {
				$id = $openid->identity;
				$sid64 = intval(preg_replace('/[^0-9]/', '', $id));
				echo $sid64;
				
				// авторизация пройдена, у вас появился Steam_ID64 пользователя, теперь вы можете писать здесь любой ваш код 
				
				header('Location: /'); // после вашего кода нужно редиректнуть пользователя на нужную вам страницу сайта
			}
			else header('Location: /');
		}
		catch(ErrorException $e) {
			header('Location: /');
		}

?>
</html>