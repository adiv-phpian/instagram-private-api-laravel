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
                <div class="panel-heading">Proxies</div>

                <div class="panel-body">
                     <table id="proxies" class="display" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>IP</th>
                                <th>Port</th>
                                <th>username</th>
                                <th>Password</th>
                                <th>Created at</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>IP</th>
                                <th>Port</th>
                                <th>username</th>
                                <th>Password</th>
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

var editor;

$(document).ready(function() {
                 editor = new $.fn.dataTable.Editor( {
                         "ajax": "/datatables/proxies",
                         "table": "#proxies",
                         "fields": [{
                                        "label": "IP Address:",
                                        "name": "ip"
                                    }, {
                                        "label": "Port:",
                                        "name": "port"
                                    }, {
                                        "label": "Username:",
                                        "name": "username"
                                    }, {
                                        "label": "Password:",
                                        "name": "password"
                                    }
                                   ]
                     } );


$('#proxies').DataTable( {
        dom: "Bfrtip",
        ajax: {
            url: "/datatables/proxies",
            type: "POST"
        },
        serverSide: true,
        columns: [
            { data: "ip" },
            { data: "port" },
            { data: "username" },
            { data: "password" },
            { data: "created_at" }
        ],
        select: true,
        buttons: [
          { extend: "create", editor: editor },
            { extend: "edit",   editor: editor },
            { extend: "remove", editor: editor }
        ]
    } );
});
</script>

@endsection
