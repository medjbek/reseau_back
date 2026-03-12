<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnnonceResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'organisation_name' => $this->organisation_name,
            'organisation_address' => $this->organisation_address,
            'city' => $this->city,
            'contact_email' => $this->contact_email,
            'contact_phone' => $this->contact_phone,
            'status' => $this->status,

            'category' => [
                'id' => $this->category?->id,
                'name' => $this->category?->name,
            ],

            'user' => [
                'id' => $this->user?->id,
                'name' => $this->user?->name,
                'email' => $this->user?->email,
            ],

            'created_at' => $this->created_at,
        ];
    }
}
