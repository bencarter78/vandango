@foreach($criterion as $criteria)
    <div class="spacer-bottom-3x col-md-6 col-sm-6">
        <div class="form-group criteria">
            <legend>{!! $criteria->name !!}</legend>
            @foreach($grades as $grade)
                <div class="radio">
                    <label>
                        @php
                            $checked = (isset(old("criteria")[$criteria->id]) && old('criteria')[$criteria->id] == $grade->id) ||
                            (isset($summary) && $summary->criteria->pluck('id')->contains($criteria->id) && $summary->criteria->where('id', $criteria->id)->first()->pivot->grade_id == $grade->id)
                                ? 'checked="checked"'
                                : ''
                        @endphp
                        <input name="criteria[{!! $criteria->id !!}]" type="radio" value="{!! $grade->id !!}" {!! $checked !!}>
                        {!! $grade->name !!}
                    </label>
                </div>
            @endforeach
            @include('partials/forms/_error', [ 'field' => $criteria->id ])
        </div>
    </div>
@endforeach
