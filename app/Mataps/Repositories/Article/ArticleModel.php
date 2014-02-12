<?php namespace Mataps\Repositories\Article;

use Mataps\Repositories\AbstractBaseRepository;
use Str;

class ArticleModel extends AbstractBaseRepository implements ArticleRepositoryInterface
{
	protected $collection = 'articles';

	public function setTitleAttribute($value)
	{
    $this->attributes['content']['title'] = $value;
	}

	public function setContentAttribute($value)
	{
    $this->attributes['content']['content'] = $value;
	}

	public function setTagsAttribute($value)
	{
    $this->attributes['tags'] = explode(',', $value);
	}

	public function setMediaAttribute($value)
	{
    $this->attributes['media'][] = $value;
	}

	public function setRegionAttribute($value)
	{
    $this->attributes['region_id'] = $value;
    $this->attributes['loc'][] = $value;
	}

	public function setProvinceAttribute($value)
	{
    $this->attributes['province_id'] = $value;
    $this->attributes['loc'][] = $value;
	}

	public function setCityAttribute($value)
	{
    $this->attributes['city_id'] = $value;
    $this->attributes['loc'][] = $value;
	}
}