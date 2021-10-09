@extends('admin.layout')

@section('content')
    @foreach($events as $event)
        <div>{{ $event->title }}</div>
        <div>{{ $event->text }}</div>
        <div>{{ $event->image }}</div>
        <div>{{ $event->probability }}/{{ $sum_tickets }}</div>
        <div>Теги:
            @foreach($event->tags as $tag)
                <div>{{ $tag->name }} ({{$tag->pivot->change}})</div>
            @endforeach
        </div>
    @endforeach

    <form action="{{ route("event.create") }}" method="post">
        @csrf
        <div>Заголовок:<input type="text" name="title" style="border: 1px solid black"></div>
        <div>Текст:<textarea name="text" style="border: 1px solid black"></textarea></div>
        <div>Решение:<textarea name="solution" style="border: 1px solid black"></textarea></div>
        <div>Изображение:<input type="text" name="image" style="border: 1px solid black"></div>
        <div>Вероятность из {{ $sum_tickets }} билетов:<input type="text" name="probability" style="border: 1px solid black"></div>
        @foreach($tags as $tag)
            <div>
                <input type="checkbox" name="tags[]" value="{{ $tag->id }}"  style="border: 1px solid black"><span>{{ $tag->name }}</span><input type="text" name="change{{ $tag->id }}" placeholder="0.00" style="border: 1px solid black">
            </div>
        @endforeach
        <input type="submit" value="Создать">
        </form>
@endsection