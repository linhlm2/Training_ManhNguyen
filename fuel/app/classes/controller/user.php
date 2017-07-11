<?php
use \Model\Hash;
use \Model\Department;
class Controller_User extends Controller_Template
{
	// public function before()
	// {
	// 	parent::before();
 //        $user_id = Session::get('user_id');
 //        $group_id = Session::get('group_id');
 //        if (!empty($user_id)) {			
	// 		if ($group_id !== 2) {
 //                if ($group_id !== 6) {
 //                    Session::set_flash('error', e('You don\'t have access to the admin panel'));
 //                    Response::redirect('user/view/'.$user_id);
 //                } else {
 //                    Response::redirect('user/index');
 //                }
	// 		}else{
 //                Response::redirect('/');
	// 		}
	// 	} else {
 //            Response::redirect('/');
 //        }
	// }

    // public static function _init()
    //     {
    //         if (Auth::check()){
    //             $admin_group_id = Config::get('auth.driver', 'Simpleauth') == 'Ormauth' ? 6 : 100;
    //             // if ( ! Auth::member($admin_group_id)) {
    //             //     Session::set_flash('error', e('You don\'t have access to the admin panel'));
    //             //     Response::redirect('/');
    //             // }else{
    //             //     die('before function');
    //                 Response::redirect('user/index');
    //             // }
    //         }else{
    //             Request::forge('login');   
    //             // return Response::redirect('login');
    //         }
    //     }


    public function action_index()
    {
        // die('aa');
        $data['users'] = Model_User::find('all', array(
                'related' => array(
                        'profile' => array(
                            'related' => array(
                                'position',
                                'department',
                            ),
                        )
                    ),
                'order_by' => array('created_at' => 'desc')
            ));
        $this->template->title = "Users";
        $this->template->content = View::forge('user/index', $data);

    }

    public function action_view($id = null)
    {
        is_null($id) and Response::redirect('user');
        $data['user'] = Model_User::find('first', array(
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
        $this->template->title = "User";
        $this->template->content = View::forge('user/view', $data);

    }

    public function action_create()
    {
        $listDepartment = Model_Department::find('all');
        $departments = array();
        foreach ($listDepartment as $key => $value){
            $departments[$value['id']] = $value['name'];
        }

        $positions = Model_Position::find('all');

        array_unshift($departments, '');
        if (Input::method() == 'POST') {
            // $val = Model_User::validate('create');
            $val = Validation::forge();
            $val->add('email', 'Email or Username')
                ->add_rule('required');
            $val->add('password', 'Password')
                ->add_rule('required');
            $val->add('firstname', 'First Name') 
                ->add_rule('max_length[255]');
            $val->add('lastname', 'Last Name') 
                ->add_rule('max_length[255]');
            $val->add_field('birthday ', 'Birthday')
                ->add_rule('max_length[255]');
            $val->add_field('address', 'Address')
                ->add_rule('max_length[255]');
            $val->add_field('department ', 'Department')
                ->add_rule('max_length[255]');
            $val->add_field('position ', 'Position')
                ->add_rule('max_length[255]');
            $val->add_field('phone', 'Phone')
                ->add_rule('max_length[20]');
            $val->add_field('gender', 'Gender')
                ->add_rule('match_collection[M,F]');

            if ($val->run()) {
                $user_id = Auth::create_user(                
                    Input::post('username'),                
                    '12345678',                
                    Input::post('email')       
                );

                $profile = new Model_Profile();
                $profile->user_id = $user_id;
                $profile->firstname = Input::post('firstname');
                $profile->lastname = Input::post('lastname');
                $profile->birthday = Input::post('birthday');
                $profile->deparment = Input::post('deparment');
                $profile->position = Input::post('position');
                $profile->address = Input::post('address');
                $profile->phone = Input::post('phone');
                $profile->gender = Input::post('gender');
                $profile->save();

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
        $this->template->set_global('departments', $departments, false);
        $this->template->set_global('positions', $positions, false);
    }

    public function action_edit($id = null)
    {
        is_null($id) and Response::redirect('user');

        $a = Model_Department::find('all');
        $departments = array();
        if (!empty($a)) {
            foreach ($a as $key => $value){
                $departments[$value['id']] = $value['name'];
            }
            array_unshift($departments, 'Choose');
        }
        
        $positions = Model_Position::find('all');
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
        $this->template->set_global('positions', $positions, false);
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

    public function action_verification($hash = NULL)
    {
        if (Input::method() == 'GET') {
            // decode the hash
            $hash = base64_decode($hash);
        
            // get the userid from the hash
            $user_id = substr($hash, 44);

            $hashinfo = Model_Hash::find('first', array(
                'where' => array(
                    array('hash', $hash),
                ),
            ));

            // and find the user with this id
            if ($user = Model_User::find_by_id($hashinfo->user_id)) {
                // do we have this hash for this user, and hasn't it expired yet (we allow for 24 hours response)?
                if (isset($user) and (time() - $hashinfo->created_at < 86400)) {
                    // invalidate the hash and active user
                    $now = time();
                    DB::query('UPDATE `profiles` SET `active` = 1 WHERE `user_id` ='.$user_id)->execute();
                    DB::query('UPDATE `hashes` SET `expired_at` = '.$now.' WHERE `user_id` ='.$user_id)->execute();
                    // log the user in and go to the profile to change the password
                    if (\Auth::instance()->force_login($user->id)) {
                        Session::set_flash('success', e('Verification successfully.'));
                        \Response::redirect('user/index');
                    }
                }
            }

            // return View::forge('admin/waitverify');
        }
    }

    public function action_recoverpassword($hash = NULL)
    {
        if (Input::method() == 'GET') {
            // decode the hash
            $hash = base64_decode($hash);
        
            // get the userid from the hash
            $user_id = substr($hash, 44);

            $hashinfo = Model_Hash::find('first', array(
                'where' => array(
                    array('hash', $hash),
                ),
            ));

            // and find the user with this id
            if ($user = Model_User::find_by_id($hashinfo->user_id)) {
                // do we have this hash for this user, and hasn't it expired yet (we allow for 24 hours response)?
                if (isset($user) and (time() - $hashinfo->created_at < 86400)) {
                    \Auth::update_user(
                        array(
                            'lostpassword_hash' => null,
                            'lostpassword_created' => null
                        ),
                        $user->username
                    );
                    Auth::update_user(
                        array(
                            'password' => '111111',    // set a new password
                        ),
                        $user->username
                    );
                    DB::query('UPDATE `profiles` SET `flag` = 0 WHERE `user_id` ='.$user_id)->execute();
                    DB::query('UPDATE `hashes` SET `expired_at` = '.$now.' WHERE `user_id` ='.$user_id)->execute();
                    // log the user in and go to the profile to change the password
                    if (\Auth::instance()->force_login($user->id)) {
                        Session::set_flash('success', e('Verification successfully.'));
                        \Response::redirect('user/index');
                    }
                }
            }

            // return View::forge('admin/waitverify');
        }
    }


    public function action_changepassword($id= null) 
    {
        if (Input::method() == 'POST') {
            $val = Validation::forge();;
            $val->add('password', 'Password')
                ->add_rule('required');
            $val->add('password_confirm', 'Password')
                ->add_rule('required');
            if ($val->run()) {
                if (strnatcmp(Input::post('password'), Input::post('password_confirm')) == 0) {
                    //transaction code flow
                    $db = DB::instance();               // get the default connection
                    $db->start_transaction();           //start transaction
                    try {
                        $user = Model_User::find($id);
                        $user->password = \Auth::instance()->hash_password(Input::post('password'));

                        $db->commit_transaction();      //commit transaction

                        DB::query('UPDATE `profiles` SET `flag` = 1 WHERE `user_id` ='.$id)->execute();
                        $user->save();
                        if ($user->save()) {
                            Session::set_flash('success', 'Change password successfully.');
                            Response::redirect('user/changepassword/'.$id);
                        } else {
                            Session::set_flash('error', 'Nothing updated.');
                        }
                    } catch (Exception $e) {
                        // rollback pending transactional queries
                        $db->commit_transaction();
                        throw $e;
                    }
                } else {
                     Session::set_flash('error', 'Password not the same!');
                }               
            } else {
                Session::set_flash('error', $val->error());
            }
        }
       
        $this->template->title = "Users";
        $this->template->content = View::forge('user/changepassword');
    }

    public function action_uploadavatar($id)
    {
        if (Input::method() == 'POST') {
            // Custom configuration for this upload
            $config = array(
                'path' => DOCROOT.'files',
                'randomize' => true,
                'ext_whitelist' => array('img', 'jpg', 'jpeg', 'gif', 'png'),
            );

            // process the uploaded files in $_FILES
            Upload::process($config);

            // if there are any valid files
            if (Upload::is_valid()) {
                // save them according to the config
                Upload::save();
                $profile = Model_Profile::find('first', array(
                    'where' => array(
                        array('user_id', $id),
                    ),
                ));
                $profile->avatar = Upload::get_files()['0']['saved_as'];
                $profile->save();
                Session::delete('avatar');
                $avatar = Upload::get_files()['0']['saved_as'];
                Session::set('avatar', $avatar);
                if ($profile->save()) {
                    Session::set_flash('success', e('Upload successfully.'));
                    \Response::redirect('user/view/'.$id);
                }
            }

            // and process any errors
            foreach (Upload::get_errors() as $file)
            {
                // $file is an array with all file information,
                // $file['errors'] contains an array of all error occurred
                // each array element is an an array containing 'error' and 'message'
            }
        }
        $this->template->title = "Users";
        $this->template->content = View::forge('user/uploadavatar');
    }

    public function post_resetmultiple()
    {
        $listUserId = Input::post('selected');
        $strUserId = implode(",", $listUserId);
        $strGroupId = '1'; 
        $listUser = DB::query('SELECT id, email FROM `users` WHERE `id` IN ('.$strUserId.') AND group_id IN ('.$strGroupId.')');
        \Package::load('email');
        $email = Email::forge();
        $email->subject('Verify your account.');
       
        $email->from('manhbker@gmail.com', 'Support Team');
        foreach ($listUser as $key => $user) {
            $hash = \Auth::instance()->hash_password(\Str::random()).$user_id;
            $data = new Model_Hash; 
            $data->hash = $hash;
            // $data->hash_type = RESET;
            $data->hash_type = 2;
            $data->user_id = $user_id;
            $data->expired_at = time() + (1 * 24 * 60 * 60);

            $data->save(); 

            $data = array();
            $data['url'] = \Uri::create('user/verification/' . base64_encode($hash) . '/');
            $email->body(\View::forge('email/forgotpassword', $data));
            $email->to($user->email, 'Demo');
            try {
                $email->send();
            } catch(\EmailValidationFailedException $e) {
                // The validation failed
                \Debug::dump($e);               
                Session::set_flash('error',$e->getMessage());
            } catch(\EmailSendingFailedException $e) {
                // The driver could not send the email
                \Debug::dump($e);           
                Session::set_flash('error',$e->getMessage());
            }
        }
        Session::set_flash('success', e('Reset successfully.'));
        \Response::redirect('user/index');
    }

}
