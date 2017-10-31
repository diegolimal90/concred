<?php

	require 'api/PHPMailer/PHPMailerAutoload.php';

	//variaveis com os valores de get e post
	$nome 		= utf8_decode($_POST['name']);
	$perfil		= $_POST['perfil'];
	$tel 		= $_POST['tel'];
	$email 		= $_POST['email'];

	//verifica valor recebido pelo get para criar o assunto
	/*if($env == '1'){
		$assunto = 'Solicitação do MegaZAP para empresa';
	}elseif($env == '2'){
		$assunto = 'Solicitação do MegaZAP para revenda';
	}else{
		$assunto = 'Solicitação de Contato sobre o MegaZAP';
	}*/


	//Instancio a classe PHPMAILER
	$mail = new PHPMailer;

	//$mail ->SMTPDebug = 2;
	
	//configurar acesso ao email
	$mail->IsSMTP(); 
	$mail->Host = "smtp.conscred.com.br"; 
	$mail->SMTPAuth = true; 
	$mail->Port = 587;
	$mail->SMTPSecure = false;
	$mail->SMTPAutoTLS = false;
	$mail->Username = 'ligue@conscred.com.br'; 
	$mail->Password = 'credcons1234';
		
	$mail ->Charset = 'UTF-8';										//aceitar caracteres especiais

	//configurar cabeçalho de email
	$mail ->setFrom('ligue@conscred.com.br', 'Me Ligue ConsCred');//insere o remetente
	$mail ->addAddress('contato@conscred.com.br');//adiciona o destinatario
	$mail->addCC('ligue@conscred.com.br');							//envio de copia de email
	$mail ->isHTML(true);											//formato do email em html

	//conteudo do email
	$mail ->Subject = "Me ligue";//adiciona assunto ao email
	$mail ->Body = "<b>Nome:</b> {$nome} <br> <b>Telefone:</b> {$tel} <br> <b>Perfil:</b> {$perfil} <br> <b>E-mail:</b> {$email}";
	$mail ->AltBody = "Nome: {$nome} \n\r Telefone: {$tel} \n\r Perfil: {$perfil} \n\r E-mail: {$email}";

	//verificação se o email foi enviado
	if(!$mail->send()) {
    	echo 'Mensagem nao foi enviada.';
    	echo 'Error: ' . $mail->ErrorInfo;
	} else {
	    echo '<script type="text/javascript">alert("Mensagem enviada com sucesso!"); location.href="http://conscred.com.br";</script>';
	}
