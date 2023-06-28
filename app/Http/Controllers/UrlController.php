<?php

namespace App\Http\Controllers;

use App\Models\ShortUrl;
use App\Models\Url;
use Illuminate\Http\Request;

class UrlController extends Controller
{
    public function redirect($code)
    {
        $shortUrl = ShortUrl::query()->where('short_code', $code)->firstOrFail();
        $url = Url::query()->findOrFail($shortUrl->url_id);
        return redirect($url->original_url);
    }

}
