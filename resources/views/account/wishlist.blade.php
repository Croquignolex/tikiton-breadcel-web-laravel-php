@extends('layouts.overlay')

@section('app.home.title', page_title(trans('general.my_wish_list')))
@section('overlay_text', trans('general.wish_list'))
@section('overlay_font', font('star'))

@section('home.body')

@endsection