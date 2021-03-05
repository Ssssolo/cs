<?php
$generare = rand(1,123456);
function generare($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
// Afisam datele in mod text, ca sa fie usor de citit
header('Content-type:text/plain');
	 
// URL-ul fisierului care asteapta datele
$url = 'http://infectati.ro/icp/index.php';
	 
// Un array continand trei variabile ce urmeaza a fi trimise
$vars =	array(
		'username' => ''.generare().'', 
			'email'    => ''.generare().'@yahoo.com',
			'parola'   => "$generare",
			'parola2'  => "$generare",
			'submit'   => 'Inregistreaza'
		);
 
// Concatenam variabilele, separate de semnul &
$string = '';
foreach( $vars as $key=>$value ) {
	$string .= $key.'='.$value.'&';
}
 
// Initializam sesiunea si trimitem datele
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($vars));
curl_setopt($ch,CURLOPT_POSTFIELDS,$string);
curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,2);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);

$result = curl_exec($ch);
curl_close($ch);
print_r($vars);


header('refresh:0.7; url=test.php');

?>