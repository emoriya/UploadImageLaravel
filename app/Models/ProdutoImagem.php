<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class ProdutoImagem extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = ['produto_id', 'path'];
    protected $table = "produto_imagem";

    public function produtos()
    {
        return $this->belongsTo(Produto::class);
    }
}
