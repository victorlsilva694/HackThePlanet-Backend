<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministrationTravel extends Model
{
    use HasFactory;
    protected $table = 'laravel.administration_travels';
    protected $fillable = [
        'transaction_name',
        'passport',
        'travel_code',
        'covid_data',
        'price_values',
        'warning_annotation',
        'user_id',
    ];

    public function user()
{
    return $this->belongsTo(User::class);
}

    public static function saveValues($transactionName, $passport, $travelCode, $userId, $covidData, $priceValues, $warningAnnotation)
    {
        $model = new static();

        $model->transaction_name = $transactionName;
        $model->user_id = $userId;
        $model->passport = $passport;
        $model->travel_code = $travelCode;
        $model->covid_data = $covidData;
        $model->price_values = $priceValues;
        $model->warning_annotation = $warningAnnotation;

        $model->save();

        return $model;
    }
}
