<?php
namespace App\Models\Repositories;

use App\Models\Values;
use Cache;

class WidgetRepository
{

    public function allValues()
    {
        return Cache::remember(
            'all_values',
            60,
            function () {
                $values =  Values::with('project','version')
                    ->orderBy('id', 'DESC')
                    ->get();

                if(!$values)
                    return false;
                else
                    return $values;


            }
        );

    }

    public function getLocaleValues($lang = null, $take = 10, $skip = 0)
    {
        return Cache::tags('values/' . $lang)->rememberForever(
            $take . '/' .
            $skip,
            function () use ($lang, $take, $skip) {
                $values = Values::with('project','version')
                    ->whereLang($lang)
                    ->orderBy('id', 'DESC')
                    ->take($take)
                    ->skip($skip)
                    ->get();

                if (!$values)
                    return false;
                else
                    return $values;
            }
        );
    }


}