<?php namespace Mataps\Forms\Article;

use Mataps\Forms\AbstractBaseForm;
use Mataps\Repositories\Article\ArticleRepositoryInterface;
use Mataps\Validators\ValidatorInterface;

class ArticleForm extends AbstractBaseForm implements ArticleFormInterface
{
	public function __construct(ArticleRepositoryInterface $repo, ValidatorInterface $validator)
	{
		$this->repo = $repo;
		$this->validator = $validator;
	}
}