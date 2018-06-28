@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h4>{{ $sector->title }} Linked OneFile Centres</h4>
        </div>
        <div class="panel-body">
            <p>
                Please select all OneFile centres that this sector can apply to.
            </p>
            <form action="{{ route('eportfolios.onefile.sectors.update', $sector->id) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PATCH') }}
                @foreach($centres as $centre)
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="centre_id[]" value="{{ $centre->id }}" {{ $sector->eportfolioCentres->pluck('id')->contains($centre->id) ? 'checked' : '' }}>
                            {{ $centre->name }}
                        </label>
                    </div>
                @endforeach

                <div class="form-group spacer-top-3x">
                    <button class="btn btn-success">Save</button>
                </div>
            </form>
        </div>
    </div>
@stop