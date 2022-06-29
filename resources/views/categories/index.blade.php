@extends('layouts.app')

@section('content')

<ul class="list-group">
    @foreach($categories as $category)
        <a href="{{ route('categories.show', $category->key) }}" class="list-group-item list-group-item">
            <span class=""><i class="fa-solid {{ catIcon($category->key)}}"></i> </span>
            {{ catName($category->key) }}
        </a>
    @endforeach
</ul>

@endsection