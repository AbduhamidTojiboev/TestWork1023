<?php

namespace App\Common\Helpers;

class Permission
{
    //USER
    const USER_CREATE = 'user-create';
    const USER_EDIT = 'user-edit';
    const USER_SHOW = 'user-show';
    const USER_DELETE = 'user-delete';
    const USER_LIST = 'user-list';

    //POST
    const POST_CREATE = 'post-create';
    const POST_EDIT = 'post-edit';
    const POST_SHOW = 'post-show';
    const POST_DELETE = 'post-delete';
    const POST_LIST = 'post-list';

    //ROLE
    const ROLE_CREATE = 'role-create';
    const ROLE_EDIT = 'role-edit';
    const ROLE_SHOW = 'role-show';
    const ROLE_DELETE = 'role-delete';
    const ROLE_LIST = 'role-list';
}
