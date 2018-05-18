<div class="panel panel-default">
    <div class="panel-heading">
        {{ isset($city) ? 'Edit' : 'Create' }} city
    </div>

    <div class="panel-body">
        @include('translate::_partials._nav_tabs')

        <div class="tab-content">
            @foreach(\Netcore\Translator\Helpers\TransHelper::getAllLanguages() as $language)
                <div class="tab-pane fade {{ $loop->first ? 'active in' : '' }}" id="{{ $language->iso_code }}">
                    <div class="form-group">
                        {{ Form::label("name-{$language->iso_code}", 'Name:') }}
                        {{ Form::text("translations[{$language->iso_code}][name]", trans_model(@$city, $language, 'name'), [
                            'id'       => "name-{$language->iso_code}",
                            'class'    => 'form-control',
                            'required' => true,
                        ]) }}
                    </div>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            {{ Form::label('zip_code', 'ZIP code:') }}
            {{ Form::text('zip_code', null, ['class' => 'form-control', 'required' => true]) }}
        </div>
    </div>

    <div class="panel-footer text-right">
        <button class="btn btn-success">
            <i class="fa fa-save"></i> Save
        </button>
    </div>
</div>