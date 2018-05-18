@extends('admin::layouts.master')

@section('content')
    {{ Breadcrumbs::render('admin.countries.cities', $country) }}

    <div class="page-header">
        <h1>
            <span class="text-muted font-weight-light">
                <i class="page-header-icon fa fa-globe"></i>
                {{ $country->name }} cities
            </span>
        </h1>
    </div>

    @include('admin::_partials._messages')

    <div class="panel panel-default">
        <div class="panel-heading">
            Cities &nbsp; <span class="label label-info">{{ $country->cities->count() }}</span>
            <div class="pull-right">
                <a href="{{ route('country::countries.cities.create', $country) }}" class="btn btn-xs btn-success">
                    <i class="fa fa-plus-circle"></i> Create
                </a>
            </div>
        </div>

        <div class="panel-body overflow-x-auto">
            <div class="table-primary m-b-0">
                <table class="table table-bordered table-stripped" id="cities-datatable" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>ZIP code</th>
                            <th class="actions">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($country->cities as $city)
                            <tr>
                                <td>{{ $city->id }}</td>
                                <td>{{ $city->name }}</td>
                                <td>{{ $city->zip_code}}</td>
                                <td>
                                    <a href="{{ route('country::countries.cities.edit', [$country, $city]) }}"
                                       class="btn btn-xs btn-success">
                                        <i class="fa fa-edit"></i> Edit
                                    </a>

                                    {{ Form::open([
                                        'route'    => ['country::countries.cities.destroy', $country, $city],
                                        'method'   => 'DELETE',
                                        'onsubmit' => 'return confirm("Are you sure?")',
                                        'class'    => 'inline-block'
                                    ]) }}
                                        <button class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    {{ Form::close() }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ versionedAsset('assets/country/admin/cities/js/index.js') }}"></script>
@endsection