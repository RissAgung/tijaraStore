<?php

namespace App\Models\suplaier;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class suplaier extends Model
{
    use HasFactory;
    protected $table = 'suplaier';
    protected $primaryKey = 'id'; // mendevinisikan primary key
    public $incrementing = false; // auto pada primaryKey incremment false
    public $timestamps = false; // create_at dan update_at false

    
}
