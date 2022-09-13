<?php

namespace App\Services;

use App\Models\Link;
use Illuminate\Support\Str;


class MainService
{
    public function getTitle($url)
    {
        @$page = file_get_contents($url);
        if($page){
            if (preg_match("~<title>(.*?)</title>~iu", $page, $out)) {
                $title = $out[1];
                return $title;
            }
        }
    }

    public function createLink($url){
        $data['link'] = $url;
        $data['short_link'] = Str::random(5);

            if(isset(auth()->user()->id)){
                $data['user_id'] = auth()->user()->id;
            }

            $createLink = Link::create($data);
            return $createLink;
    }
}
