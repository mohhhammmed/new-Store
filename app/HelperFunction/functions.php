<?php

function locale_lang(){
    return app()->getLocale();
}


 function get_response($statue,$msg){
    return response()->json([
        'statue'=>$statue,
        'msg'=>$msg

    ]);
}