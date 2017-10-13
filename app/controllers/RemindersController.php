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
		switch ($response = Password::remind(Input::only('email_usuario')))
		{
			case Password::INVALID_USER:

				//return Redirect::back()->with('error', Lang::get($response));
				// $data = array(
			          
			 //          'message' => Lang::get($response)
			 //    );
			    Session::flash(
			    	'message', Lang::get($response)
			    );


				return Redirect::back()->withInput(Input::only('email_usuario'));

			case Password::REMINDER_SENT:

				// $data = array(
			          
			 //        'status' => Lang::get($response)
			 //    );
				Session::flash(
			    	'status', Lang::get($response)
			    );

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

		return View::make('password.reset')->with('token', $token);
	}

	/**
	 * Handle a POST request to reset a user's password.
	 *
	 * @return Response
	 */
	public function postReset()
	{
		$credentials = Input::only(
			'email', 'password', 'password_confirmation', 'token'
		);

		$response = Password::reset($credentials, function($user, $password)
		{
			$user->password = Hash::make($password);

			$user->save();
		});

		switch ($response)
		{
			case Password::INVALID_PASSWORD:
			case Password::INVALID_TOKEN:
			case Password::INVALID_USER:
				return Redirect::back()->with('error', Lang::get($response));

			case Password::PASSWORD_RESET:
				return Redirect::to('/');
		}
	}

}