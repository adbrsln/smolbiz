<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Business extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'legal_name',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'zip_code',
        'country',
        'phone',
        'email',
        'website',
        'tax_id',
        'currency',
        'logo_path',
        'default_payment_term_id',
        'default_notes',
    ];

    /**
     * Get the user that owns the business.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the customers for the business.
     */
    public function customers(): HasMany
    {
        return $this->hasMany(Customer::class);
    }

    /**
     * Get the invoices for the business.
     */
    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    /**
     * Get the products and services for the business.
     */
    public function productServices(): HasMany
    {
        return $this->hasMany(ProductService::class);
    }

    /**
     * Get the payment terms for the business.
     */
    public function paymentTerms(): HasMany
    {
        return $this->hasMany(PaymentTerm::class);
    }

    /**
     * Get the payments for the business.
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    /**
     * Get the default payment term for the business.
     */
    public function defaultPaymentTerm(): BelongsTo
    {
        return $this->belongsTo(PaymentTerm::class, 'default_payment_term_id');
    }

     // Auto-generate slug when the business name is set
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($business) {
            $business->slug = Str::slug($business->name);
        });
    }

    public function getTenant(): Model
    {
        return $this;
    }
}
