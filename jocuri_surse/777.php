<?php
if(!defined('PERMIS'))
	die('Accesul direct interzis!');

$token = time();
if(!isset($_SESSION['token']) || $_SESSION['token']<($token-600))
	$_SESSION['token'] = $token;

?>
<link href='http://fonts.googleapis.com/css?family=Gravitas+One&text=1234567' rel='stylesheet' type='text/css'>
<link href='css/777.css' rel='stylesheet' type='text/css'>
<?php if($date_utilizator['credit']>0) {?>
<script>
$(function(){
	//Verificam daca se incearca reincarcarea paginii
	// window.onbeforeunload = function() {
		// return "Esti sigur ca vrei sa reincarci pagina?";
	// }
	
	$('#credit').val('<?php echo $date_utilizator['credit']?>');
	
    $('#invarte').click(function() {
		//Afisam cat a mai ramas din timp
		var i=7.8; //numarul de secunde
		var timp  = setInterval(cronometru, 100);
		function cronometru(){
		  i-= 0.1;
		  i = i.toFixed(1);  //setam o zecimala
		  if(i >=0 )
			   $('#timp').text(i);
		  else 
			  return clearInterval(timp);
		}
		
		//La fiecare spin dezactivam butonul
		$('#invarte').prop('disabled', true);
		
		//Dupa 7.8 secunde il activam
		setTimeout(function() {
			$('#invarte').prop('disabled', false);
		  }, 7690);
		
		$.ajax({
			url:"jocuri_surse/actiuni/777/credit.php",  
            method:"GET",
			data:'username=<?php echo $date_utilizator['username']?>',
            success:function(data){
				if(data === 'zero_credite')
					$('#invarte').prop('onclick',null).off('click');
				
				if($('#credit').val() > 0)
						$('#credit').text(data);
				else
				if($('#credit').val() == 0)
					location.reload();
					

            }  
		});  
   });
});
</script>
<?php } ?>
<div class="row">
	<div class="col-lg-8">
		<div class="card">
			<div class="card-body">
				<h3>Slots 777</h3>
				<p>Încearcă să câștigi cât mai mulți de 7 pentru a aduna credite! ( 1 euro &#8771 10 puncte )</p>
				
				<div class="row">
					<div class="col-md-6">
						<div class="fancy text-center">
							<ul class="slot" >
								<li><span>7</span></li>
								<li><span>6</span></li>
								<li><span>5</span></li>
								<li><span>4</span></li>
								<li><span>3</span></li>
								<li><span>2</span></li>
								<li><span>1</span></li>
							</ul>
							<br>
							
							<input type="button" class="btn btn-info" 
							<?php if($date_utilizator['credit']>0) {?>
							id="invarte" onclick="afisare_credit"
							<?php } else echo 'disabled'; ?>
							value="Încearcă">
						</div>
					</div>
					<div class="col-md-6">
						<p>Credite initiale: <code><?php echo $date_utilizator['credit']; ?></code></p>
							<p>
							Mai aveti de asteptat: 
							<code id="timp" >7</code>
							</p>
						
						<?php 
						if(!$date_utilizator['credit'])
							echo 'Nu mai aveti credit';
						else {
						?>
							Mai aveți 
							<code id="credit"><?php echo $date_utilizator['credit']; ?></code> 
							puncte
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="col-lg-4">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-header bg-info">
						<h4 class="m-b-0 text-white">Informații jocuri</h4>
					</div>
					<div class="card-body">
					<style>
					
					</style>
						<table class="table">
							<tr>
								<th>Investiție totală</th>		
								<th>:</th>
								<th># X</th>
							</tr>
							<tr>
								<th>Câștig/pagubă</th>		
								<th>:</th>
								<th># X</th>
							</tr>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
    <script src="js/jocuri/jquery.easing.1.3.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/jocuri/jquery.jSlots.min.js" type="text/javascript" charset="utf-8"></script>
    <script src="js/jocuri/cv.js" type="text/javascript" charset="utf-8"></script>