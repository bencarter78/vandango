@section('head')
    @parent
    <link rel="stylesheet" href="{!! asset('css/jquery-ui.min.css') !!}"/>
@stop

@section('scripts')
    @parent
    <script src="{!! asset('js/jquery-ui.js') !!}"></script>
@stop

@section('js')
    @parent
    <script>
        $(function () {
            $(".datepicker").datepicker({
                locale: 'en-gb',
                dateFormat: 'dd/mm/yy',
                changeMonth: true,
                changeYear: true
            });
        });
    </script>
@stop