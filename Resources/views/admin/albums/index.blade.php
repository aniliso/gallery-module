@extends('layouts.master')

@section('content-header')
    <h1>
        {{ trans('gallery::albums.title.albums') }}
    </h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> {{ trans('core::core.breadcrumb.home') }}</a></li>
        <li class="active">{{ trans('gallery::albums.title.albums') }}</li>
    </ol>
@stop

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="row">
                <div class="btn-group pull-right" style="margin: 0 15px 15px 0;">
                    <a href="{{ route('admin.gallery.album.create') }}" class="btn btn-primary btn-flat" style="padding: 4px 10px;">
                        <i class="fa fa-pencil"></i> {{ trans('gallery::albums.button.create album') }}
                    </a>
                </div>
            </div>
            <div class="box box-primary">
                <div class="box-header">
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                    <table class="data-table table table-bordered table-hover">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>{{ trans('gallery::albums.form.status') }}</th>
                            <th>{{ trans('gallery::albums.form.sorting') }}</th>
                            <th>{{ trans('gallery::albums.form.category_id') }}</th>
                            <th>{{ trans('gallery::albums.form.image') }}</th>
                            <th>{{ trans('gallery::albums.form.title') }}</th>
                            <th>{{ trans('gallery::albums.form.slug') }}</th>
                            <th>{{ trans('core::core.table.created at') }}</th>
                            <th data-sortable="false">{{ trans('core::core.table.actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if (isset($albums)): ?>
                        <?php foreach ($albums as $album): ?>
                        <tr>
                            <td>
                                {{ $album->id }}
                            </td>
                            <td>
                                {{ $album->status }}
                            </td>
                            <td>
                                {{ $album->sorting }}
                            </td>
                            <td>
                                <a href="{{ route('admin.gallery.album.edit', [$album->id]) }}">
                                    {{ $album->category->title ?? null }}
                                </a>
                            </td>
                            <td>
                                {{ $album->files()->count() }}
                            </td>
                            <td>
                                <a href="{{ route('admin.gallery.album.edit', [$album->id]) }}">
                                    {{ $album->title }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.gallery.album.edit', [$album->id]) }}">
                                    {{ $album->slug }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.gallery.album.edit', [$album->id]) }}">
                                    {{ $album->created_at }}
                                </a>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('admin.gallery.album.edit', [$album->id]) }}" class="btn btn-default btn-flat"><i class="fa fa-pencil"></i></a>
                                    <button class="btn btn-danger btn-flat" data-toggle="modal" data-target="#modal-delete-confirmation" data-action-target="{{ route('admin.gallery.album.destroy', [$album->id]) }}"><i class="fa fa-trash"></i></button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php endif; ?>
                        </tbody>
                    </table>
                    <!-- /.box-body -->
                    </div>
                </div>
                <!-- /.box -->
            </div>
        </div>
    </div>
    @include('core::partials.delete-modal')
@stop

@section('footer')
    <a data-toggle="modal" data-target="#keyboardShortcutsModal"><i class="fa fa-keyboard-o"></i></a> &nbsp;
@stop
@section('shortcuts')
    <dl class="dl-horizontal">
        <dt><code>c</code></dt>
        <dd>{{ trans('gallery::albums.title.create album') }}</dd>
    </dl>
@stop

@push('js-stack')
    <script type="text/javascript">
        $( document ).ready(function() {
            $(document).keypressAction({
                actions: [
                    { key: 'c', route: "<?= route('admin.gallery.album.create') ?>" }
                ]
            });
        });
    </script>
    <?php $locale = locale(); ?>
    <script type="text/javascript">
        $(function () {
            $('.data-table').dataTable({
                "processing": true,
                "serverSide": true,
                "ajax": '{{ route('admin.gallery.album.index') }}',
                "paginate": true,
                "lengthChange": true,
                "filter": true,
                "sort": true,
                "info": true,
                "autoWidth": true,
                "order": [[ 0, "desc" ]],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'status', name: 'status'},
                    {data: 'sorting', name: 'sorting'},
                    {data: 'category', name: 'category.translations.title'},
                    {data: 'image', name: 'image'},
                    {data: 'title', name: 'translations.title'},
                    {data: 'slug', name: 'translations.slug'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: true}
                ],
                stateSave: true,
                "language": {
                    "url": '<?php echo Module::asset("core:js/vendor/datatables/{$locale}.json") ?>'
                }
            });
        });
    </script>
@endpush
