<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{

    public function store()
    {
        $data = request()->validate([
            'url' => 'required|url|unique:urls',
            'website' => 'required',
        ]);
        
        auth()->user()->urls()->create([
            'url' => $data['url'],
            'website' => $data['website'],
            'short_url' => Url::generateShortUrl($data['url']),
        ]);

        return redirect('/home');
    }

    public function destroy($id){
        $url = Url::findOrFail($id);

        auth()->user()->urls()->where('id', $id)->delete();

        return redirect('/home');
    }

    public function edit($id){

        $url = Url::findOrFail($id);

        return view('url', [
            'url' => $url,
        ]);

    }

    public function update($id){

        $url = Url::findOrFail($id);

        $data = request()->validate([
            'url' => 'required|url|unique:urls,url,'.$url->id,
            'website' => 'required',
            'url_status' => 'required',
        ]);


        $clicks = $url->clicks;

        if($data['url'] != $url->url){
            $clicks = 0;
        }


        auth()->user()->urls()->where('id', $id)->update([
            'url' => $data['url'],
            'website' => $data['website'],
            'short_url' => Url::generateShortUrl($data['url']),
            'is_active' => $data['url_status'] == 'active' ? true : false,
            'clicks' => $clicks,
        ]);


        return redirect('/home');
    }

    public function redirect($hash){

        $url_str = 'http://localhost:8000/'.$hash;

        $url = auth()->user()->urls()->where('short_url', $url_str)->firstOrFail();

        $url->increment('clicks');

        return view('redirect', [
            'url' => $url,
        ]);
    }

}
