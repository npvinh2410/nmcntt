<?php

namespace Hydrogen\Media\Http\Controllers;

use Hydrogen\Media\Repositories\Contracts\MediaShareInterface;
use Hydrogen\Media\Repositories\Contracts\UserInterface;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Hydrogen\Media\Facades\HMediaFacade;

class MediaShareController extends Controller
{
    protected $shareRepository;
    protected $userRepository;
    public function __construct(MediaShareInterface $mediaShareRepository, UserInterface $userRepository)
    {
        $this->shareRepository = $mediaShareRepository;
        $this->userRepository = $userRepository;
    }

    public function getSharedUsers(Request $request)
    {
        $share_id = $request->input('share_id');
        $share_type = $request->input('is_folder') == 'false' ? 'file' : 'folder';
        $shared_users = $this->shareRepository->getSharedUsers($share_id, $share_type)->pluck('id')->all();
        $users = $this->userRepository->getListUsers();

        foreach ($users as $user) {
            $user->is_selected = 0;
            if (in_array($user->id, $shared_users)) {
                $user->is_selected = 1;
            }
        }

        return HMediaFacade::responseSuccess(compact('users'));
    }
}
