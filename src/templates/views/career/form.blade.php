@php
    use Statamic\Facades\Form;

    $builder['form'] = Form::find('career');
@endphp

<!-- /astricelng/careerform/templates/views/career/form.blade.php -->
    @if (isset($builder['form']))
        @includeIf('page_builder._form')
    @endif


<!-- End: /astricelng/careerform/templates/views/career/form.blade.php -->
