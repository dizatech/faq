<?php

namespace Modules\Faq\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FaqQuestion extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [
        'question', 'answer', 'faq_id'
    ];

}
