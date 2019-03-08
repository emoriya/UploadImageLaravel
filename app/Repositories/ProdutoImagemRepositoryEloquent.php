<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProdutoImagemRepository;
use App\Models\ProdutoImagem;
use App\Validators\ProdutoImagemValidator;

/**
 * Class ProdutoImagemRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ProdutoImagemRepositoryEloquent extends BaseRepository implements ProdutoImagemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProdutoImagem::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
