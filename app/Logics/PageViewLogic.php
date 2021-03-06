<?php

namespace App\Logics;

use App\Models\PageView;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Logics\Interfaces\PageViewLogicInterface;

class PageViewLogic implements PageViewLogicInterface 
{

	public static function updatePageViewCache() 
	{
		$views = Cache::get('new_views');

		if($views) {
			PageView::insert($views);

			// Сбрасываем кэш при вставке
			Cache::forget('new_views');
			Cache::forget('views_stats');
		}
	}

    public function postPageView(Request $request) 
    {
    	// Подгатавливаем адрес, приводим к общему виду
    	$url = $request->input('url');
        if(substr($request->input('url'), -1) !== '/') $url .= '/';
        $url = str_replace('/'.$request->input('lang'), '', $url);

        // Не считаем технические страницы
        if(explode('/', $url)[1] === 'views') 
            return false;

        // Отслеживаем мобильные устройства
        $regex = "/(android|avantgo|blackberry|bolt|boost|cricket|docomo|fone|hiptop|mini|mobi|palm|phone|pie|tablet|up\.browser|up\.link|webos|wos)/i";
        $isMobile = preg_match($regex, $request->header('User-Agent'));

        // Отслеживаем посещения пользователей
        $user = $request->user();

        // Добавляем просмотр в кэш
        $views = Cache::get('new_views') ?? [];
        $views[] = [
            'ip' => $request->ip(),
            'url' => $url,
            'time' => $request->input('time'),
            'agent' => $request->header('User-Agent'),
            'user_id' => $user ? $user->id : NULL,
            'mobile' => $isMobile,
            'referer' => $request->input('referer'),
        	'language' => $request->input('lang'),
            'created_at' => date('Y-m-d H:i'),
            'updated_at' => date('Y-m-d H:i'),
        ];
    	Cache::forever('new_views', $views);
    }
}