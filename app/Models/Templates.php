<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Templates extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'content',
        'header',
        'tags',
        'count_parameters',
        'count_signatures',
        'user_created',
        'topic_id',
        'classification_id',
    ];

    /**
     * The Documents that belong to the role.
     */
    public function Documents()
    {
        return $this->belongsToMany(Documents::class);
    }

    /**
     * The Template_parameters that belong to the role.
     */
    public function Template_parameters()
    {
        return $this->belongsToMany(Template_parameters::class);
    }
    
}
