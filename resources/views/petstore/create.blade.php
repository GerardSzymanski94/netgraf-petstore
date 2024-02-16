@extends('layouts.app')


@section('content')
    <div>
        <form class="w-full max-w-lg" action="{{ route('petstore.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @include('petstore.form')

        </form>

    </div>
@endsection
