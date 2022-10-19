
<div class="form-group d-flex justify-content-between align-items-baseline">
    <h2>{!! trans('admin.label.page-blocks')!!}</h2>
    <a href="{{ma_get_admin_create_url('block')}}?model={{$pageConfig->get('model')}}&model_id={{$page->id}}" class="btn btn-accent  btn-block">{{icon('plus')}} {{trans('admin.message.add_block')}}</a>
</div>
<hr>
<div class="form-group">
    <div class="table-container">
        <div class="table-responsive">
            <table class="admin-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Image</th>
                    <th>Title</th>
                    <th>Subtitle</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                @foreach($page->blocks()->orderBy('sort')->get() as $block)
                    <tr id="box_{{class_basename($block)}}_{{ $block->id}}">
                        <td>{!! $block->id !!}</td>
                        <td class="m-auto">
                            @if($block->image)
                                <img src="{!! ImgHelper::get_cached($block->image, config('fromSky.image.admin_small')) !!}"  class="img-thumb m-auto">
                            @endif
                        </td>
                        <td>{!! $block->title !!}</td>
                        <td>{!! $block->subtitle !!}</td>
                        <td>
                            <input
                                    id="{!! class_basename($block).'_sort_'.$block->id !!}"
                                    class="form-control form-control-sm"
                                    name="{!! class_basename($block).'_sort_'.$block->id !!}"
                                    type="text" value="{{ $block->sort  }}"
                                    data-list-value ="{!! class_basename($block).'_'.$block->id !!}"
                                    data-list-name ="sort"
                                    autocomplete="off"
                            />
                        </td>
                        <td>

                            <div class="bool-toggle" data-list-boolean="{!! class_basename($block).'_'.$block->id !!}" data-list-name ="pub">
                            <span class="bool-on {{($block->pub)? '' : 'd-none'}}">
                                {{AdminDecorator::getBooleanOn()}}
                            </span>
                                <span class="bool-off {{($block->pub)? 'd-none' : ''}}">
                                {{AdminDecorator::getBooleanOff()}}
                            </span>
                            </div>
                        </td>
                        <td class="list-actions d-flex gap-2 justify-content-center">
                            <a href="{{ma_get_admin_edit_url($block)}}" data-role="edit-item" class="btn btn-info btn-sm">
                                {{icon('edit')}}
                                @if (config('fromSky.admin.option.list.show-labels'))
                                    {!! trans('admin.label.edit')!!}
                                @endif
                            </a>
                            <a href="{{  ma_get_admin_copy_url($block) }}" class="btn btn-warning btn-sm"   data-role="edit-item">
                                {{icon('copy')}}
                                @if (config('fromSky.admin.option.list.show-labels'))
                                    {!! trans('admin.label.copy')!!}
                                @endif
                            </a>
                            <a href="{{  ma_get_admin_delete_url($block) }}" class="btn btn-danger btn-sm" onclick="Cms.deleteItem(this);return false" id="delete_{{class_basename($block)}}_{{ $block->id}}">
                                {{icon('trash')}}
                                @if (config('fromSky.admin.option.list.show-labels'))
                                    {!! trans('admin.label.delete')!!}
                                @endif
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
