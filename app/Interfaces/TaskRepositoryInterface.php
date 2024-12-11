<?php
namespace App\Interfaces;

interface TaskRepositoryInterface
{
    public function all();
    public function belongsToMe();
    public function find($id);
    public function create(array $attributes);
    public function update($id, array $attributes);
    public function delete($id);
}