@extends('admin.layout')

@section('content')
    @foreach($companies as $company)
        <div>{{ $company->name }}</div>
        <div>{{ $company->description }}</div>
        <div>{{ $company->image }}</div>
        <div>{{ $company->rate }}</div>
        <div>Теги:
            @foreach($company->tags as $tag)
                <div>{{ $tag->name }}</div>
            @endforeach
        </div>
    @endforeach

    <form action="{{ route("company.create") }}" method="post">
    @csrf
    <div>Имя:<input type="text" name="name" style="border: 1px solid black"></div>
    <div>Описание:<input type="text" name="description" style="border: 1px solid black"></div>
    <div>Изображение:<input type="text" name="image" style="border: 1px solid black"></div>
    <div>Начальная цена акции:<input type="text" name="rate" style="border: 1px solid black"></div>
    @foreach($tags as $tag)
        <div>
            <input type="checkbox" name="tags[]" value="{{ $tag->id }}"  style="border: 1px solid black"><span>{{ $tag->name }}</span>
        </div>
    @endforeach
    <input type="submit" value="Создать">
    </form>
@endsection