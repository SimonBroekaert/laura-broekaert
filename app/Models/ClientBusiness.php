<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientBusiness extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'tax_number',
        'street',
        'street_number',
        'city',
        'postal_code',
    ];

    protected function address(): Attribute
    {
        return Attribute::make(
            get: function () {
                return (object) [
                    'street' => $this->street,
                    'street_number' => $this->street_number,
                    'city' => $this->city,
                    'postal_code' => $this->postal_code,
                    'line_1' => $this->street . ' ' . $this->street_number,
                    'line_2' => $this->postal_code . ' ' . $this->city,
                    'full' => $this->street . ' ' . $this->street_number . ', ' . $this->postal_code . ' ' . $this->city,
                ];
            }
        );
    }
}
