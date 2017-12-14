<?php

namespace App\Console\Commands;

use App\Tweet;
use Illuminate\Console\Command;

class ImportTweets extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:tweets';

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
        $this->info('Initializing curl ...');
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.twitter.com/1.1/search/tweets.json?q=ifkgbg",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                "authorization: Bearer AAAAAAAAAAAAAAAAAAAAAMer3QAAAAAA3GOCAsG6FYYHDlIwB81bflfRATk%3DW1smc9XjJT1670o5wnx9gVT435qVNDRvikn4mgMep9Xs3ZFYai",
                "cache-control: no-cache",
                "postman-token: 07cef348-50e1-acbc-1d24-054b0bff7171"
            ),
        ));

        $response = json_decode(curl_exec($curl),true);

        curl_close($curl);

        foreach ($response['statuses'] as $tweet) {
            $tweets = Tweet::findOrNew($tweet['id']);
            $this->info("Importing tweets: ".$tweet['id']);
            $tweets->fill($tweet)->save();
        }
        $this->info("Tweets imported");
    }
}
