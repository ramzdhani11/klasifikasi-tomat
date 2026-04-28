<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Predictions extends Model
{
    protected $table = 'predictions';

    protected $fillable = [
        'upload_id',
        'predicted_label',
        'probability',
    ];

    protected $casts = [
        'probability' => 'float',
        'created_at'  => 'datetime',
        'updated_at'  => 'datetime',
    ];

    public function upload()
    {
        return $this->belongsTo(Upload::class, 'upload_id');
    }
}