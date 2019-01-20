<div class="box-body">
    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#info-{{ $lang }}" data-toggle="tab" aria-expanded="true">{{ trans('gallery::albums.tab.general') }}</a></li>
            <li><a href="#meta-{{ $lang }}" data-toggle="tab" aria-expanded="true">{{ trans('gallery::albums.tab.seo') }}</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="info-{{ $lang }}">
                <div class="box-body">
                    {!! Form::i18nInput('title', trans('gallery::albums.form.title'), $errors, $lang, $album, ['data-slug' => 'source']) !!}
                    {!! Form::i18nInput('slug', trans('gallery::albums.form.slug'), $errors, $lang, $album, ['data-slug' => 'target']) !!}
                    {!! Form::i18nTextarea('description', trans('gallery::albums.form.description'), $errors, $lang, $album) !!}
                </div>
            </div>
            <div class="tab-pane" id="meta-{{ $lang }}">
                @include('gallery::admin.albums.partials.meta-fields', compact('album'))
            </div>
        </div>
    </div>
</div>

