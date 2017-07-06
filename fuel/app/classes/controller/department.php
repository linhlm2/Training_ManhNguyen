<?php
class Controller_Department extends Controller_Template
{

	public function action_index()
	{
		$data['departments'] = Model_Department::find('all');
		$this->template->title = "Departments";
		$this->template->content = View::forge('department/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('department');

		if ( ! $data['department'] = Model_Department::find($id)) {
			Session::set_flash('error', 'Could not find department #'.$id);
			Response::redirect('department');
		}

		$this->template->title = "Department";
		$this->template->content = View::forge('department/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST') {
			$val = Model_Department::validate('create');

			if ($val->run()) {
				//Check unique record
				$tmp = Model_Department::find('first',array(             //record for compare with unique condition
					'where' => array(
				        array('name', Input::post('name')),
				        'or' => array(
				            array('email', Input::post('email')),
				        ),
				    ),
				));

				if (empty($tmp) && $tmp == NULL) {  						//If array return is empty and NULL => True
					$department = Model_Department::forge(array(
						'name' => Input::post('name'),
						'address' => Input::post('address'),
						'phone' => Input::post('phone'),
						'description' => Input::post('description'),
						'email' => Input::post('email'),
					));

					if ($department and $department->save()) {             //If validated and save
						Session::set_flash('success', 'Added department #'.$department->id.'.');

						Response::redirect('department');
					} else {
						Session::set_flash('error', 'Could not save department.');
					}
				} else {												//If array return is not empty and NULL => False - Duplicated record
					Session::set_flash('error', 'Could not save department. The name or email was duplicated!');
				}
				
			} else {
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Departments";
		$this->template->content = View::forge('department/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('department');

		if ( ! $department = Model_Department::find($id)) {
			Session::set_flash('error', 'Could not find department #'.$id);
			Response::redirect('department');
		}

		$val = Model_Department::validate('edit');

		if ($val->run()) {
			//Check unique record
			$tmp = Model_Department::find('first',array(             //record for compare with unique condition
				'where' => array(
			        array('name', Input::post('name')),
			        'or' => array(
			            array('email', Input::post('email')),
			        ),
			    ),
			    'where' => array(
			    	array('id', '<>' , $id)
			    )
			));

			if (empty($tmp) && $tmp == NULL) {
				$department->name = Input::post('name');
				$department->address = Input::post('address');
				$department->phone = Input::post('phone');
				$department->description = Input::post('description');
				$department->email = Input::post('email');

				if ($department->save()) {
					Session::set_flash('success', 'Updated department #' . $id);

					Response::redirect('department');
				} else {
					Session::set_flash('error', 'Could not update department #' . $id);
				}
			} else {
				Session::set_flash('error', 'Could not update department #' . $id . 'The name or email was duplicated!');
			}
		} else {
			if (Input::method() == 'POST') {
				$department->name = $val->validated('name');
				$department->address = $val->validated('address');
				$department->phone = $val->validated('phone');
				$department->description = $val->validated('description');
				$department->email = $val->validated('email');

				Session::set_flash('error', $val->error());
			}
			
		}

		$this->template->set_global('department', $department, false);
		$this->template->title = "Departments";
		$this->template->content = View::forge('department/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('department');

		if ($department = Model_Department::find($id)) {
			$department->delete();

			Session::set_flash('success', 'Deleted department #'.$id);
		} else {
			Session::set_flash('error', 'Could not delete department #'.$id);
		}

		Response::redirect('department');

	}

}
