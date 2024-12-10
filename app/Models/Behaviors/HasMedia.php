<?php

namespace App\Models\Behaviors;

use App\Models\User;
use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Database\ClassMorphViolationException;

trait HasMedia
{
    /**
     * Get related medias
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function medias()
    {        
        return $this->morphMany(Media::class, 'mediable');
    }

    public function media()
    {
        Relation::morphMap([
            User::class => 'App\\Models\\User',
        ]);
        
        return $this->morphOne(Media::class, 'mediable')
            ->latestOfMany();
    }

    /**
     * Get medias url's file_names
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getMediasUrlAttribute()
    {
        return $this->medias->pluck('file_name');
    }

    /**
     * Get media's url
     *
     * @return string
     */
    public function getMediaUrlAttribute()
    {
        return optional($this->medias->first())->file_url ?? '/blank-image-dark.svg';
    }

    //----------- Getters

    public function single(string $type)
    {
        return $this->medias->firstWhere('type', $type);
    }

    public function multiple(string $type)
    {
        return $this->medias->where('type', $type);
    }
}
