<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SitesLogs extends Model
{
    protected $fillable = [
        'site_id', 'resposta', 'data'
    ];

    public function sites()
    {
        return $this->belongsTo(Sites::class,'site_id','id');
    }
}
