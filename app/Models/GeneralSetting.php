<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'maxDiscount',
        'VAT',
        'title',
        'taxNumber',
        'address',
        'phoneNumber',
        'email',
        'invoiceFooter',
        'black_logo',
        'white_logo',
    ];
}
