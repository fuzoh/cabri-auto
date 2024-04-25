<?php

namespace App\Models;

use App\Models\Enums\RegistrationType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Import extends Model
{
    public $fillable = [
        'imported_file'
    ];

    public function importRowFail(): HasMany
    {
        return $this->hasMany(ImportRowFail::class);
    }
}
