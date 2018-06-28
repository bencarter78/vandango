@extends('layouts.master')
@section('content')

    <div class="panel panel-default">
        @include('partials/panels/_heading', [
            'access' => 'auditorAdmin',
            'title' => 'All Categories',
            'titleClass' => '',
            'buttonText' => 'Create New Category',
            'buttonIcon' => 'plus',
            'buttonRoute' =>  'auditor.categories.create',
            'buttonRouteParameters' => [],
            'buttonClass' => 'pull-right'
        ] )

        <div class="table-responsive">
            @if($categories->count() > 0)
                <table class="table table-striped table-bordered">
                    <tr>
                        <th>Category</th>
                    </tr>
                    @foreach($categories as $category)
                        <tr>
                            <td>
                                <span class="pull-right label" style="background: {!! $category->color !!}">
                                    <i class="fa fa-tag"></i>
                                </span>
                                {!! link_to_route('auditor.categories.edit', $category->name, $category->id) !!}
                            </td>
                        </tr>
                    @endforeach
                </table>
            @else
                <div class="panel-body">
                    <p>No categories found, please add a new one.</p>
                </div>
            @endif
        </div>
    </div>

@stop