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

    <title>Brand</title>
    
    <!-- Bootstrap CSS -->
    <link href="{{ asset("ajax/css/bootstrap.min.css") }}" rel="stylesheet">
    
    <!-- icheck checkboxes -->
    <link rel="stylesheet" href="{{ asset("icheck/square/yellow.css") }}">
    
    <!-- toastr notifications -->
    <link rel="stylesheet" href="{{ asset("toastr/toastr.min.css") }}">


    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset("ajax/css/font-awesome.min.css") }}">



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
                <h2 class="text-center">Manage Brand</h2>
                <br/>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul>
                            <li><i class="fa fa-file-text-o"></i> All the current Posts</li>
                            <a href="#" class="add-modal"><li>Add a Brand</li></a>
                        </ul>
                    </div>
                
                    <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover" id="brandsTable" style="visibility: hidden;">
                                <thead>
                                    <tr>
                                        <th valign="middle">#</th>
                                        <th>Nama Brand</th>
                                        <th>Prefiks</th>
                                        <th>Supplier</th>  
                                        <th>Status</th>                                      
                                        <th>Actions</th>
                                    </tr>
                                    {{ csrf_field() }}
                                </thead>
                                <tbody>
                                    
                                    @foreach($brands as $indexKey => $brand)
                                        <tr class="item{{$brand->id}} @if($brand->enabled) warning @endif">
                                            <td class="col1">{{ $indexKey+1 }}</td>
                                            <td>{{$brand->nama_brand}}</td>
                                            <td>{{$brand->prefiks}}</td>
                                            <td>{{$brand->supplier}}</td>
                                            <td>{{$brand->status}}</td>
                                            <td>
                                                <button class="show-modal btn btn-success" data-id="{{$brand->id}}" data-nama_brand="{{$brand->nama_brand}}" data-prefiks="{{$brand->prefiks}}" data-supplier="{{$brand->supplier}}" data-status="{{$brand->status}}" >
                                                <span class="glyphicon glyphicon-eye-open"></span> Show</button>
                                                <button class="edit-modal btn btn-info" data-id="{{$brand->id}}" data-nama_brand="{{$brand->nama_brand}}" data-prefiks="{{$brand->prefiks}}" data-supplier="{{$brand->supplier}}" data-status="{{$brand->status}}">
                                                <span class="glyphicon glyphicon-edit"></span> Edit</button>
                                                <button class="delete-modal btn btn-danger" data-id="{{$brand->id}}" data-nama_brand="{{$brand->nama_brand}}" data-prefiks="{{$brand->prefiks}}" data-supplier="{{$brand->supplier}}" data-status="{{$brand->status}}">
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
                            <form  class="form-horizontal form-label-left" role="form">
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_brand">Nama Brand <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="nama_brand_add" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Nama Brand" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="prefiks">Prefiks <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="prefiks_add" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Prefiks" required="required">
                                </div>
                              </div>
                               <div class="item form-group">
                                 <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supplier">Nama Supplier <span class="required"></span>
                                 </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                   <select id="supplier_add" required="required" placeholder="supplier" class="form-control col-md-7 col-xs-12">
                                            <option value="Staf Gudang">Staf Gudang</option>
                                            <option value="Staf Sales">Staf Sales</option>
                                            <option value="Staf Finance">Staf Finance</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Super Admin">Super Admin</option>
                                       
                                  </select>
                                 </div>
                              </div>
                              <div class="item form-group">
                                  <label class="radio-inline" for="status">Status</label>
                                  <div>
                                    <form id="status">
                                      <label class="radio-inline" >
                                        <input type="radio" name="status_option" value="enabled" checked> Enable
                                      </label>
                                      <label class="radio-inline">
                                      <input type="radio" name="status_option" value="disabled"> Disable
                                    </label>
                                    </form>
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
                                    <label class="control-label col-sm-2" for="nama_brand">Nama Brand:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_brand_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="prefiks">Prefiks:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="prefiks_show" cols="40" rows="5" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="supplier">Nama Supplier:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="supplier_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="status">Status:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="status_show" disabled>
                                    </div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <span class='glyphicon glyphicon-remove'></span> Close
                                </button>
                            </div>
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
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="nama_brand">Nama Brand:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_brand_edit" autofocus>
                                        <p class="errorTitle text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="prefiks">Prefiks:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="prefiks_edit" cols="40" rows="5">
                                        <p class="errorContent text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                 <div class="form-group">
                                    <label class="control-label col-sm-2" for="supplier">Nama Supplier:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="supplier_edit" disabled>
                                    </div>
                                </div>
                               <div class="item form-group">
                                  <label class="radio-inline" for="status">Status</label>
                                  <div>
                                    <form id="status">
                                      <label class="radio-inline" >
                                        <input type="radio" name="status_option" value="enabled" checked> Enable
                                      </label>
                                      <label class="radio-inline">
                                      <input type="radio" name="status_option" value="disabled"> Disable
                                    </label>
                                    </form>
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
                                    <label class="control-label col-sm-2" for="nama_brand">Nama:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_brand_delete" disabled>
                                    </div>
                                </div>
                            </form>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger delete" data-dismiss="modal">
                                    <span id="" class='glyphicon glyphicon-trash'></span> Delete
                                </button>
                                <button type="button" class="btn btn-warning" data-dismiss="modal">
                                    <span class='glyphicon glyphicon-remove'></span> Close
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

                    </div>
                </div>
            

            <!-- jQuery -->
            <script src="{{ asset("ajax/js/jquery.min.js") }}"></script>
            <script src="{{ asset("ajax/js/jquery-2.2.4.js") }}"></script>

            <!-- Bootstrap JavaScript -->
            <script src="{{ asset("ajax/js/bootstrap.min.js") }}"></script>

            <!-- toastr notifications -->
            <script type="text/javascript" src="{{ asset("toastr/toastr.min.js") }}"></script>
            

            <!-- icheck checkboxes -->
            <script type="text/javascript" src="{{ asset("icheck/icheck.min.js") }}"></script>

            <!-- Delay table load until everything else is loaded -->
    



    <script>
        $(window).load(function(){
            $('#brandsTable').removeAttr('style');
        })
    </script>

    
    

    <!-- AJAX CRUD operations -->
    <script type="text/javascript">
        // add a new post
        $(document).on('click', '.add-modal', function() {
            $('.modal-title').text('Add Brand');
            $('#addModal').modal('show');
        });
        $('.modal-footer').on('click', '.add', function() {
            $.ajax({
                type: 'POST',
                url: 'brands',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'nama_brand': $('#nama_brand_add').val(),
                    'prefiks': $('#prefiks_add').val(),
                    'supplier': $('#supplier_add').val(),
                    'status' : $('input[name=status_option]:checked').val()
                },

                success: function(data) {
                    $('.errorNama_Brand').addClass('hidden');
                    $('.errorPrefiks').addClass('hidden');
                    $('.errorSupplier').addClass('hidden');
                    $('.errorStatus').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.nama_brand) {
                            $('.errorNama_Brand').removeClass('hidden');
                            $('.errorNama_Brand').text(data.errors.nama_brand);
                        }
                        if (data.errors.prefiks) {
                            $('.errorPrefiks').removeClass('hidden');
                            $('.errorPrefiks').text(data.errors.prefiks);
                        }
                        if (data.errors.supplier) {
                            $('.errorSupplier').removeClass('hidden');
                            $('.errorSupplier').text(data.errors.supplier);
                        }
                        if (data.errors.status) {
                            $('.errorStatus').removeClass('hidden');
                            $('.errorStatus').text(data.errors.status);
                        }
                        
                    } else {
                        toastr.success('Successfully added Brand!', 'Success Alert', {timeOut: 5000});
                        $('#brandsTable').append("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.nama_brand + "</td><td>" + data.prefiks + "</td><td>" + data.supplier + "</td><td>" + data.status + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-nama_brand='" + data.nama_brand + "' data-prefiks='" + data.prefiks + "' data-supplier='" + data.supplier + "' data-status='" + data.status + "' ><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-nama='" + data.nama_brand + "' data-prefiks='" + data.prefiks + "' data-supplier='" + data.supplier + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-nama='" + data.nama_brand + "' data-prefiks'" + data.prefiks + "' data-supplier='" + data.supplier + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                    }


                    $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                },
            });
        });


       //show radio button 
       
        

         //Show a post
        $(document).on('click', '.show-modal', function() {
                    $('.modal-title').text('Show');
                    $('#id_show').val($(this).data('id'));
                    $('#nama_brand_show').val($(this).data('nama_brand'));
                    $('#prefiks_show').val($(this).data('prefiks'));
                    $('#supplier_show').val($(this).data('supplier'));
                    $('#status_show').val($(this).data('status'));
                      $('#showModal').modal('show');

                });
        $(document).ready(function(){
    
         });

                 // Edit a post
        $(document).on('click', '.edit-modal', function() {
            $('.modal-title').text('Edit');
            $('#id_edit').val($(this).data('id'));
            $('#nama_brand_edit').val($(this).data('nama_brand'));
            $('#prefiks_edit').val($(this).data('prefiks'));
            $('#supplier_edit').val($(this).data('supplier'));
            $('#status').val($(this).data('status'));
            id = $('#id_edit').val();
            $('#editModal').modal('show');
        });
        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: 'brands/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit").val(),
                    'nama_brand': $('#nama_brand_edit').val(),
                    'prefiks': $('#prefiks_edit').val(),
                    'supplier': $('#supplier_edit').val(),
                    'status': $('input[name=status_option]:checked').val()  
                },
                success: function(data) {
                    $('.errorNama_Brand').addClass('hidden');
                    $('.errorPrefiks').addClass('hidden');
                    $('.errorSupplier').addClass('hidden');
                    $('.errorStatus').addClass('hidden');
                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.nama_brand) {
                            $('.errorNama_Brand').removeClass('hidden');
                            $('.errorTitle').text(data.errors.nama_brand);
                        }
                        if (data.errors.prefiks) {
                            $('.errorPrefiks').removeClass('hidden');
                            $('.errorPrefiks').text(data.errors.prefiks);
                        }
                        if (data.errors.supplier) {
                            $('.errorSupplier').removeClass('hidden');
                            $('.errorSupplier').text(data.errors.supplier);
                        }
                        if (data.errors.status) {
                            $('.errorStatus').removeClass('hidden');
                            $('.errorStatus').text(data.errors.status);
                        }
                    } else {
                        toastr.success('Successfully updated Post!', 'Success Alert', {timeOut: 5000});
                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.nama_brand + "</td><td>" + data.prefiks + "</td><td>" + data.supplier + "</td><td>" + data.status + "</td><td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-nama='" + data.nama + "' data-jabatan='" + data.jabatan + "' data-email='" + data.email + "' data-status='" + data.status + "' data-foto='" + data.foto + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-nama='" + data.nama + "' data-jabatan='" + data.jabatan + "' data-email='" + data.email + "' data-status='" + data.status + "' data-foto='" + data.foto + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-nama='" + data.nama + "' data-jabatan='" + data.jabatan + "' data-email='" + data.email + "' data-status='" + data.status + "' data-foto='" + data.foto + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

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
                    $('#nama_brand_delete').val($(this).data('nama_brand'));
                    $('#deleteModal').modal('show');
                    id = $('#id_delete').val();
                });
                $('.modal-footer').on('click', '.delete', function() {
                    $.ajax({
                        type: 'DELETE',
                        url: 'brands/' + id,
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

