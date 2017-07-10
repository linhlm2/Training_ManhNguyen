<?php
use \Model\User;
use \Model\Profile;
use \Model\Position;
use \Model\Department;

class Controller_Login extends Controller
{

	public function action_index()
	{
		if (Auth::check()) {
            Response::redirect('login');
        }
        $val = Validation::forge();

        if (Input::method() == 'POST') {
            // $val->add_field('username', 'Username', 'required|valid_string[alpha,lowercase,numeric]|max_length[50]');
            // $val->add_field('email', 'Email', 'required|valid_email|max_length[255]');
            // $val->add_field('password', 'Password', 'required|min_length[6]|max_length[12]');
            $val->add('email', 'Email or Username')
                ->add_rule('required');
            $val->add('password', 'Password')
                ->add_rule('required');

            if ($val->run()){
                if ( ! Auth::check()) {
                    if (Auth::login(Input::post('email'), Input::post('password'))){
                        // assign the user id that lasted updated this record
                        foreach (\Auth::verified() as $driver) {
                            if (($id = $driver->get_user_id()) !== false){
                                // credentials ok, go right in
                                $current_user = Model\Auth_User::find($id[1]);
                                
                                $profile = Model_Profile::find('first', array(
				                    'related' => array(
		                                'position',
		                                'department',
				                    ),
				                    'where' => array(
		                              	array('user_id', $current_user->id)
				                    )
				                ));
				                // \Debug::dump($profile); die();
				                if(empty($profile)) {
				                	$position_id = 0;
				                	$department_id = 0;
				                	$avatar = '';
				                } else {
				                	if(!empty($profile->department)) {
					                	$department_id = $profile->department->id;
					                } else {
					                	$department_id = 0;
					                }

					                if(!empty($profile->position)) {
					                	$position_id = $profile->position->id;
					                } else {
					                	$position_id = 0;
					                }
					                $avatar = $profile->avatar;
				                }

				                $user_session = array(
								   'user_id'		=> $current_user->id,
								   'user_info'		=> $current_user->username,
								   'group_id'		=> $current_user->group_id,
								   'department_id'  => $department_id,
								   'position_id'  	=> $position_id,
								   'avatar'			=> $avatar,
								);
                                Session::set($user_session);
                                Session::set_flash('success', e('Welcome, '.$current_user->username));
                                if (!empty($profile)) {
                                	if( $profile->flag == 0 )
                                		Response::redirect('user/changepassword/'.$current_user->id);
                                } else {
                                	Response::redirect('user/index');
                                }
                                break;
                            }
                        }
                    } else {
                        Session::set_flash('error', 'The username or password is incorrect!');
                    }
                } else {
                    Session::set_flash('error', 'Already logged in!');
                }
            }
        }
        return Response::forge(View::forge('login', array('val' => $val), false));
	}

    public function action_register() 
    {
        if (Input::method() == 'POST') {
            //Validate
            $val = Validation::forge('signup_validation');    
            $val->add_field(        
                'username',        
                'Username',        
                'required|valid_string[alpha,lowercase,numeric]|max_length[50]'   
                );    
            $val->add_field(        
                'password',        
                'Password',        
                'required'   
                );    
            $val->add('email', 'Email')        
                ->add_rule('required')       
                ->add_rule('valid_email');   
            // Running validation   
            if ($val->run()) {        
                try {
                    // Since validation passed, we try to create a user            
                    $user_id = Auth::create_user(                
                        Input::post('username'),                
                        Input::post('password'),                
                        Input::post('email')       
                    );

                    $profile = new Model_Profile();
                    $profile->user_id = $user_id;
                    $profile->save();

                    if ($user_id) {
                        $hash = \Auth::instance()->hash_password(\Str::random()).$user_id;
                        $data = new Model_Hash; 
                        $data->hash = $hash;
                        // $data->hash_type = SIGNUP;
                        $data->hash_type = 0;
                        $data->user_id = $user_id;
                        $data->expired_at = time() + (1 * 24 * 60 * 60);

                        $data->save(); 
                    }

                    \Package::load('email');
                    $email = Email::forge();
                    $email->subject('Verify your account.');
                    $data = array();
                    $data['url'] = \Uri::create('user/verification/' . base64_encode($hash) . '/');
                    $email->body(\View::forge('email/activation', $data));
                   
					$email->from('manhbker@gmail.com', 'Support Team');
                    $email->to('manhnvit@gmail.com', 'Demo');
                    try {
                        $email->send();
                        return Response::forge(View::forge('login/waiting', array('val' => $val), false));
                        // return Response::redirect('login/waiting');
                    } catch(\EmailValidationFailedException $e) {
                        // The validation failed
                        \Debug::dump($e);               
                        Session::set_flash('error',$e->getMessage());
                    } catch(\EmailSendingFailedException $e) {
                        // The driver could not send the email
                        \Debug::dump($e);           
                        Session::set_flash('error',$e->getMessage());
                    }      
                } catch (\SimpleUserUpdateException $e) {            
                // Either the username or email already exists            
                    Session::set_flash('error', e($e->getMessage()));
                }
            } else {      
                 // At least one field is not correct        
                Session::set_flash('error', e($val->error()));    
            }
        }
    }

    public function action_logout() 
    {
        Auth::logout();
        Session::set_flash('success', 'You have been successfully logged out');
        Session::delete('user_session');
        Response::redirect('login');
    }

    public function action_forgotpassword()
    {
    	$val = Validation::forge();
        if (Input::method() == 'POST') {
            $val->add('email', 'Email')
                ->add_rule('valid_email|max_length[255]');
            $val->add('username', 'Username')
                ->add_rule('valid_string[alpha,lowercase,numeric]|max_length[50]');

            if ($val->run()){
                if ( ! Auth::check()) {
                	$tmp = Model_User::find('first',array(             //record for compare with unique condition
						'where' => array(
					        array('username', Input::post('username'))					        
					    ),
					    'where' => array(
					        array('email', Input::post('email'))
					    ),
					));

                    if (!empty($tmp)) {									//check exist record
                        //send email
                        $hash = \Auth::instance()->hash_password(\Str::random()).$tmp->id;
                        $data = new Model_Hash; 
                        $data->hash = $hash;
                        // $data->hash_type = FORGOT;
                        $data->hash_type = 1;
                        $data->user_id = $tmp->id;
                        $data->expired_at = time() + (1 * 24 * 60 * 60);

                        $data->save();
                        
                        \Package::load('email');
	                    $email = Email::forge();
	                    $email->subject('Verify your account.');
	                    $data = array();
	                    $data['url'] = \Uri::create('user/recoverpassword/' . base64_encode($hash) . '/');
	                    $email->body(\View::forge('email/activation', $data));
	                   
						$email->from('manhbker@gmail.com', 'Support Team');
	                    $email->to('manhnvit@gmail.com', 'Demo');
	                    try {
	                        $email->send();
	                        return Response::redirect('/');
	                    } catch(\EmailValidationFailedException $e) {
	                        // The validation failed
	                        \Debug::dump($e);               
	                        Session::set_flash('error',$e->getMessage());
	                    } catch(\EmailSendingFailedException $e) {
	                        // The driver could not send the email
	                        \Debug::dump($e);           
	                        Session::set_flash('error',$e->getMessage());
	                    }

                    } else {
                        Session::set_flash('error', 'The username or email is incorrect!');
                    }
                } else {
                    Session::set_flash('error', 'Already logged in!');
                }
            }
        }
        return Response::forge(View::forge('forgotpassword', array('val' => $val), false));
    }

}
