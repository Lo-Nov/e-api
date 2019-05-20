<?php

namespace App\Http\Resources\Product;

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
        return array(array(
           'name'=>$this->name,
            'id' =>$this->id,
            'user_id' => $this->user_id,
            'description'=>$this->detail,
            'price'=>$this->price,
            'totalPrice'=>round(( 1 - ($this->discount/100)) * $this->price,2),
            'stock'=>$this->stock == 0 ? 'Out of Stock' : $this->stock,
            'discount'=>$this->discount,
            'rating'=>$this->reviews->count() > 0 ? round($this->reviews->sum('star')/$this->reviews->count(),2) : 'No rating yet',
            'href'=> array(
                'reviews'=>route('reviews.index',$this->id)
            )
        ));
    }
}
