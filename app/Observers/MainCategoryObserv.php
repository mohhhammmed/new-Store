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
                      ///////////////////////////
        ///////////////////Delete Sub Categories/////////
           $subcategories=$maincategory->subcategories();
           if(isset($subcategories)&& $subcategories->count() > 0){
               foreach($maincategory->subcategories as $subcategory){
                   $subcategory->description()->delete();
                   $subcategory->parent()->delete();
               }
               $subcategories->delete();
           }

                       ////////////////////////////
             //////////////////Delete Average////////////
           if(isset($maincategory->average) && $maincategory->average!=null){
               $maincategory->average()->delete();
           }

           /////////////////////////////////////////////////////////////////////////////////
////////////////Delete Translations && Translation's Subcategories && Translation's vendors////////////
        $translations=$maincategory->translations();
        if(isset($translations) && $translations->count()!=null){
            if(isset($translations->subcategories) && $translations->subcategories->count() > 0){
                foreach($maincategory->translations as $trans) {
                    foreach($trans->subcategories as $subcategory) {
                        $subcategory->delete();
                    }
                    foreach($trans->vendors as $vendor) {
                        $vendor->delete();
                    }
                }
            }
            $translations->delete();
        }

                    ///////////////////////////////////
  //////////////////////////////Delete Vendors///////////////////////////
        if(isset($maincategory->vendors) && $maincategory->vendors->count() > 0 )
        {
            $maincategory->vendors()->delete();
        }



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
