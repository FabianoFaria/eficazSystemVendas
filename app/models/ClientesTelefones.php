<?php

use Illuminate\Database\Eloquent\SoftDeletingTrait;
use \GuzzleHttp\Exception\RequestException;


class ClientesTelefones extends Eloquent {


	use SoftDeletingTrait;


	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table 		= 'clientes_telefones';

	protected $primaryKey 	= 'id_cliente_telefone';

	protected $fillable 	= ['telefone'];

	public static $rules = array(
	  		'telefone'=> 'required|numeric|min:8',
	  		'observacao'=>'max:100'
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

    public static function pesquisarTelefonesIndicacao($id_cliente_indicado){

    	//Chama a API para trazer os dados dos clientes indicados

        //Inicia pacote para enviar dados para API
        $client             = new \GuzzleHttp\Client();

        try {

            $r = $client->get('https://api.eficazsystem.com.br/api/listarTelefones/'.$id_cliente_indicado, 
                ['json' => [
                    "parceiro_sistema"  =>  Input::get('id_parceiro'),
                ]]);

            $statusRequisicao   = $r->getStatusCode();
            $resultado          = $r->json();

            //dd($resultado);

        }catch (RequestException $e) {

            // Catch all 4XX errors 

            // To catch exactly error 400 use 
            if ($e->getResponse()->getStatusCode() == '400') {
                //echo "Got response 400";
                Session::flash('error_cad', 'Não foi possivel recuperar a lista dos telefones do parceiro.');

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

    public static function carregartelefoneIndicacao($id_telefone_indicado){

    	//Chama a API para trazer os dados dos clientes indicados

        //Inicia pacote para enviar dados para API
        $client             = new \GuzzleHttp\Client();

        try {

            $r = $client->get('https://api.eficazsystem.com.br/api/carregarTelefone/'.$id_telefone_indicado, 
                ['json' => [
                    "parceiro_sistema"  =>  Input::get('id_parceiro'),
                ]]);

            $statusRequisicao   = $r->getStatusCode();
            $resultado          = $r->json();

            //dd($resultado);

        }catch (RequestException $e) {

            // Catch all 4XX errors 

            // To catch exactly error 400 use 
            if ($e->getResponse()->getStatusCode() == '400') {
                //echo "Got response 400";
                Session::flash('error_cad', 'Não foi possivel recuperar a lista dos telefones do parceiro.');

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