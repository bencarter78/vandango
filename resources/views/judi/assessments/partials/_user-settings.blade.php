<div class="panel-body">
    <div class="alert alert-info"><i class="fa fa-info-circle"></i> The teaching and learning process will automatically be set for group delivery. To change this for either individual delivery or instruction please select the correct type.</div>
</div>

{!! Form::model(
    $settings,
    [
        'route' => ['judi.assessments.user.settings.update', $settings->id],
    ]
) !!}
<div class="table-responsive">
    <table id="settings" class="table table-striped table-bordered">
        <thead>
        <tr>
            <th>Process</th>
            <th>Type</th>
            @include('partials/tables/_th-actions', ['access' => 'judiAdmin'])
        </tr>
        </thead>
        @if(json_decode($settings->settings))
            @foreach(json_decode($settings->settings) as $processId => $type)
                <tr>
                    <td>
                        {!! Form::select(
                            'process_id[]',
                            dropdownOptions($processes, 'name'),
                            isset($processId) ? $processId : null,
                            ['class' => 'form-control']
                        ) !!}
                    </td>
                    <td>
                        {!! Form::select(
                            'type[]',
                            dropdownOptions(getProcessTypes()),
                            isset($type) ? $type : null,
                            ['class' => 'form-control']
                        ) !!}
                    </td>
                    <td class="text-center">
                        <a class="btn btn-circle btn-xs btn-danger" onclick="deleteRow(this)"><i class="fa fa-trash-o"></i></a>
                        <a class="btn btn-circle btn-secondary btn-xs add-row" onclick="addRow(this)"><i class="fa fa-plus"></i></a>
                    </td>
                </tr>
            @endforeach
        @else
            <tr>
                <td>
                    {!! Form::select(
                        'process_id[]',
                        dropdownOptions($processes, 'name'),
                        isset($processId) ? $processId : null,
                        ['class' => 'form-control']
                    ) !!}
                </td>
                <td>
                    {!! Form::select(
                        'type[]',
                        dropdownOptions(getProcessTypes()),
                        isset($type) ? $type : null,
                        ['class' => 'form-control']
                    ) !!}
                </td>
                <td class="text-center">
                    <a class="btn btn-circle btn-xs btn-danger" onclick="deleteRow(this)"><i class="fa fa-trash-o"></i></a>
                    <a class="btn btn-circle btn-secondary btn-xs add-row" onclick="addRow(this)"><i class="fa fa-plus"></i></a>
                </td>
            </tr>
        @endif
        <tr>
            <td colspan="3">
                {!! Form::submit(
                    'Update',
                    [
                        'name' => 'submit',
                        'class' => 'btn btn-secondary'
                    ]
                ) !!}
            </td>
        </tr>
    </table>
</div>
{!! Form::close() !!}

@section('js')
    <script>
        var deleteRow = function (element) {
            $(element).closest('tr').remove();
        };

        var addRow = function (element) {
            var row = $(element).closest('tr');
            row.after("<tr>" + row.html() + "</tr>").next().find(".form-control").each(function (index, element) {
                $(element).val("");
            });
        }
    </script>
@stop
