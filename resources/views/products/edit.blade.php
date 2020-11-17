@extends('layouts.app')


@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Edit Product</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('products.index') }}"> Back</a>
            </div>
        </div>
    </div>


    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('products.update',$product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Title:</strong>
                    <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Title">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Body:</strong>
                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Image:</strong>
                    <input class="form-control" type="file"  style="height:150px" name="image" value="{{ $product->image }}" placeholder="Image">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Price:</strong>
                    <input type="text" name="prijs" value="{{ $product->prijs }}" class="form-control" placeholder="Prijs">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    <strong>Link:</strong>
                    <input type="text"  value="{{ $product->link}}" class="form-control" placeholder="url">
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </div>

    </form>
    {{--    <form action="{{ route('products.update',$product->id) }}" method="POST">--}}
    {{--        @csrf--}}
    {{--        @method('PUT')--}}


    {{--        <div class="row">--}}
    {{--            <div class="col-xs-12 col-sm-12 col-md-12">--}}
    {{--                <div class="form-group">--}}
    {{--                    <strong>Name:</strong>--}}
    {{--                    <input type="text" name="name" value="{{ $product->name }}" class="form-control" placeholder="Name">--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col-xs-12 col-sm-12 col-md-12">--}}
    {{--                <div class="form-group">--}}
    {{--                    <strong>Detail:</strong>--}}
    {{--                    <textarea class="form-control" style="height:150px" name="detail" placeholder="Detail">{{ $product->detail }}</textarea>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--            <div class="col-xs-12 col-sm-12 col-md-12 text-center">--}}
    {{--                <button type="submit" class="btn btn-primary">Submit</button>--}}
    {{--            </div>--}}
    {{--        </div>--}}


    {{--    </form>--}}


    <p class="text-center text-primary"><small>Tutorial by ItSolutionStuff.com</small></p>
@endsection
