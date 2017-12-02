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

    <title>Customer</title>
    
    <!-- Bootstrap CSS -->
     <link href="{{asset("ajax/css/bootstrap.min.css")}}"  rel="stylesheet">

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
                <h2 class="text-center">Manage Customer</h2>
                <br />
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul>
                            <li><i class="fa fa-file-text-o"></i> All the current customers</li>
                            <a href="#" class="add-modal"><li>Add a Customer</li></a>
                        </ul>
                    </div>
                
                    <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover" id="customersTable" style="visibility: hidden;">
                                <thead>
                                    <tr>
                                        <th valign="middle">#</th>
                                        <th>Nama</th>
                                        <th>Email</th>
                                        <th>Gender</th>
                                        <th>Type</th>
                                        <th>City</th> 
                                        <th>Phone</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    {{ csrf_field() }}
                                </thead>
                                <tbody>
                                    @foreach($customers as $indexKey => $customer)
                                        <tr class="item{{$customer->id}} @if($customer->enabled) warning @endif">
                                            <td class="col1">{{ $indexKey+1 }}</td>
                                            <td>{{$customer->nama}}</td>
                                            <td>{{$customer->email}}</td>
                                            <td>{{$customer->gender}}</td>
                                            <td>{{$customer->type}}</td>
                                            <td>{{$customer->city}}</td>
                                            <td>{{$customer->phone}}</td>
                                            <td>{{$customer->status}}</td>
                                            <td>
                                                <button class="show-modal btn btn-success" data-id="{{$customer->id}}" data-nama="{{$customer->nama}}" data-email="{{$customer->email}}" data-gender="{{$customer->gender}}" data-type="{{$customer->type}}" data-city="{{$customer->city}}" data-phone="{{$customer->phone}}" data-status="{{$customer->status}}">
                                                <span class="glyphicon glyphicon-eye-open"></span> Show</button>
                                                <button class="edit-modal btn btn-info" data-id="{{$customer->id}}" data-nama="{{$customer->nama}}" data-email="{{$customer->email}}" data-gender="{{$customer->gender}}" data-type="{{$customer->type}}" data-city="{{$customer->city}}" data-phone="{{$customer->phone}}" data-status="{{$customer->status}}">
                                                <span class="glyphicon glyphicon-edit"></span> Edit</button>
                                                <button class="delete-modal btn btn-danger" data-id="{{$customer->id}}" data-nama="{{$customer->nama}}" data-email="{{$customer->email}}" data-gender="{{$customer->gender}}" data-type="{{$customer->type}}" data-city="{{$customer->city}}" data-phone="{{$customer->phone}}" data-status="{{$customer->status}}">
                                                <span class="glyphicon glyphicon-trash"></span> Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div><!-- /.panel-body -->
                </div><!-- /.panel panel-default -->
            </div><!-- /.col-md-8 -->

            <!-- Modal form to add a customer -->
            <div id="addModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>

                        <div class="modal-body">
                            <form action="{{ url('customers') }}" class="form-horizontal form-label-left" role="form">
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="nama_add" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Enter Full Name" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="email_add" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Enter Email" required="required">
                                </div>
                              </div>

                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Gender <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="gender_add" required="required" placeholder="Choose Gender" class="form-control col-md-7 col-xs-12">                                 
                                  <option value="Pria">Pria</option>
                                  <option value="Wanita">Wanita</option>                                 
                                  </select>
                                </div>
                              </div>

                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Type <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="type_add" required="required" placeholder="Choose Type" class="form-control col-md-7 col-xs-12">                                 
                                  <option value="Tipe A">Tipe A</option>
                                  <option value="Tipe B">Tipe B</option>
                                  <option value="Tipe C">Tipe C</option>                                 
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="city">City<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="city_add" required="required" placeholder="Enter City" class="form-control col-md-7 col-xs-12">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="phone">Phone<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="phone_add" required="required" placeholder="Enter Phone" class="form-control col-md-7 col-xs-12">
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
                            </form>

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

            <!-- Modal form to show a customer -->
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
                                    <label class="control-label col-sm-2" for="nama">Nama:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Email:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email_show" cols="40" rows="5" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="gender">Gender:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="gender_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="type">Type:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="type_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="city">City:</label>
                                    <div class="col-sm-10">
                                        <input type="city" class="form-control" id="city_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="phone">Phone:</label>
                                    <div class="col-sm-10">
                                        <input type="number" class="form-control" id="phone_show" disabled>
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
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="nama">Nama:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_edit" autofocus>
                                        <p class="errorTitle text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Email:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email_edit" cols="40" rows="5">
                                        <p class="errorContent text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                               <div class="item form-group">
                                <label class="control-label col-sm-2" for="gender">Gender <span class="required"></span>
                                </label>
                                <div class="col-sm-10">
                                  <select id="gender_edit" required="required" placeholder="Choose Gender" class="form-control col-md-7 col-xs-12">                                 
                                  <option value="Pria">Pria</option>
                                  <option value="Wanita">Wanita</option>                                 
                                  </select>
                                </div>
                              </div>

                              <div class="item form-group">
                                <label class="control-label col-sm-2" for="type">Type <span class="required"></span>
                                </label>
                                <div class="col-sm-10">
                                  <select id="type_edit" required="required" placeholder="Choose Type" class="form-control col-md-7 col-xs-12">                                 
                                  <option value="Tipe A">Tipe A</option>
                                  <option value="Tipe B">Tipe B</option>
                                  <option value="Tipe C">Tipe C</option>                                 
                                  </select>
                                </div>
                              </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="city">City:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="city_edit" autofocus>
                                        <p class="errorTitle text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="phone">Phone:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="phone_edit" autofocus>
                                        <p class="errorTitle text-center alert alert-danger hidden"></p>
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
                            <h3 class="text-center">Are you sure you want to delete the following customer?</h3>
                            <br />
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="id">ID:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="id_delete" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="nama">Nama:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_delete" disabled>
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
            <script src="{{asset("ajax/js/jquery.min.js") }}"></script>
            <script src="{{asset("ajax/js/jquery-2.2.4.js") }}"></script>
           
            <!-- Bootstrap JavaScript -->
            <script src="{{asset("ajax/js/bootstrap.min.js") }}></script>

            <!-- toastr notifications -->
            <script type="text/javascript" src="{{ asset("toastr/toastr.min.js") }}"></script>
            
            <!-- icheck checkboxes -->
            <script type="text/javascript" src="{{ asset("icheck/icheck.min.js") }}"></script>

            <!-- Delay table load until everything else is loaded -->
    <script>
        $(window).load(function(){
            $('#customersTable').removeAttr('style');
        })
    </script>

    <!-- AJAX CRUD operations -->
    <script type="text/javascript">
        // add a new customer
        $(document).on('click', '.add-modal', function() {
            $('.modal-title').text('Add');
            $('#addModal').modal('show');
        });
        $('.modal-footer').on('click', '.add', function() {
            $.ajax({
                type: 'POST',
                url: 'customers',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'nama': $('#nama_add').val(),
                    'email': $('#email_add').val(),
                    'gender': $('#gender_add').val(),
                    'type': $('#type_add').val(),
                    'city': $('#city_add').val(),
                    'phone': $('#phone_add').val(),
                    'status' : $('input[name=status_option]:checked').val()
                },
                success: function(data) {
                    $('.errorNama').addClass('hidden');
                    $('.errorEmail').addClass('hidden');
                    $('.errorGender').addClass('hidden');
                    $('.errorType').addClass('hidden');
                    $('.errorCity').addClass('hidden');
                    $('.errorPhone').addClass('hidden');
                    $('.errorStatus').addClass('hidden');
                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.nama) {
                            $('.errorNama').removeClass('hidden');
                            $('.errorNama').text(data.errors.nama);
                        }
                        if (data.errors.email) {
                            $('.errorEmail').removeClass('hidden');
                            $('.errorEmail').text(data.errors.email);
                        }
                        if (data.errors.gender) {
                            $('.errorGender').removeClass('hidden');
                            $('.errorGender').text(data.errors.gender);
                        }
                        if (data.errors.type) {
                            $('.errorType').removeClass('hidden');
                            $('.errorType').text(data.errors.type);
                        }
                        if (data.errors.city) {
                            $('.errorCity').removeClass('hidden');
                            $('.errorCity').text(data.errors.city);
                        }
                        if (data.errors.phone) {
                            $('.errorPhone').removeClass('hidden');
                            $('.errorPhone').text(data.errors.phone);
                        }
                        if (data.errors.status) {
                            $('.errorStatus').removeClass('hidden');
                            $('.errorStatus').text(data.errors.status);
                        }
                    } else {
                        toastr.success('Successfully added customer!', 'Success Alert', {timeOut: 5000});
                        $('#customersTable').append("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.nama + "</td><td>" + data.email + "</td><td>" + data.gender + "</td><td>" + data.type + "</td><td>" + data.city + "</td><td>" + data.phone + "</td><td>" + data.status +"</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-nama='" + data.nama + "' data-email='" + data.email + "' data-gender='" + data.gender + "' data-type='" + data.type + "' data-city='" + data.city+ "' data-phone='" + data.phone+ "' data-status='" + data.status + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-nama='" + data.nama + "' data-email='" + data.email + "' data-gender='" + data.gender + "' data-type='" + data.type + "' data-city='" + data.city+ "' data-phone='" + data.phone+ "' data-status='" + data.status+ "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-nama='" + data.nama + "' data-email='" + data.email + "' data-gender='" + data.gender + "' data-type='" + data.type + "' data-city='" + data.city+ "' data-phone='" + data.phone+ "' data-status='" + data.status + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }

                    
                },
            });
        });

                // Show a customer
                $(document).on('click', '.show-modal', function() {
                    $('.modal-title').text('Show');
                    $('#id_show').val($(this).data('id'));
                    $('#nama_show').val($(this).data('nama'));
                    $('#email_show').val($(this).data('email'));
                    $('#gender_show').val($(this).data('gender'));
                    $('#type_show').val($(this).data('type'));
                    $('#city_show').val($(this).data('city'));
                    $('#phone_show').val($(this).data('phone'));
                    $('#status_show').val($(this).data('status'));
                    $('#showModal').modal('show');
                });


                 // Edit a customer
        $(document).on('click', '.edit-modal', function() {
            $('.modal-title').text('Edit');
            $('#id_edit').val($(this).data('id'));
            $('#nama_edit').val($(this).data('nama'));
            $('#email_edit').val($(this).data('email'));
            $('#gender_edit').val($(this).data('gender'));
            $('#type_edit').val($(this).data('type'));            
            $('#city_edit').val($(this).data('city'));
            $('#phone_edit').val($(this).data('phone'));
            $('#status_edit').val($(this).data('status'));
            id = $('#id_edit').val();
            $('#editModal').modal('show');
        });
        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: 'customers/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit").val(),
                    'nama': $('#nama_edit').val(),
                    'email': $('#email_edit').val(),
                    'gender': $('#gender_edit').val(),
                    'type': $('#type_edit').val(),                    
                    'city': $('#city_edit').val(),
                    'phone': $('#phone_edit').val(),
                    'status' : $('input[name=status_option]:checked').val()
                },
                success: function(data) {
                    $('.errorNama').addClass('hidden');
                    $('.errorEmail').addClass('hidden');
                    $('.errorGender').addClass('hidden');
                    $('.errorType').addClass('hidden');                   
                    $('.errorCity').addClass('hidden');
                    $('.errorPhone').addClass('hidden');
                    $('.errorStatus').addClass('hidden');
                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.nama) {
                            $('.errorNama').removeClass('hidden');
                            $('.errorNama').text(data.errors.nama);
                        }
                        if (data.errors.email) {
                            $('.errorEmail').removeClass('hidden');
                            $('.errorEmail').text(data.errors.email);
                        }
                        if (data.errors.gender) {
                            $('.errorGender').removeClass('hidden');
                            $('.errorGender').text(data.errors.gender);
                        }
                        if (data.errors.type) {
                            $('.errorType').removeClass('hidden');
                            $('.errorType').text(data.errors.type);
                        }
                        if (data.errors.city) {
                            $('.errorCity').removeClass('hidden');
                            $('.errorCity').text(data.errors.city);
                        }
                        if (data.errors.phone) {
                            $('.errorPhone').removeClass('hidden');
                            $('.errorPhone').text(data.errors.phone);
                        }
                        if (data.errors.status) {
                            $('.errorStatus').removeClass('hidden');
                            $('.errorStatus').text(data.errors.status);
                        }


                    } else {
                        toastr.success('Successfully updated customer!', 'Success Alert', {timeOut: 5000});
                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.nama + "</td><td>" + data.email + "</td><td>" + data.gender + "</td><td>" + data.type + "</td><td>" + data.city + "</td><td>" + data.phone + "</td><td>" + data.status +"</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-nama='" + data.nama + "' data-email='" + data.email + "' data-gender='" + data.gender + "' data-type='" + data.type + "' data-city='" + data.city +"' data-phone='" + data.phone+ "' data-status='" + data.status+ "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-nama='" + data.nama + "' data-email='" + data.email + "' data-gender='" + data.gender + "' data-type='" + data.type + "' data-city='" + data.city +"' data-phone='" + data.phone+ "' data-status='" + data.status+ "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-nama='" + data.nama + "' data-email='" + data.email + "' data-gender='" + data.gender+ "' data-type='" + data.type + "' data-city='" + data.city + "' data-phone='" + data.phone+ "' data-status='" + data.status+ "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }
                }
            });
        });
                
                // delete a customer
                $(document).on('click', '.delete-modal', function() {
                    $('.modal-title').text('Delete');
                    $('#id_delete').val($(this).data('id'));
                    $('#nama_delete').val($(this).data('nama'));
                    $('#deleteModal').modal('show');
                    id = $('#id_delete').val();
                });
                $('.modal-footer').on('click', '.delete', function() {
                    $.ajax({
                        type: 'DELETE',
                        url: 'customers/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function(data) {
                            toastr.success('Successfully deleted customer!', 'Success Alert', {timeOut: 5000});
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