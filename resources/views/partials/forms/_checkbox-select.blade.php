<small class="checkbox-options pull-right">
    <a id="checkAll" onclick="checkAll('{!! $name or null !!}')">All</a>
    |
    <a id="checkNone" onclick="checkNone('{!! $name or null !!}')">Clear</a>
</small>

@section('js')
    <script>
        function checkAll(criteria) {
            $('.' + criteria).prop('checked', 'checked');
        }

        function checkNone(criteria) {
            $('.' + criteria).prop('checked', null);
        }
    </script>
@stop