@extends('layouts.app')


@section('content')
    <div>
        <form class="w-full max-w-lg" action="{{ route('petstore.update', ['id' => $pet['id']]) }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('petstore.form', ['pet'=>$pet])

        </form>

    </div>
@endsection
