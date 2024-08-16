<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'avatar' => $this->avatar_url,
            'nome' => $this->name,
            'usuario' => $this->login,
            'bio' => $this->bio,
            'url' => $this->html_url,
            'blog' => $this->blog,
            'empresa' => $this->company,
            'localizacao' => $this->location,
            'reposistorios_publicos' => $this->public_repos,
            'seguidores' => $this->followers,
            'seguindo' => $this->following,
        ];
    }
}
