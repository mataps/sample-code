<?php

class MediaCollectionSeeder extends Seeder
{
  public function run()
  {
    DB::collection('media')
          ->delete();

    //load media json
    $media = file_get_contents(__DIR__ . '/collections/media.json');
    $media = json_decode($media, true);

    foreach ($media as $item) {
      DB::collection('media')->insert($item);
    }
  }
}