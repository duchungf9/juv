@foreach($config['actions'] as $key => $action )
  @php

    if(is_array($action) && isset($action['action_name'])){
        $action = $action['action_name'];
    }
  @endphp
  @if(AdminList::isAction($key) && auth_user('admin')->action($key,$config))
    <x-dynamic-component :component="'admin.buttons.'.$key" :page="$page"/>
  @endif
@endforeach


