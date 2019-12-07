<?php

namespace Hydrogen\Base\Repositories\Eloquent\User;


use Hydrogen\Base\Models\User\User;
use Hydrogen\Base\Repositories\Contracts\User\UserRepositoryInterface;
use Hydrogen\Base\Validators\UserValidator;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Events\RepositoryEntityCreated;
use Prettus\Repository\Events\RepositoryEntityUpdated;
use Prettus\Validator\Contracts\ValidatorInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function model()
    {
        return User::class;
    }

    public function validator()
    {
        return UserValidator::class;
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }


    public function create(array $attributes)
    {
        if (!is_null($this->validator)) {
//            $attributes = $this->model->newInstance()->forceFill($attributes)->toArray();
            $this->validator->with($attributes)->passesOrFail(ValidatorInterface::RULE_CREATE);
        }

        unset($attributes['password_confirmation']);
        $attributes['password'] = bcrypt($attributes['password']);



        $model = $this->model->newInstance($attributes);
        $model->save();
        $this->resetModel();
        event(new RepositoryEntityCreated($this, $model));

        return $this->parserResult($model);
    }

    public function update(array $attributes, $id)
    {

        if (!$attributes['password']) {
            unset($attributes['password']);
            unset($attributes['password_confirmation']);
        }


        $this->applyScope();
        if (!is_null($this->validator)) {
            $this->validator->with($attributes)->setId($id)->passesOrFail(ValidatorInterface::RULE_UPDATE);
        }

        $temporarySkipPresenter = $this->skipPresenter;

        $this->skipPresenter(true);

        $model = $this->model->findOrFail($id);

        // update password
        if (isset($attributes['password']) && $attributes['password']) {
            $attributes['password'] = bcrypt($attributes['password']);
        }

        $model->fill($attributes);
        $model->save();

        $this->skipPresenter($temporarySkipPresenter);
        $this->resetModel();

        event(new RepositoryEntityUpdated($this, $model));

        return $this->parserResult($model);
    }
}