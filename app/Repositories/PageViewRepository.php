<?php

namespace App\Repositories;

use DB;
use App\Models\PageView;

use Illuminate\Support\Facades\Cache;
use App\Repositories\Interfaces\PageViewRepositoryInterface;

class PageViewRepository implements PageViewRepositoryInterface 
{
    public function pageViewList() 
    {
        return PageView::all();
    }

    public function pageViewStat() 
    {
    	// Кэшируем запрос. Кэш сбрасывается при обновлении базы
    	return Cache::remember('views_stats', 1800, function() {
	        return DB::table('page_views')
				->select(
					'url', 
					'language', 
					DB::raw('count(*) as total'), 
					DB::raw('count(DISTINCT ip) as visits')
				)
				->groupBy('url', 'language')
				->orderBy('url', 'ASC')
				->orderBy('visits', 'DESC')
				->orderBy('total', 'DESC')
				->orderBy('language', 'ASC')
				->get();
		});
    }
}