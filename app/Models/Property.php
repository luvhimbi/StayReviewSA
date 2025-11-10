<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $fillable = [
        'poster_id',
        'property_name',
        'address',
        'city',
        'state',
        'country',
        'property_type',
        'main_image',
        'approved',
        'verified'
    ];

    protected $casts = [
        'approved' => 'boolean',
        'verified' => 'boolean',
    ];

    /**
     * The owner (user) of the property
     */
    public function poster()
    {
        return $this->belongsTo(User::class, 'poster_id');
    }

    /**
     * Images associated with this property
     */
    public function images()
    {
        return $this->hasMany(PropertyImage::class);
    }


    /**
     * Scope for verified properties
     */
    public function scopeVerified($query)
    {
        return $query->where('verified', true)->where('approved', true);
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
