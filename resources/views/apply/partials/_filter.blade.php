<form action="{!! $route !!}">
    {!! csrf_field() !!}
    <input type="hidden" name="period" value="{!! request('period') !!}">
    <select name="programme_group" class="form-control" onchange="this.form.submit()">
        <option value="">Please select...</option>
        <option value="all" {!! isSelected('all', request('programme_group')) !!}>All Programmes</option>
        @foreach(programmeGroups() as $k => $v)
            <option value="{!! $k !!}" {!! isSelected($k, request('programme_group')) !!}>{!! $k !!}</option>
        @endforeach
        <option value="opportunities" {!! isSelected('opportunities', request('programme_group')) !!}>Opportunities</option>
    </select>
</form>