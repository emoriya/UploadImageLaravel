<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Produto extends Model implements Transformable
{

    use TransformableTrait;

    protected $fillable = ['nome', 'categoria', 'valor'];
    public function produtosImagems()
    {
        return $this->hasMany(ProdutoImagem::class);
    }

}
