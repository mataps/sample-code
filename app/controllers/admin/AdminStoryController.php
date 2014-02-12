<?php

use Dpsa\Repositories\Story\StoryRepositoryInterface;

class AdminStoryController extends BaseController {

	protected $model;

	public function __construct(StoryRepositoryInterface $model)
	{
		$this->model = $model;
	}

	public function getIndex()
	{
		return 'index page';
	}
}