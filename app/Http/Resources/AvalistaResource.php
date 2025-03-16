<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AvalistaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $avalista = [
            'id' => $this->id,
            'curso_id' => $this->curso_id,
            'avalista_nome' => $this->avalista_nome,
            'avalista_email' => $this->avalista_email,
        ];

        return $avalista;
    }
}
