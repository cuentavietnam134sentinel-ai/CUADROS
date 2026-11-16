<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CustomRequestImage extends Model
{
    protected $fillable = ['custom_request_id', 'image_path'];

    public function customRequest(): BelongsTo
    {
        return $this->belongsTo(CustomRequest::class);
    }
}
