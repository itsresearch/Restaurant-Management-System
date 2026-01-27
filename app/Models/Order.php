<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
        public const STATUS_IN_PROGRESS = 'in_progress';
        public const STATUS_ON_THE_WAY = 'on_the_way';
        public const STATUS_DELIVERED = 'delivered';
        public const STATUS_CANCELED = 'canceled';

        public const STATUSES = [
            self::STATUS_IN_PROGRESS,
            self::STATUS_ON_THE_WAY,
            self::STATUS_DELIVERED,
            self::STATUS_CANCELED,
        ];

        public function getDeliveryStatusLabelAttribute(): string
        {
            $value = strtolower((string) $this->delivery_status);
            $value = match ($value) {
                'inprogress' => self::STATUS_IN_PROGRESS,
                'on the way' => self::STATUS_ON_THE_WAY,
                default => $value,
            };

            return str_replace('_', ' ', ucwords($value, '_'));
        }

        protected $fillable = [
            'name',
            'email',
            'phone',
            'address',
            'title',
            'price',
            'quantity',
            'image',
            'delivery_status',
            'user_id',
        ];
}
