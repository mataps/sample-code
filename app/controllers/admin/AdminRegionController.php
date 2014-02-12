<?php

use Mataps\Repositories\Region\RegionRepositoryInterface;
use Mataps\Forms\Region\RegionFormInterface;

class AdminRegionController extends BaseController
{

	public function __construct(RegionRepositoryInterface $repo, RegionFormInterface $form)
	{
		$this->repo = $repo;
		$this->form = $form;

		$this->beforeFilter('admin');
	}

	public function getIndex()
	{
		$page = Input::get('page', 1);

		$perPage = 10;

		$pagination = $this->repo->byPage($page, $perPage, true);

		$regions = Paginator::make($pagination->items, $pagination->totalItems, $pagination->limit);

		return View::make('admin.regions.index', compact('regions'));
	}

	public function getAdd()
	{
		return View::make('admin.regions.add');
	}

	public function postAdd()
	{
		$saved = $this->form->save(Input::all());

		if( ! $saved)
		{
			return Redirect::to('admin/regions/add')
										->withInput()
										->withErrors($this->form->errors());
		}

    return Redirect::to('admin/regions');
	}

	public function getEdit($id)
	{
		$article = $this->repo->byId($id);

		return View::make('admin.articles.edit', compact('article'));
	}

	public function postEdit($id)
	{
		$query = array('_id' => $id);
		$saved = $this->form->update($query, Input::all());
		
		if( ! $saved) {
			return Redirect::to('admin/articles/add')
										->withInput()
										->withErrors($this->form->errors());
		}

    return Redirect::to('admin/articles');
	}

}