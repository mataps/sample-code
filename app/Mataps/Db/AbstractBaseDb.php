<?php namespace Mataps\Db;

use Jenssegers\Mongodb\Builder as QueryBuilder;

class AbstractBaseDb extends QueryBuilder implements BaseDbInterface
{	
	protected $guarded = array();

	public function getAll()
	{
		return $this->orderBy('_id', 'desc')->get();
	}

	public function byPage($page=1, $limit=10, $all=false)
	{
		$result = new \StdClass;
		$result->page = $page;
		$result->limit = $limit;
		$result->totalItems = 0;
		$result->items = array();

		$query = $this->orderBy('_id', 'desc');

		$results = $query->skip( $limit * ($page-1) )
										->take($limit)
										->get();

										dd($results);

		$result->totalItems = $this->count();
		$result->items = $results->all();

		return $result;
	}

	public function byId($id)
	{
		return $this->find($id);
	}
}