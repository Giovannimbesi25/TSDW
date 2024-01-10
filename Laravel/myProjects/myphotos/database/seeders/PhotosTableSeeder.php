<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Photo;

class PhotosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        for($i = 1; $i<=27;$i++){
            $photo = new Photo();
            $photo->title = 'Photo '.$i;
            $photo->url = '/img/'.$i.'.png';

            $photo->save();
        }
    }
}
