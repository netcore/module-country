@extends('admin::layouts.master')

@php($isEdit = isset($city))

@section('content')

    @if(isset($city))
        {{ Breadcrumbs::render('admin.countries.cities.edit', $country, $city) }}
    @else
        {{ Breadcrumbs::render('admin.countries.cities.create', $country) }}
    @endif

    <div class="page-header">
        <h1>
            <span class="text-muted font-weight-light">
                <i class="page-header-icon fa fa-globe"></i>
                {{ $country->name }} cities
            </span>
        </h1>
    </div>

    @include('admin::_partials._messages')

    @if(isset($city))
        {{ Form::model($city, ['route' => ['country::countries.cities.update', $country, $city], 'method' => 'PUT']) }}
    @else
        {{ Form::open(['route' => ['country::countries.cities.store', $country]]) }}
    @endif
        @include('country::cities._form-panel')
    {{ Form::close() }}
@endsection