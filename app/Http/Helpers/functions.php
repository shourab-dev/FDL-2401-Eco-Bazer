<?php

if (!function_exists('getProfileImage')) {
    function getProfileImage()
    {
        return "https://api.dicebear.com/9.x/initials/svg?seed=" . auth()->user()->name;
    }
}



if(!function_exists('general_status')){
    function general_status($status){
        if($status == 1){
            return '<span class="badge bg-success">Active</span>';
        } else{
            return '<span class="badge bg-danger">Inactive</span>';
        }

    }
}


if(!function_exists('getImage')){
    function getImage($path = null) {
        return $path ? asset('storage/'. $path) : 'https://i0.wp.com/mikeyarce.com/wp-content/uploads/2021/09/woocommerce-placeholder.png';
    }
}