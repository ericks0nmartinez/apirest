<?php

	$url = 'http://localhost:8888/api/v1';

	$montar = $url.'/estoque/mostrar';

	$retorno = file_get_contents($montar);
	var_dump($retorno);
	var_dump(json_decode($retorno, 1));