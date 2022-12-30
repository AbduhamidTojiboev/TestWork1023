<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserStoreRequest;
use App\Http\Requests\User\UserUpdateRequest;
use App\Repositories\Contract\PermissionRepositoryContract;
use App\Repositories\Contract\RoleRepositoryContract;
use App\Repositories\Contract\UserRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct(private UserRepositoryContract $userRepository,
            private RoleRepositoryContract $roleRepository,
            private PermissionRepositoryContract $permissionRepository
    )
    {
        $this->middleware('user.can-list', ['only' => ['index']]);
        $this->middleware('user.can-show', ['only' => ['show']]);
        $this->middleware('user.can-create', ['only' => ['create', 'store']]);
        $this->middleware('user.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('user.can-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userRepository->all();

        return response()->json([
            'status' => 'success',
            'users' => $users,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = $this->roleRepository->list('display_name');
        $permissions = $this->permissionRepository->list('display_name');

        return response()->json([
            'status' => 'success',
            'roles' => $roles,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserStoreRequest $request)
    {
        $user = $this->userRepository->create($this->hashPassword($request->validated()));

        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        $user = $this->userRepository->findById($id, ['*'], ['roles', 'permissions']);

        return response()->json([
            'status' => 'success',
            'user' => $user,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        $roles = $this->roleRepository->list('display_name');
        $permissions = $this->permissionRepository->list('display_name');
        $user = $this->userRepository->findById($id, ['*'], ['roles', 'permissions']);

        return response()->json([
            'status' => 'success',
            'roles' => $roles,
            'permissions' => $permissions,
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  UserUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserUpdateRequest $request, int $id)
    {
        $user = $this->userRepository->update($id, $this->hashPassword($request->validated()));

        return response()->json([
            'status' => 'success',
            'message' => 'User updated successfully',
            'user' => $user,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $this->userRepository->destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'User deleted successfully',
        ]);
    }

    /**
     * @param array $data
     * @return array
     */
    private function hashPassword(array $data): array
    {
        if (isset($data['password'])){
            $data['password'] = Hash::make($data['password']);
        }

        return $data;
    }
}
