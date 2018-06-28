@extends('layouts.master')

@section('content')
    <div class="panel panel-default">
        @include('partials/panels/_heading', [
        'title' => 'Starts Pipeline ' . createCarbonObject('Y-m-d', contractYearPeriods()[1]['start'])->format('Y') . '-' . createCarbonObject('Y-m-d', contractYearPeriods()[12]['end'])->format('y'),
        'buttonText' => 'Add',
        'buttonRoute' =>  'apply.applicants.create',
    ] )
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                    <tr>
                        <td colspan="2">
                            @include('apply.partials._filter', ['route' => route('apply.sectors.index')])
                        </td>
                        @foreach(contractYearPeriods() as $k => $v)
                            <th class="text-right">
                                P{!! $k !!}<br/>
                                <small>
                                    {!! createCarbonObject('Y-m-d', $v['start'])->format('M') !!}
                                </small>
                            </th>
                        @endforeach
                        <th class="text-right">
                            In Year<br>
                            <small>
                                {!! createCarbonObject('Y-m-d', contractYearPeriods()[1]['start'])->format('y') !!}
                                -{!! createCarbonObject('Y-m-d', contractYearPeriods()[12]['end'])->format('y') !!}
                            </small>
                        </th>
                    </tr>
                    </thead>
                    <tbody>
                    @if($applicants)
                        @include('apply.sectors.partials._applicants')
                    @elseif($opportunities)
                        @include('apply.sectors.partials._opportunities')
                    @else
                        <p>
                            Please select a programme to review the named start figures.
                        </p>
                    @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@stop