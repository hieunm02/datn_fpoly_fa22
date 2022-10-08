<?php
namespace App\Helpers;

class Helper{
    public static function active($active = 1) : string
    {
        return $active == 1 ? '<span class="btn btn-danger btn-xs">No</span>' : '<span class="btn btn-success btn-xs">Yes</span>';
    }

}

?>