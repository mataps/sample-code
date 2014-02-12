<?php namespace Mataps;

use App;
use View;
use Illuminate\Support\ServiceProvider;
use Mataps\Validators\Article\ArticleValidator;
use Mataps\Validators\Region\RegionValidator;
use Mataps\Validators\Media\MediaValidator;

class MatapsServiceProvider extends ServiceProvider
{
	public function register()
	{
		//SERVICES
		App::bind('Mataps\Services\Image\ImageProcessorInterface', 'Mataps\Services\Image\ImageProcessor');

		//Article
		App::bind('Mataps\Repositories\Article\ArticleRepositoryInterface', 'Mataps\Repositories\Article\ArticleModel');
		App::bind('Mataps\Forms\Article\ArticleFormInterface', 'Mataps\Forms\Article\ArticleForm');
		App::bind('Mataps\Validators\ValidatorInterface', function($app) {
			return new ArticleValidator($app['validator']);
		});

		//Region
		App::bind('Mataps\Repositories\Region\RegionRepositoryInterface', 'Mataps\Repositories\Region\RegionModel');
		App::bind('Mataps\Forms\Region\RegionFormInterface', 'Mataps\Forms\Region\RegionForm');
		App::bind('Mataps\Validators\ValidatorInterface', function($app) {
			return new RegionValidator($app['validator']);
		});

		//Media
		App::bind('Mataps\Repositories\Media\MediaRepositoryInterface', 'Mataps\Repositories\Media\MediaModel');
		App::bind('Mataps\Forms\Media\MediaFormInterface', 'Mataps\Forms\Media\MediaForm');
		App::bind('Mataps\Validators\ValidatorInterface', function($app) {
			return new MediaValidator($app['validator'], $app->make('Mataps\Services\Image\ImageProcessorInterface'));
		});
	}

	public function boot()
	{
		View::composer('admin._partials.regions_select', function($view) {
			$region = App::make('Mataps\Repositories\Article\ArticleRepositoryInterface');
			$view->regions = $region->all();
		});
	}
}