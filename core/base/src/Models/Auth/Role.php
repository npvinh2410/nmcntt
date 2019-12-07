<?php

namespace Hydrogen\Base\Models\Auth;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Config;
use Zizaco\Entrust\Contracts\EntrustRoleInterface;
use Zizaco\Entrust\Traits\EntrustRoleTrait;
use Illuminate\Cache\TaggableStore;
use Illuminate\Support\Facades\Cache;

class Role extends Model implements EntrustRoleInterface
{

    use EntrustRoleTrait;


    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = Config::get('entrust.roles_table');
    }

    protected $fillable = ['name', 'display_name', 'description'];


    public function users()
    {
        return $this->belongsToMany(Config::get('auth.providers.users.model'), Config::get('entrust.role_user_table'),Config::get('entrust.role_foreign_key'),Config::get('entrust.user_foreign_key'));
    }

    public function cachedPermissions()
    {
        $rolePrimaryKey = $this->primaryKey;
        $cacheKey = 'entrust_permissions_for_role_'.$this->$rolePrimaryKey;
        if(Cache::getStore() instanceof TaggableStore)
        {
            return Cache::tags(Config::get('entrust.permission_role_table'))->remember($cacheKey,
                Config::get('cache.ttl'), function () {
                    return $this->perms()->get();
                });
        }
        else
        {
            return $this->perms()->get();
        }
    }

    public function save(array $options = [])
    {   //both inserts and updates
        $result = parent::save($options);
        if(Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('entrust.permission_role_table'))->flush();
        }
        return $result;
    }
    public function delete(array $options = [])
    {   //soft or hard
        $result = parent::delete($options);
        if(Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('entrust.permission_role_table'))->flush();
        }
        return $result;
    }
    public function restore()
    {   //soft delete undo's
        $result = parent::restore();
        if(Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('entrust.permission_role_table'))->flush();
        }
        return $result;
    }
}