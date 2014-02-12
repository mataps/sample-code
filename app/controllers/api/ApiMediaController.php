<?php

use Mataps\Repositories\Media\MediaRepositoryInterface;
use Mataps\Forms\Media\MediaFormInterface;

class ApiMediaController extends BaseController
{

	public function __construct(MediaRepositoryInterface $repo, MediaFormInterface $form)
	{
		$this->repo = $repo;
		$this->form = $form;

		$this->beforeFilter('admin');
	}

	public function getIndex()
	{
		if(Input::has('q'))
    {
    	$q = Input::get('q');
      $results = $this->repo->search($q)->toArray();
    } else {
      $results = $this->repo->getAll()->toArray();
    }

		return Response::json(array(
      'success' => true,
      'data'    => $results
    ));
	}

	public function postIndex()
	{
		$saved = $this->form->save(Input::all());

		if( ! $saved)
		{
			return Response::json(array(
	      'success' => false,
	      'errors' => $this->form->errors()->toArray()
	    ));
		}

    return Response::json(array(
      'success' => true,
      'data' => array( $saved->id )
    ));
	}

	public function removeMedia($id)
	{
		$this->form->deleteById($id);

		return Response::json(array(
      'success' => true
    ));
	}
}