<?php

namespace App\Traits\Criteria;

use Illuminate\Support\Carbon;

trait SearchableDate
{
    /**
     * Get searchable date
     *
     * @param   string  $searchParam
     * @return  string
     */
    private function getSearchableDate($searchParam)
    {
        $searchDate = preg_replace('/\D/', '', $searchParam);

        if (strlen($searchDate) <> 8) {
            return false;
        }

        try {
            $searchDate = Carbon::createFromFormat('dmY', $searchDate);

            return $searchDate->format('Y-m-d');

        } catch (\Exception $e) {
            return false;
        }
    }
}
