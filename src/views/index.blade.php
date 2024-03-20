@php
    use Statamic\Facades\Form;

    $builder['form'] = Form::find('career');
@endphp

@extends('layout')

@section('body')
    <main class="py-12 md:py-16 lg:py-24 stack-12 md:stack-16 lg:stack-24" id="content">
        @includeIf('page_builder._form')
    </main>
@endsection
