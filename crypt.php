
<?php
$name= date ("d_m_y_H:i:s");
header('Content-disposition: attachment; filename=[cridev]'.date ("d-m-y H_i_s").'.txt');
header('Content-type: text/plain');
$ok=1;
if((!isset($_REQUEST['azione'])) || (!isset($_REQUEST['password']))) { //se i dati non sono corretti non si esegue nessun procedimento
	echo "Dati non corretti, riprova.";
	$ok=0;
}

function bin(&$byte,$n){//dec-bin
	for($i=0;$i<7;$i++){
	$byte[$i]=$n%2;
	$n/=2;
	}
	}

function ordina(&$byte,$n){//ordinameto di un vettore di bit
	for($i=0;$i<($n/2);$i++){
		$box=$byte[$n-$i-1];
		$byte[$n-$i-1]=$byte[$i];
		$byte[$i]=$box;
		}
		}

function critta(&$byte,$line,$pass,$n,$w){
	//conversione decimale-binario
	if($w) bin($byte,ord($line)-32);
	else bin($byte,ord($line));
	//ordina il byte 
	ordina($byte,7);
	
	//creazione maschera per XOR
	for($i=1;$i<$n;$i++){
		for($j=0;$j<7;$j++){
			$pass[$i][$j]^=$pass[$i-1][$j];
			}
		}
		//applicaizone della maschera al valore binario con XOR
	for($i=0;$i<7;$i++) $byte[$i] ^= $pass[$n-1][$i];

}

$password=$_REQUEST['password'];
$pass = array(0 => array
            (  0 => 0,
               1 => 0,	
               2 => 0,
			   3 => 0,
			   4 => 0,
			   5 => 0,
			   6 => 0,
			   7 => 0),
			1 => array
            (  0 => 0,
               1 => 0,	
               2 => 0,
			   3 => 0,
			   4 => 0,
			   5 => 0,
			   6 => 0,
			   7 => 0 ));
			   
if($ok){//se non ci sono stati errori si comincia a processare il documento
for($i=0;$i<7;$i++) $v[$i]=0;//inizializza il vettore v 

//inserisce nella matrice i binari corrispondenti ai caratteri ASCII della password
for($i=0;$i<strlen($password);$i++){
bin($pass[$i],ord($password[$i]));
ordina($pass[$i],7);
}

//dovuti controlli sul documento di testo
if ($_FILES["file"]["error"] > 0)
{
echo "Error: " . $_FILES["file"]["error"] . "<br />";
}
elseif ($_FILES["file"]["type"] !== "text/plain")
{
echo "Vengono accettati solo .txt";
}
else
{

$fp = fopen($_FILES['file']['tmp_name'], 'rb');
    while ( ($line = fgets($fp)) !== false) {
		
////////CRITTAGGIO//////////	  
	  if($_REQUEST['azione']=="cript"){
	for($i=0;$i<strlen($line);$i++){  //ogni carattere della linea viene convertito in binario e messo nel vet 'v'
	      if(ord($line[$i])==10) continue;// il valore di andare a capo non viene processato
		  if(ord($line[$i])==13) continue;// il valore di andare a capo non viene processato
		  critta($v,$line[$i],$pass,strlen($password),0);
	      $x=0;
	      for($j=0;$j<7;$j++) $x+=$v[$j]*pow(2,7-$j-1); //trasformazione da binario a decimale
	      
		  if($x<32) $x+=32;//controllo per non finire nei primi 31 caratteri
	      echo chr($x);
	  }
	   echo "\n";
	   }
////////FINE-CRITTAGGIO////////	  

////////DECRITTAGGIO//////////	  
	  if($_REQUEST['azione']=="decript"){
	for($p=0;$p<strlen($line);$p++){  //ogni carattere della linea viene convertito in binario e messo nel vet 'v'
	      if(ord($line[$p])==10) continue;// il valore di andare a capo non viene processato
		  if(ord($line[$p])==13) continue;// il valore di andare a capo non viene processato
		  
		  if((ord($line[$p])-32)<32) critta($v,$line[$p],$pass,strlen($password),1);
		  else critta($v,$line[$p],$pass,strlen($password),0);
	      $x=0;
	      for($j=0;$j<7;$j++) $x+=$v[$j]*pow(2,7-$j-1); //trasformazione da binario a decimale
	      echo chr($x);
	  }
	   echo "\n";
	   }
////////FINE-DECRITTAGGIO////////	  
}

}
}

?> 
