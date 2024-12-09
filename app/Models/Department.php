<?php 
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

final class Department extends Model
{

    /**
     * Department Has Many Users.
     *
     * @return HasMany
     */
    public function users() : HasMany
    {
        return $this->hasMany(User::class);
    }
}