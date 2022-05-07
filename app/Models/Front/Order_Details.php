<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;

class Order_Details extends Model
{
    protected $table = 'order_details';

    protected $primaryKey = 'id';

    protected $fillable =[

         'quantity',
         'invoice_code',
         'user_id',
         'admin_confirm',
         'client_confirm',
         'status',
   ];
}
