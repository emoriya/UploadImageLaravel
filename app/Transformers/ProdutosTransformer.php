<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Models\Produto;

/**
 * Class ProdutosTransformer.
 *
 * @package namespace App\Transformers;
 */
class ProdutosTransformer extends TransformerAbstract
{
    /**
     * Transform the Produtos entity.
     *
     * @param \App\Models\Produto $model
     *
     * @return array
     */
    public function transform(Produto $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
