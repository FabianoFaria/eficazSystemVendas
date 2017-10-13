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


    	$orcamentoParceiro  = DB::table('orcamentos_indicados')
    						->where('id_user', '=', $id_user)
    						->where('pagamentoComicao', '=', 0)
    						->get();

    	$arrayOrcamentos	= array();

    	if(!empty($orcamentoParceiro)){


    		//Inicia pacote para enviar dados para API
			$client = new \GuzzleHttp\Client();

			foreach ($orcamentoParceiro as $orcamento) {

				// Envia requisição para a API e recuperar o status dos orçamentos
				$r = $client->get('https://api.eficazsystem.com.br/api/statusOrcamentoCliente/'.$orcamento->id_orcamento_sistema );

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

    // Retorna o total de orçamentos do parceiro

    public static function quantidadeOrcamentoUsuario($id_user){

    	$totalOrcamentos  = DB::table('orcamentos_indicados')
    							->select(DB::raw("COUNT(id_orcamento) as orcamentos"))
    							->where('id_user', '=', $id_user)
    							->where('pagamentoComicao', '=', 0)
    							->get();

    	return $totalOrcamentos;
    }

    // Retorna o total em comissões a ser paga ao parceiro

    public static function orcamentosIndicados($id_user){

    	$orcamentosFechados = DB::table('orcamentos_indicados')
    							->select('id_orcamento',
    									'id_orcamento_sistema',
    									'id_cliente'
    									)
    							->where('id_user', '=', $id_user)
    							->where('pagamentoComicao', '=', 0)
    							->get();

    	//dd($orcamentosFechados);

    	return $orcamentosFechados;

    }

    // Retorna o valor da comisão, já com os valores de imposto e porcentagem descontado

    public static function comissaoOrcamentoAulso($valorTotalOrcamento){

    	/*
			preço liquido = Preço final - 18% de imposto
			total a pagar = preço liquido - 10%
    	*/

		$valorLiquido =  $valorTotalOrcamento - (($valorTotalOrcamento / 100) * 18);
		$valorComisao =  ($valorLiquido / 100) * 10;

		return $valorComisao;

    }
}
