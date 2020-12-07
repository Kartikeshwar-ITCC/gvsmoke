<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\User;

class AgencyListComposer
{
    public $agencyList = null;
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        $this->agencyList = User::where('role', 'agency')->select('id', 'name', 'property_manager_name')->get();

    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('agencyList', $this->agencyList);
    }
}
