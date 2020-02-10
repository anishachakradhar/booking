<?php

namespace App\Http\Resources\Frontend;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DateBookingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($item){
            return [
                'available_date' => $item->available_date,
                'available_date_id' => $item->available_date_id
            ];
        });
        // return parent::toArray($request);
    }
}
