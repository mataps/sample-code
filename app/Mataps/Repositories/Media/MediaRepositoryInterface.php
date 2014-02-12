<?php namespace Mataps\Repositories\Media;

use Mataps\Repositories\BaseRepositoryInterface;

interface MediaRepositoryInterface extends BaseRepositoryInterface
{
	function search($keyword);
}