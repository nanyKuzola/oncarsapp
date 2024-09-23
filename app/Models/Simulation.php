<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Laravel\Sanctum\HasApiTokens;

class Simulation extends Model
{
    use HasApiTokens, HasFactory;

    protected $table = 'simulations';

    protected $fillable = [
        'nome',
        'sobrenome',
        'endereco',
        'cidade',
        'estado',
        'cep',
        'score',
        'status',
        'car_id',
    ];



    /**
     * Get the car that it's credit simulations belong
     *
     * @return BelongsTo
     */
    public function car(): BelongsTo
    {
        return $this->belongsTo(Car::class);
    }

    /**
     *  this method takes in consideration the auto random
     *  score generated and gives credits information
     *
     * @since 1.0 release of feature/onCarrApp-03
     * @author Nany Huna
     * @return array
     */
    public static function checkFinance():array
    {
        $score   = rand(1,999);
        $message = '';

        switch ($score) {
            case $score >= 1 && $score<=299:
                $message = "Reprovado";
                break;
            case $score >= 300 && $score<= 599:
                $message = "70% de entrada, 30% do comprometimento da renda";
                break;
            case $score >= 600 && $score<= 799:
                $message = "50% de entrada, 25% do comprometimento da renda";
                break;
            case $score >= 800 && $score<=950:
                $message = "30% de entrada, 20% do comprometimento da renda";
                break;

            case $score >= 951 && $score<=999:
                $message = "100% de financiamento, taxa zero.";
                break;
            default:
                $message = " ---------- ";
        }
        return array('score'=>$score,'credito'=>$message);
    }
}
