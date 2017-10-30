<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use \GuzzleHttp\Exception\RequestException;


class ClientesEnderecos extends Eloquent {


	use SoftDeletingTrait;


	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table 		= 'clientes_enderecos';

	protected $primaryKey 	= 'id_cliente_endereco';

	protected $fillable 	= ['logradouro','numero','complemento','bairro','cidade','estado_endereco', 'cep'];

	public static $rules 	= array(
		'logradouro'=> 'required|min:2',
        'bairro'=> 'required|min:2',
    	'cidade'=>'required',
    	'estado_endereco'=>'required',
    	'cep'=>'required|min:8|max:9',
	);

	public $errors;

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

    public static function pesquisarEnderecosIndicacao($id_cliente_indicado){

    	//Chama a API para trazer os dados dos clientes indicados

        //Inicia pacote para enviar dados para API
        $client             = new \GuzzleHttp\Client();

    	try {

            $r = $client->get('https://api.eficazsystem.com.br/api/listarEnderecos/'.$id_cliente_indicado);

            $statusRequisicao   = $r->getStatusCode();
            $resultado          = $r->json();

            //dd($resultado);

        }catch (RequestException $e) {

            // Catch all 4XX errors 

            // To catch exactly error 400 use 
            if ($e->getResponse()->getStatusCode() == '400') {
                //echo "Got response 400";
                Session::flash('error_cad', 'Não foi possivel recuperar a lista os orçamentos do parceiro.');

                return Redirect::back()->withInput();
            }

        }

        switch ($statusRequisicao) {

            case '200':
                
                return $resultado;

            break;

            case '404':
                return $resultado;
            break;

            default:
               return $resultado;
            break;
        }

    }

    public static function carregarEnderecosIndicacao($id_endereco_indicado){

    	//Chama a API para trazer os dados dos clientes indicados

        //Inicia pacote para enviar dados para API
        $client             = new \GuzzleHttp\Client();

        try {

            $r = $client->get('https://api.eficazsystem.com.br/api/carregarEndereco/'.$id_endereco_indicado);

            $statusRequisicao   = $r->getStatusCode();
            $resultado          = $r->json();

            //dd($resultado);

        }catch (RequestException $e) {

            // Catch all 4XX errors 

            // To catch exactly error 400 use 
            if ($e->getResponse()->getStatusCode() == '400') {
                //echo "Got response 400";
                Session::flash('error_cad', 'Não foi possivel recuperar a lista os orçamentos do parceiro.');

                return Redirect::back()->withInput();
            }

        }

    	switch ($statusRequisicao) {

            case '200':
                
                return $resultado;

            break;

            case '404':
                return $resultado;
            break;

            default:
               return $resultado;
            break;
        }

    }


}