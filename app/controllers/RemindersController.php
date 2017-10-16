<?php

class RemindersController extends Controller {

	/**
	 * Display the password reminder view.
	 *
	 * @return Response
	 */
	public function getRemind()
	{
		return View::make('sitePrincipal.password_user');
	}

	/**
	 * Handle a POST request to remind a user of their password.
	 *
	 * @return Response
	 */
	public function postRemind()
	{

		$email = array('email_usuario' => Input::get('email_usuario'));
		//dd(Input::get('email_usuario'));
		
		$response =	Password::remind($email, function($message)
		{
			$message->subject('Email para alteração de senha.');
		});
		
		switch ($response)
		{
			case Password::INVALID_USER:

				//return Redirect::back()->with('error', Lang::get($response));
				// $data = array(
			          
			 //          'message' => Lang::get($response)
			 //    );
			    Session::flash(
			    	'message', Lang::get($response)
			    );


				return Redirect::back()->withInput($email);

			case Password::REMINDER_SENT:

				// $data = array(
			          
			 //        'status' => Lang::get($response)
			 //    );
				Session::flash(
			    	'status', Lang::get($response)
			    );

			 //    Password::remind(Input::only('email_usuario'), function($message)
				// {
				//     $message->subject('Renovar senha - Eficaz System Parcerias');
				//     $message->address(Input::only('email_usuario'));
				// });


				return Redirect::back();
		}
	}

	/**
	 * Display the password reset view for the given token.
	 *
	 * @param  string  $token
	 * @return Response
	 */
	public function getReset($token = null)
	{
		if (is_null($token)) App::abort(404);

		return View::make('sitePrincipal.password_reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{

		$rules = array(
            'email_usuario'      		=> 'required|email',
            'password' 					=> 'alpha_num|between:6,32|same:password_confirmation',
            'password_confirmation' 	=> 'alpha_num|between:6,32|same:password'
        );

		$validator = Validator::make(Input::all(), $rules);

		// process the login
        if ($validator->fails()) {

        	return Redirect::back()
                ->withErrors($validator)
                ->withInput(Input::except('senhaUsuario'),Input::except('confirmaSenhaUsuario'));

        }else{

        	$credentials = Input::only(
			'email_usuario', 'password', 'password_confirmation', 'token');

			$response = Password::reset($credentials, function($user, $password)
			{
				$user->senha_usuario = Hash::make($password);

				$user->save();
			});

			switch ($response)
			{
				case Password::INVALID_PASSWORD:
				case Password::INVALID_TOKEN:
				case Password::INVALID_USER:

					Session::flash('errorResposta', Lang::get($response));

					return Redirect::back()
									->withInput(Input::except('senhaUsuario'),Input::except('confirmaSenhaUsuario'));
				break;

				case Password::PASSWORD_RESET:
					//return Redirect::to('/');
					return View::make( 'sitePrincipal.password_reset_confirmado');
			}

        }

	}



}
