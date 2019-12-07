<?php


namespace Hydrogen\Base\Models\User;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Zizaco\Entrust\Traits\EntrustUserTrait;
use Illuminate\Cache\TaggableStore;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Config;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password', 'status', 'type'
    ];


    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function routeNotificationForMail()
    {
        return $this->email;
    }

    public function client()
    {
        return $this->hasOne(Client::class, 'user_id', 'id');
    }

    public function admin()
    {
        return $this->hasOne(Admin::class, 'user_id', 'id');
    }


    public function gravatar() {
        $base_url = "https://www.gravatar.com/avatar/";
        $hash = md5($this->email);

        return ($base_url . $hash);
    }


    public function cachedRoles()
    {
        $userPrimaryKey = $this->primaryKey;
        $cacheKey = 'entrust_roles_for_user_'.$this->$userPrimaryKey;
        if(Cache::getStore() instanceof TaggableStore) {
            return Cache::tags(Config::get('entrust.role_user_table'))->remember($cacheKey, Config::get('cache.ttl'), function () {
                return $this->roles()->get();
            });
        }
        else
        {
            return $this->roles()->get();
        }
    }

    public function save(array $options = [])
    {   //both inserts and updates
        parent::save($options);
        if(Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('entrust.role_user_table'))->flush();
        }
    }

    public function delete(array $options = [])
    {   //soft or hard
        parent::delete($options);
        if(Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('entrust.role_user_table'))->flush();
        }
    }

    public function restore()
    {   //soft delete undo's
        parent::restore();
        if(Cache::getStore() instanceof TaggableStore) {
            Cache::tags(Config::get('entrust.role_user_table'))->flush();
        }
    }
}