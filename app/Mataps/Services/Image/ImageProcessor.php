<?php namespace Mataps\Services\Image;

class ImageProcessor implements ImageProcessorInterface
{

	// /**
 //   * Instance of the Imagine package
 //   * @var Imagine\Gd\Imagine
 //   */
 //  protected $imagine;

 //  /**
 //   * Type of library used by the service
 //   * @var string
 //   */
 //  protected $library;

 //  /**
 //   * Initialize the image service
 //   * @return void
 //   */
 //  public function __construct()
 //  {
 //      if ( ! $this->imagine)
 //      {
 //          $this->library = Config::get('image.library', 'gd');

 //          // Now create the instance
 //          if     ($this->library == 'imagick') $this->imagine = new \Imagine\Imagick\Imagine();
 //          elseif ($this->library == 'gmagick') $this->imagine = new \Imagine\Gmagick\Imagine();
 //          elseif ($this->library == 'gd')      $this->imagine = new \Imagine\Gd\Imagine();
 //          else                                 $this->imagine = new \Imagine\Gd\Imagine();
 //      }
 //  }

 //  public function resize($filepath, $output_path, $width, $height, $quality = 100, $crop = false)
 //  {
 //    $options = array(
 //      'quality' => $quality
 //    );

 //    try
 //    {
 //      $image = $this->imagine->open($filepath);
 //    }
 //    catch (Exception $e)
 //    {
 //      return false;
 //    }

 //    $output_dir = pathinfo($output_path, PATHINFO_DIRNAME );

 //    if( ! File::isDirectory($output_dir)) {
 //      File::makeDirectory($output_dir);
 //    }

 //    $dimension = new Imagine\Image\Box($width, $height);

 //    $img = $image->resize($dimension)->save($output_path, $options);

 //    return $img ? $output_path : null;
 //  }

 //  public function createDifferentSizes($filepath, $output_path, $width, $height, $quality = 100, $crop = false)
 //  {
 //    $small = $this->resize($filepath, $output_path, 555, 416, 80);
 //    $medium = $this->resize($filepath, $output_path, 320, 240, 80);
    
 //    return $small && $medium;
 //  }

}