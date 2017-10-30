<?php


use Illuminate\Database\Eloquent\SoftDeletingTrait;
use \GuzzleHttp\Exception\RequestException;

class ClientesIndicacoes extends Eloquent {


	use SoftDeletingTrait;

	/**
	* The database table used by the model.
	*
	* @var string
	*/
	protected $table 		= 'clientes_indicados';

	protected $primaryKey 	= 'id_cliente_indicado';

	protected $fillable 	= ['nome_completo', 'email_cliente', 'data_nascimento_criacao', 'cpf_cnpj'];

	public static $rules 	= array(
    	'nome_completo'=>'required|min:2',
    	'email_cliente'=>'required|email|unique:clientes_indicados'
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

    // Retorna o total de indicados do parceiro

    public static function quantidadeIndicadosUsuario($id_user_sistema){

        // $totalIndicados  = DB::table('clientes_indicados')
        //                         ->select(DB::raw("COUNT(id_cliente_indicado) as indicados"))
        //                         ->where('id_user', '=', $id_user)->get();

        // return $totalIndicados;

        //Chama a API para trazer os dados dos clientes indicados

        //Inicia pacote para enviar dados para API
        $client             = new \GuzzleHttp\Client();

        try {

            $r = $client->get('https://api.eficazsystem.com.br/api/totalContatos/'.$id_user_sistema, 
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
                Session::flash('error_cad', 'Não foi possivel recuperar o total os contatos do parceiro.');

                return Redirect::back()->withInput();
            }

        }

        switch ($statusRequisicao) {

            case '200':
                
                $totalIndicados = $resultado[0]['totalIndicados'];

                return $totalIndicados;

            break;

            case '404':
                return $resultado;
            break;

            default:
               return $resultado;
            break;
        }

    }

    // Retorna os clientes indicados que estão no sistema

    public static function clientesIndicadosSistemas($id_user_sistema){

        //Chama a API para trazer os dados dos clientes indicados

        //Inicia pacote para enviar dados para API
        $client             = new \GuzzleHttp\Client();

        try {

            $r = $client->get('https://api.eficazsystem.com.br/api/listarContatos/'.$id_user_sistema, 
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
                Session::flash('error_cad', 'Não foi possivel recuperar a lista os orçamentos do parceiro.');

                return Redirect::back()->withInput();
            }

        }

        // $statusRequisicao   = $r->getStatusCode();
        // $resultado          = $r->json();

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

  
    /**
    * The database table used by the model.
    *
    * @var id_indicacao - id do cliente a ser verificado
    *
    * @var parceiro_sistema - id do parceiro que indicou o cliente
    */

    public static function pesquisarIndicacao($id_indicacao, $parceiro_sistema){

        //Chama a API para trazer os dados dos clientes indicados

        //Inicia pacote para enviar dados para API
        $client             = new \GuzzleHttp\Client();

        try {

            $r = $client->get('https://api.eficazsystem.com.br/api/contato/'.$id_indicacao,
                ['json' => [
                    "parceiro_sistema"  =>  $parceiro_sistema,
                ]]
            );

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


