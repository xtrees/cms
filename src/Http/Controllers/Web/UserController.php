<?php


namespace XTrees\CMS\Http\Controllers\Web;


use Illuminate\Http\Request;

class UserController extends WebController
{
    public function index(Request $request)
    {
        $user = $request->user();
        return view('cms::user.index', compact('user'));
    }

    public function update(Request $request)
    {

    }

    public function password()
    {

    }
}
