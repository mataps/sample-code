<?php

use Mataps\Repositories\Article\ArticleRepositoryInterface;
use Mataps\Forms\Article\ArticleFormInterface;

class AdminArticlesController extends BaseController
{

	public function __construct(ArticleRepositoryInterface $repo, ArticleFormInterface $form)
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

		$articles = Paginator::make($pagination->items, $pagination->totalItems, $pagination->limit);

		return View::make('admin.articles.index', compact('articles'));
	}

	public function getAdd()
	{
		return View::make('admin.articles.add');
	}

	public function postAdd()
	{
		$saved = $this->form->save(Input::all());

		if( ! $saved)
		{
			return Redirect::to('admin/articles/add')
										->withInput()
										->withErrors($this->form->errors());
		}

    return Redirect::to('admin/articles');
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