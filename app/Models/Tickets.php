<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tickets extends Model
{
    use HasFactory;
    protected $fillable = ['user_code', 'date_entered', 'transaction_id', 'reference_no', 'remarks', 'expiry_date'];
}
