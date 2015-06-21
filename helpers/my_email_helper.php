<?php

/**
* Função para envio de e-mail
*/

function email($de,$para,$assunto,$texto){

	$corpo = "";

	if(is_array($texto) && count($texto) > 0){
		foreach($texto as $key => $t){
			$corpo .= "<br><b>{$key}:</b> {$t}";
			}
		}

	# O remetente deve ser um e-mail do seu domínio conforme determina a RFC 822.
	# O return-path deve ser ser o mesmo e-mail do remetente.
	$headers = "MIME-Version: 1.1\r\n";
	$headers .= "Content-type: text/html; charset=utf-8\r\n";
	$headers .= "From: $de\r\n"; // remetente
	$envio = @mail($para, $assunto, $texto, $headers);
	 
	if($envio)
		return true;
	else
		return false;
 
}
?>