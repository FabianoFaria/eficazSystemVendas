<?php
 
class UsersEficazController extends BaseController {


	protected $layout = "layouts.main";

	protected $user;

	public function __construct(User $user) {
	    //$this->beforeFilter('csrf', array('on'=>'post'));

	    $this->user = $user;
	}

	public function index() {

		//Verifica se está logado ou não

		// if(Auth::check()){

		// 	//Usuário logado
		 	//return Redirect::to('/admin');

		// }else{
		// 	return View::make('usersEficaz.login');
		// }

		//Status de usuários existentes
		$status 	= StatusUsuarios::all();


		//CARREGA TODOS OS USUÁRIOS ATIVOS PARA SEREM EXIBIDOS
		$users 		= User::where('status', '>', 0)->get();

		
		//Status do usuario logado...
		$status_usuario = Session::get('status');

		//Verifica para qual tela de administração será redirecionada o admin
		switch ($status_usuario) {
			case 'Admin':
					
				return View::make('usersEficaz.listaUsuarios', ['usuariosAtivos' => $users, 'status_users' => $status]);

			break;
				
			case 'Parceiros':
					
				//return View::make( 'enderecos.parceiros_enderecos', $dados);
				return Redirect::to('admin');


			break;

			case 'Cliente':
				# code...
			break;
		}


	}

	// public function getLogin() {
	//     $this->layout->content = View::make('usersEficaz.login');
	// }

	// public function getRegister() {
	//     $this->layout->content = View::make('usersEficaz.register');
	// }

	// public function postCreate() {
 //    	$validator = Validator::make(Input::all(), User::$rules);
 
	//     if ($validator->passes()) {


	//     	//Regras para dar segurança para a senha 

	//     	/* 
	// 			//CUSTO DO HASH
	//             $custo = 15;

	//             //GERAR SALT
	//             $salt = uniqid(mt_rand(), true);

	//             // Gera um hash baseado em bcrypt
	//             $hash = crypt($senha, '$2a$' . $custo . '$' . $salt . '$');
	//     	*/


	//         // validation has passed, save user in DB
	//         $user = new User;
	// 	    $user->firstname = Input::get('firstname');
	// 	    $user->lastname = Input::get('lastname');
	// 	    $user->email = Input::get('email');
	// 	    $user->password = Hash::make(Input::get('password'));
	// 	    $user->save();
 
 //    		return Redirect::to('users/login')->with('message', 'Thanks for registering!');
	//     } else {
	//         // validation has failed, display error messages    
	//     }
	// }


	public function create(){

		//Status do usuario logado...
		$status_usuario = Session::get('status');

		$status 		= StatusUsuarios::all();

		//Verifica para qual tela de administração será redirecionada o admin
		switch ($status_usuario) {
			case 'Admin':
				
				return View::make('usersEficaz.create', array('statusUsuario' => $status));
			
			break;
				
			case 'Parceiros':
					
				//return View::make( 'enderecos.parceiros_enderecos', $dados);
				return Redirect::to('admin');


			break;

			case 'Cliente':
				# code...
			break;
		}

	}


	//Função para criação de usuários através da página principal
	public function criar_usuario(){
		
		return View::make('sitePrincipal.registrar');

	}


	public function show($idUser){

		$user 		= User::find($idUser);

		$ativoDesde = $user->created_at;

		$ativoDesde = explode(' ', $ativoDesde);

		$ativoDesde = implode('/', array_reverse(explode('-',$ativoDesde[0])));

		//Status do usuario logado...
		$status_usuario = Session::get('status');

		//Verifica para qual tela de administração será redirecionada o admin
		switch ($status_usuario) {
			case 'Admin':

				//Logo, o admin irá carregar mais tipos de dados conforme a necessidade.
				$dados = [
					'ativo_desde' => $ativoDesde,
				];

				
				//retorna a view com os dados necessarios.
				return View::make('usersEficaz.dadosUsuario', array( 'usuario' => $user, $dados));
				//return 'show usuário!';
			
			break;
				
			case 'Parceiros':
				
				$dadosVendedor 	= VendedoresDados::where('id_user', $idUser)->first();
				$dadosTelefones = VendedoresTelefones::where('id_user', $idUser)->take(5)->get();
				$dadosEndereco  = VendedoresEnderecos::where('id_user', $idUser)->take(5)->get();
				$dadosFinancas 	= VendedoresFinancas::where('id_user', $idUser)->take(5)->get();
				$estados 		= EstadosPais::all();
				$tipos_conta	= TipoContaBancaria::all();
				$lista_bancos 	= InstituicoesBancarias::all();

				$dados = [
					'user' 			=> $user,
					'ativo_desde' 	=> $ativoDesde,
					'vendedor'		=> $dadosVendedor,
					'telefones' 	=> $dadosTelefones,
					'enderecos' 	=> $dadosEndereco,
					'informacoes_bancarias' => $dadosFinancas,
					'estados' 		=> $estados,
					'tipo_contas'   => $tipos_conta,
					'lista_bancos' 	=> $lista_bancos,
				];

				return View::make( 'parceiros.dadosUsuarios', $dados);

			break;

			case 'Cliente':
				# code...
			break;
		}


	}

	public function store(){


		//OUTRO MODO DE EFETUAR A VALIDAÇÃO, INJETANDO OS DADOS DIRETO NO OBJETO E ENTÃO EFETUANDO A VALIDAÇÃO DENTRO DELE MESMO
		//$this->user->fill(Input::all());
		//
		//if( ! $this->user->isValid()){

		//Dentro da model User, fazer a validação do seguinte modo:
		//$validacao = Validator::Make($this->attributes, static::$rules);




		if( ! $this->user->isValid($input = Input::all())){

			//return 'Falha de validação!';
			//return Redirect::back()->withInput()->withErrors($validacao->messages());
			return Redirect::back()->withInput()->withErrors($this->user->errors);

		}else{

			// POR CONFLITOS COM AS REGRAS DE VALIDAÇÃO, OS ATRIBUTOS ESTÃO SENDO COLOCADOS MANUALMENTE
			//$this->user->create($input);

			// $senha 				=  Input::get('senhaNovoUsuario');
			// $senhaConfirmada 	=  Input::get('confirmaSenhaNovoUsuario');

			// if($senha == $senhaConfirmada){

				//CÓDIGO REFATORADO POR MOTIVOS DE MELHORIAS DE PRATICAS, COMO INSTANCIAÇÃO DA MODEL NA CONTROLER.
				// $user = new User();

			$this->user->nome_usuario = Input::get('nomeCliente');
			$this->user->senha_usuario = Hash::Make(Input::get('senhaNovoUsuario'));
			$this->user->email_usuario = Input::get('emailEnd');
			
			if(Input::get('status_usuario') != ''){
				$this->user->status = Input::get('status_usuario');
			}else{
				$this->user->status = 8;
			}

				// //dd($user);

			$this->user->save();

				// Modo hardcoded
				//return Redirect::to('/users');

				// Modo Restful
			
			// return Redirect::route('users.index');
			return Redirect::route('users.index');

			// }else{

			// 	//return 'Falha de validação!';
			// 	return Redirect::back()->withInput()->withErrors(User::$errors);
			// }

		}

		//return Input::all();

		
		//$user = Input::all();

	}

	public function edit($idUser){

		$user 			= User::find($idUser);
		$status 		= StatusUsuarios::all();

		//Status do usuario logado...
		$status_usuario = Session::get('status');

		$dados 			= [
			'statusUsuario' => $status,
			'usuario' => $user,
		];


		//Verifica para qual tela de administração será redirecionada o admin
		switch ($status_usuario) {
			case 'Admin':
					
				//retorna a view com os dados necessarios.
				return View::make('usersEficaz.editar', $dados);

			break;
				
			case 'Parceiros':
					
				return View::make( 'parceiros.parceiros_editar', $dados);

			break;

			case 'Cliente':
				# code...
			break;
		}

	}

	public function update($id){


		// validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'nomeCliente'       	=> 'required',
            'emailEnd'      		=> 'required|email',
            'senhaUsuario' 			=> 'alpha_num|between:6,32|same:confirmaSenhaUsuario',
            'confirmaSenhaUsuario' 	=> 'alpha_num|between:6,32|same:senhaUsuario'
        );

        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {

        	return Redirect::to('users/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('senhaUsuario'),Input::except('confirmaSenhaUsuario'));

        }else{

        	//dd(Input::all());

        	// Salvar o usuário
        	$this->user = User::find($id);
           	$this->user->nome_usuario = Input::get('nomeCliente');
			$this->user->email_usuario = Input::get('emailEnd');
			
			//Verifica se o status foi alterado ou não
			if(Input::get('status_usuario') != ''){
				$this->user->status = Input::get('status_usuario');
			}

			//Verifica se a senha será atualizada ou não
			if(Input::get('senhaUsuario') != ''){
				$this->user->senha_usuario = Hash::Make(Input::get('senhaUsuario'));
			}

			$this->user->save();

			// redirect
            Session::flash('message', 'Usuário foi atualizado com sucesso!');
            return Redirect::to('admin');

        }

		//return 'show edicao de usuário!';

	}

	public function criar_vendor(){


		return 'tela para registro de vendedores!';

	}

	public function guardar_parceria(){
		if( ! $this->user->isValid($input = Input::all())){

			return Redirect::back()->withInput()->withErrors($this->user->errors);

		}else{


			$this->user->nome_usuario = Input::get('nomeCliente');
			$this->user->senha_usuario = Hash::Make(Input::get('senhaNovoUsuario'));
			$this->user->email_usuario = Input::get('email');
			
			if(Input::get('status_usuario') != ''){
				$this->user->status = Input::get('status_usuario');
			}else{

				$status = StatusUsuarios::all();

				foreach ($status->all()  as $statu) {

					if($statu->status_usuario == 'Parceiros'){
			
						$this->user->status = $statu->id_status;
					}

				}

				//$this->user->status = 8;
			}

			$this->user->save();

			$data = array(
				'nomeUsuario'=> Input::get('nomeCliente')
			);

			//Teste de envio de email para parceiro recem cadastrado
			Mail::send('emails.bemVindo', $data, function($message)
			{
			  	//
				$message->to(Input::get('email'), Input::get('nomeCliente'))
          ->subject('Bem Vindo a Efficaz,'.Input::get('nomeCliente').' !');

			});


			// return Redirect::route('users.index');
			//Redireciona para a página de boas vindas com a mensagem de sucesso do cadastro.
			return Redirect::to('bemVindo')->with('cadastro', 'Cadastro concluído!');

		}
	}

	public function bemVindo(){
		

		$cadastro = Session::get('cadastro');

		if(!isset($cadastro)){

			return Redirect::to('registrar');

		}else{
			return View::make('sitePrincipal.bemVindo');
		}

	}
}

?>