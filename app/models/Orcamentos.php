<?php


use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Orcamentos extends Eloquent {

	use SoftDeletingTrait;

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table 		= 'orcamentos_indicados';

	protected $primaryKey 	= 'id_orcamento';

	protected $fillable 	= ['titulo_orcamento', 'descricao_orcamento'];

	public $errors;
    
	public static $rules = array(
		'titulo_orcamento'		=>'required|min:5',
		'descricao_orcamento'	=>'required|min:10'
	);

	public function isValid($data){

    	//FAZENDO A VALIDAÇÃO COM OS ATRIBUTOS DO PROPRIO OBJETO
    	//$validacao = Validator::Make($this->attributes, static::$rules);

    	$validacao = Validator::Make($data, static::$rules);

    	if($validacao->passes()){

    		return true;

    	}else{

    		$this->errors = $validacao->messages();

    		return false;

    	}

    }


    // Efetua a buscas de todos os orçamentos do parceiro
    public function orcamentoUsuario($id_user){


    	$orcamentoParceiro  = DB::table('orcamentos_indicados')->where('id_user', '=', $id_user)->get();

    	$arrayOrcamentos	= array();

    	if(!empty($orcamentoParceiro)){


    		//Inicia pacote para enviar dados para API
			$client = new \GuzzleHttp\Client();

			foreach ($orcamentoParceiro as $orcamento) {

				// Envia requisição para a API e recuperar o status dos orçamentos
				$r = $client->get('http://127.0.0.1/apiEficaz/public/api/orcamentoClienteDetalhado/'.$orcamento->id_orcamento_sistema );

				$statusRequisicao 	= $r->getStatusCode();
				$resultado			= $r->json();

				switch ($statusRequisicao) {

					case '200':

						//dd($resultado);

						if( !empty($resultado)){

							$dateTemp = $resultado['Data_Abertura'];

							$data  	  = explode(' ',$dateTemp);

							$resultado['Data_Abertura'] = implode('/', array_reverse(explode('-', $data[0])));

							array_push($arrayOrcamentos ,$resultado);
						}

					break;

					// case '201':

					// 	if(!empty($resultado) && $resultado != '404'){
							
					// 		$dateTemp = $resultado[0]['Data_Abertura'];

					// 		$data  	  = explode(' ',$dateTemp);

					// 		$resultado[0]['Data_Abertura'] = implode('/', array_reverse(explode('-', $data[0])));

					// 		array_push($arrayOrcamentos ,$resultado[0]);
					// 	}
					// break;

					case '404':
						echo 'Falha ao encontrar.';
					break;

					default:
						echo 'Falha ao encontrar.';
					break;
				}
			}


    	}else{

    		$arrayOrcamentos = null;

    	}


    	return $arrayOrcamentos;

    }
}
