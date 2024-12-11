<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Behaviors\HasMedia;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, HasMedia;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ! Relations 

    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class);
    }
    public function tasks()
    {
        return $this->belongsToMany(Task::class , 'user_task');
    }
    public function manager()
    {
        return $this->belongsTo(User::class , 'manager_id');
    }
    public function staff()
    {
        return $this->hasMany(User::class , 'manager_id');
    }


    // * GETTERS

    public function getNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
    public function ScopeHasRole($value, $origin)
    {
        return $this->role->name == $origin;
    }
    public function getAvatarUrlAttribute(){
        return $this->single('avatar')?->file_url  ?? asset('assets/Default-avatar.jpg');
    }
}
