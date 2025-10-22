<?php

namespace App\Models;

use App\Constants\GlobalConst;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralLevelPackage extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $casts = [
        'id'                => 'integer',
        'title'             => 'string',
        'refer_user'        => 'integer',
        'deposit_amount'    => 'double',
        'commission'        => 'double',
        'default'           => 'boolean',
    ];

    function scopeDefault($query) {
        return $query->where('default',GlobalConst::ACTIVE);
    }
}
