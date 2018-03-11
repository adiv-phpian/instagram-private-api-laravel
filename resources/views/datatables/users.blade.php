@extends('layouts.app')

@section('content')


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.5.0/css/buttons.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css">

<link rel="stylesheet" type="text/css" href="{{ URL::asset('datatables/css/editor.dataTables.min.css') }}">

<link rel="stylesheet" type="text/css" href="{{ URL::asset('datatables/css/custom.css') }}">


<style>
.img{
  max-width: 100px;
}

img{
  max-width: 100px;
}

</style>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Users</div>

                <div class="panel-body">
                     <table id="users" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>User</th>
                                <th>Last login</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th></th>
                                <th>User</th>
                                <th>Last login</th>
                                <th>Created at</th>
                            </tr>
                        </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>

@endsection('content')

@section('script')


<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/buttons/1.5.0/js/dataTables.buttons.min.js">
</script>
<script type="text/javascript" language="javascript" src="https://cdn.datatables.net/select/1.2.4/js/dataTables.select.min.js">
</script>


<script type="text/javascript" language="javascript" src="{{ URL::asset('datatables/js/dataTables.editor.min.js') }}">
</script>


<script>

$.ajaxSetup( {  headers: {
						           'X-CSRF-TOKEN': "{{ csrf_token() }}"
						       }
						     } );
$(document).ready(function() {
                 editor = new $.fn.dataTable.Editor( {
                         "ajax": "../php/staff.php",
                         "table": "#proxies",
                         "fields": [
                         ]
                     } );


$('#users').DataTable( {
        dom: "Bfrtip",
        ajax: {
            url: "/datatables/users",
            type: "POST"
        },
        serverSide: true,
        columns: [
            { data: "user_info", render:function(data, row){
               var user = JSON.parse(data).user;

               var html = '';
               html += '<img style="max-width: 50px;" class="img " src="'+user.profile_pic_url+'">';
               return html;
            } },
            { data: "id", render:function(data, c, row){
               var user = JSON.parse(row.user_info).user;

               var html = '';
               html += user.full_name+'<br>@'+user.username+'<br>';
               html += user.follower_count+' Follower '+user.following_count+' Following<br>';

               return html;
            } },
            { data: "updated_at" },
            { data: "created_at" }
        ],
        select: true,
        buttons: [
        ]
    } );
});
</script>

@endsection
