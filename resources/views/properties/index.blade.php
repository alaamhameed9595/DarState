@extends('layouts.app')

@section('content')
    <h1>Properties</h1>
    @foreach ($properties as $property)
        <div>
            <a href="{{ route('properties.show', $property->id) }}">
                <h2>{{ $property->title }}</h2>
            </a>
            <p>{{ $property->city }} - ${{ $property->price }}</p>
        </div>
    @endforeach

    {{ $properties->links() }}
@endsection
