@php
    use Statamic\Facades\Form;

    $builder['form'] = Form::find('career');

@endphp

@extends('layout')

@section('body')
    <career v-slot="slotProps">
        <div id="career">
            <career-list @item-selected="slotProps.careerSelected"></career-list>

            <career-form :career="slotProps.career">
                <main class="py-12 md:py-16 lg:py-24 stack-12 md:stack-16 lg:stack-24" id="content">
                    @if (isset($builder['form']))
                        @includeIf('page_builder._form')
                    @endif
                </main>
            </career-form>
        </div>
    </career>
@endsection
