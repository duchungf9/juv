@aware(['config','pages'])
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
                <x-admin.lists.check-box-selectable :page="$page"/>
            </td>
        @endif
        @foreach(AdminList::authorizedFields() as $label)
            <td class="{{data_get($label,'class')}}">
                {{  AdminList::renderComponent($page,$label) }}
            </td>
        @endforeach
        @if (AdminList::hasActions())
            <td class="list-actions">
                {{--                    <x-admin.lists.action :config="$config" :page="$page"></x-admin.lists.action>--}}

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
                            <a class="btn btn-danger" href="{{ma_get_admin_delete_url($page)}}" style="margin-right:3px" data-role="delete-item"><i class="fas fa-trash"></i></a>
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