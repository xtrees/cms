<?php


namespace XTrees\CMS\Http\Controllers\Web;


use Hash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use XTrees\CMS\Http\Requests\User\UserPasswordRequest;
use XTrees\CMS\Http\Requests\User\UserUpdateRequest;
use XTrees\CMS\Models\User;

class UserController extends WebController
{
    public function index(Request $request)
    {
        $user = $request->user();
        return view('cms::user.index', compact('user'));
    }

    /**
     * 更新基本信息
     * @param UserUpdateRequest $request
     * @return RedirectResponse
     */
    public function update(UserUpdateRequest $request): RedirectResponse
    {
        /** @var User $user */
        $user = $request->user();
        if ($user->update($request->input())) {
            flash("用户信息保存成功！", "success");
        } else {
            flash("用户信息保存失败！", "danger");
        }
        return back();
    }

    /**
     * 修改密码
     * @param UserPasswordRequest $request
     * @return RedirectResponse
     */
    public function password(UserPasswordRequest $request): RedirectResponse
    {
        $password = $request->input('password');
        /** @var User $user */
        $user = $request->user();
        $user->password = Hash::make($password);
        if ($user->save()) {
            flash("密码修改成功！", "success");
        } else {
            flash("密码修改失败，请稍后重试！", "danger");
        }
        return back()->withFragment('#password-setting');
    }
}
