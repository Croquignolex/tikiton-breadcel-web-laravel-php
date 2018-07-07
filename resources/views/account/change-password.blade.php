@extends('layouts.overlay')

@section('app.home.title', page_title(trans('general.my_account')))
@section('overlay_text', trans('general.account'))
@section('overlay_font', font('user'))

@section('home.body')

@endsection