<select name="{{$name}}" class="form-control example-getting-started" id="{{$type}}">
    @foreach($objects as $obj)
    <option value="{{$obj->id}}">{{$obj->name}}</option>
    @endforeach
</select>
<script type="text/javascript">
    $(function () {
        $("select#city,select#district,select#subdistrict").change( function () {
            var id = $(this).attr("id"); 
            $.get('/home/select_area?type=' + $(this).attr("id") + '&id=' + $(this).val(), function (res) {                
                $("div." + id).html(res);
            })
        });
    });
</script> 