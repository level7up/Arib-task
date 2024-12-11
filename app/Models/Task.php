<?php 
namespace App\Models;

use App\Enums\StatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected  $casts= [
        'status' => StatusEnum::class
    ];
    public function users()
    {
        return $this->belongsToMany(User::class , 'user_task');
    }
    public function creator(){
        return $this->belongsTo(User::class, 'user_id');
    }
}