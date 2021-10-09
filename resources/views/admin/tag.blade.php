@extends('admin.layout')

@section('content')
    @foreach($tags as $tag)
        <div>{{ $tag->name }}</div>
    @endforeach

    <form action="{{ route("tag.create") }}" method="post">
        @csrf
        <input type="text" name="name" style="border: 1px solid black">
        <input type="submit" value="Создать">
    </form>
@endsection