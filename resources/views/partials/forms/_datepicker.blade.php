@push('css')
    <link rel="stylesheet" href="{!! asset('css/bootstrap-datetimepicker.css') !!}"/>
@endpush

@push('scripts')
    <script src="{!! asset('js/vendor/moment.js') !!}"></script>
    <script src="{!! asset('js/vendor/bootstrap-datetimepicker.js') !!}"></script>
@endpush

@if(isset($label))
    {!! Form::label($label) !!}
@endif

@if(isset($helpText))
    <p class="{!! isset($helpTextClass) ? $helpTextClass : 'font-size-small' !!}">
        {!! $helpText !!}
    </p>
@endif

{!! Form::text($field, $value, ['class' => 'form-control datepicker']) !!}
@include('partials/forms/_error', [ 'field' => $field ] )

@section('js')
    <script>
        $(function () {
            $(".datepicker").datetimepicker({
                format: "DD/MM/YYYY"
            });
        });
    </script>
@stop