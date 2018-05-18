@extends('admin::layouts.master')

@section('content')
    {{ Breadcrumbs::render('admin.countries.edit', $country) }}

    <div class="page-header">
        <h1>
            <span class="text-muted font-weight-light">
                <i class="page-header-icon fa fa-globe"></i>
                Countries
            </span>
        </h1>
    </div>

    @include('admin::_partials._messages')

    {{ Form::model($country, ['class' => 'panel panel-default', 'method' => 'PUT', 'route' => ['country::countries.update', $country]]) }}
        <div class="panel-heading">
            <span class="panel-title">Edit country</span>
        </div>

        <div class="panel-body">
            <div class="form-group">
                {{ Form::label('currency_id', 'Currency:') }}
                {{ Form::select('currency_id', $currencies, null, ['class' => 'form-control', 'required' => true]) }}
            </div>

            <div class="form-group">
                {{ Form::label('code', 'ISO code:') }}
                {{ Form::text('code', null, ['class' => 'form-control', 'required' => true]) }}
            </div>

            <div class="form-group">
                {{ Form::label('capital', 'Capital city:') }}
                {{ Form::text('capital', null, ['class' => 'form-control', 'required' => true]) }}
            </div>

            <div class="form-group">
                {{ Form::label('calling_code', 'Calling code:') }}
                {{ Form::text('calling_code', null, ['class' => 'form-control', 'required' => true]) }}
            </div>

            <hr>

            @include('translate::_partials._nav_tabs')

            <div class="tab-content">
                @foreach(\Netcore\Translator\Helpers\TransHelper::getAllLanguages() as $language)
                    <div class="tab-pane fade {{ $loop->first ? 'active in' : '' }}" id="{{ $language->iso_code }}">
                        <div class="form-group">
                            {{ Form::label("name-{$language->iso_code}", 'Name:') }}
                            {{ Form::text("translations[{$language->iso_code}][name]", trans_model($country, $language, 'name'), [
                                'id'       => "name-{$language->iso_code}",
                                'class'    => 'form-control',
                                'required' => true,
                            ]) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label("full-name-{$language->iso_code}", 'Full name:') }}
                            {{ Form::text("translations[{$language->iso_code}][full_name]", trans_model($country, $language, 'full_name'), [
                                'id'       => "full-name-{$language->iso_code}",
                                'class'    => 'form-control',
                                'required' => true,
                            ]) }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="panel-footer text-right">
            <button class="btn btn-success">
                <i class="fa fa-save"></i> Save
            </button>
        </div>
    {{ Form::close() }}
@endsection