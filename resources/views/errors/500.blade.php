@extends('layouts.error')

@section('home.title', page_title('500'))

@section('error.code', '500')

@section('error.title', trans('error.500_title'))

@section('error.body', trans('error.500_message'))