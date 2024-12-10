<?php
namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Interfaces\EmployeeRepositoryInterface;

class EmployeeRepository implements EmployeeRepositoryInterface
{
    public function __construct(protected User $employee){}


    public function all()
    {
        return $this->employee->all();
    }

    public function find($id)
    {
        return $this->employee->find($id);
    }

    public function create(array $attributes)
    {
        DB::beginTransaction();
        try {
            if(@$attributes['avatar']){   
                $avatar = $attributes['avatar'];
                $url=  Storage::disk('public')->putFile(
                    rtrim(implode('/', ['users']), '/'),
                    $avatar 
                );
                unset($attributes['avatar']);
            }
            $user = $this->employee->create($attributes);
            if(@$attributes['avatar']){   
                $user->medias()->updateOrCreate([
                    'type' => 'avatar',
                ], [
                    'file_name' => $url,
                ]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
        DB::commit();
        return $user;
    }

    public function update($id, array $attributes)
    {
        $employee = $this->find($id);
        if(@$attributes['avatar']){     
            $avatar = $attributes['avatar'];
            $url=  Storage::disk('public')->putFile(
                rtrim(implode('/', ['users']), '/'),
                $avatar 
            );
            
            $employee->medias()->updateOrCreate([
                'type' => 'avatar',
            ], [
                'file_name' => $url,
            ]);
            unset($attributes['avatar']);
        }
        $employee->update($attributes);
        return $employee;
    }

    public function delete($id)
    {
        $employee = $this->find($id);
        $employee->delete();
    }
}