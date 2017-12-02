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

    <title>Kategori</title>
    
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
                <h2 class="text-center">Manage Kategori</h2>
                <br />
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul>
                            <li><i class="fa fa-file-text-o"></i> All the current Kategori</li>
                            <a href="#" class="add-modal"><li>Add Kategori</li></a>
                        </ul>
                    </div>
                
                    <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover" id="kategoriTable" style="visibility: hidden;">
                                <thead>
                                    <tr>
                                        <th valign="middle">#</th>
                                        <th>Kategori</th>
                                        <th>Jumlah Produk</th>                                                                               
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                    {{ csrf_field() }}
                                </thead>
                                <tbody>
                                    @foreach($kategoris as $indexKey => $kategori)
                                        <tr class="item{{$kategori->id}} @if($kategori->enabled) warning @endif">
                                            <td class="col1">{{ $indexKey+1 }}</td>
                                            <td>{{$kategori->kategori}}</td>
                                            <td>{{$kategori->jumlah_produk}}</td>
                                            <td>{{$kategori->status}}</td>
                                            <td>
                                                <button class="show-modal btn btn-success" data-id="{{$kategori->id}}" data-kategori="{{$kategori->kategori}}" data-jumlah_produk="{{$kategori->jumlah_produk}}" data-status="{{$kategori->status}}">
                                                <span class="glyphicon glyphicon-eye-open"></span> Show</button>
                                                <button class="edit-modal btn btn-info" data-id="{{$kategori->id}}" data-kategori="{{$kategori->kategori}}" data-jumlah_produk="{{$kategori->jumlah_produk}}" data-status="{{$kategori->status}}">
                                                <span class="glyphicon glyphicon-edit"></span> Edit</button>
                                                <button class="delete-modal btn btn-danger" data-id="{{$kategori->id}}" data-kategori="{{$kategori->kategori}}" data-jumlah_produk="{{$kategori->jumlah_produk}}" data-status="{{$kategori->status}}">
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
                            <form action="{{ url('kategoris') }}" class="form-horizontal form-label-left" role="form">
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kategori">Kategori<span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="kategori_add" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="kategori" required="required">
                                </div>
                            </div>
                            <div class="item form-group">
                            <label class="control-label col-md-3 col-sm-3 col-xs-12" for="jumlah_produk">Jumlah Produk<span class="required"></span>
                            </label>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <input type="text" id="jumlah_produk_add" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="jumlah_produk" required="required">
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
                                    <span id="" class='glyphicon glyphicon-check'></span> Add New Category
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
                                <form action="{{ url('kategoris') }}" class="form-horizontal form-label-left" role="form">
                                
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="kategori">Kategori:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kategori_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="jumlah_produk">Jumlah Produk:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="jumlah_produk_show" disabled>
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
                                    <label class="control-label col-sm-2" for="kategori">Kategori</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kategori_edit" autofocus>
                                        <p class="errorTitle text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="jumlah_produk">Jumlah Produk</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="jumlah_produk_edit" autofocus>
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
                            <h3 class="text-center">Are you sure you want to delete ?</h3>
                            <br />
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="id">ID:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="id_delete" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="kategori">Kategori</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="kategori_delete" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="jumlah_produk">Jumlah Produk</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="jumlah_produk_delete" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="status">Status</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="status_delete" disabled>
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
            $('#kategoriTable').removeAttr('style');
        })
    </script>

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
                url: 'kategoris',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'kategori': $('#kategori_add').val(),
                    'jumlah_produk': $('#jumlah_produk_add').val(),
                    'status' : $('input[name=status_option]:checked').val()
                    
                },
                success: function(data) {
                    $('.errorKategori').addClass('hidden');
                    $('.errorJumlah_produk').addClass('hidden');
                    $('.errorStatus').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.kategori) {
                            $('.errorKategori').removeClass('hidden');
                            $('.errorKategori').text(data.errors.kategori);
                        }
                        if (data.errors.jumlah_produk) {
                            $('.errorJumlah_produk').removeClass('hidden');
                            $('.errorJumlah_produk').text(data.errors.jumlah_produk);
                        }
                        if (data.errors.status) {
                            $('.errorStatus').removeClass('hidden');
                            $('.errorStatus').text(data.errors.status);
                        }
                       
                    } else {
                        toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
                        $('#kategoriTable').append("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.kategori + "</td><td>" + data.jumlah_produk + "</td><td>" + data.status + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-kategori='" + data.kategori +"' data-jumlah_produk='" + data.jumlah_produk  + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id +"' data-kategori='" + data.kategori +"' data-jumlah_produk='" + data.jumlah_produk  + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-kategori='" + data.kategori +"' data-jumlah_produk='" + data.jumlah_produk +  "' data-status='" + data.status + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
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
                    $('#kategori_show').val($(this).data('kategori'));
                    $('#jumlah_produk_show').val($(this).data('jumlah_produk'));
                    $('#status_show').val($(this).data('status'));
                    $('#showModal').modal('show');
                });


                 // Edit a post
                $(document).on('click', '.edit-modal', function() {
                    $('.modal-title').text('Edit');
                    $('#id_edit').val($(this).data('id'));
                    $('#kategori_edit').val($(this).data('kategori'));
                    $('#jumlah_produk_edit').val($(this).data('jumlah_produk'));
                    $('#status_edit').val($(this).data('status'));
                    id = $('#id_edit').val();
                    $('#editModal').modal('show');
                });

        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: 'kategoris/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit").val(),
                    'kategori': $('#kategori_edit').val(),
                    'jumlah_produk': $('#jumlah_produk_edit').val(),
                    'status' : $('input[name=status_option]:checked').val()
                },
                success: function(data) {
                    $('.errorKategori').addClass('hidden');
                    $('.errorJumlah_produk').addClass('hidden');
                    $('.errorStatus').addClass('hidden');
                    

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.kategori) {
                            $('.errorKategori').removeClass('hidden');
                            $('.errorKategori').text(data.errors.kategori);
                        }
                        if (data.errors.jumlah_produk) {
                            $('.errorJumlah_produk').removeClass('hidden');
                            $('.errorJumlah_produk').text(data.errors.jumlah_produk);
                        }
                        if (data.errors.status) {
                            $('.errorStatus').removeClass('hidden');
                            $('.errorStatus').text(data.errors.status);
                        }
                    } else {
                        toastr.success('Successfully updated Post!', 'Success Alert', {timeOut: 5000});
                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.kategori + "</td><td>" + data.jumlah_produk + "</td><td>" + data.status + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id +"' data-kategori='" + data.kategori +"' data-jumlah_produk='" + data.jumlah_produk+ "' data-status='" + data.status + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-kategori='" + data.kategori + "' data-jumlah_produk='" + data.jumlah_produk + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id +"' data-kategori='" + data.kategori +"' data-jumlah_produk='" + data.jumlah_produk + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

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
                    $('#kategori_delete').val($(this).data('kategori'));
                    $('#jumlah_produk_delete').val($(this).data('jumlah_produk'));
                    $('#status_delete').val($(this).data('status'));
                    $('#deleteModal').modal('show');
                    id = $('#id_delete').val();
                });
                $('.modal-footer').on('click', '.delete', function() {
                    $.ajax({
                        type: 'DELETE',
                        url: 'kategoris/' + id,
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