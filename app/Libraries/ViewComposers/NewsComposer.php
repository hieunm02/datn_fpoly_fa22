<?php

namespace App\Libraries\ViewComposers;

use Illuminate\View\View;
use App\Models\Entities\CategoryEntity;
use App\Models\User;

class NewsComposer
{
    /**
     * Bind data to the view.
     * Bind data vào view. $view->with('ten_key_se_dung_trong_view', $data);
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        // get all category (for demo purpose)
        $authors = User::all();

        // bind to view
        $view->with('authors', $authors);
    }
}
