<?php

namespace App\Models;

use App\Notifications\DespesaCriada;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Despesa extends Model
{
    use HasFactory;

    protected $fillable = [
        'descricao',
        'valor',
        'data',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scopeFilterUser($query)
    {
        return $query->where('user_id', Auth::user()->id);
    }

    public function sendNotification()
    {
        $this->user->notify(new DespesaCriada($this));
    }

}
