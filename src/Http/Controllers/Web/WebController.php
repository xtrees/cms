<?php


namespace XTrees\CMS\Http\Controllers\Web;


use Illuminate\Http\RedirectResponse;
use XTrees\CMS\Http\Controllers\Controller;

class WebController extends Controller
{

    public function flashBack($message = '', $level = 'danger'): RedirectResponse
    {
        flash($message, $level);
        return back();
    }
}
