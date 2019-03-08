<?php

namespace App\Http\Controllers;

use App\ProdutoImagem;
use App\Repositories\ImageRepository;
use App\Repositories\ProdutoImagemRepository;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ProdutosCreateRequest;
use App\Http\Requests\ProdutosUpdateRequest;
use App\Repositories\ProdutosRepository;
use App\Validators\ProdutosValidator;

/**
 * Class ProdutosController.
 *
 * @package namespace App\Http\Controllers;
 */
class ProdutosController extends Controller
{
    /**
     * @var ProdutosRepository
     */
    protected $repository;

    /**
     * @var ProdutoImagemRepository
     */
    protected $imagemRepository;


    /**
     * @var ProdutosValidator
     */
    protected $validator;

    /**
     * ProdutosController constructor.
     *
     * @param ProdutosRepository $repository
     * @param ProdutoImagemRepository $imagemRepository
     * @param ProdutosValidator $validator
     */
    public function __construct(ProdutosRepository $repository, ProdutoImagemRepository $imagemRepository, ProdutosValidator $validator)
    {
        $this->repository = $repository;
        $this->imagemRepository = $imagemRepository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $produtos = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $produtos,
            ]);
        }

        return view('produtos.index', compact('produtos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProdutosCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ProdutosCreateRequest $request, ImageRepository $repo)
    {
        try {

            $produto = $this->repository->create($request->except('_token'));

            if ($request->hasFile('imagemUm')) {
                $produto->path_image = $repo->saveImage($request->imagemUm, $produto->id, 'produtos', 250);
            }

            $imagemProduto = $this->imagemRepository->create(['produto_id' => $produto->id, 'path' => $produto->path_image]);

            return view('produtos.index');
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produto = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $produto,
            ]);
        }

        return view('produtos.show', compact('produto'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = $this->repository->find($id);

        return view('produtos.edit', compact('produto'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProdutosUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ProdutosUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $produto = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Produtos updated.',
                'data'    => $produto->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'Produtos deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Produtos deleted.');
    }
}
