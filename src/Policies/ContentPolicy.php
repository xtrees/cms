<?php


namespace XTrees\CMS\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as Authenticatable;
use XTrees\CMS\Models\Content;

class ContentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param Authenticatable|\XTrees\CMS\Models\User $user
     * @return mixed
     */
    public function viewAny($user)
    {
        return $user->role->unlimited;
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param Authenticatable|\XTrees\CMS\Models\User $user
     * @param Content $content
     * @return mixed
     */
    public function view($user, Content $content)
    {
        return $user->role->permission >= $content->permission;
    }
}
