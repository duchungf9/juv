<div class="small">
    @php
        $userAll = App\Model\AdminUser::all();
        $userCreatedEmail = '- - -';
        $userUpdatedEmail = '- - -';
        foreach($userAll as $user){
            if($user->id == $item->model->created_by){
                $userCreatedEmail = $user->first_name.' '.$user->last_name . " (" . $user->email.")";
            }
            if($user->id == $item->model->updated_by){
                $userUpdatedEmail = $user->first_name.' '.$user->last_name . " (" . $user->email.")";
            }
        }

        $ct  = Carbon::create($item->model->created_at);
        $ut = Carbon::create($item->model->updated_at);
        $now = Carbon::now();
        $ctStr = $ct->diffForHumans($now);
        $utStr = $ut->diffForHumans($now);
    @endphp
    <div>Created {{$ctStr}} by {{$userCreatedEmail}}</div>
    <div>Updated {{$utStr}} by {{$userUpdatedEmail}}</div>
</div>
