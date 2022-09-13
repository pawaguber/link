<?php

namespace App\Http\Controllers;

use App\Models\Link;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Termwind\Components\Li;
use Tests\Feature\PageTest;

class LinkController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $url = $request->link;
        $parse_url = parse_url($url);
        if($parse_url['host'] == '127.0.0.1'){
            $message['response'] = 'ni';
        }
        $title = $this->service->getTitle($url);
        if($title){
            $createLink = $this->service->createLink($url);
            $message['response'] = $createLink->short_link; // сюда підставляти!
        }else{
            $message['response'] = 'bad';
        }
        return response()->json($message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function show(Link $link)
    {
        return Redirect::to($link->link);
    }


    public function update(Request $request, Link $link)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Link  $link
     * @return \Illuminate\Http\Response
     */
    public function destroy(Link $link)
    {
        $link->delete();
        return redirect()->back();
    }
}
