<?php

use \Model\Department;
class Controller_User extends Controller_Base
{
	// public function before()
	// {
	// 	parent::before();

	// 	if (Request::active()->controller !== 'Controller_User' or ! in_array(Request::active()->action, array('index','login','logout','forgotpassword'))){
	// 		if (Auth::check()){
	// 			$admin_group_id = Config::get('auth.driver', 'Simpleauth') == 'Ormauth' ? 6 : 100;
	// 			if ( ! Auth::member($admin_group_id))
	// 			{
	// 				Session::set_flash('error', e('You don\'t have access to the admin panel'));
	// 				Response::redirect('/');
	// 			}else{
	// 				Response::redirect('user/index');
	// 			}
	// 		}else{
	// 			die('aaaaaa');
 //                Response::redirect('user/login');
	// 		}
	// 	}
	// }



    public function action_index()
    {
        $data['users'] = Model_User::find('all');
        $this->template->title = "Users";
        $this->template->content = View::forge('user/index', $data);

    }

    public function action_view($id = null)
    {
        is_null($id) and Response::redirect('user');

        // $data['user'] = Model_User::find($id);
        $data['user'] = Model_User::find('first', array(
                    'related' => array(
                        'profile' => array(
                            'related' => array(
                                'position',
                                // 'department',
                            ),
                        )
                    ),
                    'where' => array(
                              array('id', $id)
                    )
                ));
        echo \DB::last_query();
        // \Debug::dump($data['user']); die();
        $this->template->title = "User";
        $this->template->content = View::forge('user/view', $data);

    }

    public function action_create()
    {
        if (Input::method() == 'POST') {
            $val = Model_User::validate('create');

            if ($val->run()) {
                $user_id = Auth::create_user(                
                    Input::post('username'),                
                    '12345678',                
                    Input::post('email')       
                );

                if ($user_id) {
                    Session::set_flash('success', 'Added user #'.$user_id.'.');
                    Response::redirect('user');
                } else {
                    Session::set_flash('error', 'Could not save user.');
                }
            } else {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->title = "Users";
        $this->template->content = View::forge('user/create');

    }

    public function action_edit($id = null)
    {
        is_null($id) and Response::redirect('user');

        $a = Model_Department::find('all');
        $departments = array();
        foreach ($a as $key => $value){
            $departments[$value['id']] = $value['name'];
        }
        array_unshift($departments, '');
        $user = Model_User::find('first', array(
                    'related' => array(
                        'profile' => array(
                            'related' => array(
                                'position',
                                'department',
                            ),
                        )
                    ),
                    'where' => array(
                              array('id', $id)
                    )
                ));
        if (Input::method() == 'POST') {
            $val = Model_User::validate('edit');
            if ($val->run()) {
                $user->profile->firstname = Input::post('firstname');
                $user->profile->lastname = Input::post('lastname');
                $user->profile->birthday = Input::post('birthday');
                $user->profile->deparment = Input::post('deparment');
                $user->profile->position = Input::post('position');
                $user->profile->address = Input::post('address');
                $user->profile->phone = Input::post('phone');
                $user->profile->gender = Input::post('gender');
                if ($user->profile->save()) {
                    Session::set_flash('success', 'Updated user #'.$id);
                    Response::redirect('user');
                } else {
                    Session::set_flash('error', 'Nothing updated.');
                }
            } else {
                Session::set_flash('error', $val->error());
            }
        }

        $this->template->set_global('user', $user, false);
        $this->template->set_global('departments', $departments, false);
        $this->template->title = "Users";
        $this->template->content = View::forge('user/edit');

    }

    public function action_delete($id = null)
    {
        if ($user = Model_User::find($id)) {
            $user->delete();

            Session::set_flash('success', 'Deleted user #'.$id);
        } else {
            Session::set_flash('error', 'Could not delete user #'.$id);
        }

        Response::redirect('user');

    }



	public function action_login() 
    {
        if (Auth::check()) 
        {
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
                ->add_rule('required|min_length[6]|max_length[12]');

            if ($val->run()){
                if ( ! Auth::check()) {
                    if (Auth::login(Input::post('email'), Input::post('password'))){
                        // assign the user id that lasted updated this record
                        foreach (\Auth::verified() as $driver) {
                            if (($id = $driver->get_user_id()) !== false){
                                // credentials ok, go right in
                                $current_user = Model\Auth_User::find($id[1]);
                                Session::set_flash('success', e('Welcome, '.$current_user->username));
                                Response::redirect('user/index');
                            }
                        }
                    } else {
                        //$this->template->set_global('login_error', 'The username or password is incorrect!');
                        Session::set_flash('error', 'The username or password is incorrect!');
                    }
                } else {
                    // $this->template->set_global('login_error', 'Already logged in!');
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
        //Validate
        $val = Validation::forge('signup_validation');    
        $val->add_field(        
            'username',        
            'Username',        
            'required|valid_string[alpha,lowercase,numeric]'    
            );    
        $val->add_field(        
            'password',        
            'Password',        
            'required|min_length[6]|max_length[12]'    
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
                    $hash = \Auth::instance()->hash_password(\Str::random());
                    $hash = base64_encode($hash);

                    $data = new Model_Hash; 
                    $data->hash = $hash;
                    $data->hash_type = SIGNUP;
                    $data->user_id = $user_id;
                    $data->expired = time();

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

                $email->body(\View::forge(        
                    'admin/email',       
                     array(            
                        'hash' => $hash,
                        'username' => $username,       
                         )    
                     )->render() 
                );

                $email->from('azzurricatenacciomilano@gmail.com', 'Support Demo App');
                $email->to('manhnvit@gmail.com', 'Its the Other!');
                try {
                    $email->send();
                    Session::set_flash('success', e('Verification email send successfully. Please confirm for active account.'));
                    Response::redirect('admin/index'); 
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
            Session::set_flash('error', e($val->error()));    
        }
    }

    public function action_logout() 
    {
        Auth::logout();
        Session::set_flash('success', 'You have been successfully logged out');
        Response::redirect('user/login');
    }

    public function action_verification($hash = NULL)
    {
        if (Input::method() == 'GET') {
            $hashinfo = Model_Hash::find('first', array(
                'where' => array(
                    array('hash', $hash),
                ),
            ));

            // and find the user with this id
            if ($user = \Model\Auth_User::find_by_id($hashinfo->user_id)) {
                // do we have this hash for this user, and hasn't it expired yet (we allow for 24 hours response)?
                if (isset($user) and (time() - $hashinfo->created_at < 86400)) {
                    // invalidate the hash
                    \Auth::update_user(
                        array(
                            'active' => 1
                        ),
                        $user->username
                    );

                    // log the user in and go to the profile to change the password
                    if (\Auth::instance()->force_login($user->id)) {
                        Session::set_flash('success', e('Verification successfully.'));
                        \Response::redirect('admin/index');
                    }
                }
            }

            return View::forge('admin/waitverify');
        }
    }

    public function action_forgotpassword()
    {
        return Response::forge(View::forge('forgotpassword'));
    }

    public function action_changeemail()
    {
        \Debug::dump(); die();
        $this->template->title = 'Change Email';
        $this->template->content = View::forge('admin/changeemail');
    }

}
