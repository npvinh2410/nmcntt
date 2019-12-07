<?php

namespace Hydrogen\Media\Http\Controllers;

use Hydrogen\Media\Repositories\Contracts\UserInterface;
use Hydrogen\Support\Facades\HMediaFacade;
use Illuminate\Routing\Controller;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function getList()
    {
        $users = $this->userRepository->getListUsers();


        return HMediaFacade::responseSuccess($users);
    }
}
