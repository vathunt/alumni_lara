<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Repositories\UserRepository;
use App\Status;

class UserComposer
{
    public function compose(View $view)
    {
        $view->with('status', Status::all());
    }
}