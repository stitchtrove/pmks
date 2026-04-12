<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

    /**
     * Class BakeResource   
     *  
     * @package App\Http\Resources
     * @property string $slug
     * @property string $name
     * @property string $type
     * @property string|null $subtype
     * @property string $content
     * @property string|null $image_path
     * @property bool $published
     * @property Bake|null $relatedBake
     * @property \Illuminate\Support\Collection $flours
     */


class BakeResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'slug' => $this->slug,
            'name' => $this->name,
            'type' => $this->type,
            'subtype' => $this->subtype,
            'content' => $this->content,
            'image_path' => $this->image_path,
            'published' => $this->published,
            'related_bake' => $this->relatedBake ? new BakeResource($this->relatedBake) : null,
            'flours' => $this->flours->map(function ($flour) {
                return [
                    'name' => $flour->name,
                    'type' => $flour->type,
                    'shop' => $flour->shop,
                    'link' => $flour->link,
                    'protein' => $flour->protein,
                ];
            }),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
