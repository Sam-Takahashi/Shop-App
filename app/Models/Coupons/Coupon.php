<?php

namespace App\Models\Coupons;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'couponable_id', 'couponable_type'];

    public function couponable() { // Polymorphic relationships!
        // https://laravel.com/docs/9.x/eloquent-relationships#polymorphic-relationships
        // https://www.youtube.com/watch?v=rx1DQBE01b0
        return $this->morphTo();
    }

    public static function findByCode($code) {
        return self::where('code', $code)->first(); // extraction(data) into Model rather then Controller to make it more reusable.
    }

    public function discount($order) {
        return $this->couponable()->discount($order);
    }
}
