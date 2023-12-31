<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'tax_no',
        'address',
        'country'
    ];

    public function additionalLogos()
    {
        return $this->hasMany(AdditionalClientLogo::class);
    }
}
