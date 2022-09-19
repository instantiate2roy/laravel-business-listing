<?php

namespace App\CustomClasses;

use App\Models\Lookup;

class Lookups
{

    /**
     * get simple lookup
     *
     * @param string $scope
     * @param bool $fullDesc
     * 
     * @return array
     * 
     */
    public static function getSimple(string $scope, bool $fullDesc = false): array
    {
        $lookupCollection = Lookup::where('lk_scope', $scope)->get();
        $lookups = [];
        if (!$fullDesc) {
            foreach ($lookupCollection as $lookup) {
                $lookups[$lookup->lk_key] = $lookup->lk_short_description;
            }
        } else {
            foreach ($lookupCollection as $lookup) {
                $lookups[$lookup->lk_key] = $lookup->lk_full_description;
            }
        }

        return $lookups;
    }
}
