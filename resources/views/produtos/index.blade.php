@extends('layouts.dashboard')
@section('section')
    <div class="col-sm-12">
        <div class="row">
            <div class="col-lg-6">
                <form role="form" method="post" action="{{ route('produtos.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" name="nome" >
                    </div>
                    <div class="form-group">
                        <label>Categoria</label>
                        <input class="form-control" name="categoria" >
                    </div>
                    <div class="form-group">
                        <label>Valor</label>
                        <input class="form-control" name="valor" >
                    </div>


                    <div class="form-group">
                        <label>File input</label>
                        <input type='file' id="imagemUm" name="imagemUm" accept="image/*" />
                    </div>

                    <button type="submit" class="btn btn-default">Submit Button</button>
                    <button type="reset" class="btn btn-default">Reset Button</button>
                </form>
            </div>


                {{--<h2>Form Validation</h2>--}}
                {{--<form role="form">--}}
                    {{--<div class="form-group has-success">--}}
                        {{--<label class="control-label" for="inputSuccess">Input with success</label>--}}
                        {{--<input type="text" class="form-control" id="inputSuccess">--}}
                    {{--</div>--}}
                    {{--<div class="form-group has-warning">--}}
                        {{--<label class="control-label" for="inputWarning">Input with warning</label>--}}
                        {{--<input type="text" class="form-control" id="inputWarning">--}}
                    {{--</div>--}}
                    {{--<div class="form-group has-error">--}}
                        {{--<label class="control-label" for="inputError">Input with error</label>--}}
                        {{--<input type="text" class="form-control" id="inputError">--}}
                    {{--</div>--}}
                {{--</form>--}}

        </div>
    </div>
@endsection