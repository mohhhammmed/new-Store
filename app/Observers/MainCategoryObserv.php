<?php

namespace App\Observers;

use App\Models\Maincategory;

class MainCategoryObserv
{
    /**
     * Handle the Maincategory "created" event.
     *
     * @param  \App\Models\Maincategory  $maincategory
     * @return void
     */
    public function created(Maincategory $maincategory)
    {


    }

    /**
     * Handle the Maincategory "updated" event.
     *
     * @param  \App\Models\Maincategory  $maincategory
     * @return void
     */
    public function updated(Maincategory $maincategory)
    {
        //$statue_vendor=$maincategory->vendors();

            if($maincategory->action==0) {
                $maincategory->vendors()->update(['action' => $maincategory->action]);
            }
    }

    /**
     * Handle the Maincategory "deleted" event.
     *
     * @param  \App\Models\Maincategory  $maincategory
     * @return void
     */
    public function deleted(Maincategory $maincategory)
    {

            $maincategory->transes()->delete();
           // $maincategory->vendors()->delete();

    }

    /**
     * Handle the Maincategory "restored" event.
     *
     * @param  \App\Models\Maincategory  $maincategory
     * @return void
     */
    public function restored(Maincategory $maincategory)
    {
        //
    }

    /**
     * Handle the Maincategory "force deleted" event.
     *
     * @param  \App\Models\Maincategory  $maincategory
     * @return void
     */
    public function forceDeleted(Maincategory $maincategory)
    {
        //
    }
}
