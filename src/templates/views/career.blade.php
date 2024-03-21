@extends('layout')

@section('body')
    <career-list></career-list>

    <main class="py-12 md:py-16 lg:py-24 stack-12 md:stack-16 lg:stack-24" id="content">
        @include('layout.partials.career.form')
    </main>
@endsection
