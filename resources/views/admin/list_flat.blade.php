@extends('admin.master')
@section('title', 'Admin Control Panel'.$pageConfig['title'])
@section('content')
    @include('admin.common.action-bar')
    <main id="main-list" class="container-fluid">
        <div class="d-grid gap-3">
            @if(AdminList::validatedIfExtraHeaderComponentExist($pageConfig))
                <x-dynamic-component :component="AdminList::getExtraHeaderComponentName($pageConfig)"/>
            @endif
            @include('admin.common.search_bar')
        </div>
        @include('shared.notification')
        @if ($pages->isEmpty())
            <x-ui.alert class='alert-info d-flex justify-content-center mt-3'>
                <div>{{trans('admin.message.no_item_found')}}</div>
            </x-ui.alert>
        @else
            <div class="table-container">
                {{--                <x-admin.lists.table.index :pages="$pages" :config="$pageConfig"></x-admin.lists.table.index>--}}
                <div class="table-responsive">
                    @php $config = $pageConfig; @endphp
                    <table class="admin-table">
                        <thead>
                        <tr>
                            {{ AdminList::initList($config)->getListHeader() }}
                            @if (AdminList::hasActions())
                                <th>{!! __('admin.label.actions')!!}</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($pages as $page)
                            @if(AdminList::showGroupBySeparator($page))
                                <tr>
                                    <td colspan="{{AdminList::separatorColSpan()}}" class="text-start py-2 h4 "
                                        style="background-color: #c1c1c1">
                                        {{AdminList::getGroupBySeparatorValue($page)}}
                                    </td>
                                </tr>
                            @endif
                            <tr id="row_{!! $page->id !!}" {{AdminList::getGroupBySeparatorAttribute($page)}}>
                                @if (auth_user('admin')->action('selectable',$config))
                                    <td class="selectable-column">
                                        {{--                                        <x-admin.lists.check-box-selectable :page="$page"/>--}}
                                        <div class="form-check custom-checkbox">
                                            <input type="checkbox" value="{!! $page->id !!}" id="list_{!! $page->id !!}" name="list[{!! $page->id !!}]" class="form-check-input custom-control-input" autocomplete="off"/>
                                            <label class="form-check-label text-start" for="list_{!! $page->id !!}"> </label>
                                        </div>

                                    </td>
                                @endif
                                @foreach(AdminList::authorizedFields() as $label)
                                    <td class="{{data_get($label,'class')}}">
{{--                                        {{AdminList::renderComponent($page,$label)}}--}}
                                            @php
                                                if(!is_string($label)){
                                                    $fieldValue = $page->{$label['field']};

                                                    if(is_array($label) && isset($label['roles']) && is_array($label['roles'])){
                                                        if(!in_array(auth_user("admin")->roles->first()->name, $label['roles'])){
                                                            $label['editable'] = false;
                                                            if($label['type']==='editable') {$label['type']==='string';}
                                                        }
                                                    }

                                                }elseif(is_string($label)){
                                                    $fieldValue = $page->$label;
                                                }
                                            @endphp

                                            @if(is_string($label))
                                                {{$fieldValue}}
                                            @elseif($label['type']==='relation')
                                                @php
                                                    $relation  = $label['relation'];
                                                    $relationShow  = isset($label['field_readonly'])?$label['field_readonly']:$label['field'];
                                                    $relationColection = $page->$relation;
                                                    $relationData = (is_null($relationColection))?'':$relationColection->$relationShow;
                                                @endphp
                                                {{$relationData}}
                                            @elseif($label['type']==='boolean' && ($label['editable']??false)===true)
                                                <div class="bool-toggle" data-list-boolean="{{$pageConfig['model']}}_{{$page->id}}" data-list-name="{{$label['field']}}">
                                                    <span class="bool-on {{$fieldValue?'':'d-none'}}"><i class="fas fa-check"></i></span>
                                                    <span class="bool-off {{$fieldValue?'d-none':''}}"><i class="fas fa-times"></i></span>
                                                </div>

                                            @elseif($label['type']==='editable')
                                                <input
                                                        id="{{$pageConfig['model']}}_{{$label['field']}}_{{$page->id}}"
                                                        class="form-control"
                                                        name="{{$label['field']}}[]"
                                                        type="text" value="{{$fieldValue}}"
                                                        data-list-value="{{$pageConfig['model']??''}}_{{$page->id}}"
                                                        data-list-name="{{$label['field']}}"
                                                        autocomplete="off"
                                                />

                                            @elseif($label['type']==='string' || $label['type']==='text' || $label['type']==='date')
                                                {{$fieldValue}}

                                            @elseif($label['type']==='image')
                                                @php
                                                    $fieldspecFlat = $page->getFieldspec();
                                                    $disk = data_get($fieldspecFlat['image']??[], 'disk');
                                                    $folder = data_get($fieldspecFlat['image']??[], 'folder');
                                                @endphp
                                                <a href="{!! ma_get_file_from_storage($fieldValue, $disk , $folder); !!}" class="red" target="_new">
                                                    <img src="{!! ImgHelper::init($folder,$disk)->get_cached($fieldValue, config('fromSky.image.admin')) !!}" class="img-thumb" alt="">
                                                </a>
                                            @elseif($label['type']==='boolean'  && ($label['editable']??false)===false )
                                                @if($fieldValue)
                                                    <div class="bool-toggle">
                                                        <i class="text-success h2"><i class="fas fa-check"></i></i>
                                                    </div>
                                                @else
                                                    <div class="bool-toggle">
                                                        <i class="text-danger h2"><i class="fas fa-times"></i></i></div>
                                                @endif
                                            @elseif($label['type']==='logrecord')
                                                <div class="small">{!! getUserEditCreate($page) !!}</div>
                                            @endif


                                    </td>
                                @endforeach

                                @if (AdminList::hasActions())
                                    <td class="list-actions">
                                        @foreach($config['actions'] as $key => $action )
                                            @php
                                                if(is_array($action) && isset($action['action_name'])){
                                                    $action = $action['action_name'];
                                                }
                                            @endphp
                                            @if(AdminList::isAction($key) && auth_user('admin')->action($key,$config))
                                                @switch($key)
                                                    @case('edit')
                                                    <a class="btn btn-info" href="{{ma_get_admin_edit_url($page)}}" style="margin-right:3px" data-role="edit-item"><i class="fas fa-edit"></i></a>
                                                    @break

                                                    @case('delete')
                                                    <a class="btn btn-danger" href="{{ma_get_admin_delete_url($page)}}" style="margin-right:3px" data-role="delete-item" data-title="{{$fieldValue}}"><i class="fas fa-trash"></i></a>
                                                    @break

                                                    @case('copy')
                                                    <a class="btn btn-warning" title="{{trans('admin.label.copy') }}" style="margin-right:3px" data-bs-toggle="tooltip" data-placement="bottom" rel="tooltip" href="{{ma_get_admin_copy_url($page)}}" data-role="copy-item"><i class="fas fa-copy"></i></a>
                                                    @break
                                                @endswitch
                                                {{--                            <x-dynamic-component :component="'admin.buttons.'.$key" :page="$page"/>--}}
                                            @endif
                                        @endforeach
                                    </td>
                                @endif


                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        @endif

        @if ($pages->render())
            <div class="pagination mt-4">{!! $pages->render() !!}</div>
        @endif
    </main>
@endsection

@section('footerjs')
    <script src="{!! asset(config('fromSky.admin.path.plugins').'selectize/selectize.min.js')!!}"
            type="text/javascript"></script>
    <script type="text/javascript">
        $(function () {
            $('.selectize').selectize({
                sortField: 'text'
            });
            $('.suggest-remote').selectize({
                valueField: 'id',
                labelField: 'value',
                searchField: 'value',
                sortField: 'text',
                load: function (query, callback) {
                    var obj = $(this)[0];
                    var cur_item = $('#' + obj.$input["0"].id)
                    if (!query.length) return callback();
                    $.ajax({
                        url: '{!! route('api.suggest') !!}',
                        type: 'GET',
                        dataType: 'json',
                        data: {
                            q: query,
                            model: cur_item.data('model'),
                            value: cur_item.data('value'),
                            caption: cur_item.data('caption'),
                            searchFields: cur_item.data('fields'),
                            accessor: cur_item.data('accessor'),
                            where: cur_item.data('where')
                        },
                        error: function () {
                            callback();
                        },
                        success: function (res) {
                            callback(res);
                        }
                    });
                }
            });
        });
    </script>
@endsection
