<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'sub_total',
        'quantity',
        'delivery_charge',
        'status',
        'total_amount',
        'first_name',
        'last_name',
        'country',
        'post_code',
        'address1',
        'address2',
        'phone',
        'email',
        'payment_method',
        'payment_status',
        'shipping_id',
        'coupon',
    ];

    /**
     * Relation vers les éléments du panier liés à la commande.
     */
    public function carts(): HasMany
    {
        return $this->hasMany(Cart::class, 'order_id');
    }

    /**
     * Alias pour la relation carts, si tu veux garder cart_info.
     */
    public function cart_info(): HasMany
    {
        return $this->carts();
    }

    /**
     * Retourne l'utilisateur ayant passé la commande.
     */
    //public function user(): BelongsTo
    //{
      //  return $this->belongsTo(\App\Models\User::class, 'user_id');
    //}

    /**
     * Retourne le mode de livraison.
     */
    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class, 'shipping_id');
    }

    /**
     * Récupère une commande avec tous ses éléments de panier.
     */
    public static function getAllOrder($id): ?self
    {
        return self::with('carts')->find($id);
    }

    /**
     * Compte le nombre total de commandes.
     */
    public static function countActiveOrder(): int
    {
        return self::count();
    }

     /**
     * Relation entre les commandes et les produits
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
