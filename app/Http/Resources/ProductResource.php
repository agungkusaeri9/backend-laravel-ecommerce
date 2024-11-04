<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'product_category_name' => $this->category->name,
            'slug' => $this->slug,
            'desc' => $this->desc,
            'price' => $this->price,
            'qty' => $this->qty,
            'sold' => $this->sold,
            'weight' => $this->weight,
            'image' => $this->image,
            'galleries' => $this->galleries
        ];
    }
}
