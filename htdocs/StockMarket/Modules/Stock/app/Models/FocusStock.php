<?php

namespace Modules\Stock\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Stock\Database\factories\FocusStockFactory;

class FocusStock extends Model
{
    use HasFactory;

    use HasFactory;

    public $table = 'FocusStock';

    public function stockInfo(){
        return $this->belongsTo(Stock::class, 'stockCode', 'stockCode');
    }
}
