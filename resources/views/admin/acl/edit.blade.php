<table class="table table-striped table-check">
    <thead>
        <tr class="header">  
            <th width="10px">Url</th>  
            <td width="10px">
                List
            </td>  
            <td width="10px">
                Detail
            </td> 
            <td width="10px">
                Tambah
            </td> 
            <td width="10px">
                Edit
            </td> 
            <td width="10px">
                Hapus
            </td> 
            <td width="10px">
                Cetak
            </td> 
        </tr>
    </thead>
    <tbody> 

        @foreach($menus as $key => $m)
        <tr class="ordering"> 
            <th width="10px">{{$m->name}}</th>
            <th><input class="btn alert-success" name="index" data-field="index" type="checkbox" data-role_id="{{$role->id}}" data-menu_id="{{$m->id}}" {{getStatus($role->id,$m->id, 'index')}}></th>  
            <th width="10px"><input class="btn btn-primary" name="show" data-field="show" type="checkbox" data-role_id="{{$role->id}}" data-menu_id="{{$m->id}}" {{getStatus($role->id,$m->id, 'show')}}> </th>                                    
            <th width="10px"><input class="btn btn-primary" name="create" data-field="create" type="checkbox" data-role_id="{{$role->id}}" data-menu_id="{{$m->id}}" {{getStatus($role->id,$m->id, 'create')}}></th>
            <th width="10px"><input class="btn btn-primary" name="edit" data-field="edit" type="checkbox" data-role_id="{{$role->id}}" data-menu_id="{{$m->id}}" {{getStatus($role->id,$m->id, 'edit')}}></th>
            <th width="10px"><input class="btn btn-primary" name="destroy" data-field="destroy" type="checkbox" data-role_id="{{$role->id}}" data-menu_id="{{$m->id}}" {{getStatus($role->id,$m->id, 'destroy')}}></th>
            <th width="10px"><input class="btn btn-primary" name="print" data-field="print" type="checkbox" data-role_id="{{$role->id}}" data-menu_id="{{$m->id}}" {{getStatus($role->id,$m->id, 'print')}}></th>
        </tr>
        @endforeach
    </tbody>
</table> 
<div class="table-list-footer">
    <span class="result-count">{{$menus->links()}}</span> 
</div>
@section('script')
<script src="{{ asset('js/bootstrap-switch.js') }}"></script> 
<script>
$("[name='index'],[name='show'],[name='create'],[name='edit'],[name='destroy'],[name='print']").bootstrapSwitch({
    on: 'On',
    off: 'Off ',
    onLabel: '&nbsp;&nbsp;&nbsp;',
    offLabel: '&nbsp;&nbsp;&nbsp;',
    same: false, //same labels for on/off states
    size: 'xs',
    onClass: 'primary',
    offClass: 'default'
});

$("[name='index'],[name='show'],[name='create'],[name='edit'],[name='destroy'],[name='print']").change(function () {
    if ($(this).is(':checked')) {
        var status = 1;
    } else {
        var status = 0;
    }
    //console.log(status, $(this).data('role_id'),$(this).data('menu_id'));
    $.post('/acl/' + $(this).data('role_id'), {_token: '{{csrf_token()}}', role_id: $(this).data('role_id'), menu_id: $(this).data('menu_id'), status: status, field: $(this).data('field'), _method: 'PUT'}, function (response) {
        console.log(response);
    });

});
</script> 