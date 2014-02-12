<?php

class NewsCollectionSeeder extends Seeder {

    protected $collection = 'news';
    public $faker;

    public function __construct()
    {
        $this->faker = Faker\Factory::create();
    }

/*** Public Methods
*********************************************/


    /**
     * method that will be fired when NewsCollectionSeeder is called
     */
    public function run()
    {
        $this->clearDatabase();
        $json = $this->getSpreadsheetJson('news.json');
        $this->createNews($json);
    }

    public function clearDatabase()
    {
      DB::collection($this->collection)
          ->delete();
    }

    public function createNews($news)
    {
      $ids = array();
      foreach ($news as $item)
      {
        $id = DB::collection($this->collection)
                ->insertGetId( $this->formatNews($item) );
      }

      return $ids;
    }

    protected function getSpreadsheetJson($filename)
    {
      $data = file_get_contents(__DIR__ . '/collections/' . $filename);
      $data = json_decode($data, true);

      return $data;
    }


/*** Private Methods
*********************************************/


    private function formatNews($news)
    {
      if(isset($news['imageFilename'])) {
        $media_id = DB::collection('media')->insertGetId(array(
          'path' => '/img/Photos/News/' . $news['imageFilename'],
          'type' => 'image'
        ));

        $media = array($media_id);
      } else {
        $media = array();
      }
      $title = $news['title'];

      $data = array(
          'content'       => array(
              'title'     => $title,
              'content'   => $news['bodydescription']
          ),
          'slug'          => Str::slug($title),
          'published'     => 'on',
          'media'         => $media
      );

      return $data;
    }

}