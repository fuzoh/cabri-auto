<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ImportRowFail extends Model
{
    public $fillable = [
        'failed_form_row_id',
        'exception'
    ];

    public $timestamps = false;

    public function import(): BelongsTo
    {
        return $this->belongsTo(Import::class);
    }
}
