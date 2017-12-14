<?php

namespace App\Console\Commands;

use App\Image;
use App\Post;
use App\User;
use Illuminate\Console\Command;

class ImportImages extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:images';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
    $this->info("Initializing curl...");
    $curl = curl_init();

    curl_setopt_array($curl, array(
        CURLOPT_URL => "https://api.instagram.com/v1/users/self/media/recent/?access_token=3933881182.fbc4ba9.87889e9eaa0a45d49a0bc743420923fe",
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => "",
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 30,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => array(
            "cache-control: no-cache",
            "postman-token: b4336717-ca26-e417-7119-3f7f3b825a4a"
        ),
    ));

    $response = json_decode(curl_exec($curl), true);

    curl_close($curl);

    foreach ($response['data'] as $posts) {

        /*foreach ($posts['user'] as $user) {
            $this->info("Importing users: " .$user['id']);
            $users = User::findOrNew($user['id']);
            $users->fill($user)->save();
        }*/

        $caption = Image::findOrNew($posts['caption']['id']);
        $this->info("Importing caption/images: " .$posts['caption']['id']);
        $caption->fill($posts['caption']);
        foreach ($posts['images'] as $image) {
                $caption->fill($image);
                $caption->save();

        }
    }
    }
}
