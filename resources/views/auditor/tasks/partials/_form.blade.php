<legend>About The Task</legend>
<div class="row">
    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            {!! Form::label('Task Title') !!}
            {!! Form::text('title', isset($task->title) ? $task->title : '', array('class' => 'form-control')) !!}
            @include('partials/forms/_error', [ 'field' => 'title' ] )
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            {!! Form::label('Category') !!}
            {!! Form::select(
                'category_id',
                dropdownOptions($categories, 'name'),
                isset($task->category_id) ? $task->category_id : null,
                ['class' => 'form-control']
            ) !!}
            @include('partials/forms/_error', ['field' => 'category_id'])
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-group spacer-bottom-3x">
            {!! Form::label('How Often Should This Task Run? Every...') !!}
            {!! Form::select(
                'run_frequency',
                dropdownOptions(getCronJobFrequencies(), null, null, ['' => 'Draft']),
                isset($task->run_frequency) ? $task->run_frequency : '',
                ['class' => 'form-control']
            ) !!}
            @include('partials/forms/_error', [ 'field' => 'run_frequency' ])
        </div>
    </div>
</div>

<div class="form-group spacer-bottom-3x">
    {!! Form::label('Description') !!}
    {!! Form::textarea('description', isset($task->description) ? $task->description : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'description' ] )
</div>

<legend class="spacer-top-5x">About The Data</legend>
<div class="form-group spacer-bottom-3x">
    {!! Form::label('SQL') !!}
    <div id="sql-editor"></div>
    {!! Form::textarea('sql', isset($task->sql) ? $task->sql : '', array('class' => 'form-control sql-query', 'id' => 'sql')) !!}
    @include('partials/forms/_error', [ 'field' => 'sql' ] )
</div>
<button type="button" id="sql-test" class="btn btn-primary spacer-bottom-3x" data-toggle="modal" data-target="#myModal">
    Test SQL
</button>

<div class="form-group spacer-bottom-3x">
    {!! Form::label('Group By') !!}
    <p>
        Do you wish to group the data by a field? If so, please enter the name of the field you wish to group the data
        by. <strong>Do not use curly braces here ({}).</strong>
    </p>
    {!! Form::text('group_by', isset($task->group_by) ? $task->group_by : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'group_by' ] )
</div>


<legend class="spacer-top-5x">About the Notification Email</legend>
<div class="row">
    <div class="col-md-6">
        <div class="form-group spacer-bottom-3x">
            {!! Form::label('Email Template') !!}
            {!! Form::select(
                'template_id',
                dropdownOptions($templates, 'name'),
                isset($task->template_id) ? $task->template_id : null,
                ['class' => 'form-control']
            ) !!}
            @include('partials/forms/_error', ['field' => 'template_id'])
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-group spacer-bottom-3x">
            {!! Form::label('Reply To') !!}
            {!! Form::text('reply_to', isset($task->reply_to) ? $task->reply_to : '', array('class' => 'form-control')) !!}
            @include('partials/forms/_error', ['field' => 'reply_to'])
        </div>
    </div>
</div>

<div class="form-group spacer-bottom-3x">
    {!! Form::label('Recipients') !!}
    <p>
        This must be a comma separated list of email address or field names from the SQL (e.g. info@myemail.com,
        someone@myotheremail.com, {learnerEmail}, {adviser_email}). To avoid ambiguity think about using aliases in the
        SQL.
    </p>
    {!! Form::textarea('recipients', isset($task->recipients) ? $task->recipients : '', array('class' => 'form-control')) !!}
    @include('partials/forms/_error', [ 'field' => 'recipients' ] )
</div>

<div class="form-group spacer-bottom-3x">
    {!! Form::label('Notification Text') !!}
    <p>
        To use data from the query in the notification text, wrap field names in curly braces (e.g. This is to let you
        know that {learner_name} has an end date of {tr_expect}).
    </p>
    <p>
        To parse dates you can use this format ({start_date}|date:d/m/Y).
        More information on <a href="http://www.w3schools.com/php/func_date_date.asp" target="_blank">date parsing</a>.
    </p>
    <p>
        If you're using grouped data you will need to add loop tags to the data you wish to loop over. Simply
        add <strong><em>{{ '@loop' }}</em></strong> above your data and <strong><em>{{ '@endloop' }}</em></strong> below
        your data.
    </p>
    <text-editor field-name="notification" value="{{{ isset($task->notification) ? $task->notification : '' }}} "></text-editor>
    @include('partials/forms/_error', [ 'field' => 'notification' ] )
</div>

{!! Form::hidden('url', URL::previous()) !!}

{!! Form::submit($submit, array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">PICS SQL Test</h4>
            </div>
            <div class="modal-body">
                <div class="loading">
                    <spinner loading="loading"></spinner>
                </div>
                <div class="results"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

@section('js')
    <script>
        // Syntax Highlighting (Ace)
        var textarea = $('textarea[name="sql"]').hide();
        var editor = ace.edit("sql-editor");
        editor.setTheme("ace/theme/monokai");
        editor.getSession().setMode("ace/mode/sql");
        editor.getSession().setValue(textarea.val());
        editor.setOption("showPrintMargin", false)
        editor.getSession().on('change', function () {
            textarea.val(editor.getSession().getValue());
        });

        var $loading = $('.loading').hide();
        $(document).ajaxStart(function () {
            $loading.show();
        }).ajaxStop(function () {
            $loading.hide();
        });

        $('#myModal').on('hidden.bs.modal', function () {
            $('.modal-body .results').empty();
        })

        // SQL Test
        $('#sql-test').on('click', function () {
            $.ajax({
                method: "GET",
                dataType: 'jsonp',
                crossDomain: true,
                url: "<?php echo Config::get('vandango.papi.v3') ?>?callback=?",
                data: {
                    q: $('#sql').val()
                },
                success: function (response) {
                    if (response.status) {
                        $('.modal-body .results').html("<h4 class='spacer-bottom-3x'>" + response.data.length + " Results</h4><div class='well-results'></div>");
                        var $i = 0;
                        $.each(response.data, function () {
                            $('.well-results').append("<pre class='well-result_" + $i + " alert alert-success'></pre>");
                            $.each(this, function (key, value) {
                                $('.well-result_' + $i).append("<li><strong>" + key + "</strong>: " + $.trim(value) + "</li>");
                            });
                            $i++;
                        });
                    }

                    if (response.errors) {
                        console.log(response.errors)
                        console.log(response.errors.status)
                        $('.modal-body').html("<h4>" + response.errors.status + " Error</h4><p>" + response.errors.title + "</p>");
                    }
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                    $('.modal-body').html("<h4>Error</h4><p>The server has encountered an error, it could be an error with your SQL.");
                }
            })
        });
    </script>
@stop