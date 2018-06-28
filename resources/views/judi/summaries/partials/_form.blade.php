<div class="row">
    <div class="col-md-3 spacer-bottom-3x">
        <div class="form-submit">
            <div class="grading spacer-bottom-3x">
                <div class="form-group spacer-bottom-3x">
                    <legend>Overall Grade</legend>
                    {!! Form::select('grade_id', dropdownOptions($grades, 'name'), isset($summary->grade_id) ? $summary->grade_id : '', ['class' => 'form-control']) !!}
                    @include('partials/forms/_error', [ 'field' => 'grade_id' ])
                </div>

                <div class="form-group spacer-bottom-3x">
                    {!! Form::label('Assessment Date') !!}
                    <datepicker
                            field-name="assessment_date"
                            value="{!! isset($summary->assessment_date) ? $summary->assessment_date->format('d/m/Y') : null !!}"
                            min-date="null">
                    </datepicker>
                    @include('partials/forms/_error', [ 'field' => 'assessment_date' ] )
                </div>

                <div class="form-group file-upload spacer-bottom-3x">
                    @if(isset($summary->document_path))
                        {!! Form::label('Uploaded Linked Document') !!}
                        <div class="uploaded-file spacer-bottom-2x spacer-top-2x">
                            <i class="fa fa-file-text-o fa-2x"></i>
                            {!! link_to_route( 'judi.summaries.documentation', $summary->present()->fileName, $summary->id ) !!}
                        </div>
                        {!! Form::hidden('uploaded_document', $summary->document_path) !!}
                    @else
                        {!! Form::label('Upload Linked Document') !!}
                    @endif
                    {!! Form::file('document_path', array('class' => 'form-control filestyle', 'data-buttonName' => 'btn-default' )) !!}
                    @include('partials/forms/_error', [ 'field' => 'document_path' ] )
                </div>

            </div>

            {!! Form::hidden('assessment_id', isset($report) ? $assessment->id : $summary->assessment_id) !!}
            {!! Form::hidden('report_id', isset($report) ? $report->id : $summary->report_id) !!}

            <div class="submit hidden-xs hidden-sm">
                {!! Form::submit('Save', array('name' => 'save', 'class' => 'btn btn-primary btn-block')) !!}
                <a role="button" data-target="#modal-submit" data-toggle="modal" class="btn btn-secondary btn-block">Submit</a>
            </div>
        </div>
    </div>

    <div class="col-md-9">
        <div class="row">
            @include('judi.summaries.partials._criteria-grade')
        </div>

        <div class="submit hidden-md hidden-lg">
            {!! Form::submit('Save', array('name' => 'save', 'class' => 'btn btn-primary btn-lg')) !!}
            <a role="button" data-target="#modal-submit" data-toggle="modal" class="btn btn-secondary btn-lg">Submit</a>
        </div>
    </div>
</div>

@include('partials/modals/_form-submit', [
    'title' => 'Report Summary',
    'route' => 'judi.summaries.update',
    'body' => "You are about to submit this summary to the Performance Assessment team. To confirm this submission please click Submit, otherwise go back and hit 'Save'."
])

@include('partials/js/_file-upload')