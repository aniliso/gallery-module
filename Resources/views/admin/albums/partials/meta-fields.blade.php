<div class="box-group" id="accordion">
    <!-- we are adding the .panel class so bootstrap.js collapse plugin detects it -->
    <div class="panel box box-primary">
        <div class="box-header">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo-{{$lang}}">
                    {{ trans('gallery::albums.form.meta_data') }}
                </a>
            </h4>
        </div>
        <div id="collapseTwo-{{$lang}}" class="panel-collapse collapse in">
            <div class="box-body">
                {!! Form::i18nInput("meta_title", trans('gallery::albums.form.meta_title'), $errors, $lang, $album ?? null) !!}
                {!! Form::i18nTextarea("meta_description", trans('gallery::albums.form.meta_description'), $errors, $lang, $album ?? null, ['class'=>'form-control']) !!}
            </div>
        </div>
    </div>
    <div class="panel box box-primary">
        <div class="box-header">
            <h4 class="box-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFacebook-{{$lang}}">
                    {{ trans('gallery::albums.form.facebook_data') }}
                </a>
            </h4>
        </div>
        <div id="collapseFacebook-{{$lang}}" class="panel-collapse collapse">
            <div class="box-body">
                {!! Form::i18nInput("og_title", trans('gallery::albums.form.og_title'), $errors, $lang, $album ?? null) !!}

                {!! Form::i18nInput("og_description", trans('gallery::albums.form.og_description'), $errors, $lang, $album ?? null) !!}

                {!! Form::i18nSelect("og_type", trans('gallery::albums.form.og_type'), $errors, $lang, ['website'=>'website', 'product'=>'product', 'article'=>'article'], $album ?? null) !!}

            </div>
        </div>
    </div>
</div>
