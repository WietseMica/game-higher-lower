<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    /**
     * Generate number between 1 - 100
     *
     * @return int
     */
    public function generateNumber()
    {
        return rand(1, 100);
    }
}
