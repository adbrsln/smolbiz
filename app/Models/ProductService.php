<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductService extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'business_id',
        'name',
        'description',
        'unit_price',
        'is_service',
        'taxable',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'unit_price' => 'decimal:2',
        'is_service' => 'boolean',
        'taxable' => 'boolean',
    ];

    /**
     * Get the business that owns the product/service.
     */
    public function business(): BelongsTo
    {
        return $this->belongsTo(Business::class);
    }
}
