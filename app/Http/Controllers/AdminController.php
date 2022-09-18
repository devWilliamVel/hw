<?php

namespace App\Http\Controllers;

use App\Http\Requests\admin\AssignRoleToUserRequest;
use App\Http\Requests\admin\CreatePermissionRequest;
use App\Http\Requests\admin\CreateRoleRequest;
use App\Http\Requests\admin\DeletePermissionRequest;
use App\Http\Requests\admin\DeleteRoleRequest;
use App\Http\Requests\admin\GivePermissionToRoleRequest;
use App\Http\Requests\admin\RemoveRoleToUserRequest;
use App\Http\Requests\admin\RevokePermissionToRoleRequest;
use App\Libraries\Permissions;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:'.Permissions::PERM_WRITE_PERMISSIONS.'|'.Permissions::PERM_READ_PERMISSIONS])
            ->only([
                "rolesAndPermissions",
            ]);

        $this->middleware(['role:'.Permissions::ROLE_SUPER_ADMIN])
            ->only([
                "createPermission",
                "deletePermission",
            ]);

        $this->middleware(['permission:'.Permissions::PERM_WRITE_PERMISSIONS])
            ->only([
                "createRole",
                "deleteRole",
                "givePermissionToRole",
                "revokePermissionToRole",
                "assignRoleToUser",
                "removeRoleToUser",
                "getUserRoles",
                "getRolePermissions",
            ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function rolesAndPermissions()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $users = User::orderBy('name', 'asc')->get();

        $rolesToBeCreated = Permissions::getRolesListHandled();
        foreach($roles as $role)
        {
            $roleSearchIndex = array_search($role->name, $rolesToBeCreated);
            if($roleSearchIndex !== false)
            {
                unset($rolesToBeCreated[$roleSearchIndex]);
            }
        }

        $permissionsToBeCreated = Permissions::getPermissionsListHandled();
        foreach($permissions as $permission)
        {
            $permissionSearchIndex = array_search($permission->name, $permissionsToBeCreated);
            if($permissionSearchIndex !== false)
            {
                unset($permissionsToBeCreated[$permissionSearchIndex]);
            }
        }

        return view('admin/rolesAndPermissions')->with([
            "roles" => $roles,
            "permissions" => $permissions,
            "users" => $users,
            "rolesToBeCreated" => $rolesToBeCreated,
            "permissionsToBeCreated" => $permissionsToBeCreated,
        ]);
    }

    /**
     * @param CreatePermissionRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createPermission(CreatePermissionRequest $request)
    {
        $validated = $request->validated();
        $permissionName = $request->get("permissionName");
        $guard = $request->get("guard", Permissions::GUARD_NAME_WEB);

        $permission = Permission::create([
            'guard_name' => $guard,
            'name' => $permissionName,
        ]);

        return response()->json([
            'permission' => $permission,
        ]);
    }

    /**
     * @param DeletePermissionRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function deletePermission(DeletePermissionRequest $request)
    {
        $validated = $request->validated();
        $idPermission = $request->get("idPermission");

        $permission = Permission::find($idPermission);
        if(is_null($permission))
        {
            $responseStatus = config('constants.http_response.bad_request');
            return response()->json([
                'result' => 'error',
                'message' => __("admin.notFountError"),
            ], $responseStatus);
        }
        if($permission->roles()->count())
        {
            $responseStatus = config('constants.http_response.bad_request');
            return response()->json([
                'result' => 'error',
                'message' => __("admin.revokePermissionFromRolesFirstError"),
            ], $responseStatus);
        }

        $permission->delete();
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        return response()->json([
            'result' => 'success',
        ]);
    }

    /**
     * @param CreateRoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createRole(CreateRoleRequest $request)
    {
        $validated = $request->validated();
        $roleName = $request->get("roleName");
        $guard = $request->get("guard", Permissions::GUARD_NAME_WEB);

        $role = Role::create([
            'guard_name' => $guard,
            'name' => $roleName,
        ]);

        return response()->json([
            'role' => $role,
        ]);
    }

    /**
     * @param DeleteRoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Contracts\Container\BindingResolutionException
     */
    public function deleteRole(DeleteRoleRequest $request)
    {
        $validated = $request->validated();
        $idRole = $request->get("idRole");

        $role = Role::find($idRole);
        if(is_null($role))
        {
            $responseStatus = config('constants.http_response.bad_request');
            return response()->json([
                'result' => 'error',
                'message' => __("admin.notFountError"),
            ], $responseStatus);
        }
        if($role->name == Permissions::ROLE_SUPER_ADMIN)
        {
            $responseStatus = config('constants.http_response.bad_request');
            return response()->json([
                'result' => 'error',
                'message' => __("admin.deleteSuperAdminError"),
            ], $responseStatus);
        }

        if($role->permissions()->count())
        {
            $responseStatus = config('constants.http_response.bad_request');
            return response()->json([
                'result' => 'error',
                'message' => __("admin.revokePermissionsFromRoleFirstError"),
            ], $responseStatus);
        }

        $role->delete();
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();

        return response()->json([
            'result' => 'success',
        ]);
    }

    /**
     * @param GivePermissionToRoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function givePermissionToRole(GivePermissionToRoleRequest $request)
    {
        $validated = $request->validated();
        $idRole = $request->get("idRole");
        $idPermission = $request->get("idPermission");

        $role = Role::find($idRole);
        if(is_null($role))
        {
            $responseStatus = config('constants.http_response.bad_request');
            return response()->json([
                'result' => 'error',
                'message' => __("admin.notFountError"),
            ], $responseStatus);
        }

        $permission = Permission::find($idPermission);
        if(is_null($permission))
        {
            $responseStatus = config('constants.http_response.bad_request');
            return response()->json([
                'result' => 'error',
                'message' => __("admin.notFountError"),
            ], $responseStatus);
        }

        $role->givePermissionTo($permission->id);

        return response()->json([
            'role' => $role,
        ]);
    }

    /**
     * @param RevokePermissionToRoleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function revokePermissionToRole(RevokePermissionToRoleRequest $request)
    {
        $validated = $request->validated();
        $idRole = $request->get("idRole");
        $idPermission = $request->get("idPermission");

        $role = Role::find($idRole);
        if(is_null($role))
        {
            $responseStatus = config('constants.http_response.bad_request');
            return response()->json([
                'result' => 'error',
                'message' => __("admin.notFountError"),
            ], $responseStatus);
        }

        $permission = Permission::find($idPermission);
        if(is_null($permission))
        {
            $responseStatus = config('constants.http_response.bad_request');
            return response()->json([
                'result' => 'error',
                'message' => __("admin.notFountError"),
            ], $responseStatus);
        }
        $role->revokePermissionTo($permission->id);

        return response()->json([
            'role' => $role,
        ]);
    }

    /**
     * @param AssignRoleToUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function assignRoleToUser(AssignRoleToUserRequest $request)
    {
        $validated = $request->validated();
        $idRole = $request->get("idRole");
        $idUser = $request->get("idUser");

        $user = User::find($idUser);
        if(is_null($user))
        {
            $responseStatus = config('constants.http_response.bad_request');
            return response()->json([
                'result' => 'error',
                'message' => __("admin.notFountError"),
            ], $responseStatus);
        }
        $role = Role::find($idRole);
        if(is_null($role))
        {
            $responseStatus = config('constants.http_response.bad_request');
            return response()->json([
                'result' => 'error',
                'message' => __("admin.notFountError"),
            ], $responseStatus);
        }
        $user->assignRole($role->id);

        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * @param RemoveRoleToUserRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function removeRoleToUser(RemoveRoleToUserRequest $request)
    {
        $validated = $request->validated();
        $idRole = $request->get("idRole");
        $idUser = $request->get("idUser");

        $user = User::find($idUser);
        if(is_null($user))
        {
            $responseStatus = config('constants.http_response.bad_request');
            return response()->json([
                'result' => 'error',
                'message' => __("admin.notFountError"),
            ], $responseStatus);
        }
        $role = Role::find($idRole);
        if(is_null($role))
        {
            $responseStatus = config('constants.http_response.bad_request');
            return response()->json([
                'result' => 'error',
                'message' => __("admin.notFountError"),
            ], $responseStatus);
        }
        $user->removeRole($role->id);

        return response()->json([
            'user' => $user,
        ]);
    }

    /**
     * @param int $idUser
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUserRoles($idUser)
    {
        $idUser = intval($idUser);

        $user = User::with('roles')->where('id', $idUser)->first();
        if(is_null($user))
        {
            $responseStatus = config('constants.http_response.bad_request');
            return response()->json([
                'result' => 'error',
                'message' => __("admin.notFountError"),
            ], $responseStatus);
        }
        $roles = $user->roles;

        return response()->json([
            'roles' => $roles,
        ]);
    }

    /**
     * @param int $idRole
     * @return \Illuminate\Http\JsonResponse
     */
    public function getRolePermissions($idRole)
    {
        $idRole = intval($idRole);

        $role = Role::find($idRole);
        if(is_null($role))
        {
            $responseStatus = config('constants.http_response.bad_request');
            return response()->json([
                'result' => 'error',
                'message' => __("admin.notFountError"),
            ], $responseStatus);
        }
        $permissions = $role->permissions;

        return response()->json([
            'permissions' => $permissions,
        ]);
    }
}
