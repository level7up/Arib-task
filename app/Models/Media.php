<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Http\UploadedFile;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Media extends Model
{
    use HasFactory;

    protected $table = 'medias';

    protected $fillable = ['mediable_id', 'mediable_type', 'file_name', 'type'];

    protected $appends = ['file_url'];
    public static function booted()
    {
        static::deleting(function (self $media) {
            Storage::disk('public')->delete($media->file_name);
        });
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = Str::uuid()->toString();
            }
        });
    }
    //----------- Relationships

    /**
     * Get the related model
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function mediable()
    {
        return $this->morphTo();
    }

    //----------- Getters

    /**
     * Get full image url
     *
     * @return string
     */
    public function getFileUrlAttribute()
    {
        return Storage::disk('public')->url($this->file_name);
    }

    /**
     * Get full image path
     *
     * @return string
     */
    public function getFilePathAttribute()
    {
        return Storage::disk('public')->path($this->file_name);
    }


    public function upload(UploadedFile $file, string|null $folder = null, string|null $sub_folder = null)
    {
        if ($this->file_name) {
            Storage::disk('public')->delete($this->file_name);
        }
        $folder = config("support.filesystem.{$folder}") ?? $folder;

        $file_name = Storage::disk('public')->putFile(
            rtrim(implode('/', [$folder, $sub_folder]), '/'),
            $file
        );
        return $this->forceFill([
            'file_name' => $file_name,
        ]);
    }
}
