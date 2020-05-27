@extends('layouts.appmenu', ['background' => $menu->imageBackground()])

@section('css')

@endsection

@section('content')

@include('layouts.messages')

@include('menu.partials.list', ['categories' => $categories])

@endsection

@section('js')

@endsection
