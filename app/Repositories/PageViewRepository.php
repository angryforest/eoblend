<?php

namespace App\Repositories;

use DB;
use App\Models\PageView;

use Illuminate\Http\Request;
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
					DB::raw('count(*) as total'), 
					DB::raw('count(DISTINCT ip) as visits')
				)
				->groupBy('url')
				->orderBy('visits', 'DESC')
				->orderBy('total', 'DESC')
				->orderBy('url', 'ASC')
				->get();
		});
    }

    public function pageViewStatByUrl(Request $request) 
    {
    	return DB::table('page_views')
			->select(
				'ip',
				'agent',
				'mobile',
				'language',
			)
			->where('url', $request->input('url'))
			->get();
    }
}