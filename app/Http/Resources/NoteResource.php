<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

    /**
     * Class NoteResource
     *
     * @property int         $id
     * @property string      $uuid
     * @property string      $title
     * @property string|null $slug
     * @property string|null $excerpt
     * @property string|null $content
     * @property string|null $status
     * @property bool        $is_pinned
     * @property bool        $is_public
     * @property int|null    $word_count
     * @property int|null    $read_time
     * @property \Illuminate\Support\Carbon|null $last_reviewed_at
     * @property int         $user_id
     * @property \Illuminate\Support\Carbon|null $created_at
     * @property \Illuminate\Support\Carbon|null $updated_at
     *
     * @mixin \App\Models\Note
     */

class NoteResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id'               => $this->id,
            'uuid'             => $this->uuid,
            'title'            => $this->title,
            'slug'             => $this->slug,
            'excerpt'          => $this->excerpt,
            'content'          => $this->content,
            'status'           => $this->status,
            'is_pinned'        => (bool) $this->is_pinned,
            'is_public'        => (bool) $this->is_public,
            'word_count'       => (int) $this->word_count,
            'read_time'        => (int) $this->read_time,
            'last_reviewed_at' => $this->last_reviewed_at
                ? $this->last_reviewed_at->toDateTimeString()
                : null,
            'user_id'          => $this->user_id,
            'created_at'       => $this->created_at?->toDateTimeString(),
            'updated_at'       => $this->updated_at?->toDateTimeString(),
        ];
    }
}
