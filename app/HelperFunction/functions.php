<?php

function locale_lang(){
    return app()->getLocale();
}


 function get_response($statue,$msg){
    return response()->json([
        'status'=>$statue,
        'msg'=>$msg

    ]);


}



function website_translation($text){
    return locale_lang() != 'en'?__('trans.'.$text):$text;
}



function get_image($image){
    return asset($image);
}