<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Documents extends Model
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'generated_content',
        'type_download',
        'download',
        'state',
        'user_created',
        'template_id',
    ];

    /**
     * The Documentsignatures that belong to the role.
     */
    public function Documentsignatures()
    {
        return $this->belongsToMany(Documentsignatures::class);
    }

    /**
     * The Document_values that belong to the role.
     */
    public function Document_values()
    {
        return $this->belongsToMany(Document_values::class);
    }

    
}
