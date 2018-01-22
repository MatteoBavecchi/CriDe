<!doctype html>
<html>
<head>
<link rel="stylesheet" href="style.css" type="text/css">
<meta charset="UTF-8">
<title>---CriDe---</title>
</head>

<body bgcolor=#F3F5F4>

<div id="crediti">Matteo Bavecchi - Tutti i diritti riservati</div>
<div id="logo"> CriDe </div>

<div id="back">
<div id="testo">"Assicurati che i tuoi <span id="linea">documenti sensibili</span> vengano letti solo dalle persone gradite."</div>
</div>

<div id="boxdown">
<form action="crypt.php" method="post" enctype="multipart/form-data">
       <div id="scegli" <label for="file">Scegli il documento di testo da de/crittare: </label> 
       <input type="file" name="file" id="file"/></div>
       <div id="radio"> crittografare<input type="radio" name="azione" value="cript">
       decrittografare<input type="radio" name="azione" value="decript"></div>
       <div id="psw"> Password: <input type="text" name="password"></div>
       <div id="button"><input type="submit" value="Elabora">              
	   <input type="reset" value="Cancella"></div>
</form>

</div>

</body>
</html>