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

	<title>Product</title>

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
					<h2 class="text-center"> Manage Products </h2>
					<br/>
					<div class="panel panel-default">
						<div class="panel-heading">
							<ul>
								<li><i class="fa fa-file-text-o"></i>All the current Products</li>
								<a href="#" class="add-modal"><li>Add a product</li></a>
							</ul>
						</div>

						<div class="panel-body">
							<table class="table table-striped table-bordered table-hover" id="productTable" style="visibility: hidden;">
								<thead>
									<tr>
										<th valign="middle">#</th>
										<th>SKU</th>
                    <th>Kategori</th>
										<th>Brand</th>
                    <th>Style</th>
                    <th>Gudang</th>
                    <th>Size</th>
                    <th>Gender</th>
                    <th>Supplier</th>
                    <th>Stock</th>
										<th>Status</th>
                    <th>Foto</th>
										<th>Action</th>
									</tr>
									{{ csrf_field() }}
								</thead>
								<tbody>
									@foreach($products as $indexKey => $product)
									<tr class="item{{$product->id}} @if($product->enabled) warning @endif">
										<td class="col1">{{$indexKey+1}}</td>
										<td>{{$product->sku}}</td>
										<td>{{$product->kategori}}</td>
                    <td>{{$product->brand}}</td>
                    <td>{{$product->style}}</td>
                    <td>{{$product->gudang}}</td>
                    <td>{{$product->size}}</td>
                    <td>{{$product->gender}}</td>
                    <td>{{$product->supplier}}</td>
                    <td>{{$product->stock}}</td>
										<td>{{$product->status}}</td>
                    <td>{{$product->foto}}</td>
										<td>
											<button class="show-modal btn btn-success" data-id="{{$product->id}}" data-sku="{{$product->sku}}" data-kategori="{{$product->kategori}}" data-brand="{{$product->brand}}" data-style="{{$product->style}}" data-gudang="{{$product->gudang}}" data-size="{{$product->size}}" data-gender="{{$product->gender}}" data-supplier="{{$product->supplier}}" data-stock="{{$product->stock}}" data-status="{{$product->status}}" data-foto="{{$product->foto}}">
											<span class="glyphicon glyphicon-eye-open"></span>Show </button>
											<button class="edit-modal btn btn-info" data-id="{{$product->id}}" data-sku="{{$product->sku}}" data-kategori="{{$product->kategori}}" data-brand="{{$product->brand}}" data-style="{{$product->style}}" data-gudang="{{$product->gudang}}" data-size="{{$product->size}}" data-gender="{{$product->gender}}" data-supplier="{{$product->supplier}}" data-stock="{{$product->stock}}" data-status="{{$product->status}}" data-foto="{{$product->foto}}">
											<span class="glyphicon glyphicon-edit"></span>Edit</button>
											<button class="delete-modal btn btn-danger" data-id="{{$product->id}}" data-sku="{{$product->sku}}" data-kategori="{{$product->kategori}}" data-brand="{{$product->brand}}" data-style="{{$product->style}}" data-gudang="{{$product->gudang}}" data-size="{{$product->size}}" data-gender="{{$product->gender}}" data-supplier="{{$product->supplier}}" data-stock="{{$product->stock}}" data-status="{{$product->status}}" data-foto="{{$product->foto}}">
											<span class="glyphicon glyphicon-trash"></span>Delete</button>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
							
						</div> <!-- panel-body -->
						
					</div><!-- panel panel-default -->
				</div> <!-- /.col-md-8 -->

				<!-- Modal form to add a product -->
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
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sku"> SKU <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="sku_add" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="SKU" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kategori"> Kategori <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="kategori_add" required="required" placeholder="kategori" class="form-control col-md-7 col-xs-12">
                                     
                                      <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                        <option value="e">E</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand">Brand<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="brand_add" required="required" placeholder="Brand" class="form-control col-md-7 col-xs-12">    
                                  <option value="a">A<option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                        <option value="e">E</option> 
                                     
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="style">Style<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="style_add" required="required" placeholder="style" class="form-control col-md-7 col-xs-12">
                                      <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                        <option value="e">E</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gudang">Gudang<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="gudang_add" required="required" placeholder="gudang" class="form-control col-md-7 col-xs-12">
                                      <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                        <option value="e">E</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size">Size<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="size_add" required="required" placeholder="size" class="form-control col-md-7 col-xs-12">
                                      <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                        <option value="e">E</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Gender<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="gender_add" required="required" placeholder="style" class="form-control col-md-7 col-xs-12">
                                      <option value="pria">Pria</option>
                                      <option value="wanita">Wanita</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supplier">Supplier<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="supplier_add" required="required" placeholder="size" class="form-control col-md-7 col-xs-12">
                                      <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                        <option value="e">E</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stock"> Stock <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="number" id="stock_add" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="stock" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                  <label for="foto" class="control-label col-md-3 col-sm-3 col-xs-12">Foto</label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group"> 
                                            <label class="btn btn-default btn-file">
                                              <input type="file" id="foto_add">
                                            </label>
                                        </div>
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

				<!-- Modal form to show a product -->
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
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="id">ID:</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" class="form-control" id="id_show" disabled>
                                    </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sku"> SKU </label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" id="sku_show" disabled>
                                  </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kategori"> Kategori  </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" id="kategori_show" disabled>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand">Brand</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" id="brand_show" disabled>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="style">Style</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" id="style_show" disabled>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gudang">Gudang</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" id="gudang_show" disabled>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size">Size</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                   <input type="text" class="form-control" id="size_show" disabled>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Gender</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" id="gender_show" disabled>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supplier">Supplier</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" class="form-control" id="supplier_show" disabled>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stock"> Stock <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" class="form-control" id="stock_show" disabled>
                                </div>
                              </div>
                              <div class="item form-group">
                                  <label for="foto" class="control-label col-md-3 col-sm-3 col-xs-12">Foto</label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group"> 
                                              <input type="text" class="form-control" id="foto_show" disabled>
                                        </div>
                                      </div>
                              </div>
                              <div class="item form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="status">Status</label>
                                  <div class="col-md-6 col-sm-6 col-xs-12">
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
	                                <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sku"> SKU <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="sku_edit" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="SKU" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kategori"> Kategori <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="kategori_edit" required="required" placeholder="kategori" class="form-control col-md-7 col-xs-12">
                                     
                                      <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                        <option value="e">E</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brand">Brand<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="brand_edit" required="required" placeholder="Brand" class="form-control col-md-7 col-xs-12">    
                                  <option value="a">A<option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                        <option value="e">E</option> 
                                     
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="style">Style<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="style_edit" required="required" placeholder="style" class="form-control col-md-7 col-xs-12">
                                      <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                        <option value="e">E</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gudang">Gudang<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="gudang_edit" required="required" placeholder="gudang" class="form-control col-md-7 col-xs-12">
                                      <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                        <option value="e">E</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="size">Size<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="size_edit" required="required" placeholder="size" class="form-control col-md-7 col-xs-12">
                                      <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                        <option value="e">E</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Gender<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="gender_edit" required="required" placeholder="style" class="form-control col-md-7 col-xs-12">
                                      <option value="pria">Pria</option>
                                      <option value="wanita">Wanita</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="supplier">Supplier<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="supplier_edit" required="required" placeholder="size" class="form-control col-md-7 col-xs-12">
                                      <option value="a">A</option>
                                        <option value="b">B</option>
                                        <option value="c">C</option>
                                        <option value="d">D</option>
                                        <option value="e">E</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="stock"> Stock <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="number" id="stock_edit" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="stock" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                  <label for="foto" class="control-label col-md-3 col-sm-3 col-xs-12">Foto</label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                        <div class="input-group"> 
                                            <label class="btn btn-default btn-file">
                                              <input type="file" id="foto_edit">
                                            </label>
                                        </div>
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
	                            <h3 class="text-center">Are you sure you want to delete the following product?</h3>
	                            <br />
	                            <form class="form-horizontal" role="form">
	                                <div class="form-group">
	                                    <label class="control-label col-sm-2" for="id">ID:</label>
	                                    <div class="col-sm-10">
	                                        <input type="text" class="form-control" id="id_delete" disabled>
	                                    </div>
	                                </div>
	                                <div class="form-group">
	                                    <label class="control-label col-sm-2" for="sku">SKU:</label>
	                                    <div class="col-sm-10">
	                                        <input type="text" class="form-control" id="sku_delete" disabled>
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
		            $('#productTable').removeAttr('style');
		        })
		    </script>

		    <!-- AJAX CRUD operations -->
		    <script type="text/javascript">
		        // add a new product
		        $(document).on('click', '.add-modal', function() {
		            $('.modal-title').text('Add');
		            $('#addModal').modal('show');
		        });
		        $('.modal-footer').on('click', '.add', function() {
		            $.ajax({
		                type: 'POST',
		                url: 'products',
		                data: {
		                    '_token': $('input[name=_token]').val(),
		                    'sku': $('#sku_add').val(),
		                    'kategori': $('#kategori_add').val(),
		                    'brand': $('#brand_add').val(),
		                    'style': $('#style_add').val(),
		                    'gudang': $('#gudang_add').val(),
		                    'size': $('#size_add').val(),
		                    'gender': $('#gender_add').val(),
                        'supplier': $('#supplier_add').val(),
                        'stock': $('#stock_add').val(),
		                    'status' : $('input[name=status_option]:checked').val()
		                },
		                success: function(data) {
		                    $('.errorSku').addClass('hidden');
		                    $('.errorKategori').addClass('hidden');
		                    $('.errorBrand').addClass('hidden');
		                    $('.errorStyle').addClass('hidden');
		                    $('.errorGudang').addClass('hidden');
		                    $('.errorSize').addClass('hidden');
		                    $('.errorGender').addClass('hidden');
		                    $('.errorSupplier').addClass('hidden');
                        $('.errorStock').addClass('hidden');
                        $('.errorStatus').addClass('hidden');

		                    if ((data.errors)) {
		                        setTimeout(function () {
		                            $('#addModal').modal('show');
		                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
		                        }, 500);

		                        if (data.errors.sku) {
		                            $('.errorSku').removeClass('hidden');
		                            $('.errorSku').text(data.errors.sku);
		                        }
		                        if (data.errors.kategori) {
		                            $('.errorKategori').removeClass('hidden');
		                            $('.errorKategori').text(data.errors.kategori);
		                        }
		                        if (data.errors.brand) {
		                            $('.errorBrand').removeClass('hidden');
		                            $('.errorBrand').text(data.errors.brand);
		                        }
		                        if (data.errors.style) {
		                            $('.errorStyle').removeClass('hidden');
		                            $('.errorStyle').text(data.errors.style);
		                        }
		                        if (data.errors.gudang) {
		                            $('.errorGudang').removeClass('hidden');
		                            $('.errorGudang').text(data.errors.gudang);
		                        }
		                        if (data.errors.size) {
		                            $('.errorSize').removeClass('hidden');
		                            $('.errorSize').text(data.errors.size);
		                        }
		                        if (data.errors.gender) {
		                            $('.errorGender').removeClass('hidden');
		                            $('.errorGender').text(data.errors.gender);
		                        }
                            if (data.errors.supplier) {
                                $('.errorSupplier').removeClass('hidden');
                                $('.errorSupplier').text(data.errors.supplier);
                            }
                            if (data.errors.stock) {
                                $('.errorStock').removeClass('hidden');
                                $('.errorStock').text(data.errors.stock);
                            }
		                        if (data.errors.status) {
		                            $('.errorStatus').removeClass('hidden');
		                            $('.errorStatus').text(data.errors.status);
		                        }
		                    } else {
		                        toastr.success('Successfully added product!', 'Success Alert', {timeOut: 5000});
		                        $('#productTable').append("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.sku + "</td><td>" + data.kategori + "</td><td>" + data.brand + "</td><td>" + data.style + "</td><td>" + data.gudang + "</td><td>" + data.size + "</td><td>" + data.gender + "</td><td>" + data.supplier + "</td><td>" + data.stock + "</td><td>" + data.status + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-sku='" + data.sku + "' data-kategori='" + data.kategori + "' data-brand='" + data.brand + "' data-style='" + data.style + "' data-gudang='" + data.gudang + "' data-size='" + data.size + "' data-gender='" + data.gender + "' data-supplier='" + data.supplier + "' data-stock='" + data.stock + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-sku='" + data.sku + "' data-kategori='" + data.kategori + "' data-brand='" + data.brand + "' data-style='" + data.style + "' data-gudang='" + data.gudang + "' data-size='" + data.size + "' data-gender='" + data.gender + "' data-supplier='" + data.supplier + "' data-stock='" + data.stock + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-sku='" + data.sku + "' data-kategori='" + data.kategori + "' data-brand='" + data.brand + "' data-style='" + data.style + "' data-gudang='" + data.gudang + "' data-size='" + data.size + "' data-gender='" + data.gender + "' data-supplier='" + data.supplier + "' data-stock='" + data.stock + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                            $('.col1').each(function (index) {
                                $(this).html(index+1);
                            });
		                    }

		                    
		                },
		            });
		        });

		                // Show a product
		                $(document).on('click', '.show-modal', function() {
		                    $('.modal-title').text('Show');
		                    $('#id_show').val($(this).data('id'));
		                    $('#sku_show').val($(this).data('sku'));
		                    $('#kategori_show').val($(this).data('kategori'));
		                    $('#brand_show').val($(this).data('brand'));
		                    $('#style_show').val($(this).data('style'));
		                    $('#gudang_show').val($(this).data('gudang'));
		                    $('#size_show').val($(this).data('size'));
		                    $('#gender_show').val($(this).data('gender'));
                        $('#supplier_show').val($(this).data('supplier'));
                        $('#stock_show').val($(this).data('stock'));
		                    $('#status_show').val($(this).data('status'));
		                    $('#showModal').modal('show');
		                });


		                 // Edit a product
		        $(document).on('click', '.edit-modal', function() {
		            $('.modal-title').text('Edit');
		            $('#id_edit').val($(this).data('id'));
		            $('#sku_edit').val($(this).data('sku'));
                $('#kategori_edit').val($(this).data('kategori'));
                $('#brand_edit').val($(this).data('brand'));
                $('#style_edit').val($(this).data('style'));
                $('#gudang_edit').val($(this).data('gudang'));
                $('#size_edit').val($(this).data('size'));
                $('#gender_edit').val($(this).data('gender'));
                $('#supplier_edit').val($(this).data('supplier'));
                $('#stock_edit').val($(this).data('stock'));
		            $('#status_edit').val($(this).data('status'));
		            id = $('#id_edit').val();
		            $('#editModal').modal('show');
		        });
		        $('.modal-footer').on('click', '.edit', function() {
		            $.ajax({
		                type: 'PUT',
		                url: 'products/' + id,
		                data: {
		                    '_token': $('input[name=_token]').val(),
		                    'id': $("#id_edit").val(),
		                    'sku': $('#sku_edit').val(),
                        'kategori': $('#kategori_edit').val(),
                        'brand': $('#brand_edit').val(),
                        'style': $('#style_edit').val(),
                        'gudang': $('#gudang_edit').val(),
                        'size': $('#size_edit').val(),
                        'gender': $('#gender_edit').val(),
                        'supplier': $('#supplier_edit').val(),
                        'stock': $('#stock_edit').val(),
                        'status' : $('input[name=status_option]:checked').val()
		                },
		                success: function(data) {
		                    $('.errorSku').addClass('hidden');
                        $('.errorKategori').addClass('hidden');
                        $('.errorBrand').addClass('hidden');
                        $('.errorStyle').addClass('hidden');
                        $('.errorGudang').addClass('hidden');
                        $('.errorSize').addClass('hidden');
                        $('.errorGender').addClass('hidden');
                        $('.errorSupplier').addClass('hidden');
                        $('.errorStock').addClass('hidden');
                        $('.errorStatus').addClass('hidden');

		                    if ((data.errors)) {
		                        setTimeout(function () {
		                            $('#editModal').modal('show');
		                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
		                        }, 500);

		                        if (data.errors.sku) {
                                $('.errorSku').removeClass('hidden');
                                $('.errorSku').text(data.errors.sku);
                            }
                            if (data.errors.kategori) {
                                $('.errorKategori').removeClass('hidden');
                                $('.errorKategori').text(data.errors.kategori);
                            }
                            if (data.errors.brand) {
                                $('.errorBrand').removeClass('hidden');
                                $('.errorBrand').text(data.errors.brand);
                            }
                            if (data.errors.style) {
                                $('.errorStyle').removeClass('hidden');
                                $('.errorStyle').text(data.errors.style);
                            }
                            if (data.errors.gudang) {
                                $('.errorGudang').removeClass('hidden');
                                $('.errorGudang').text(data.errors.gudang);
                            }
                            if (data.errors.size) {
                                $('.errorSize').removeClass('hidden');
                                $('.errorSize').text(data.errors.size);
                            }
                            if (data.errors.gender) {
                                $('.errorGender').removeClass('hidden');
                                $('.errorGender').text(data.errors.gender);
                            }
                            if (data.errors.supplier) {
                                $('.errorSupplier').removeClass('hidden');
                                $('.errorSupplier').text(data.errors.supplier);
                            }
                            if (data.errors.stock) {
                                $('.errorStock').removeClass('hidden');
                                $('.errorStock').text(data.errors.stock);
                            }
                            if (data.errors.status) {
                                $('.errorStatus').removeClass('hidden');
                                $('.errorStatus').text(data.errors.status);
                            }
		                    } else {
		                        toastr.success('Successfully updated product!', 'Success Alert', {timeOut: 5000});
		                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.sku + "</td><td>" + data.kategori + "</td><td>" + data.brand + "</td><td>" + data.style + "</td><td>" + data.gudang + "</td><td>" + data.size + "</td><td>" + data.gender + "</td><td>" + data.supplier + "</td><td>" + data.stock + "</td><td>" + data.status + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-sku='" + data.sku + "' data-kategori='" + data.kategori + "' data-brand='" + data.brand + "' data-style='" + data.style + "' data-gudang='" + data.gudang + "' data-size='" + data.size + "' data-gender='" + data.gender + "' data-supplier='" + data.supplier + "' data-stock='" + data.stock + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "'data-sku='" + data.sku + "' data-kategori='" + data.kategori + "' data-brand='" + data.brand + "' data-style='" + data.style + "' data-gudang='" + data.gudang + "' data-size='" + data.size + "' data-gender='" + data.gender + "' data-supplier='" + data.supplier + "' data-stock='" + data.stock + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-sku='" + data.sku + "' data-kategori='" + data.kategori + "' data-brand='" + data.brand + "' data-style='" + data.style + "' data-gudang='" + data.gudang + "' data-size='" + data.size + "' data-gender='" + data.gender + "' data-supplier='" + data.supplier + "' data-stock='" + data.stock + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

		                        $('.col1').each(function (index) {
		                            $(this).html(index+1);
		                        });
		                    }
		                }
		            });
		        });
		                
		                // delete a product
		                $(document).on('click', '.delete-modal', function() {
		                    $('.modal-title').text('Delete');
		                    $('#id_delete').val($(this).data('id'));
		                    $('#sku_delete').val($(this).data('sku'));
		                    $('#deleteModal').modal('show');
		                    id = $('#id_delete').val();
		                });
		                $('.modal-footer').on('click', '.delete', function() {
		                    $.ajax({
		                        type: 'DELETE',
		                        url: 'products/' + id,
		                        data: {
		                            '_token': $('input[name=_token]').val(),
		                        },
		                        success: function(data) {
		                            toastr.success('Successfully deleted product!', 'Success Alert', {timeOut: 5000});
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