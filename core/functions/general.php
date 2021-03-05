<?php
accesare_directa();

function e_d($action, $string) {
	/* 
	$plain_txt = "**";
	echo "Plain Text =" .$plain_txt. "<br>";
	
	$encrypted_txt = encrypt_decrypt('encrypt', $plain_txt);
	echo "Encrypted Text = " .$encrypted_txt. "<br>";
	
	$decrypted_txt = encrypt_decrypt('decrypt', $encrypted_txt);
	echo "Decrypted Text =" .$decrypted_txt. "<br>";
	
	if($plain_txt === $decrypted_txt) 
		echo "SUCCESS";
	else 
		echo "FAILED";
	
	echo "<br>";
	*/
	
    $output = false;
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'owmda';
    $secret_iv = 'This is my secret iv';
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
    if ( $action == 'encrypt' ) {
        $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
        $output = base64_encode($output);
    } else if( $action == 'decrypt' ) {
        $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
    return $output;
}

function sterge_notificari(){
	include('./core/database/connect.php');
	$sql = mysqli_query($con, "SELECT * FROM `notificari`");
	while($rand = mysqli_fetch_assoc($sql)){
		$azi             = new DateTime("now");
		$data_notificare = new DateTime($rand['data']);
		$interval 		 = $azi->diff($data_notificare);
		$zile     		 = $interval->format('%a');
		if($zile>=15)
			mysqli_query($con, "DELETE FROM `notificari` WHERE `id` = '". $rand['id'] ."'");
		
	}
}

function data($sql){
	include('./core/database/connect.php');
	$rezultat = mysqli_query($con, "$sql");
	$rand = mysqli_fetch_assoc($rezultat);
	
	$azi             = new DateTime("now");
	$data_notificare = new DateTime($rand['data']);
	$interval 		 = $azi->diff($data_notificare);
	$zile     		 = $interval->format('%a');															
	$ora_notificare  = date('H:i', strtotime($rand['data']));
															
	if($zile == 0)
		echo 'Astăzi, ora '. $ora_notificare;
	elseif($zile == 1)
		echo 'Ieri, '. $ora_notificare;
	elseif($zile == 2)
		echo 'Acum 2 zile, ';
	elseif($zile == 3)
		echo 'Acum 3 zile, ';
	elseif($zile == 4)
		echo 'Acum 4 zile, ';
	elseif($zile == 5)
		echo 'Acum 5 zile, ';
	elseif($zile == 6)
		echo 'Acum 6 zile, ';
	elseif($zile == 7)
		echo 'Acum 7 zile, ';
	elseif($zile > 7)
		echo 'Peste 7 zile';

}

function cript($str, $prima=1, $ultima=-2, $rep='*'){
	$inceput = substr($str,0,$prima);
	$mijloc = str_repeat($rep,strlen(substr($str,$prima,$ultima)));
	$sfarsit = substr($str,$ultima);
	$stars = $inceput.$mijloc.$sfarsit;
	return $stars;
}

function cod_eroare(){
	return rand(1,9) . chr(rand(65,90)) . rand(1,974) .chr(rand(65,90)) . rand(22,51);
}

function numar_anunturi(){
	include('./core/database/connect.php');

	$sql = mysqli_query($con, "SELECT `id` FROM `anunturi`");
	return mysqli_num_rows($sql);
}

function numar_tichete(){
	include('./core/database/connect.php');

	$sql = mysqli_query($con, "SELECT `id` FROM `tichete`");
	return mysqli_num_rows($sql);
}


function numar_accesari(){
	include('./core/database/connect.php');

	$sql = mysqli_query($con, "SELECT `accesari` FROM `general`");
	while($rand = mysqli_fetch_assoc($sql))
		if(empty($rand['accesari']))
			return '0';
		else
			return $rand['accesari'];
}

function numar_utilizatori(){
	include('./core/database/connect.php');

	$sql = mysqli_query($con, "SELECT `id` FROM `utilizatori`");
	return mysqli_num_rows($sql);
}

function protectie_nelogat(){
	if(!isset($_SESSION['id']))
		header('Location: ./');
}

function protectie_logat(){
	if(isset($_SESSION['id']))
		header('Location: ./');
}

function protectie_admin(){
	global $date_utilizator;
	if($date_utilizator['acces'] != 1)
		header('Location: ./');
}

function accesare_directa(){
	if(!defined('PERMIS'))
		die('Direct access not permitted');
}

function curatare($item){
	include('./core/database/connect.php');
	return htmlentities(strip_tags(mysqli_real_escape_string($con,$item)));
}

function afisare_erori($erori){
	return '
		<div class="alert alert-danger"> 
			<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			<b>A apărut o eroare! </b>
			' . implode('
		</div>
		
		<div class="alert alert-danger">
			<i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
			<b>A apărut o eroare! </b>
			',$erori) . '
		</div>';
}
?>
