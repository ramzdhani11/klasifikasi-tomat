<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Upload extends Model
{
    protected $table = 'uploads';

    protected $fillable = [
        'image_path',
        'category',
        'confidence',
    ];

    protected $casts = [
        'confidence' => 'float',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Tambahkan ini
    public function prediction()
    {
        return $this->hasOne(Prediction::class, 'upload_id');
    }
}