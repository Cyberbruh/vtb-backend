@extends('admin.layout')

@section('content')
    <a href="{{ route('tag.form') }}">Добавить тег</a>
    <a href="{{ route('company.form') }}">Добавить компанию</a>
    <a href="{{ route('event.form') }}">Добавить событие</a>
@endsection