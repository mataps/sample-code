<?php namespace Mataps\Repositories\Media;

use Mataps\Repositories\AbstractBaseRepository;

class MediaModel extends AbstractBaseRepository implements MediaRepositoryInterface
{
	protected $collection = 'media';

	protected $mimeTypes = array(
		'image/png',
		'image/jpg',
		'image/tiff',
		'image/pjpeg',
		'image/gif',
		'image/jpeg',
		//VIDEOS
		'video/mpeg',
		'video/mp4',
		'video/ogg',
		'video/quicktime',
		'video/webm',
		'video/x-matroska',
		'video/x-ms-wmv',
		'video/x-flv',
		'video/x-msvideo',
		'application/x-troff-msvideo',
		'video/avi',
		'video/msvideo',
		'video/MP2T',
		'video/3gpp',
		'application/x-mpegURL'
	);

	protected $uploadPath = '/media';

	public function getUploadPath()
	{
		return public_path() . $this->uploadPath;
	}

	public function search($keyword)
	{
		return $this->where('tags', 'like', '%'.$keyword.'%')->get();
	}

	public function setPathAttribute($value)
	{
		$this->attributes['path'] = $this->uploadPath.'/'.$value;
	}

	public function setTagsAttribute($value)
	{
    $this->attributes['tags'] = explode(',', $value);
	}
}