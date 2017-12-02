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

	<title>Supplier</title>

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
					<h2 class="text-center"> Manage Supplier </h2>
					<br/>
					<div class="panel panel-default">
						<div class="panel-heading">
							<ul>
								<li><i class="fa fa-file-text-o"></i>All the current Suppliers</li>
								<a href="#" class="add-modal"><li>Add a supplier</li></a>
							</ul>
						</div>

						<div class="panel-body">
							<table class="table table-striped table-bordered table-hover" id="supplierTable" style="visibility: hidden;">
								<thead>
									<tr>
										<th valign="middle">#</th>
										<th>Supplier</th>
										<th>Contak Person</th>
                                        <th>No. Telp/HP</th>
                                        <th>Alamat</th>
                                        <th>Provinsi</th>
                                        <th>Kabupaten</th>
										<th>Tipe</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
									{{ csrf_field() }}
								</thead>
								<tbody>
									@foreach($suppliers as $indexKey => $supplier)
									<tr class="item{{$supplier->id}} @if($supplier->enabled) warning @endif">
										<td class="col1">{{$indexKey+1}}</td>
										<td>{{$supplier->nama}}</td>
										<td>{{$supplier->ktkPerson}}</td>
                                        <td>{{$supplier->no_hp}}</td>
                                        <td>{{$supplier->alamat}}</td>
                                        <td>{{$supplier->provinsi}}</td>
                                        <td>{{$supplier->kabupaten}}</td>
										<td>{{$supplier->tipe}}</td>
										<td>{{$supplier->status}}</td>
										<td>
											<button class="show-modal btn btn-success" data-id="{{$supplier->id}}" data-nama="{{$supplier->nama}}" data-ktkPerson="{{$supplier->ktkPerson}}" data-no_hp="{{$supplier->no_hp}}" data-alamat="{{$supplier->alamat}}" data-provinsi="{{$supplier->provinsi}}" data-kabupaten="{{$supplier->kabupaten}}" data-tipe="{{$supplier->tipe}}" data-status="{{$supplier->status}}">
											<span class="glyphicon glyphicon-eye-open"></span>Show </button>
											<button class="edit-modal btn btn-info" data-id="{{$supplier->id}}" data-nama="{{$supplier->nama}}" data-ktkPerson="{{$supplier->ktkPerson}}" data-no_hp="{{$supplier->no_hp}}" data-alamat="{{$supplier->alamat}}" data-provinsi="{{$supplier->provinsi}}" data-kabupaten="{{$supplier->kabupaten}}" data-tipe="{{$supplier->tipe}}" data-status="{{$supplier->status}}">
											<span class="glyphicon glyphicon-edit"></span>Edit</button>
											<button class="delete-modal btn btn-danger" data-id="{{$supplier->id}}" data-nama="{{$supplier->nama}}" data-ktkPerson="{{$supplier->ktkPerson}}" data-no_hp="{{$supplier->no_hp}}" data-alamat="{{$supplier->alamat}}" data-provinsi="{{$supplier->provinsi}}" data-kabupaten="{{$supplier->kabupaten}}" data-tipe="{{$supplier->tipe}}" data-status="{{$supplier->status}}">
											<span class="glyphicon glyphicon-trash"></span>Delete</button>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							
						</div> <!-- panel-body -->
						
					</div><!-- panel panel-default -->
				</div> <!-- /.col-md-8 -->

				<!-- Modal form to add a supplier -->
				<div id="addModal" class="modal fade" role="dialog">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h4 class="modal-title"></h4>
							</div>

							<div class="modal-body">
                            <form class="form-horizontal form-label-left" role="form">
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="nama">Nama Supplier <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="nama_add" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Nama Supplier" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ktkPerson">Contact Person <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="ktkPerson_add" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Contact Person" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="no_hp">No. Telp/HP <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="no_hp_add" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="No. Telp/HP" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alamat">Alamat <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col   -xs-12">
                                  <textarea type="text" id="alamat_add" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="alamat" required="required"></textarea>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="provinsi">Provinsi <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="provinsi_add" required="required" placeholder="provinsi" class="form-control col-md-7 col-xs-12">
                                     
                                      <option value="sumut">Sumatera Utara</option>
                                        <option value="sumteng">Sumatera Tengah</option>
                                        <option value="sumbar">Sumatera Barat</option>
                                        <option value="sumtim">Sumatera Timur</option>
                                        <option value="sumsel">Sumatera Selatan</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kabupaten">Kota/Kabupaten <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="kabupaten_add" required="required" placeholder="Kota/Kabupaten" class="form-control col-md-7 col-xs-12">    
                                  <option value="taput">Tapanuli Utara</option>
                                        <option value="tapteng">Tapanuli Tengah</option>
                                        <option value="tapbar">Tapanuli Barat</option>
                                        <option value="taptim">Tapanuli Timur</option>
                                        <option value="tapsel">Tapanuli Selatan</option> 
                                     
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipe">Tipe<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="tipe_add" required="required" placeholder="Tipe" class="form-control col-md-7 col-xs-12">
                                      <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                        <option value="e">E</option>
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

				<!-- Modal form to show a supplier -->
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
                                    <label class="control-label col-sm-2" for="ktkPerson">Contact Person:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ktkPerson_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="no_hp">No. Telp/HP:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="no_hp_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="alamat">Alamat:</label>
                                    <div class="col-sm-10">
                                        <textarea type="text" class="form-control" id="alamat_show" disabled></textarea>
                                    </div>
                                </div>
                                <div class="item form-group">
	                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="provinsi">Provinsi <span class="required"></span>
	                                </label>
	                                <div class="col-md-6 col-sm-6 col-xs-12">
	                                  <input type="text" class="form-control" id="provinsi_show" disabled>
	                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kabupaten">Kota/Kabupaten <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" id="kabupaten_show" disabled>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipe">Tipe<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" id="tipe_show" disabled>
                                </div>
                              </div>
                              <div class="item form-group">
                                  <label class="radio-inline" for="status">Status</label>
                                  <div>
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
	                                    <label class="control-label col-sm-2" for="nama">Nama:</label>
	                                    <div class="col-sm-10">
	                                        <input type="text" class="form-control" id="nama_edit" autofocus>
	                                        <p class="errorTitle text-center alert alert-danger hidden"></p>
	                                    </div>
	                                </div>
	                                <div class="form-group">
                                        <label class="control-label col-sm-2" for="ktkPerson">Contact Person:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="ktkPerson_edit" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="no_hp">No. Telp/HP:</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="no_hp_edit" autofocus>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="alamat">Alamat:</label>
                                        <div class="col-sm-10">
                                            <textarea type="text" class="form-control" id="alamat_edit" autofocus></textarea>
                                        </div>
                                    </div>
                                    <div class="item form-group">
    	                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="provinsi">Provinsi <span class="required"></span>
    	                                </label>
    	                                <div class="col-md-6 col-sm-6 col-xs-12">
    	                                  <input type="text" class="form-control" id="provinsi_edit" autofocus>
    	                                </div>
                                  </div>
                                  <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kabupaten">Kota/Kabupaten <span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" class="form-control" id="kabupaten_edit" autofocus>
                                    </div>
                                  </div>
                                  <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tipe">Tipe<span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" class="form-control" id="tipe_edit" autofocus>
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
	                            <h3 class="text-center">Are you sure you want to delete the following supplier?</h3>
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
            <script type="text/javascript" src="{{ asset("icheck/icheck.min.js") }}"></script>

             <!-- Delay table load until everything else is loaded -->
		    <script>
		        $(window).load(function(){
		            $('#supplierTable').removeAttr('style');
		        })
		    </script>

        <script type="text/javascript">
          $(document).ready(function() {
               $(document).on('change','.supplier_add',function() {
                
               })
          });
        </script>

		    <!-- AJAX CRUD operations -->
		    <script type="text/javascript">
		        // add a new supplier
		        $(document).on('click', '.add-modal', function() {
		            $('.modal-title').text('Add');
		            $('#addModal').modal('show');
		        });
		        $('.modal-footer').on('click', '.add', function() {
		            $.ajax({
		                type: 'POST',
		                url: 'suppliers',
		                data: {
		                    '_token': $('input[name=_token]').val(),
		                    'nama': $('#nama_add').val(),
		                    'ktkPerson': $('#ktkPerson_add').val(),
		                    'no_hp': $('#no_hp_add').val(),
		                    'alamat': $('#alamat_add').val(),
		                    'provinsi': $('#provinsi_add').val(),
		                    'kabupaten': $('#kabupaten_add').val(),
		                    'tipe': $('#tipe_add').val(),
		                    'status' : $('input[name=status_option]:checked').val()
		                },
		                success: function(data) {
		                    $('.errorNama').addClass('hidden');
		                    $('.errorKtkPerson').addClass('hidden');
		                    $('.errorNo_hp').addClass('hidden');
		                    $('.errorAlamat').addClass('hidden');
		                    $('.errorProvinsi').addClass('hidden');
		                    $('.errorKabupaten').addClass('hidden');
		                    $('.errorTipe').addClass('hidden');
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
		                        if (data.errors.ktkPerson) {
		                            $('.errorKtkPerson').removeClass('hidden');
		                            $('.errorKtkPerson').text(data.errors.ktkPerson);
		                        }
		                        if (data.errors.no_hp) {
		                            $('.errorNo_hp').removeClass('hidden');
		                            $('.errorNo_hp').text(data.errors.no_hp);
		                        }
		                        if (data.errors.alamat) {
		                            $('.errorAlamat').removeClass('hidden');
		                            $('.errorAlamat').text(data.errors.alamat);
		                        }
		                        if (data.errors.provinsi) {
		                            $('.errorProvinsi').removeClass('hidden');
		                            $('.errorProvinsi').text(data.errors.provinsi);
		                        }
		                        if (data.errors.kabupaten) {
		                            $('.errorKabupaten').removeClass('hidden');
		                            $('.errorKabupaten').text(data.errors.kabupaten);
		                        }
		                        if (data.errors.tipe) {
		                            $('.errorTipe').removeClass('hidden');
		                            $('.errorTipe').text(data.errors.tipe);
		                        }
		                        if (data.errors.status) {
		                            $('.errorStatus').removeClass('hidden');
		                            $('.errorStatus').text(data.errors.status);
		                        }
		                    } else {
		                        toastr.success('Successfully added Supplier!', 'Success Alert', {timeOut: 5000});
		                        $('#supplierTable').append("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.nama + "</td><td>" + data.ktkPerson + "</td><td>" + data.no_hp + "</td><td>" + data.alamat + "</td><td>" + data.provinsi + "</td><td>" + data.kabupaten + "</td><td>" + data.tipe + "</td><td>" + data.status + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-nama='" + data.nama + "' data-ktkPerson='" + data.ktkPerson + "' data-no_hp='" + data.no_hp + "' data-alamat='" + data.alamat + "' data-provinsi='" + data.provinsi + "' data-kabupaten='" + data.kabupaten + "' data-tipe='" + data.tipe + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-nama='" + data.nama + "' data-ktkPerson='" + data.ktkPerson + "' data-no_hp='" + data.no_hp + "' data-alamat='" + data.alamat + "' data-provinsi='" + data.provinsi + "' data-kabupaten='" + data.kabupaten + "' data-tipe='" + data.tipe + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-nama='" + data.nama + "' data-ktkPerson='" + data.ktkPerson + "' data-no_hp='" + data.no_hp + "' data-alamat='" + data.alamat + "' data-provinsi='" + data.provinsi + "' data-kabupaten='" + data.kabupaten + "' data-tipe='" + data.tipe + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                            $('.col1').each(function (index) {
                                $(this).html(index+1);
                            });
		                    }

		                    
		                },
		            });
		        });

		                // Show a supplier
		                $(document).on('click', '.show-modal', function() {
		                    $('.modal-title').text('Show');
		                    $('#id_show').val($(this).data('id'));
		                    $('#nama_show').val($(this).data('nama'));
		                    $('#ktkPerson_show').val($(this).data('ktkPerson'));
		                    $('#no_hp_show').val($(this).data('no_hp'));
		                    $('#alamat_show').val($(this).data('alamat'));
		                    $('#provinsi_show').val($(this).data('provinsi'));
		                    $('#kabupaten_show').val($(this).data('kabupaten'));
		                    $('#tipe_show').val($(this).data('tipe'));
		                    $('#status_show').val($(this).data('status'));
		                    $('#showModal').modal('show');
		                });


		                 // Edit a supplier
		        $(document).on('click', '.edit-modal', function() {
		            $('.modal-title').text('Edit');
		            $('#id_edit').val($(this).data('id'));
		            $('#nama_edit').val($(this).data('nama'));
		            $('#ktkPerson_edit').val($(this).data('ktkPerson'));
		            $('#no_hp_edit').val($(this).data('no_hp'));
		            $('#alamat_edit').val($(this).data('alamat'));
		            $('#provinsi_edit').val($(this).data('provinsi'));
		            $('#kabupaten_edit').val($(this).data('kabupaten'));
		            $('#tipe_edit').val($(this).data('tipe'));
		            $('#status_edit').val($(this).data('status'));
		            id = $('#id_edit').val();
		            $('#editModal').modal('show');
		        });
		        $('.modal-footer').on('click', '.edit', function() {
		            $.ajax({
		                type: 'PUT',
		                url: 'suppliers/' + id,
		                data: {
		                    '_token': $('input[name=_token]').val(),
		                    'id': $("#id_edit").val(),
		                    'nama': $('#nama_edit').val(),
		                    'ktkPerson': $('#ktkPerson_edit').val(),
		                    'no_hp': $('#no_hp_edit').val(),
		                    'alamat': $('#alamat_edit').val(),
		                    'provinsi': $('#provinsi_edit').val(),
		                    'kabupaten': $('#kabupaten_edit').val(),
		                    'tipe': $('#tipe_edit').val(),
		                    'status' : $('input[name=status_option]:checked').val()
		                },
		                success: function(data) {
		                    $('.errorNama').addClass('hidden');
		                    $('.errorKtkPerson').addClass('hidden');
		                    $('.errorNo_hp').addClass('hidden');
		                    $('.errorAlamat').addClass('hidden');
		                    $('.errorProvinsi').addClass('hidden');
		                    $('.errorKabupaten').addClass('hidden');
		                    $('.errorTipe').addClass('hidden');
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
		                        if (data.errors.ktkPerson) {
		                            $('.errorKtkPerson').removeClass('hidden');
		                            $('.errorKtkPerson').text(data.errors.ktkPerson);
		                        }
		                        if (data.errors.no_hp) {
		                            $('.errorNo_hp').removeClass('hidden');
		                            $('.errorNo_hp').text(data.errors.no_hp);
		                        }
		                        if (data.errors.alamat) {
		                            $('.errorAlamat').removeClass('hidden');
		                            $('.errorAlamat').text(data.errors.alamat);
		                        }
		                        if (data.errors.provinsi) {
		                            $('.errorProvinsi').removeClass('hidden');
		                            $('.errorProvinsi').text(data.errors.provinsi);
		                        }
		                        if (data.errors.kabupaten) {
		                            $('.errorKabupaten').removeClass('hidden');
		                            $('.errorKabupaten').text(data.errors.kabupaten);
		                        }
		                        if (data.errors.tipe) {
		                            $('.errorTipe').removeClass('hidden');
		                            $('.errorTipe').text(data.errors.tipe);
		                        }
		                        if (data.errors.status) {
		                            $('.errorStatus').removeClass('hidden');
		                            $('.errorStatus').text(data.errors.status);
		                        }
		                    } else {
		                        toastr.success('Successfully updated Supplier!', 'Success Alert', {timeOut: 5000});
		                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.nama + "</td><td>" + data.ktkPerson + "</td><td>" + data.no_hp + "</td><td>" + data.alamat + "</td><td>" + data.provinsi + "</td><td>" + data.kabupaten + "</td><td>" + data.tipe + "</td><td>" + data.status + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-nama='" + data.nama + "' data-ktkPerson='" + data.ktkPerson + "' data-no_hp='" + data.no_hp + "' data-alamat='" + data.alamat + "' data-provinsi='" + data.provinsi + "' data-kabupaten='" + data.kabupaten + "' data-tipe='" + data.tipe + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "'data-nama='" + data.nama + "' data-ktkPerson='" + data.ktkPerson + "' data-no_hp='" + data.no_hp + "' data-alamat='" + data.alamat + "' data-provinsi='" + data.provinsi + "' data-kabupaten='" + data.kabupaten + "' data-tipe='" + data.tipe + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-nama='" + data.nama + "' data-ktkPerson='" + data.ktkPerson + "' data-no_hp='" + data.no_hp + "' data-alamat='" + data.alamat + "' data-provinsi='" + data.provinsi + "' data-kabupaten='" + data.kabupaten + "' data-tipe='" + data.tipe + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

		                        $('.col1').each(function (index) {
		                            $(this).html(index+1);
		                        });
		                    }
		                }
		            });
		        });
		                
		                // delete a supplier
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
		                        url: 'suppliers/' + id,
		                        data: {
		                            '_token': $('input[name=_token]').val(),
		                        },
		                        success: function(data) {
		                            toastr.success('Successfully deleted Supplier!', 'Success Alert', {timeOut: 5000});
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