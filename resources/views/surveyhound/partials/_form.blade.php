<div class="form-group spacer-bottom-3x">
    {!! Form::label('Title') !!}
    {!! Form::text('title', isset($survey->title) ? $survey->title : null, [ 'class' => 'form-control' ]) !!}
    @include('partials/forms/_error', [ 'field' => 'title' ] )
</div>

<div class="form-group spacer-bottom-3x">
    {!! Form::label('Description') !!}
    {!! Form::textarea('description', isset($survey->description) ? $survey->description : null, [ 'class' => 'form-control' ]) !!}
    @include('partials/forms/_error', [ 'field' => 'description' ] )
</div>

<div class="form-group spacer-bottom-1x">
    {!! Form::label('SQL Query') !!}
    <div id="sql-editor"></div>
    {!! Form::textarea('sql', isset($survey->sql) ? $survey->sql : null, [ 'class' => 'form-control', 'id' => 'sql' ]) !!}
    @include('partials/forms/_error', [ 'field' => 'sql' ] )
</div>

<button type="button" id="sql-test" class="btn btn-primary spacer-bottom-3x" data-toggle="modal" data-target="#myModal">
    Test SQL
</button>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">PICS SQL Test</h4>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>

<div class="form-group spacer-bottom-3x">
    {!! Form::label('Email Subject') !!}
    {!! Form::text('subject', isset($survey->subject) ? $survey->subject : null, [ 'class' => 'form-control' ]) !!}
    @include('partials/forms/_error', [ 'field' => 'subject' ] )
</div>

<div class="form-group spacer-bottom-3x">
    {!! Form::label('Email Message') !!}
    <p>To use data from the query in the email, wrap field names in curly braces
        (e.g. This is to let you know that {learner_name} has an end date of
        {tr_expect}).</p>
    {!! Form::textarea('message', isset($survey->message) ? $survey->message : null, [ 'class' => 'form-control tinymce' ]) !!}
    @include('partials/forms/_error', [ 'field' => 'message' ] )
</div>

<div class="form-group spacer-bottom-3x">
    {!! Form::label('Frequency') !!}
    {!! Form::select(
        'frequency',
        dropdownOptions(getCronJobFrequencies(), null, null, ['' => 'Draft']),
        isset($survey->frequency) ? $survey->frequency : null,
        ['class' => 'form-control' ]
    ) !!}
    @include('partials/forms/_error', [ 'field' => 'frequency' ])
</div>

{!! Form::submit($submit, array('name' => 'submit', 'class' => 'btn btn-secondary btn-lg')) !!}

@section('scripts')
    <script src="{!! asset('js/vendor/tinymce/tinymce.min.js') !!}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ace/1.2.3/ace.js" type="text/javascript" charset="utf-8"></script>
@stop

@section('head')
    <style type="text/css" media="screen">
        #sql-editor {
            height: 400px;
        }
    </style>
@stop

@section('js')
    <script>
        // Syntax Highlighting (Ace)
        var textarea = $('textarea[name="sql"]').hide();
        var editor = ace.edit("sql-editor");
        editor.setTheme("ace/theme/sql_server");
        editor.getSession().setMode("ace/mode/sql");
        editor.getSession().setValue(textarea.val());
        editor.setOption("showPrintMargin", false)
        editor.getSession().on('change', function () {
            textarea.val(editor.getSession().getValue());
        });

        // TinyMCE
        tinymce.init({
            selector: ".tinymce",
            theme: "modern",
            plugins: [
                "advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "save table contextmenu directionality emoticons template paste textcolor"
            ],
            toolbar: "undo redo | bold italic | alignleft aligncenter alignright | bullist numlist | link unlink image",
            content_css: "/css/app.css",
            height: 500,
        });

        // SQL Test
        $('#sql-test').on('click', function () {
            $.ajax({
                method: "GET",
                dataType: 'jsonp',
                crossDomain: true,
                url: "<?php echo Config::get('vandango.papi.v2') ?>?callback=?",
                data: {
                    q: $('#sql').val()
                },
                success: function (response) {
                    console.log(response.data.length);
                    $('.modal-body').html("<h4 class='spacer-bottom-3x'>" + response.data.length + " Results</h4><div class='well-results'></div>");
                    var $i = 0;
                    $.each(response.data, function () {
                        $('.well-results').append("<pre class='well-result_" + $i + " alert alert-success'></pre>");
                        $.each(this, function (key, value) {
                            $('.well-result_' + $i).append("<li><strong>" + key + "</strong>: " + $.trim(value) + "</li>");
                        });
                        $i++;
                    });
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    $('.modal-body').html("<h4>Error</h4><p>There seems to be an error in your SQL.");
                    console.log(textStatus, errorThrown);
                }
            })
        });
    </script>
@stop