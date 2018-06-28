<div class="form-group">
    <div class="form-label">
        <checkbox-toggle criteria="{!! $field !!}"></checkbox-toggle>
        <label>{!! $label !!}</label>
    </div>
    <ul class="list-unstyled {!! isset($overflow) ? 'overflow' : '' !!}">
        @foreach ($items as $item)
            <li>
                <ul class="list-inline">
                    <li>
                        {!! Form::checkbox(
                            $field . '[]',
                            $item->id,
                            checkboxState($item->id, Request::get($field)),
                            ['id' => $field . '_' . $item->id, 'class' => $field]
                        ) !!}
                    </li>
                    <li>{!! $item->name !!}</li>
                </ul>
            </li>
        @endforeach
    </ul>
</div>