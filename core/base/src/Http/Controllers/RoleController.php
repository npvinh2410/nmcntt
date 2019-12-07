<?php
namespace Hydrogen\Base\Http\Controllers;

use App\Http\Controllers\Controller;
use Hydrogen\Base\Repositories\Eloquent\Auth\PermissionRepository;
use Hydrogen\Base\Repositories\Eloquent\Auth\RoleRepository;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;


class RoleController extends Controller {
    protected $roleRepository;
    protected $permissionRepository;

    public function __construct(RoleRepository $roleRepository, PermissionRepository $permissionRepository)
    {
        $this->roleRepository = $roleRepository;
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        hydrogen_authorize('roles-index');

        $roles = $this->roleRepository->all();
        return view('dashboard::role.index', ['roles' => $roles]);
    }

    public function create()
    {
        hydrogen_authorize('roles-create');

        $permissions = $this->permissionRepository->all();

        $group_permissions = [];

        foreach ($permissions as $permission)
        {
            $group = ucfirst(str_singular(explode('-', $permission->name)[0]));
            $tmp['id'] = $permission->id;
            $tmp['display-name'] = $permission->display_name;
            $tmp['name'] = $permission->name;
            $group_permissions[$group][] = $tmp;
        }

        return view('dashboard::role.create', ['permissions' => $group_permissions]);
    }

    public function store(Request $request)
    {
        hydrogen_authorize('roles-create');

        $role_params = [
            'name' => $request->name,
            'display_name' => $request->display_name,
            'description' => $request->description,
        ];

        $role = $this->roleRepository->create($role_params);

        $permissions = $request->permissions;
        if (is_array($permissions)) {
            foreach ($permissions as $pid) {
                $p = $this->permissionRepository->find($pid);
                $role->attachPermission($p);
            }
        }

        Session::flash('flash', ['success' => 'Role created successfully']);
        return redirect()->route('roles.index');
    }

    public function show($id)
    {
        hydrogen_authorize('roles-show');

        $role = $this->roleRepository->find($id);
        $permissions = $this->permissionRepository->all();

        $group_permissions = [];

        foreach ($permissions as $permission)
        {
            $group = ucfirst(str_singular(explode('-', $permission->name)[0]));
            $tmp['id'] = $permission->id;
            $tmp['display-name'] = $permission->display_name;
            $tmp['name'] = $permission->name;
            $group_permissions[$group][] = $tmp;
        }

        return view('dashboard::role.show', ['role' => $role, 'permissions' => $group_permissions]);
    }

    public function edit($id)
    {
        hydrogen_authorize('roles-edit');

        $role = $this->roleRepository->find($id);
        $permissions = $this->permissionRepository->all();
        $group_permissions = [];

        foreach ($permissions as $permission)
        {
            $group = ucfirst(str_singular(explode('-', $permission->name)[0]));
            $tmp['id'] = $permission->id;
            $tmp['display-name'] = $permission->display_name;
            $tmp['name'] = $permission->name;
            $group_permissions[$group][] = $tmp;
        }

        return view('dashboard::role.edit', ['role' => $role, 'permissions' => $group_permissions]);
    }

    public function update(Request $request, $id)
    {
        hydrogen_authorize('roles-edit');
        $role_params = [
                'name' => $request->name,
                'display_name' => $request->display_name,
                'description' => $request->description,
            ];

        $role = $this->roleRepository->update($role_params, $id);

        $permissions = $this->permissionRepository->all();
        foreach ($permissions as $per) {
            $role->detachPermission($per);
        }

        $permissions_param = $request->permissions;
        if (is_array($permissions_param)) {
            foreach($permissions_param as $pid) {
                $p = $this->permissionRepository->find($pid);
                $role->attachPermission($p);
            }
        }
        Session::flash('flash', ['success' => 'Permission updated successfully']);
        return redirect()->route('roles.index');
    }

    public function destroy($id)
    {
        hydrogen_authorize('roles-destroy');

        $role = $this->roleRepository->find($id);
        $role->users()->sync([]);
        $role->perms()->sync([]);
        $role->forceDelete();

        Session::flash('flash', ['success' => 'Role deleted successfully']);
        return redirect()->route('roles.index');
    }
}