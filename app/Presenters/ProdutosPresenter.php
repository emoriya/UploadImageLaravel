<?php

namespace App\Presenters;

use App\Transformers\ProdutosTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ProdutosPresenter.
 *
 * @package namespace App\Presenters;
 */
class ProdutosPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ProdutosTransformer();
    }
}
