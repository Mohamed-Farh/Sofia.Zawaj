<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Product_Add_Cart extends Model
{
    protected $table = 'product_add_cart';

    protected $primaryKey = 'id';

    protected $fillable =[

         'quantity',
         'quantity_price',
         'user_id',
         'product_id',
         'admin_confirm',
         'client_confirm',
         'status',
   ];
}
