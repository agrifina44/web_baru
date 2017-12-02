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

    <title>Gudang</title>
    
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
                <h2 class="text-center">Manage  Gudang</h2>
                <br />
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul>
                            <li><i class="fa fa-file-text-o"></i> All the current Posts</li>
                            <a href="#" class="add-modal"><li>Add a gudang</li></a>
                        </ul>
                    </div>
                
                    <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover" id="gudangTable" style="visibility: hidden;">
                                <thead>
                                    <tr>
                                        <th valign="middle">#</th>
                                        <th>Nama Gudang</th>
                                        <th>Contact Person</th>
                                        <th>Nomor HP</th>
                                        <th>Alamat</th>
                                        <th>Provinsi</th>
                                        <th>Kota</th>
                                        <th>Status</th>                                   
                                        <th>Actions</th>
                                    </tr>
                                    {{ csrf_field() }}
                                </thead>
                                <tbody>
                                    @foreach($gudangs as $indexKey => $gudang)
                                        <tr class="item{{$gudang->id}} @if($gudang->enabled) warning @endif">
                                            <td class="col1">{{ $indexKey+1 }}</td>
                                            <td>{{$gudang->nama_gudang}}</td>
                                            <td>{{$gudang->contact_person}}</td>
                                            <td>{{$gudang->no_hp}}</td>
                                            <td>{{$gudang->alamat}}</td>
                                            <td>{{$gudang->provinsi}}</td>
                                            <td>{{$gudang->kota}}</td>
                                            <td>{{$gudang->status}}</td>
                                            <td>
                                                <button class="show-modal btn btn-success" data-id="{{$gudang->id}}" data-nama_gudang="{{$gudang->nama_gudang}}" data-contact_person="{{$gudang->contact_person}}" data-no_hp="{{$gudang->no_hp}}" data-alamat="{{$gudang->alamat}}" data-provinsi="{{$gudang->provinsi}}" data-kota="{{$gudang->kota}}" data-status="{{$gudang->status}}">
                                                <span class="glyphicon glyphicon-eye-open"></span> Show</button>

                                                <button class="edit-modal btn btn-info" data-id="{{$gudang->id}}" data-nama_gudang="{{$gudang->nama_gudang}}" data-contact_person="{{$gudang->contact_person}}" data-no_hp="{{$gudang->no_hp}}" data-alamat="{{$gudang->alamat}}" data-provinsi="{{$gudang->provinsi}}" data-kota="{{$gudang->kota}}" data-status="{{$gudang->status}}">
                                                <span class="glyphicon glyphicon-edit"></span> Edit</button>
                                                
                                                <button class="delete-modal btn btn-danger" data-id="{{$gudang->id}}" data-nama_gudang="{{$gudang->nama_gudang}}" data-contact_person="{{$gudang->contact_person}}" data-no_hp="{{$gudang->no_hp}}" data-alamat="{{$gudang->alamat}}" data-provinsi="{{$gudang->provinsi}}" data-kota="{{$gudang->kota}}" data-status="{{$gudang->status}}">
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
                            <form action="{{ url('posts') }}" class="form-horizontal form-label-left" role="form">
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_gudang">Nama Gudang <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="nama_gudang_add" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Nama Gudang" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact_person">Contact Person <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="contact_person_add" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Contact Person" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_hp">No HP<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="no_hp_add" required="required" placeholder="No HP" class="form-control col-md-7 col-xs-12">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label for="alamat" class="control-label col-md-3">Alamat</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input  id="alamat_add" placeholder="Alamat" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="provinsi">Provinsi<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="provinsi_add" required="required" placeholder="Provinsi" class="form-control col-md-7 col-xs-12">

                                  <option value = "Sumatera Utara">Sumatera Utara</option>
                                  <option value = "Sumatera Barat">Sumatera Barat</option>
                                  <option value = "Sumatera Selatan">Sumatera Selatan</option>
                                  <option value = "Jawa Timur">Jawa Timur</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kota">Kota<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="kota_add" required="required" placeholder="Kota" class="form-control col-md-7 col-xs-12">

                                  <option value = "Medan">Medan</option>
                                  <option value = "Padang">Padang</option>
                                  <option value = "Palembang">Palembang</option>
                                  <option value = "Surabaya">Surabaya</option>
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
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">ID:</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control" id="id_show" disabled>
                                    </div>
                                </div>
                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama_gudang">Nama Gudang <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="nama_gudang_show" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Nama Gudang" required="required" disabled>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="contact_person">Contact Person <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="contact_person_show" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Contact Person" required="required" disabled>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_hp">No HP<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="no_hp_show" required="required" placeholder="no_hp" class="form-control col-md-7 col-xs-12" disabled>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label for="alamat" class="control-label col-md-3">Alamat</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input  id="alamat_show" placeholder="Alamat" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required" disabled>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label for="provinsi" class="control-label col-md-3">Provinsi</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input  id="provinsi_show" placeholder="provinsi" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required" disabled>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label for="kota" class="control-label col-md-3">Kota</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input  id="kota_show" placeholder="kota" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required" disabled>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label for="status" class="control-label col-md-3">Status</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input  id="status_show" placeholder="status" data-validate-length="6,8" class="form-control col-md-7 col-xs-12" required="required" disabled>
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
                                    <label class="control-label col-sm-2" for="nama_gudang">nama_gudang:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_gudang_edit" autofocus>
                                        <p class="errorNamaGudang text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="contact_person">Contast Person:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="contact_person_edit" cols="40" rows="5">
                                        <p class="errorContactPerson text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="no_hp">No HP:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="no_hp_edit" autofocus>
                                        <p class="errorNoHp text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="alamat">Alamat:</label>
                                    <div class="col-sm-10">
                                        <input type="alamat" class="form-control" id="alamat_edit" autofocus>
                                        <p class="errorAlamat text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                <div class="item form-group">
                                <label class="control-label col-sm-2" for="provinsi">Provinsi<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="provinsi_edit" required="required" placeholder="Provinsi" class="form-control col-md-7 col-xs-12">

                                  <option value = "Sumatera Utara">Sumatera Utara</option>
                                  <option value = "Sumatera Barat">Sumatera Barat</option>
                                  <option value = "Sumatera Selatan">Sumatera Selatan</option>
                                  <option value = "Jawa Timur">Jawa Timur</option>
                                  </select>
                                  <p class="errorProvinsi text-center alert alert-danger hidden"></p>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-sm-2" for="kota">Kota<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="kota_edit" required="required" placeholder="Kota" class="form-control col-md-7 col-xs-12">

                                  <option value = "Medan">Medan</option>
                                  <option value = "Padang">Padang</option>
                                  <option value = "Palembang">Palembang</option>
                                  <option value = "Surabaya">Surabaya</option>
                                  </select>
                                  <p class="errorKota text-center alert alert-danger hidden"></p>
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
                                    <label class="control-label col-sm-2" for="nama_gudang">Nama Gudang:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="nama_gudang_delete" disabled>
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
            $('#gudangTable').removeAttr('style');
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
                url: 'gudang',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'nama_gudang': $('#nama_gudang_add').val(),
                    'contact_person': $('#contact_person_add').val(),
                    'no_hp': $('#no_hp_add').val(),
                    'alamat': $('#alamat_add').val(),
                    'provinsi': $('#provinsi_add').val(),
                    'kota': $('#kota_add').val(),
                    'status' : $('input[name=status_option]:checked').val(),
                    'foto': $('#foto_add').val()
                },
                success: function(data) {
                    $('.errorNamaGudang').addClass('hidden');
                    $('.errorContactPerson').addClass('hidden');
                    $('.errorNoHp').addClass('hidden');
                    $('.errorAlamat').addClass('hidden');
                    $('.errorProvinsi').addClass('hidden');
                    $('.errorKota').addClass('hidden');
                    $('.errorStatus').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.nama_gudang) {
                            $('.errorNamaGudang').removeClass('hidden');
                            $('.errorNamaGudang').text(data.errors.nama_gudang);
                        }
                        if (data.errors.contact_person) {
                            $('.errorContactPerson').removeClass('hidden');
                            $('.errorContactPerson').text(data.errors.contact_person);
                        }
                        if (data.errors.no_hp) {
                            $('.errorNoHp').removeClass('hidden');
                            $('.errorNoHp').text(data.errors.no_hp);
                        }
                        if (data.errors.alamat) {
                            $('.errorAlamat').removeClass('hidden');
                            $('.errorAlamat').text(data.errors.alamat);
                        }
                        if (data.errors.provinsi) {
                            $('.errorProvinsi').removeClass('hidden');
                            $('.errorProvinsi').text(data.errors.provinsi);
                        }
                        if (data.errors.kota) {
                            $('.errorKota').removeClass('hidden');
                            $('.errorKota').text(data.errors.kota);
                        }
                        if (data.errors.status) {
                            $('.errorStatus').removeClass('hidden');
                            $('.errorStatus').text(data.errors.status);
                        }
                        if (data.errors.foto) {
                            $('.errorFoto').removeClass('hidden');
                            $('.errorFoto').text(data.errors.foto);
                        }
                    } else {
                        toastr.success('Successfully added Post!', 'Success Alert', {timeOut: 5000});
                        $('#gudangTable').append("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.nama_gudang + "</td><td>" + data.contact_person + "</td><td>" + data.no_hp + "</td><td>" + data.alamat + "</td><td>"+ data.provinsi + "</td><td>" + data.kota + "</td><td>" + data.status + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-nama_gudang='" + data.nama_gudang + "' data-contact_person='" + data.contact_person + "' data-no_hp='" + data.no_hp + "' data-alamat='" + data.alamat + "' data-provinsi='" + data.provinsi + "' data-kota='" + data.kota + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-nama_gudang='" + data.nama_gudang + "' data-contact_person='" + data.contact_person + "' data-no_hp='" + data.no_hp + "' data-alamat='" + data.alamat + "' data-provinsi='" + data.provinsi + "' data-kota='" + data.kota + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-nama_gudang='" + data.nama_gudang + "' data-contact_person='" + data.contact_person + "' data-no_hp='" + data.no_hp + "' data-alamat='" + data.alamat + "' data-provinsi='" + data.provinsi + "' data-kota='" + data.kota + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
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
                    $('#nama_gudang_show').val($(this).data('nama_gudang'));
                    $('#contact_person_show').val($(this).data('contact_person'));
                    $('#no_hp_show').val($(this).data('no_hp'));
                    $('#alamat_show').val($(this).data('alamat'));
                    $('#provinsi_show').val($(this).data('provinsi'));
                    $('#kota_show').val($(this).data('kota'));
                    $('#status_show').val($(this).data('status'));
                    $('#showModal').modal('show');
                });


                 // Edit a post
        $(document).on('click', '.edit-modal', function() {
            $('.modal-title').text('Edit');
            $('#id_edit').val($(this).data('id'));
            $('#nama_gudang_edit').val($(this).data('nama_gudang'));
            $('#contact_person_edit').val($(this).data('contact_person'));
            $('#no_hp_edit').val($(this).data('no_hp'));
            $('#alamat_edit').val($(this).data('alamat'));
            $('#provinsi_edit').val($(this).data('provinsi'));
            $('#kota_edit').val($(this).data('kota'));
            $('#status_edit').val($(this).data('status'));
            id = $('#id_edit').val();
            $('#editModal').modal('show');
        });
        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: 'gudang/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit").val(),
                    'nama_gudang': $('#nama_gudang_edit').val(),
                    'contact_person': $('#contact_person_edit').val(),
                    'no_hp': $('#no_hp_edit').val(),
                    'alamat': $('#alamat_edit').val(),
                    'provinsi': $('#provinsi_edit').val(),
                    'kota': $('#kota_edit').val(),
                    'status' : $('input[name=status_option]:checked').val()
                },
                success: function(data) {
                    $('.errorNamaGudang').addClass('hidden');
                    $('.errorContactPerson').addClass('hidden');
                    $('.errorNoHp').addClass('hidden');
                    $('.errorAlamat').addClass('hidden');
                    $('.errorProvinsi').addClass('hidden');
                    $('.errorKota').addClass('hidden');
                    $('.errorStatus').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.nama_gudang) {
                            $('.errorNamaGudang').removeClass('hidden');
                            $('.errorNamaGudang').text(data.errors.nama_gudang);
                        }
                        if (data.errors.contact_person) {
                            $('.errorContactPerson').removeClass('hidden');
                            $('.errorContactPerson').text(data.errors.contact_person);
                        }
                        if (data.errors.no_hp) {
                            $('.errorNoHp').removeClass('hidden');
                            $('.errorNoHp').text(data.errors.no_hp);
                        }
                        if (data.errors.alamat) {
                            $('.errorAlamat').removeClass('hidden');
                            $('.errorAlamat').text(data.errors.alamat);
                        }
                        if (data.errors.provinsi) {
                            $('.errorProvinsi').removeClass('hidden');
                            $('.errorProvinsi').text(data.errors.provinsi);
                        }
                        if (data.errors.kota) {
                            $('.errorKota').removeClass('hidden');
                            $('.errorKota').text(data.errors.kota);
                        }
                        if (data.errors.status) {
                            $('.errorStatus').removeClass('hidden');
                            $('.errorStatus').text(data.errors.status);
                        }
                        if (data.errors.foto) {
                            $('.errorFoto').removeClass('hidden');
                            $('.errorFoto').text(data.errors.foto);
                        }
                    } else {
                        toastr.success('Successfully updated Post!', 'Success Alert', {timeOut: 5000});
                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.nama_gudang + "</td><td>" + data.contact_person + "</td><td>" + data.no_hp + "</td><td>" + data.alamat + "</td><td>"+ data.provinsi + "</td><td>" + data.kota + "</td><td>" + data.status + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-nama_gudang='" + data.nama_gudang + "' data-contact_person='" + data.contact_person + "' data-no_hp='" + data.no_hp + "' data-alamat='" + data.alamat + "' data-provinsi='" + data.provinsi + "' data-kota='" + data.kota + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-nama_gudang='" + data.nama_gudang + "' data-contact_person='" + data.contact_person + "' data-no_hp='" + data.no_hp + "' data-alamat='" + data.alamat + "' data-provinsi='" + data.provinsi + "' data-kota='" + data.kota + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-nama_gudang='" + data.nama_gudang + "' data-contact_person='" + data.contact_person + "' data-no_hp='" + data.no_hp + "' data-alamat='" + data.alamat + "' data-provinsi='" + data.provinsi + "' data-kota='" + data.kota + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

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
                    $('#nama_gudang_delete').val($(this).data('nama_gudang'));
                    $('#deleteModal').modal('show');
                    id = $('#id_delete').val();
                });
                $('.modal-footer').on('click', '.delete', function() {
                    $.ajax({
                        type: 'DELETE',
                        url: 'gudang/' + id,
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