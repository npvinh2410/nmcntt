<?php
namespace Hydrogen\Base\Http\Controllers;

use App\Http\Controllers\Controller;
use Hydrogen\Base\Repositories\Eloquent\Auth\PermissionRepository;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;

class PermissionController extends Controller {

    protected $permissionRepository;

    public function __construct(PermissionRepository $permissionRepository)
    {
        $this->permissionRepository = $permissionRepository;
    }

    public function index()
    {
        hydrogen_authorize('permissions-index');

        $permissions = $this->permissionRepository->scopeQuery(function($query){
            return $query->orderBy('created_at','desc');
        })->all();

        return view('dashboard::permission.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        hydrogen_authorize('permissions-create');

        return view('dashboard::permission.create');
    }

    public function create_bundle()
    {
        hydrogen_authorize('permissions-create');

        return view('dashboard::permission.create_bundle');
    }

    public function store_bundle(Request $request)
    {
        hydrogen_authorize('permissions-create');

        $permissions = [];
        $name = trim($request->name);

        if($this->permissionRepository->findByField('name',$name.'-index')->isEmpty())
        {
            $tmp['name'] = $name.'-index';
            $tmp['display_name'] = 'List '. ucfirst(str_singular($name));
            $tmp['description'] = $request->description;
            $permissions[] = $tmp;
        }

        if($this->permissionRepository->findByField('name', $name.'-create')->isEmpty())
        {
            $tmp['name'] = $name.'-create';
            $tmp['display_name'] = 'Create '. ucfirst(str_singular($name));
            $tmp['description'] = $request->description;
            $permissions[] = $tmp;
        }

        if($this->permissionRepository->findByField('name', $name.'-show')->isEmpty())
        {
            $tmp['name'] = $name.'-show';
            $tmp['display_name'] = 'Show '. ucfirst(str_singular($name));
            $tmp['description'] = $request->description;
            $permissions[] = $tmp;
        }

        if($this->permissionRepository->findByField('name', $name.'-edit')->isEmpty())
        {
            $tmp['name'] = $name.'-edit';
            $tmp['display_name'] = 'Edit '. ucfirst(str_singular($name));
            $tmp['description'] = $request->description;
            $permissions[] = $tmp;
        }

        if($this->permissionRepository->findByField('name', $name.'-destroy')->isEmpty())
        {
            $tmp['name'] = $name.'-destroy';
            $tmp['display_name'] = 'Delete '. ucfirst(str_singular($name));
            $tmp['description'] = $request->description;
            $permissions[] = $tmp;
        }
        $per = '';

        foreach ($permissions as $permission)
        {
            $this->permissionRepository->create($permission);
            $per .= $permission['display_name'] . ' | ';
        }
        if($per == '')
        {
            Session::flash('flash', ['warning' => 'Bundle is existed']);
        }
        else
        {
            Session::flash('flash', ['success' => 'Permission '.rtrim($per, ' | ').' created successfully']);
        }

        return redirect()->route('permissions.index');
    }

    public function store(Request $request)
    {
        hydrogen_authorize('permissions-create');

        $params = Input::all();
        $this->permissionRepository->create($params);
        Session::flash('flash', ['success' => 'Permission created successfully']);
        return redirect()->route('permissions.index');
    }

    public function show($id)
    {
        hydrogen_authorize('permissions-show');

        $permission = $this->permissionRepository->find($id);
        return view('dashboard::permission.show', ['permission' => $permission]);
    }

    public function edit($id)
    {
        hydrogen_authorize('permissions-edit');

        $permission = $this->permissionRepository->find($id);
        return view('dashboard::permission.edit', ['permission' => $permission]);
    }

    public function update(Request $request, $id)
    {
        hydrogen_authorize('permissions-edit');

        $params = Input::all();
        $this->permissionRepository->update($params, $id);

        Session::flash('flash', ['success' => 'Permission updated successfully']);
        return redirect()->route('permissions.index');
    }

    public function destroy($id)
    {
        hydrogen_authorize('permissions-destroy');

        $this->permissionRepository->delete($id);
        Session::flash('flash', ['success' => 'Permission deleted successfully']);
        return redirect()->route('permissions.index');
    }
}