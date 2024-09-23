<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Car extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 'cars';
    /**
     * @var string[]
     */
    protected $fillable = ['modelo','marca','cor'];


    /**
     *
     *
     * @return HasMany
     */
    public function simulations():HasMany
    {
        return $this->hasMany(Simulation::class);
    }

}
