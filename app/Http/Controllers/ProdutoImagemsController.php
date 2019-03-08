<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\ProdutoImagemCreateRequest;
use App\Http\Requests\ProdutoImagemUpdateRequest;
use App\Repositories\ProdutoImagemRepository;
use App\Validators\ProdutoImagemValidator;

/**
 * Class ProdutoImagemsController.
 *
 * @package namespace App\Http\Controllers;
 */
class ProdutoImagemsController extends Controller
{
    /**
     * @var ProdutoImagemRepository
     */
    protected $repository;

    /**
     * @var ProdutoImagemValidator
     */
    protected $validator;

    /**
     * ProdutoImagemsController constructor.
     *
     * @param ProdutoImagemRepository $repository
     * @param ProdutoImagemValidator $validator
     */
    public function __construct(ProdutoImagemRepository $repository, ProdutoImagemValidator $validator)
    {
        $this->repository = $repository;
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
        $produtoImagems = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $produtoImagems,
            ]);
        }

        return view('produtoImagems.index', compact('produtoImagems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ProdutoImagemCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ProdutoImagemCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $produtoImagem = $this->repository->create($request->all());

            $response = [
                'message' => 'ProdutoImagem created.',
                'data'    => $produtoImagem->toArray(),
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
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produtoImagem = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $produtoImagem,
            ]);
        }

        return view('produtoImagems.show', compact('produtoImagem'));
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
        $produtoImagem = $this->repository->find($id);

        return view('produtoImagems.edit', compact('produtoImagem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ProdutoImagemUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ProdutoImagemUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $produtoImagem = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ProdutoImagem updated.',
                'data'    => $produtoImagem->toArray(),
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
                'message' => 'ProdutoImagem deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ProdutoImagem deleted.');
    }
}
