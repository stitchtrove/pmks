<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Database\Factories\NoteFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Filament\Forms\Components\RichEditor\FileAttachmentProviders\SpatieMediaLibraryFileAttachmentProvider;
use Filament\Forms\Components\RichEditor\Models\Concerns\InteractsWithRichContent;
use Filament\Forms\Components\RichEditor\Models\Contracts\HasRichContent;

class Note extends Model implements HasMedia, HasRichContent
{
    /** @use HasFactory<NoteFactory> */
    use HasFactory, InteractsWithMedia, InteractsWithRichContent;

    protected $fillable = [
        'title',
        'uuid',
        'slug',
        'content',
        'excerpt',
        'status',
        'is_pinned',
        'is_public',
        'word_count',
        'read_time',
        'last_reviewed_at',
        'user_id',
    ];

    protected $casts = [
        'is_pinned' => 'boolean',
        'last_reviewed_at' => 'datetime',
    ];

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('note-attachments')->useDisk('public');
    }

    public function setUpRichContent(): void
    {
        $this->registerRichContent('content')
            ->fileAttachmentProvider(
                SpatieMediaLibraryFileAttachmentProvider::make()
                    ->collection('note-attachments')
                    ->preserveFilenames()
            );
    }

    // Auto-generate slug and optional fields
    protected static function booted(): void
    {
        static::creating(function ($note) {
            $note->uuid = Str::uuid();
            // a note always needs a slug but may not have a title
            // in that case, simply use the uuid
            if (empty($note->slug)) {
                $note->slug = Str::slug($note->title) ? Str::slug($note->title) . '-' . Str::random(6) : $note->uuid;
            }

            $note->word_count = str_word_count(strip_tags($note->content));
            $note->read_time = ceil($note->word_count / 200); // ~200 wpm
        });

        static::updating(function ($note) {
            $note->word_count = str_word_count(strip_tags($note->content));
            $note->read_time = ceil($note->word_count / 200);
        });
    }

    /**
     * Get the topic for this note.
     *
     * @return BelongsTo<Topic, $this>
     */
    public function topic(): BelongsTo
    {
        return $this->belongsTo(Topic::class);
    }

    /**
     * The tags attached to this note.
     *
     * @return BelongsToMany<Tag, $this>
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

}