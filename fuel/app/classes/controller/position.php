<?php
class Controller_Position extends Controller_Template
{

	public function action_index()
	{
		$data['positions'] = Model_Position::find('all');
		$this->template->title = "Positions";
		$this->template->content = View::forge('position/index', $data);

	}

	public function action_view($id = null)
	{
		is_null($id) and Response::redirect('position');

		if ( ! $data['position'] = Model_Position::find($id)) {
			Session::set_flash('error', 'Could not find position #'.$id);
			Response::redirect('position');
		}

		$this->template->title = "Position";
		$this->template->content = View::forge('position/view', $data);

	}

	public function action_create()
	{
		if (Input::method() == 'POST') {
			$val = Model_Position::validate('create');

			if ($val->run()) {
				//Check unique record
				$tmp = Model_Position::find('first',array(             //record for compare with unique condition
					'where' => array(
				        array('name', Input::post('name'))
				    ),
				));

				if (empty($tmp) && $tmp == NULL) {
					$position = Model_Position::forge(array(
						'name' => Input::post('name'),
						'description' => Input::post('description'),
					));

					if ($position and $position->save()) {
						Session::set_flash('success', 'Added position #'.$position->id.'.');

						Response::redirect('position');
					} else {
						Session::set_flash('error', 'Could not save position.');
					}
				} else {												//If array return is not empty and NULL => False - Duplicated record
					Session::set_flash('error', 'Could not save position. The name or email was duplicated!');
				}
			} else {
				Session::set_flash('error', $val->error());
			}
		}

		$this->template->title = "Positions";
		$this->template->content = View::forge('position/create');

	}

	public function action_edit($id = null)
	{
		is_null($id) and Response::redirect('position');

		if ( ! $position = Model_Position::find($id)) {
			Session::set_flash('error', 'Could not find position #'.$id);
			Response::redirect('position');
		}

		$val = Model_Position::validate('edit');

		if ($val->run()) {
			//Check unique record
			$tmp = Model_Department::find('first',array(             //record for compare with unique condition
				'where' => array(
			        array('name', Input::post('name'))
			    ),
			    'where' => array(
			    	array('id', '<>' , $id)
			    )
			));

			if (empty($tmp) && $tmp == NULL) {
				$position->name = Input::post('name');
				$position->description = Input::post('description');

				if ($position->save()) {
					Session::set_flash('success', 'Updated position #' . $id);

					Response::redirect('position');
				} else {
					Session::set_flash('error', 'Could not update position #' . $id);
				}
			} else {
				Session::set_flash('error', 'Could not update position #' . $id . 'The name or email was duplicated!');
			}
		} else {
			if (Input::method() == 'POST') {
				$position->name = $val->validated('name');
				$position->description = $val->validated('description');

				Session::set_flash('error', $val->error());
			}

			$this->template->set_global('position', $position, false);
		}

		$this->template->title = "Positions";
		$this->template->content = View::forge('position/edit');

	}

	public function action_delete($id = null)
	{
		is_null($id) and Response::redirect('position');

		if ($position = Model_Position::find($id)) {
			$position->delete();

			Session::set_flash('success', 'Deleted position #'.$id);
		} else {
			Session::set_flash('error', 'Could not delete position #'.$id);
		}

		Response::redirect('position');

	}

}
