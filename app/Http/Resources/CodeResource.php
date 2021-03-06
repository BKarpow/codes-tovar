<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CodeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'search_mask' => $this->search_mask,
            'code' => $this->code,
            'code_n' => $this->code_n,
            'comment' => $this->comment,
        ];
    }
}
