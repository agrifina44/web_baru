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

    <title>User</title>
    
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
            <h2 class="text-center">Manage User</h2> <br />
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul>
                            <li><i class="fa fa-file-text-o"></i> All the current Posts</li>
                            <button class="add-modal"><li>Add a User</li> </button>
                        </ul>
                    </div>
                    
                    <div class="panel-body">
                        <table class="table table-striped table-bordered table-hover" id="postTable" style="visibility: hidden;">
                            <thead>
                                <tr>
                                    <th valign="middle">#</th>
                                    <th>Nama</th>
                                    <th>Jabatan</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Foto</th>                                        
                                    <th>Actions</th>
                                </tr>
                            </thead>
                                    
                            <tbody>
                                @foreach($users as $indexKey => $user)
                                    <tr class="item{{$user->id}} @if($user->status) warning @endif">
                                        @if(Request::get('page'))
                                        <td class="col1">{{ $indexKey+1 + ((Request::get('page')-1)*10)}}</td>
                                        @else
                                        <td class="col1">{{ $indexKey+1 }}</td>
                                        @endif
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->jabatan}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$user->status}}</td>
                                        <td> <img src="{{url('/image/', $user->foto)}}" height="100" width="100" /></td>
                                        <td>
                                            <button class="show-modal btn btn-success" data-id="{{$user->id}}" data-nama="{{$user->name}}" data-jabatan="{{$user->jabatan}}" data-email="{{$user->email}}" data-role="{{$user->jabatan}}" data-status="{{$user->status}}" data-foto="{{$user->foto}}">
                                            <span class="glyphicon glyphicon-eye-open"></span> Show</button>

                                            <button class="edit-modal btn btn-info" data-id="{{$user->id}}" data-nama="{{$user->name}}" data-jabatan="{{$user->jabatan}}" data-email="{{$user->email}}" data-role="{{$user->jabatan}}" data-status="{{$user->status}}" data-foto="{{$user->foto}}">
                                            <span class="glyphicon glyphicon-edit"></span> Edit</button>

                                            <button class="delete-modal btn btn-danger" data-id="{{$user->id}}" data-nama="{{$user->name}}" data-jabatan="{{$user->jabatan}}" data-email="{{$user->email}}" data-role="{{$user->jabatan}}" data-status="{{$user->status}}" data-foto="{{$user->foto}}">
                                            <span class="glyphicon glyphicon-trash"></span> Delete</button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            {{ $users->render()}}
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
                            <form action="{{url('user')}}" id="test-add" class="form-horizontal form-label-left" role="form" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Lengkap <span class="required"></span>
                                    <label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" id="nama_add" class="form-control col-md-7 col-xs-12" name="nama"data-validate-length-range="6" data-validate-words="2" placeholder="Nama Lengkap" required="required" />
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jabatan">Level/Jabatan <span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select id="jabatan_add" required="required" placeholder="Level/Jabatan" name="jabatan" class="form-control col-md-7 col-xs-12">
                                            <option value="Staf Gudang">Staf Gudang</option>
                                            <option value="Staf Sales">Staf Sales</option>
                                            <option value="Staf Finance">Staf Finance</option>
                                            <option value="Admin">Admin</option>
                                            <option value="Super Admin">Super Admin</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="email">Email<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="email" id="email_add" name="email" required="required" placeholder="Email" class="form-control col-md-7 col-xs-12">
                                     </div>
                                </div>

                                <div class="item form-group">
                                    <label for="password" class="control-label col-md-3">Password</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password"  id="password_add" name="password" placeholder="Password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                                    </div>
                                </div>
                              
                                <div class="item form-group">
                                    <label for="repassword" class="control-label col-md-3">Confirm Password</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="password" id="repassword_add" name="repassword" placeholder="Confirmation Password" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                                    </div>
                                </div>
                              
                                <div class="item form-group">
                                    <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group">
                                              <input type="file" id="foto_add" name="foto">
                                        </div>
                                    </div>
                                </div>
                              
                                <div class="item form-group">
                                    <label class="radio-inline" for="status">Status</label>
                                    <div>
                                        <label class="radio-inline" >
                                            <input type="radio" name="status_option" value="enabled" checked> Enable
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="status_option" value="disabled"> Disable
                                        </label>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="button" class="btn btn-success add" data-dismiss="modal" onclick="test()">
                                        <span class='glyphicon glyphicon-check'></span> Add
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
                                    <label class="control-label col-sm-2" for="nama">Nama:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="jabatan">Jabatan:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="jabatan_show" cols="40" rows="5" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Email:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="status">Status:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="status_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="password">Password:</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password_show" disabled>
                                    </div>
                                </div>
                               
                                <div class="item form-group">
                                  <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            
                                            <label class="btn btn-default btn-file">
                                              <input type="file" id="foto_add">
                                            </label>
                                            
                                              
                                        </div>
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
                                    <label class="control-label col-sm-2" for="nama">Nama:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_edit" autofocus>
                                        <p class="errorTitle text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="jabatan">Jabatan:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="jabatan_edit" cols="40" rows="5">
                                        <p class="errorContent text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Email:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="email_edit" autofocus>
                                        <p class="errorTitle text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="status">Status:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="status_edit" autofocus>
                                        <p class="errorTitle text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="password">Password:</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password_edit" autofocus>
                                        <p class="errorTitle text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                            
                                <div class="item form-group">
                                  <label for="image" class="control-label col-md-3 col-sm-3 col-xs-12">Image</label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group">
                                            
                                            <label class="btn btn-default btn-file">
                                              <input type="file" id="foto_add">
                                            </label>
                                            
                                              
                                        </div>
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
            <script src="{{ asset("ajax/js/jquery.min.js") }}"></script>
            <script src="{{ asset("ajax/js/jquery2.min.js") }}"></script>
            <script src="{{ asset("ajax/js/jquery-2.2.4.js") }}"></script>

            <!-- Bootstrap JavaScript -->
            <script src="{{ asset("ajax/js/bootstrap.min.js") }}"></script>


            <!-- toastr notifications -->
            <script type="text/javascript" src="{{ asset("toastr/toastr.min.js") }}"></script>
            

            <!-- icheck checkboxes -->
            <script type="text/javascript" src="{{ asset("icheck/icheck.min.js") }}"></script><!-- jQuery -->
            <script src="{{ asset("ajax/js/jquery.min.js") }}"></script>
            <script src="{{ asset("ajax/js/jquery2.min.js") }}"></script>
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
            $('#postTable').removeAttr('style');
        })
    </script>

    <!-- AJAX CRUD operations -->
    <script type="text/javascript">
        function test(){
            parent.window.location.href = '{{ url('user')}}';
        }
        // add a new post
        $(document).on('click', '.add-modal', function() {
            $('.modal-title').text('Add');
            $('#addModal').modal('show');
        });

        $('.modal-footer').on('click', '.add', function() {
            var fd = new FormData();
            var file_data = $('input[type="file"]')[0].files; // for multiple files
            for(var i = 0;i<file_data.length;i++){
                fd.append("photo", file_data[i]);
            }
            var other_data = $('#test-add').serializeArray();
            $.each(other_data,function(key,input){
                fd.append(input.name,input.value);
            });

            $.ajax({
                url: 'user',
                type:'post',
                processData: false,
                dataType:'json',
                contentType:false,
                async: true,
                data: fd, 
                headers: {
                    'X-CSRF-TOKEN': '{!! csrf_field() !!}'
                },
                success: function(data) {
                    $('.errorNama').addClass('hidden');
                    $('.errorJabatan').addClass('hidden');
                    $('.errorEmail').addClass('hidden');
                    $('.errorStatus').addClass('hidden');
                    $('.errorPassword').addClass('hidden');
                    $('.errorRepassword').addClass('hidden');
                    $('.errorRole').addClass('hidden');
                    $('.errorFoto').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.nama) {
                            $('.errorNama').removeClass('hidden');
                            $('.errorNama').text(data.errors.nama);
                        }
                        if (data.errors.jabatan) {
                            $('.errorJabatan').removeClass('hidden');
                            $('.errorJabatan').text(data.errors.jabatan);
                        }
                        if (data.errors.email) {
                            $('.errorEmail').removeClass('hidden');
                            $('.errorEmail').text(data.errors.email);
                        }
                        if (data.errors.status) {
                            $('.errorStatus').removeClass('hidden');
                            $('.errorStatus').text(data.errors.status);
                        }
                        if (data.errors.password) {
                            $('.errorPassword').removeClass('hidden');
                            $('.errorPassword').text(data.errors.password);
                        }
                        if (data.errors.repassword) {
                            $('.errorRepassword').removeClass('hidden');
                            $('.errorRepassword').text(data.errors.repassword);
                        }
                        if (data.errors.role) {
                            $('.errorRole').removeClass('hidden');
                            $('.errorRole').text(data.errors.role);
                        }
                        if (data.errors.foto) {
                            $('.errorFoto').removeClass('hidden');
                            $('.errorFoto').text(data.errors.foto);
                        }
                    } else {
                        toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 500});
                        // $('#postTable').append("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.nama + "</td><td>" + data.jabatan + "</td><td>" + data.email + "</td><td>" + data.status + "</td><td>" + data.password + "</td><td>" + data.repassword + "</td><td>" + data.role + "</td><td>" + data.foto + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-nama='" + data.nama + "' data-jabatan='" + data.jabatan + "' data-email='" + data.email + "' data-password='" + data.password + "' data-repassword='" + data.repassword + "' data-role='" + data.role + "' data-status='" + data.status + "' data-foto='" + data.foto + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-nama='" + data.nama + "' data-jabatan='" + data.jabatan + "' data-email='" + data.email + "' data-password='" + data.password + "' data-repassword='" + data.repassword + "' data-role='" + data.role + "' data-status='" + data.status + "' data-foto='" + data.foto + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-nama='" + data.nama + "' data-jabatan='" + data.jabatan + "' data-email='" + data.email + "' data-password='" + data.password + "' data-repassword='" + data.repassword + "' data-role='" + data.role + "' data-status='" + data.status + "' data-foto='" + data.foto + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                    }
                },
            });
        });

                // Show a post
        $(document).on('click', '.show-modal', function() {
                    $('.modal-title').text('Show');
                    $('#id_show').val($(this).data('id'));
                    $('#nama_show').val($(this).data('nama'));
                    $('#jabatan_show').val($(this).data('jabatan'));
                    $('#email_show').val($(this).data('email'));
                    $('#status_show').val($(this).data('status'));
                    $('#password_show').val($(this).data('password'));
                    $('#repassword_show').val($(this).data('repassword'));
                    $('#role_show').val($(this).data('role'));
                    $('#foto_show').val($(this).data('foto'));
                    $('#showModal').modal('show');
        });


                 // Edit a post
        $(document).on('click', '.edit-modal', function() {
            $('.modal-title').text('Edit');
            $('#id_edit').val($(this).data('id'));
            $('#nama_edit').val($(this).data('nama'));
            $('#jabatan_edit').val($(this).data('jabatan'));
            $('#email_edit').val($(this).data('email'));
            $('#status_edit').val($(this).data('status'));
            $('#password_edit').val($(this).data('password'));
            $('#repassword_show').val($(this).data('repassword'));
            $('#role_show').val($(this).data('role'));
            $('#foto_edit').val($(this).data('foto'));
            id = $('#id_edit').val();
            $('#editModal').modal('show');
        });

        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: 'user/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit").val(),
                    'nama': $('#nama_edit').val(),
                    'jabatan': $('#jabatan_edit').val(),
                    'email': $('#email_edit').val(),
                    'status' : $('input[name=status_option]:checked').val(),
                    'password': $('#password_edit').val(),
                    'repassword': $('#repassword_add').val(),
                    'role': $('#role_add').val(),
                    'foto': $('#foto_edit').val()
                },
                success: function(data) {
                    $('.errorNama').addClass('hidden');
                    $('.errorJabatan').addClass('hidden');
                    $('.errorEmail').addClass('hidden');
                    $('.errorStatus').addClass('hidden');
                    $('.errorPassword').addClass('hidden');
                    $('.errorRepassword').addClass('hidden');
                    $('.errorRole').addClass('hidden');
                    $('.errorFoto').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.nama) {
                            $('.errorNama').removeClass('hidden');
                            $('.errorTitle').text(data.errors.nama);
                        }
                        if (data.errors.jabatan) {
                            $('.errorJabatan').removeClass('hidden');
                            $('.errorJabatan').text(data.errors.jabatan);
                        }
                        if (data.errors.email) {
                            $('.errorEmail').removeClass('hidden');
                            $('.errorEmail').text(data.errors.email);
                        }
                        if (data.errors.status) {
                            $('.errorStatus').removeClass('hidden');
                            $('.errorStatus').text(data.errors.status);
                        }
                        if (data.errors.password) {
                            $('.errorPassword').removeClass('hidden');
                            $('.errorPassword').text(data.errors.password);
                        }
                        if (data.errors.repassword) {
                            $('.errorRepassword').removeClass('hidden');
                            $('.errorRepassword').text(data.errors.repassword);
                        }
                        if (data.errors.role) {
                            $('.errorRole').removeClass('hidden');
                            $('.errorRole').text(data.errors.role);
                        }
                        if (data.errors.foto) {
                            $('.errorFoto').removeClass('hidden');
                            $('.errorFoto').text(data.errors.foto);
                        }
                    } else {
                        toastr.success('Successfully updated Post!', 'Success Alert', {timeOut: 5000});
                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.nama + "</td><td>" + data.jabatan + "</td><td>" + data.email + "</td><td>" + data.status + "</td><td>" + data.password + "</td><td>" + data.foto + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-nama='" + data.nama + "' data-jabatan='" + data.jabatan + "' data-email='" + data.email + "' data-password='" + data.password + "' data-repassword='" + data.repassword + "' data-role='" + data.role + "' data-status='" + data.status + "' data-foto='" + data.foto + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-nama='" + data.nama + "' data-jabatan='" + data.jabatan + "' data-email='" + data.email + "' data-password='" + data.password + "' data-repassword='" + data.repassword + "' data-role='" + data.role + "' data-status='" + data.status + "' data-foto='" + data.foto + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-nama='" + data.nama + "' data-jabatan='" + data.jabatan + "' data-email='" + data.email + "' data-password='" + data.password + "' data-repassword='" + data.repassword + "' data-role='" + data.role + "' data-status='" + data.status + "' data-foto='" + data.foto + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }

                    window.location = '{{ url('user') }}';
                    // location.reload();
                }
            });
        });
                
                // delete a post
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
                url: 'user/' + id,
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