<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}">

    <!-- CSFR token for ajax call -->
    <meta name="_token" content="{{ csrf_token() }}"/>

    <title>Delivery Order</title>
    
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    {{-- <link rel="styleeheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> --}}

    <!-- icheck checkboxes -->
    <link rel="stylesheet" href="{{ asset('icheck/square/yellow.css') }}">
    {{-- <link rel="stylesheet" href="https://raw.githubusercontent.com/fronteed/icheck/1.x/skins/square/yellow.css"> --}}

    <!-- toastr notifications -->
    {{-- <link rel="stylesheet" href="{{ asset('toastr/toastr.min.css') }}"> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
   

    <!-- Font Awesome -->
    {{-- <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}"> --}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.1/css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
      
     <!-- datepicker -->
   <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

   
  
    <!-- Bootstrap -->
        <link href="{{ asset("css/bootstrap.min.css") }}" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset("css/font-awesome.min.css") }}" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{ asset("css/gentelella.min.css") }}" rel="stylesheet">


    <style>
        .panel-heading {
            padding: 0;
        }
        .panel-heading ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
        }
        .panel-heading li {
            float: left;
            border-right:1px solid #bbb;
            display: block;
            padding: 14px 16px;
            text-align: center;
        }
        .panel-heading li:last-child:hover {
            background-color: #ccc;
        }
        .panel-heading li:last-child {
            border-right: none;
        }
        .panel-heading li a:hover {
            text-decoration: none;
        }

        .table.table-bordered tbody td {
            vertical-align: baseline;
        }
    </style>

    @stack('stylesheets')


</head>

<body class="nav-md">
    <div class="container body">
            <div class="main_user">

                @include('includes/sidebar')

                @include('includes/topbar')

                <div class="right_col" role="main">

    
    <!-- /page content -->
    <div class="col-md-12">
                <h2 class="text-center">Manage Delivery Order</h2>
                <br />
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul>
                            <li><i class="fa fa-file-text-o"></i> All the current Posts</li>
                            <a href="#" class="add-modal"><li>Add a Delivery Order</li></a>
                        </ul>
                    </div>
                
                    <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover" id="dosTable" style="visibility: hidden;">
                                <thead>
                                    <tr>
                                        <th valign="middle">#</th>
                                        <th>Tanggal</th>
                                        <th>Sales Order</th>
                                        <th>Actions</th>
                                    </tr>
                                    {{ csrf_field() }}
                                </thead>
                                <tbody>
                                    @foreach($dos as $indexKey => $do)
                                        <tr class="item{{$do->id}}">
                                            <td class="col1">{{ $indexKey+1 }}</td>
                                            <td>{{$do->tanggal}}</td>
                                            <td>{{$do->sales_order}}</td>
                                            <td>
                                                <button class="show-modal btn btn-success" data-id="{{$do->id}}" data-tanggal="{{$do->tanggal}}" data-sales_order="{{$do->sales_order}}">
                                                <span class="glyphicon glyphicon-eye-open"></span> Show</button>
                                                <button class="edit-modal btn btn-info" data-id="{{$do->id}}" data-tanggal="{{$do->tanggal}}" data-sales_order="{{$do->sales_order}}">
                                                <span class="glyphicon glyphicon-edit"></span> Edit</button>
                                                <button class="delete-modal btn btn-danger" data-id="{{$do->id}}" data-tanggal="{{$do->tanggal}}" data-sales_order="{{$do->sales_order}}">
                                                <span class="glyphicon glyphicon-trash"></span> Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div><!-- /.panel-body -->
                </div><!-- /.panel panel-default -->
            </div><!-- /.col-md-8 -->

            <!-- Modal form to add a post -->
            <div id="addModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>

                        <div class="modal-body">
                            <form action="{{ url('/do') }}" class="form-horizontal form-label-left" role="form">
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Tanggal <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="tanggal" id="tanggal_add" placeholder="dd/mm/yyyy" class="form-control input-md" required="">
                                </div>
                              </div>

                               <!-- <div class="input-group date" data-provide="datepicker">
                                 <input type="text"  id = "tanggal_add" class="form-control" >
                                   <div class="input-group-addon">
                                   <span class="glyphicon glyphicon-th"></span>
                                   </div>
                                 </div> -->

                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sales_order">Sales Order <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="sales_order_add" required="required" placeholder="Pilih Sales Order" class="form-control col-md-7 col-xs-12">
                                  <!-- @foreach($dos as $dos)
                                    
                                    <option value="{{ $dos->id }}">{{ $dos->sales_order }}</option>

                                  @endforeach -->
                                  <option value= "staf gudang"> Staf gudang</option>
                                   <option value= "staf sales"> Staf sales</option>
                                   <option value= "staf finance"> Staf finance</option>
                                   <option value= "admin"> Admin </option>
                                    <option value= "superadmin"> Super Admin </option>

                                  </select>
                                </div>
                              </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-success add" data-dismiss="modal">
                                    <span id="" class='glyphicon glyphicon-check'></span> Add
                                </button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <span class='glyphicon glyphicon-remove'></span> Cancel
                                </button>
                            </div>

                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal form to show a post -->
            <div id="showModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="id">ID:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="id_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="tanggal">Tanggal:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="tanggal_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="sales_order">Sales_Order:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="sales_order_show" cols="40" rows="5" disabled>
                                    </div>
                                </div>
                            
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <span class='glyphicon glyphicon-remove'></span> Close
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal form to edit a form -->
            <div id="editModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="id">ID:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="id_edit" disabled>
                                    </div>
                                </div>
                                <div class="item form-group">
                                <label class="control-label col-sm-2" for="tanggal">Tanggal <span class="required"></span>
                                </label>
                               <div class="col-sm-10">
                                    <input type="text" name="tanggal" id="tanggal_edit" placeholder="dd/mm/yyyy" class="form-control input-md" required="">
                                </div>
                              </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="sales_order">Sales Order:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="sales_order_edit" cols="40" rows="5">
                                        <p class="errorContent text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                               <div class="modal-footer">
                                <button id="submit" name="submit" class="btn btn-primary edit" data-dismiss="modal">
                                    <span class='glyphicon glyphicon-check'></span> Edit
                                </button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <span class='glyphicon glyphicon-remove'></span> Close
                                </button>
                               </div>

                            </form>
                          
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal form to delete a form -->
            <div id="deleteModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>
                        <div class="modal-body">
                            <h3 class="text-center">Are you sure you want to delete the following post?</h3>
                            <br />
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="id">ID:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="id_delete" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="tanggal">Tanggal:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="tanggal_delete" disabled>
                                    </div>
                                </div>
                     
                              <div class="modal-footer">
                                <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                                    <span id="" class='glyphicon glyphicon-trash'></span> Delete
                                </button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <span class='glyphicon glyphicon-remove'></span> Close
                                </button>
                              </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</div>
   <script type="text/javascript">
     $('#tanggal_add').datepicker({  
       format: 'mm-dd-yyyy' });  

     </script>  

     <script type="text/javascript">
     $('#tanggal_edit').datepicker({  
       format: 'mm-dd-yyyy' });  

     </script>  



            <!-- jQuery -->
            {{-- <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script> --}}
            <script src="https://code.jquery.com/jquery-2.2.4.js" integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>

            <!-- Bootstrap JavaScript -->
            <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.0.1/js/bootstrap.min.js"></script>

            <!-- toastr notifications -->
            {{-- <script type="text/javascript" src="{{ asset('toastr/toastr.min.js') }}"></script> --}}
            <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

            <!-- icheck checkboxes -->
            <script type="text/javascript" src="{{ asset('icheck/icheck.min.js') }}"></script>

            <!-- Delay table load until everything else is loaded -->
    

    
    <script>
        $(window).load(function(){
            $('#dosTable').removeAttr('style');
        });
    </script>


    
    <!-- AJAX datepicker in laravel -->
   

    <!-- AJAX CRUD operations -->
    <script type="text/javascript">
        // add a new post
        $(document).on('click', '.add-modal', function() {
            $('.modal-title').text('Add');
            $('#addModal').modal('show');
        });
        $('.modal-footer').on('click', '.add', function() {
            $.ajax({
                type: 'POST',
                url: 'do',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'tanggal': $('#tanggal_add').val(),
                    'sales_order': $('#sales_order_add').val()
                },
                success: function(data) {
                    $('.errorTanggal').addClass('hidden');
                    $('.errorSalesOrder').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.tanggal) {
                            $('.errorTanggal').removeClass('hidden');
                            $('.errorTanggal').text(data.errors.tanggal);
                        }
                        if (data.errors.sales_order) {
                            $('.errorSalesOrder').removeClass('hidden');
                            $('.errorSalesOrder').text(data.errors.sales_order);
                        }
                    } else {
                        toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
                        $('#dosTable').append("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.tanggal + "</td><td>" + data.sales_order + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-tanggal='" + data.tanggal + "' data-sales_order='" + data.sales_order  + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-tanggal='" + data.tanggal + "' data-sales_order='" + data.sales_order + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-tanggal='" + data.tanggal + "' data-sales_order='" + data.sales_order + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                    }

                    $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                },
            });
        });

                // Show a post
                $(document).on('click', '.show-modal', function() {
                    $('.modal-title').text('Show');
                    $('#id_show').val($(this).data('id'));
                    $('#tanggal_show').val($(this).data('tanggal'));
                    $('#sales_order_show').val($(this).data('sales_order'));
                    $('#showModal').modal('show');
                });


                 // Edit a post
        $(document).on('click', '.edit-modal', function() {
            $('.modal-title').text('Edit');
            $('#id_edit').val($(this).data('id'));
            $('#tanggal_edit').val($(this).data('tanggal'));
            $('#sales_order_edit').val($(this).data('sales_order'));
            id = $('#id_edit').val();
            $('#editModal').modal('show');
        });
        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: 'do/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit").val(),
                    'tanggal': $('#tanggal_edit').val(),
                    'sales_order': $('#sales_order_edit').val()
                    
                },
                success: function(data) {
                    $('.errorTanggal').addClass('hidden');
                    $('.errorSalesOrder').addClass('hidden');
                    
                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.tanggal) {
                            $('.errorTanggal').removeClass('hidden');
                            $('.errorTanggal').text(data.errors.tanggal);
                        }
                        if (data.errors.sales_order) {
                            $('.errorSalesOrder').removeClass('hidden');
                            $('.errorSalesOrder').text(data.errors.sales_order);
                        }
                    } else {
                        toastr.success('Successfully updated Post!', 'Success Alert', {timeOut: 5000});
                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-tanggal='" + data.tanggal + "' data-sales_order='" + data.sales_order + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-tanggal='" + data.tanggal + "' data-sales_order='" + data.sales_order + "'><span class='glyphicon glyphicon-edit'></span> Edit</button><button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-tanggal='" + data.tanggal + "' data-sales_order='" + data.sales_order + "' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }
                }
            });
        });
                
                // delete a post
                $(document).on('click', '.delete-modal', function() {
                    $('.modal-title').text('Delete');
                    $('#id_delete').val($(this).data('id'));
                    $('#tanggal_delete').val($(this).data('tanggal'));
                    $('#deleteModal').modal('show');
                    id = $('#id_delete').val();
                });
                $('.modal-footer').on('click', '.delete', function() {
                    $.ajax({
                        type: 'DELETE',
                        url: 'do/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function(data) {
                            toastr.success('Successfully deleted Post!', 'Success Alert', {timeOut: 5000});
                            $('.item' + data['id']).remove();
                            $('.col1').each(function (index) {
                                $(this).html(index+1);
                            });
                        }
                    });
                });
            
            </script>

       </div>
    
   
    <!-- jQuery -->
        <script src="{{ asset("js/jquery.min.js") }}"></script>
        <!-- Bootstrap -->
        <script src="{{ asset("js/bootstrap.min.js") }}"></script>
        <!-- Custom Theme Scripts -->
        <script src="{{ asset("js/gentelella.min.js") }}"></script>

        @stack('scripts')

</body>
</html>