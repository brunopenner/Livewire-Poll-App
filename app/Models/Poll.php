<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poll extends Model
{
    use HasFactory;

    //Used for mass assignment, so we can easily fill out the title
    protected $fillable = ['title'];

    public function options(): HasMany {
        return $this->hasMany(Option::class);
    }
}
