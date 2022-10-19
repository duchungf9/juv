<h1>History ở đây</h1>
<div class="table-wrapper-scroll-y my-custom-scrollbar">

    <table class="table table-bordered table-striped mb-0">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Người Dùng</th>
            <th scope="col">Thời Gian</th>
            <th scope="col">Thông tin</th>
        </tr>
        </thead>
        <tbody>
        @foreach($history as $key=>$action)
        <tr>
            <th scope="row">{{$key + 1}}</th>
            <td>{{$action->causer?->email ?? ""}}</td>
            <td>{{$action->created_at}}</td>
            <td>{{$action->description}} <span onclick="showLog('{{ addslashes(json_encode($action->properties)) }}')"> 🔍 </span></td>
        </tr>
        @endforeach
        </tbody>
    </table>

</div>
