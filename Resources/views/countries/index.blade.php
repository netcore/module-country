@extends('admin::layouts.master')

@section('content')
    {{ Breadcrumbs::render('admin.countries') }}

    <div class="page-header">
        <h1>
            <span class="text-muted font-weight-light">
                <i class="page-header-icon fa fa-globe"></i>
                Countries
            </span>
        </h1>
    </div>

    @include('admin::_partials._messages')

    <div class="panel panel-default">
        <div class="panel-heading">
            Countries &nbsp; <span class="label label-info">{{ $countries->count() }}</span>
            <div class="pull-right">
                <a href="{{ route('country::countries.create') }}" class="btn btn-xs btn-success">
                    <i class="fa fa-plus-circle"></i> Create
                </a>
            </div>
        </div>

        <div class="panel-body overflow-x-auto">
            <div class="table-primary m-b-0">
                <table class="table table-bordered table-stripped" id="countries-datatable" style="width: 100%;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Cities</th>
                        <th>Is active?</th>
                        <th class="actions">Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($countries as $country)
                        <tr>
                            <td>{{ $country->id }}</td>
                            <td>{{ $country->name }}</td>
                            <td>{{ $country->cities_count }}</td>
                            <td>
                                <label for="country-enabled-{{ $country->id }}"
                                       class="switcher switcher-success switcher-blank m-b-0 inline-block">
                                    <input type="checkbox" id="country-enabled-{{ $country->id }}" value="1"
                                           class="is-active"
                                           data-id="{{ $country->id }}" {{ $country->is_active ? 'checked' : '' }}>
                                    <div class="switcher-indicator">
                                        <div class="switcher-yes">Yes</div>
                                        <div class="switcher-no">No</div>
                                    </div>
                                </label>
                            </td>
                            <td>
                                <a href="{{ route('country::countries.edit', $country) }}"
                                   class="btn btn-xs btn-success">
                                    <i class="fa fa-edit"></i> Edit
                                </a>

                                <a href="{{ route('country::countries.cities.index', $country) }}"
                                   class="btn btn-xs btn-info">
                                    <i class="fa fa-cogs"></i> Manage cities
                                </a>
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
    <script src="{{ versionedAsset('assets/country/admin/countries/js/index.js') }}"></script>
@endsection