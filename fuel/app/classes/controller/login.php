<?php
use \Model\User;
use \Model\Profile;
use \Model\Position;
use \Model\Department;

class Controller_Login extends Controller_Template
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
                                Session::set_flash('success', e('Welcome, '.$current_user->username));
                                $profile = Model_Profile::find('first', array(
				                    'related' => array(
		                                'position',
		                                'department',
				                    ),
				                    'where' => array(
		                              	array('user_id', $current_user->id)
				                    )
				                ));
                                Session::set(array(
								   'user_id'		=> $current_user->id,
								   'user_info'		=> $current_user->username,
								   'department_id'  => $profile->department->id,
								   'position_id'  	=> $profile->position->id,
								   'avatar'			=> $profile->avatar,
								));

                                Response::redirect('user/index');
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

        // $this->template->title = 'Login';
        // $this->template->content = View::forge('login', array('val' => $val), false);
        return Response::forge(View::forge('login', array('val' => $val), false));
        // View::set_global('val', $val);
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

                    if ($user_id && $profile->save() ) {
                        $hash = \Auth::instance()->hash_password(\Str::random()).$user_id;
                        $data = new Model_Hash; 
                        $data->hash = $hash;
                        // $data->hash_type = SIGNUP;
                        $data->hash_type = 0;
                        $data->user_id = $user_id;
                        $data->expired_at = time() + (1 * 24 * 60 * 60);

                        $data->save(); 
                    }

                    // Send email
                    // Create an instance
                    // Use the default config and change the driver
                    $username = Input::post('username');
                    \Package::load('email');
                    $email = \Email::forge('my_defaults',array(
                        'driver' => 'smtp',
                    ));
                    $email->subject('Verify your account.');

                    /*$email->body(\View::forge(        
                        'email/activation',       
                         array(            
                            'hash' => $hash,
                            'username' => $username,       
                             )    
                         )->render() 
                    );*/

                    $email->body(\View::forge('email/activation')
                        ->set('url', \Uri::create('activation/' . base64_encode($hash) . '/'), false)
                        ->set()
                        ->render() 
                    );

                    $email->from('azzurricatenacciomilano@gmail.com', 'Support Team');
                    $email->to('manhnvit@gmail.com', 'Demo');


                    // if ($user_id && $profile->save()) {
                    //     $hash = \Auth::instance()->hash_password(\Str::random()).$user_id;
                    //     $data = new Model_Hash; 
                    //     $data->hash = $hash;
                    //     // $data->hash_type = SIGNUP;
                    //     $data->hash_type = 0;
                    //     $data->user_id = $user_id;
                    //     $data->expired = time();

                    //     // send an email out with a reset link
                    //     \Package::load('email');
                    //     $email = \Email::forge();

                    //     // use a view file to generate the email message
                    //     $email->html_body(
                    //         \Theme::instance()->view('email/activation')
                    //             ->set('url', \Uri::create('activation/' . base64_encode($hash) . '/'), false)
                    //             ->set('user', $user, false)
                    //             ->render()
                    //     );

                    //     // give it a subject
                    //     $email->subject(__('login.password-recovery'));

                    //     // add from- and to address
                    //     // $from = \Config::get('application.email-addresses.from.website', 'website@example.org');
                    //     // $email->from($from['email'], $from['name']);
                    //     $email->from('azzurricatenacciomilano@gmail.com', 'Support Team');
                    //     $email->to('manhnvit@gmail.com', 'Test');
                    // }

                    try {
                        $email->send();
                        Session::set_flash('success', e('Verification email send successfully. Please confirm for active account.'));
                        Response::redirect('login'); 
                    } catch(\EmailValidationFailedException $e) {
                        // The validation failed
                        \Debug::dump($e);               
                        Session::set_flash('error',$e->getMessage());
                    } catch(\EmailSendingFailedException $e) {
                        // The driver could not send the email
                        \Debug::dump($e);           
                        Session::set_flash('error',$e->getMessage());
                    }

                    // Session::set_flash('success', e('Welcome '.Input::post('username').'!'));
                    // Response::redirect('admin/index');        
                } catch (\SimpleUserUpdateException $e) {            
                // Either the username or email already exists            
                    Session::set_flash('error', e($e->getMessage()));
                }
            } else {      
                 // At least one field is not correct
           //     Session::set_flash('error', $val->error());        
                Session::set_flash('error', e($val->error()));    
            }
        }
    }

    public function action_logout() 
    {
        Auth::logout();
        Session::set_flash('success', 'You have been successfully logged out');
        Response::redirect('login');
    }

}
