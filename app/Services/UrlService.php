<?php

namespace App\Services;

use App\Models\ShortUrl;
use App\Models\Url;
use Hashids\Hashids;

class UrlService
{
    public function shortenUrl($originalUrl)
    {
        $url = Url::query()->create([
            'original_url' => $originalUrl,
        ]);

        $shortCode = $this->generateShortCode($url->id);

        return ShortUrl::query()->create([
            'short_code' => $shortCode,
            'url_id' => $url->id,
        ]);

    }

    private function generateShortCode($id): string
    {
        $hashids = new Hashids('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789', 6);
        // Specify your own salt value and desired code length
        return $hashids->encode($id);
    }

}
