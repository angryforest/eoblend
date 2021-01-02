<?php

namespace App\Http\Controllers;

use App\Logics\Interfaces\PageViewLogicInterface;
use App\Repositories\Interfaces\PageViewRepositoryInterface;

use Illuminate\Http\Request;

class PageViewController extends Controller
{
    private $pageViewLogic, $pageViewRepository;

    public function __construct(
        PageViewLogicInterface $pageViewLogic, 
        PageViewRepositoryInterface $pageViewRepository
    ) 
    {
        parent::__construct();
        $this->pageViewLogic = $pageViewLogic;
        $this->pageViewRepository = $pageViewRepository;
    }

    public function postPageView(Request $request)
    {
        $this->pageViewLogic->postPageView($request);
    }

    public function getPageViews()
    {
        return response()->json([
            'pageViews' => $this->pageViewRepository->pageViewStat(),
        ]);
    }

    public function getPageViewsByUrl(Request $request)
    {
        return response()->json([
            'pageViews' => $this->pageViewRepository->pageViewStatByUrl($request),
        ]);
    }
}
