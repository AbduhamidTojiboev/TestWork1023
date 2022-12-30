<?php

namespace App\Http\Controllers\Crud;

use App\Http\Controllers\Controller;
use App\Http\Requests\Role\RoleStoreRequest;
use App\Http\Requests\Role\RoleUpdateRequest;
use App\Repositories\Contract\PermissionRepositoryContract;
use App\Repositories\Contract\RoleRepositoryContract;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function __construct(private RoleRepositoryContract $roleRepository,
            private PermissionRepositoryContract $permissionRepository
    )
    {
        $this->middleware('role.can-list', ['only' => ['index']]);
        $this->middleware('role.can-show', ['only' => ['show']]);
        $this->middleware('role.can-create', ['only' => ['create', 'store']]);
        $this->middleware('role.can-edit', ['only' => ['edit', 'update']]);
        $this->middleware('role.can-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = $this->roleRepository->all();

        return response()->json([
            'status' => 'success',
            'roles' => $roles,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permissionRepository->list('display_name');

        return response()->json([
            'status' => 'success',
            'permissions' => $permissions,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoleStoreRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleStoreRequest $request)
    {
        $role = $this->roleRepository->create($request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Role created successfully',
            'role' => $role,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = $this->roleRepository->findById($id);

        return response()->json([
            'status' => 'success',
            'role' => $role,
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
        $permissions = $this->permissionRepository->list('display_name');
        $role = $this->roleRepository->findById($id);

        return response()->json([
            'status' => 'success',
            'role' => $role,
            'permissions' => $permissions,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoleUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RoleUpdateRequest $request, int $id)
    {
        $role = $this->roleRepository->update($id, $request->validated());

        return response()->json([
            'status' => 'success',
            'message' => 'Role updated successfully',
            'role' => $role,
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
        $this->roleRepository->destroy($id);

        return response()->json([
            'status' => 'success',
            'message' => 'Role deleted successfully',
        ]);
    }
}
