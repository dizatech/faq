<?php

namespace Modules\Faq\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['title'];

    public function questions()
    {
        return $this->hasMany(FaqQuestion::class)->orderBy('sort_order', 'DESC');
    }
}
