<?php
namespace Hydrogen\Base\Http\Controllers;

use App\Http\Controllers\Controller;

use Hydrogen\Base\Repositories\Eloquent\Auth\RoleRepository;
use Hydrogen\Base\Repositories\Eloquent\User\AdminRepository;
use Hydrogen\Base\Repositories\Eloquent\User\ClientRepository;
use Hydrogen\Base\Repositories\Eloquent\User\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Request;


class UserController extends Controller {
    protected $userRepository;
    protected $clientRepository;
    protected $adminRepository;
    protected $roleRepository;

    public function __construct(UserRepository $userRepository,
                                ClientRepository $clientRepository,
                                AdminRepository $adminRepository,
                                RoleRepository $roleRepository)
    {
        $this->userRepository = $userRepository;
        $this->adminRepository = $adminRepository;
        $this->clientRepository = $clientRepository;
        $this->roleRepository = $roleRepository;
    }

    public function index() {
        hydrogen_authorize('users-index');

        $admins = $this->userRepository->findByField('type', 0);
        $clients = $this->userRepository->findByField('type', 1);

        return view('dashboard::user.index', ['admins' => $admins, 'clients' => $clients]);
    }

    public function create_admin()
    {
        hydrogen_authorize('admins-create');

        $roles = $this->roleRepository->all();
        return view('dashboard::user.create_admin', ['roles' => $roles]);
    }

    public function create_client()
    {
        hydrogen_authorize('clients-create');

        return view('dashboard::user.create_client');
    }

    public function store_admin(Request $request)
    {
        hydrogen_authorize('admins-create');

        $user_params = [
            'email' => $request->email,
            'type' => 0,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ];

        $new_user = $this->userRepository->create($user_params);

        $admin_param = [
            'name' => $request->name,
            'user_id' => $new_user->id
        ];

        $this->adminRepository->create($admin_param);

        $role = $this->roleRepository->find($request->role);

        $new_user->attachRole($role);

        Session::flash('flash', ['success' => 'User admin created successfully']);
        return redirect()->route('users.index');
    }

    public function store_client(Request $request)
    {
        hydrogen_authorize('clients-create');

        $user_params = [
            'email' => $request->email,
            'type' => 1,
            'password' => $request->password,
            'password_confirmation' => $request->password_confirmation,
        ];

        $new_user = $this->userRepository->create($user_params);

        $client_param = [
            'name' => $request->name,
            'phone' => $request->phone,
            'user_id' => $new_user->id
        ];

        if($request->address)
        {
            $client_param['address'] = $request->address;
        }

        $this->clientRepository->create($client_param);

        Session::flash('flash', ['success' => 'User client created successfully']);
        return redirect()->route('users.index');
    }

    public function show_admin($id)
    {
        if (current_user_id() != $id)
        {
            hydrogen_authorize('admins-show');
        }

        $user = $this->userRepository->find($id);

        return view('dashboard::user.show', ['user' => $user, 'type' => 0]);
    }

    public function show_client($id)
    {
        if (current_user_id() != $id)
        {
            hydrogen_authorize('clients-show');
        }

        $user = $this->userRepository->find($id);

        return view('dashboard::user.show', ['user' => $user, 'type' => 1]);
    }

    public function edit_admin($id)
    {
        if (current_user_id() != $id)
        {
            hydrogen_authorize('admins-edit');
        }

        $user = $this->userRepository->find($id);
        $roles = $this->roleRepository->all();

        return view('dashboard::user.edit_admin', ['user' => $user, 'roles' => $roles]);
    }

    public function edit_client($id)
    {
        if (current_user_id() != $id)
        {
            hydrogen_authorize('clients-edit');
        }

        $user = $this->userRepository->find($id);

        return view('dashboard::user.edit_client', ['user' => $user]);
    }

    public function update_admin(Request $request, $id)
    {
        if (current_user_id() != $id)
        {
            hydrogen_authorize('admins-edit');
        }

        $current_password = $request->current_password;

        if (Hash::check($current_password, current_user()->password)) {

            $user_params = [
                'email' => $request->email,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
            ];

            $user = $this->userRepository->update($user_params, $id);

            if ($request->deactivate)
            {
                $user->status = false;
                $user->save();
            }
            else
            {
                $user->status = true;
                $user->save();
            }

            $admin_param = [
                'name' => $request->name
            ];

            $this->adminRepository->update($admin_param, $user->admin->id);

            $role_id = $request->role;

            if($role_id)
            {
                $user->detachRoles();
                $role = $this->roleRepository->find($role_id);
                $user->attachRole($role);
            }

            Session::flash('flash', ['success' => 'User admin updated successfully']);
            return redirect()->route('users.index');

        }

        return redirect()->back()->withErrors(['current_password' => 'Current password is not correct!'])->withInput();
    }


    public function update_client(Request $request, $id)
    {
        if (current_user_id() != $id)
        {
            hydrogen_authorize('clients-edit');
        }

        $current_password = $request->current_password;

        if (Hash::check($current_password, current_user()->password)) {

            $user_params = [
                'email' => $request->email,
                'password' => $request->password,
                'password_confirmation' => $request->password_confirmation,
            ];

            $user = $this->userRepository->update($user_params, $id);

            if ($request->deactivate)
            {
                $user->status = false;
                $user->save();
            }
            else
            {
                $user->status = true;
                $user->save();
            }

            $client_param = [
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address
            ];

            $this->clientRepository->update($client_param, $user->client->id);

            $role_id = $request->role;

            if($role_id)
            {
                $user->detachRoles();
                $role = $this->roleRepository->find($role_id);
                $user->attachRole($role);
            }

            Session::flash('flash', ['success' => 'User client updated successfully']);
            return redirect()->route('users.index');

        }

        return redirect()->back()->withErrors(['current_password' => 'Current password is not correct!'])->withInput();
    }

    public function destroy_admin($id)
    {
        hydrogen_authorize('admins-destroy');

        $user = $this->userRepository->find($id);
        $user->detachRoles();
        $this->adminRepository->delete($user->admin->id);

        $this->userRepository->delete($id);

        Session::flash('flash', ['success' => 'User admin deleted successfully']);
        return redirect()->route('users.index');
    }

    public function destroy_client($id)
    {
        hydrogen_authorize('clients-destroy');

        $user = $this->userRepository->find($id);


        $user->detachRoles();
        $this->clientRepository->delete($user->client->id);

        $this->userRepository->delete($id);

        Session::flash('flash', ['success' => 'User client deleted successfully']);
        return redirect()->route('users.index');
    }
}