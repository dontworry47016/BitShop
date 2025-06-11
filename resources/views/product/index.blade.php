@extends('master.product')

@section('product-content')


    <p>{!! \GrahamCampbell\Markdown\Facades\Markdown::convertToHtml(e($product -> description)) !!}</p>


@stop
