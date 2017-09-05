<?php

class CustomValidator extends Illuminate\Validation\Validator {

	public function cpfCnpjVal($field, $value, $parameters){
	    
		$strlen = strlen($value);

		if($strlen == 11){
			//Tratamento de CPF

			$soma = 0;
	      
		    // Verifica 1º digito      
		    for ($i = 0; $i < 9; $i++) {         
		         $soma += (($i+1) * $value[$i]);
		    }

		    $d1 = ($soma % 11);
	      
		    if ($d1 == 10) {
		        $d1 = 0;
		    }

		    $soma = 0;
	      
		    // Verifica 2º digito
		    for ($i = 9, $j = 0; $i > 0; $i--, $j++) {
		        $soma += ($i * $value[$j]);
		    }
	      
	      	$d2 = ($soma % 11);

	      	if ($d2 == 10) {
	         	$d2 = 0;
	      	}      
	      
	      	if ($d1 == $value[9] && $d2 == $value[10]) {
	         	return true;
	      	}
		    else {
		        return false;
		    }

		}elseif($strlen == 14){
			//Tratamento de CNPJ

			$soma = 0;
	      
		    $soma += ($value[0] * 5);
		    $soma += ($value[1] * 4);
		    $soma += ($value[2] * 3);
		    $soma += ($value[3] * 2);
		    $soma += ($value[4] * 9); 
		    $soma += ($value[5] * 8);
		    $soma += ($value[6] * 7);
		    $soma += ($value[7] * 6);
		    $soma += ($value[8] * 5);
		    $soma += ($value[9] * 4);
		    $soma += ($value[10] * 3);
		    $soma += ($value[11] * 2); 

		    $d1 = $soma % 11; 
		    $d1 = $d1 < 2 ? 0 : 11 - $d1; 

			$soma = 0;
		    $soma += ($value[0] * 6); 
		    $soma += ($value[1] * 5);
		    $soma += ($value[2] * 4);
		    $soma += ($value[3] * 3);
		    $soma += ($value[4] * 2);
		    $soma += ($value[5] * 9);
		    $soma += ($value[6] * 8);
		    $soma += ($value[7] * 7);
		    $soma += ($value[8] * 6);
		    $soma += ($value[9] * 5);
		    $soma += ($value[10] * 4);
		    $soma += ($value[11] * 3);
		    $soma += ($value[12] * 2);

		    $d2 = $soma % 11; 
	      	$d2 = $d2 < 2 ? 0 : 11 - $d2; 

	      	if ($value[12] == $d1 && $value[13] == $d2) {
	         	return true;
	      	}
	      	else {
	         	return false;
	      	}
		}else{
			return false;
		}
	    
	}
}	