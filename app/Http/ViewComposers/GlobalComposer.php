<?php

namespace App\Http\ViewComposers;

use JavaScript;
use Illuminate\Support\Facades\Auth;

class GlobalComposer
{
    /**
     * @param $view
     */
    public function compose($view)
    {
        if (Auth::check()) {
            $user = Auth::user();
            $view->with('currentUser', $user);
        }
    }
}