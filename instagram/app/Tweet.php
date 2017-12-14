<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = [
        'id',
        'id_str',
        'created_at',
        'text'
    ];

    static public function countWords($tweets)
    {
        $wordList = [];
        foreach ($tweets as $tweet) {
            $wordList = array_merge($wordList, explode(" ", $tweet));
        }
        $words = array_unique($wordList);
        foreach ($words as $word => $amount) {
            foreach ($wordList as $line) {
                if (strpos($line, $word) !== false) {
                    $words[$word] = $words[$word] ++;
                }
            }
        }
        return (array_count_values($wordList));
    }

    static public function excludeWords($tweets) {
        $filter = array("+0000", "des", "Moskva", "@GPSporten", "Dec", "07", );

        $wordList = [];
        foreach ($tweets as $tweet) {
            $wordList = array_merge($wordList, explode(" ", $tweet));
        }

        foreach ($wordList as $key => $value) {
            if (in_array($value, $filter)) {
                unset($wordList[$key]);
            }
        }
        return (array_count_values($wordList));
    }

    static public function findTweet($response) {

        $wordList = [];
        foreach ($response['statuses'] as $tweet) {
            $wordList = array_merge($wordList, explode(" ", $tweet['text']));
        }
        $words = array_unique($wordList);
        foreach ($words as $word => $amount) {
            foreach ($wordList as $line) {
                if (strpos($line, $word) !== false) {
                    $words[$word] = $words[$word] ++;
                }
            }
        }

        $sorted = array_count_values($wordList);
        asort($sorted);
        return array_slice(array_reverse($sorted),0,10);
    }
}

