<?php

namespace App\Model\Web;

use App\Model\Common\CommonNews;

class News extends CommonNews
{
    public static function getNewsToPosition($pos = 1, $limit = 5)
    {
        return zcache()->remember('index_scroll_news', function () use ($pos, $limit) {
            return News::where([
                'to_position' => $pos
            ])
                ->orderBy('created_at', 'desc')
                ->limit($limit)
                ->get();
        }, 'news');
    }
}
