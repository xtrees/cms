<?php


namespace XTrees\CMS\Http\Controllers\Web;


class HomeController extends WebController
{
    public function index()
    {
        return cms_view('home');
    }
}
