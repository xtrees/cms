<?php


namespace XTrees\CMS\Http\Controllers\Web;


use XTrees\CMS\Http\Requests\Auth\LoginRequest;

class AuthController extends WebController
{
    /**
     * 登录
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('auth.login');
    }


    /**
     * Handle an incoming authentication request.
     *
     * @param LoginRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }


}
