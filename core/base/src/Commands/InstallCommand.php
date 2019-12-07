<?php


namespace Hydrogen\Base\Commands;


use Hydrogen\Base\Repositories\Eloquent\Auth\PermissionRepository;
use Hydrogen\Base\Repositories\Eloquent\Auth\RoleRepository;
use Hydrogen\Base\Repositories\Eloquent\User\AdminRepository;
use Hydrogen\Base\Repositories\Eloquent\User\UserRepository;
use Illuminate\Console\Command;

class InstallCommand extends Command
{
    protected $signature = 'hydrogen:init {email?}';
    protected $description = 'Init Permissions, Roles and User';


    protected $permissionRepository;
    protected $roleRepository;
    protected $userRepository;
    protected $adminRepository;

    public function __construct(PermissionRepository $permissionRepository,
                                RoleRepository $roleRepository,
                                UserRepository $userRepository,
                                AdminRepository $adminRepository)
    {
        $this->permissionRepository = $permissionRepository;
        $this->roleRepository = $roleRepository;
        $this->userRepository = $userRepository;
        $this->adminRepository = $adminRepository;

        parent::__construct();
    }

    public function handle()
    {
        $permissions = [];

        $file = public_path('backend/permissions.txt');

        $data = array();

        if (($handle = fopen($file, 'r')) !== false)
        {
            while (($row = fgets($handle)) !== false)
            {
                $data[] = trim($row, "\n");
            }

            fclose($handle);
        }

        $email = $this->argument('email') ? $this->argument('email') : 'admin@hydrogen.com';
        $password = "hydrogen@888";

        if($this->permissionRepository->findByField('name', 'settings-index')->isEmpty())
        {
            $permissions[] = [
                'name' => 'settings-index',
                'display_name' => 'List Setting',
                'description' => 'List Setting',
            ];
        }

        if($this->permissionRepository->findByField('name', 'settings-update')->isEmpty())
        {
            $permissions[] = [
                'name' => 'settings-update',
                'display_name' => 'Update Setting',
                'description' => 'Update Setting',
            ];
        }

        if($this->permissionRepository->findByField('name', 'media-files-create')->isEmpty())
        {
            $permissions[] = [
                'name' => 'media-files-create',
                'display_name' => 'Create File',
                'description' => 'Create File',
            ];
        }

        if($this->permissionRepository->findByField('name', 'media-files-edit')->isEmpty())
        {
            $permissions[] = [
                'name' => 'media-files-edit',
                'display_name' => 'Edit File',
                'description' => 'Edit File',
            ];
        }

        if($this->permissionRepository->findByField('name', 'media-files-destroy')->isEmpty())
        {
            $permissions[] = [
                'name' => 'media-files-destroy',
                'display_name' => 'Delete File',
                'description' => 'Delete File',
            ];
        }

        if($this->permissionRepository->findByField('name', 'media-files-trash')->isEmpty())
        {
            $permissions[] = [
                'name' => 'media-files-trash',
                'display_name' => 'Trash File',
                'description' => 'Trash File',
            ];
        }

        if($this->permissionRepository->findByField('name', 'media-folders-create')->isEmpty())
        {
            $permissions[] = [
                'name' => 'media-folders-create',
                'display_name' => 'Create Folders',
                'description' => 'Create Folders',
            ];
        }

        if($this->permissionRepository->findByField('name', 'media-folders-edit')->isEmpty())
        {
            $permissions[] = [
                'name' => 'media-folders-edit',
                'display_name' => 'Edit Folders',
                'description' => 'Edit Folders',
            ];
        }

        if($this->permissionRepository->findByField('name', 'media-folders-destroy')->isEmpty())
        {
            $permissions[] = [
                'name' => 'media-folders-destroy',
                'display_name' => 'Destroy Folders',
                'description' => 'Destroy Folders',
            ];
        }

        if($this->permissionRepository->findByField('name', 'media-folders-trash')->isEmpty())
        {
            $permissions[] = [
                'name' => 'media-folders-trash',
                'display_name' => 'Trash Folders',
                'description' => 'Trash Folders',
            ];
        }

        if($this->permissionRepository->findByField('name', 'pages-publish')->isEmpty())
        {
            $permissions[] = [
                'name' => 'pages-publish',
                'display_name' => 'Pages Publish',
                'description' => 'Pages Publish',
            ];
        }

        if($this->permissionRepository->findByField('name', 'posts-publish')->isEmpty())
        {
            $permissions[] = [
                'name' => 'posts-publish',
                'display_name' => 'Posts Publish',
                'description' => 'Posts Publish',
            ];
        }

        if($this->permissionRepository->findByField('name', 'products-publish')->isEmpty())
        {
            $permissions[] = [
                'name' => 'products-publish',
                'display_name' => 'Products Publish',
                'description' => 'Products Publish',
            ];
        }

        if($this->permissionRepository->findByField('name', 'users-index')->isEmpty())
        {
            $permissions[] = [
                'name' => 'users-index',
                'display_name' => 'User index',
                'description' => 'User index',
            ];
        }


        if($this->permissionRepository->findByField('name', 'contacts-index')->isEmpty())
        {
            $permissions[] = [
                'name' => 'contacts-index',
                'display_name' => 'Contact index',
                'description' => 'Contact index',
            ];
        }

        if($this->permissionRepository->findByField('name', 'contacts-show')->isEmpty())
        {
            $permissions[] = [
                'name' => 'contacts-show',
                'display_name' => 'Contact show',
                'description' => 'Contact show',
            ];
        }

        if($this->permissionRepository->findByField('name', 'contacts-destroy')->isEmpty())
        {
            $permissions[] = [
                'name' => 'contacts-destroy',
                'display_name' => 'Contact delete',
                'description' => 'Contact delete',
            ];
        }



        foreach ($data as $item)
        {
            $item = trim($item, "\r");

            $group = str_plural($item);



            if($this->permissionRepository->findByField('name', $group.'-index')->isEmpty())
            {
                $permissions[] = [
                    'name' => $group.'-index',
                    'display_name' => 'List '. ucfirst($item),
                    'description' => ucfirst($item),
                ];
            }

            if($this->permissionRepository->findByField('name', $group.'-create')->isEmpty())
            {
                $permissions[] = [
                    'name' => $group.'-create',
                    'display_name' => 'Create '. ucfirst($item),
                    'description' => ucfirst($item),
                ];
            }

            if($this->permissionRepository->findByField('name', $group.'-show')->isEmpty())
            {
                $permissions[] = [
                    'name' => $group.'-show',
                    'display_name' => 'Show '. ucfirst($item),
                    'description' => ucfirst($item),
                ];
            }

            if($this->permissionRepository->findByField('name', $group.'-edit')->isEmpty())
            {
                $permissions[] = [
                    'name' => $group.'-edit',
                    'display_name' => 'Edit '. ucfirst($item),
                    'description' => ucfirst($item),
                ];
            }

            if($this->permissionRepository->findByField('name', $group.'-destroy')->isEmpty())
            {
                $permissions[] = [
                    'name' => $group.'-destroy',
                    'display_name' => 'Delete '. ucfirst($item),
                    'description' => ucfirst($item),
                ];
            }
        }

        $role = null;
        if($this->roleRepository->findByField('name', 'administrator')->isEmpty())
        {
            $role = [
                'name' => 'administrator',
                'display_name' => 'Administrator',
                'description' => 'Full Permissions'
            ];
        }

        if($this->roleRepository->findByField('name', 'client')->isEmpty())
        {
            $role_client = [
                'name' => 'client',
                'display_name' => 'Client',
                'description' => 'Khách Hàng'
            ];

            $this->roleRepository->create($role_client);
        }

        $user = null;
        if($this->userRepository->findByField('email', $email)->isEmpty())
        {
            $user = [
                'email' => $email,
                'password' => $password,
                'type' => 0,
                'password_confirmation' => $password
            ];
        }

        if($role != null)
        {
            $administrator =$this->roleRepository->create($role);


            foreach ($permissions as $permission) {
                $p = $this->permissionRepository->create($permission);
                echo "Permission ".$permission['name']." created successfully!" . PHP_EOL;
                $administrator->attachPermission($p);
            }

            echo "Admin created successfully!" . PHP_EOL;

            if($user != null)
            {
                $admin = $this->userRepository->create($user);

                $user_admin = [
                    'name' => 'Hydrogen',
                    'user_id' => $admin->id
                ];

                $this->adminRepository->create($user_admin);

                $admin->attachRole($administrator);

                echo "email: {$email}" . PHP_EOL;
                echo "password: {$password}" . PHP_EOL;
                echo "Please, login and update admin's information" . PHP_EOL;
            }
        }
        else
        {
            $administrator = $this->roleRepository->findByField('name', 'administrator')
                ->first();
            foreach ($permissions as $permission) {
                $p = $this->permissionRepository->create($permission);
                echo "Permission ".$permission['name']." created successfully!" . PHP_EOL;
                $administrator->attachPermission($p);
            }

            if($user != null)
            {
                $admin = $this->userRepository->create($user);

                $user_admin = [
                    'name' => 'Hydrogen',
                    'user_id' => $admin->id
                ];

                $this->adminRepository->create($user_admin);

                $admin->attachRole($administrator);


                echo "email: {$email}" . PHP_EOL;
                echo "password: {$password}" . PHP_EOL;
                echo "Please, login and update admin's information" . PHP_EOL;
            }
        }
    }
}