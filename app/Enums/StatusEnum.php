<?php 
namespace App\Enums;

enum StatusEnum : int
{
    case Pending = 1;
    case Progress = 2;
    case Done = 3;
}