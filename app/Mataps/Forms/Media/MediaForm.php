<?php namespace Mataps\Forms\Media;

use Mataps\Forms\AbstractBaseForm;
use Mataps\Repositories\Media\MediaRepositoryInterface;
use Mataps\Validators\ValidatorInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Mataps\Services\Image\ImageProcessorInterface;

class MediaForm extends AbstractBaseForm implements MediaFormInterface
{
	public function __construct(MediaRepositoryInterface $repo, ValidatorInterface $validator, ImageProcessorInterface $imageProcessor)
	{
		$this->repo = $repo;
		$this->validator = $validator;
		$this->imageProcessor = $imageProcessor;
	}

	public function save($data)
	{
		if($this->validator->canCreate($data))
		{
			$fileName = $this->saveUpload($data['file']);
			$data = $this->trimInputs(array('tags'), $data);
			$data['path'] = $fileName;
			return $this->repo->create($data);
		}
		$this->errors = $this->validator->errors;
		return false;
	}

	public function saveUpload(UploadedFile $file)
	{
		$destinationPath = $this->repo->getUploadPath();
    $fileName = rand(0, 100000) . '_' .$file->getClientOriginalName();

    try {
      $file->move($destinationPath, $fileName);
    } catch (Exception $e) {
      return false;
    }

    // $this->resizeImages($this->repo->uploadPath, $fileName);

    return $fileName;
	}

	public function resizeImages($basePath, $fileName)
	{
		if(in_array($file->getClientMimeType(), $this->repo->mimeTypes))
    {
      $filepath     = $basePath.'/'.$fileName;

      //generate small
      $outputPath  = $basePath.'/small/'.$fileName;
      $small       = $this->imageProcessor->resize($filepath, $outputPath, 320, 240, 80);

      //generate medium
      $outputPath  = $basePath.'/medium/'.$fileName;
      $medium      = $this->imageProcessor->resize($filepath, $outputPath, 555, 416, 80);
    }

    return true;
	}
}