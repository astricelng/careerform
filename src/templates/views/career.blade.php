@extends('layout')

@section('body')
    <div id="career">
        <career-list @push-button="pushButton"></career-list>

        <main class="py-12 md:py-16 lg:py-24 stack-12 md:stack-16 lg:stack-24" id="content">
            @include('layout.partials.career.form')
        </main>
    </div>


    <script>
        var career = new Vue({
            el: '#career',
            data: {
                pButton: null,
            },
            methods: {
                pushButton: function(value){
                    this.pButton = value;
                    alert('aqui '+this.pButton)
                }
            }
        });
    </script>
@endsection
