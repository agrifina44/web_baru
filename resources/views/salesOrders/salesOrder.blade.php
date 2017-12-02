<!DOCTYPE html>
<html lang="en">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.jpg') }}">

    <!-- CSFR token for ajax call -->
    <meta name="_token" content="{{ csrf_token() }}"/>

    <title>Sales Order</title>
    
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

<body class="nav-md" background="{{url('/image/Background.png')}}">
        <div class="container body">
            <div class="main_container">

                @include('includes/sidebar')

                @include('includes/topbar')

                <div class="right_col" role="main">

    
        <div class="col-md-12">
                <h2 class="text-center">Sales Order Table View</h2>
                <br/>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul>
                            <li><i class="fa fa-file-text-o"></i> All the current Sales Order</li>
                            <a href="#" class="add-modal"><li>Add Sales Order</li></a>
                        </ul>
                    </div>
                
                    <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover" id="salesOrderTable" style="visibility: hidden;">
                                <thead>
                                    <tr>
                                        <th valign="middle">#</th>
                                        <th>Tanggal</th>
                                        <th>Sales</th>
                                        <th>Total</th>
                                        <th>Status</th>        
                                        <th>Actions</th>
                                    </tr>
                                    {{ csrf_field() }}
                                </thead>
                                <tbody>
                                    @foreach($salesOrders as $indexKey => $salesOrder)
                                        <tr class="item{{$salesOrder->id}} @if($salesOrder->enabled) warning @endif">
                                            <td class="col1">{{ $indexKey+1 }}</td>
                                            <td>{{$salesOrder->tanggal}}</td>
                                            <td>{{$salesOrder->salesPerson}}</td>
                                            <td>{{$salesOrder->total}}</td>
                                            <td>{{$salesOrder->status}}</td>
                                            <td>
                                                <button class="show-modal btn btn-success" data-id="{{$salesOrder->id}}" data-tanggal="{{$salesOrder->tanggal}}" data-salesPerson="{{$salesOrder->salesPerson}}" data-total="{{$salesOrder->total}}" data-status="{{$salesOrder->status}}">
                                                <span class="glyphicon glyphicon-eye-open"></span> Show</button>

                                                <button class="edit-modal btn btn-info" data-id="{{$salesOrder->id}}" data-tanggal="{{$salesOrder->tanggal}}" data-salesPerson="{{$salesOrder->salesPerson}}" data-total="{{$salesOrder->total}}" data-status="{{$salesOrder->status}}">
                                                <span class="glyphicon glyphicon-edit"></span> Edit</button>
                                                
                                                <button class="delete-modal btn btn-danger" data-id="{{$salesOrder->id}}" data-tanggal="{{$salesOrder->tanggal}}" data-salesPerson="{{$salesOrder->salesPerson}}" data-total="{{$salesOrder->total}}" data-status="{{$salesOrder->status}}">
                                                <span class="glyphicon glyphicon-trash"></span> Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                    </div><!-- /.panel-body -->
                </div><!-- /.panel panel-default -->
            </div><!-- /.col-md-8 -->


            <!-- Modal form to add a salesOrder -->
            <div id="addModal" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            <h4 class="modal-title"></h4>
                        </div>

                        <div class="modal-body">
                            <form action="{{ url('salesOrders') }}" class="form-horizontal form-label-left" role="form">
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Tanggal<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="date" id="tanggal_add" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Tanggal" required="required">
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="salesChannel">Sales Channel<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="salesChannel_add" required="required" placeholder="Sales Channel" class="form-control col-md-7 col-xs-12">

                                      <option value = "Website">Website</option>
                                      <option value = "Facebook">Facebook</option>
                                      <option value = "Instagram">Instagram</option>
                                      <option value = "WhatsApp">WhatsApp</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="salesPerson">Sales Person<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="salesPerson_add" required="required" placeholder="Sales Person" class="form-control col-md-7 col-xs-12">

                                      <option value = "Website">Website</option>
                                      <option value = "Facebook">Facebook</option>
                                      <option value = "Instagram">Instagram</option>
                                      <option value = "WhatsApp">WhatsApp</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Type<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="type_add" required="required" placeholder="Type" class="form-control col-md-7 col-xs-12">

                                      <option value = "Website">Website</option>
                                      <option value = "Facebook">Facebook</option>
                                      <option value = "Instagram">Instagram</option>
                                      <option value = "WhatsApp">WhatsApp</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer">Customer<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="customer_add" required="required" placeholder="Customer" class="form-control col-md-7 col-xs-12">

                                      <option value = "Website">Website</option>
                                      <option value = "Facebook">Facebook</option>
                                      <option value = "Instagram">Instagram</option>
                                      <option value = "WhatsApp">WhatsApp</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shippingAddress">Choose Shipping Address<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="shippingAddress_add" required="required" placeholder="Shipping Address" class="form-control col-md-7 col-xs-12">

                                      <option value = "Website">Website</option>
                                      <option value = "Facebook">Facebook</option>
                                      <option value = "Instagram">Instagram</option>
                                      <option value = "WhatsApp">WhatsApp</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="billingAddress">Choose Billing Address<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="billingAddress_add" required="required" placeholder="Billing Address" class="form-control col-md-7 col-xs-12">

                                      <option value = "Website">Website</option>
                                      <option value = "Facebook">Facebook</option>
                                      <option value = "Instagram">Instagram</option>
                                      <option value = "WhatsApp">WhatsApp</option>
                                  </select>
                                </div>
                              </div>
                               <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total">Total<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="int" id="total_add" required="required" placeholder="Total" class="form-control col-md-7 col-xs-12">
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

            <!-- Modal form to show a salesOrder -->
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
                                        <input type="date" class="form-control" id="tanggal_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="salesChannel">Sales Channel:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="salesChannel_show" cols="40" rows="5" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="salesPerson">Sales Person:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="salesPerson_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="type">Type:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="type_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="customer">Customer:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="customer_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="shippingAddress">Shipping Address:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="shippingAddress_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="billingAddress">Billing Address:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="billingAddress_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="total">Total:</label>
                                    <div class="col-sm-10">
                                        <input type="int" class="form-control" id="total_show" disabled>
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
                                <div class="item form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="tanggal">Tanggal<span class="required"></span></label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="date" id="tanggal_edit" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Tanggal" required="required">
                                    </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="salesChannel">Sales Channel<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="salesChannel_edit" required="required" placeholder="Sales Channel" class="form-control col-md-7 col-xs-12">

                                      <option value = "Website">Website</option>
                                      <option value = "Facebook">Facebook</option>
                                      <option value = "Instagram">Instagram</option>
                                      <option value = "WhatsApp">WhatsApp</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="salesPerson">Sales Person<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="salesPerson_edit" required="required" placeholder="Sales Person" class="form-control col-md-7 col-xs-12">

                                      <option value = "Website">Website</option>
                                      <option value = "Facebook">Facebook</option>
                                      <option value = "Instagram">Instagram</option>
                                      <option value = "WhatsApp">WhatsApp</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="type">Type<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="type_edit" required="required" placeholder="Type" class="form-control col-md-7 col-xs-12">

                                      <option value = "Website">Website</option>
                                      <option value = "Facebook">Facebook</option>
                                      <option value = "Instagram">Instagram</option>
                                      <option value = "WhatsApp">WhatsApp</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="customer">Customer<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="customer_edit" required="required" placeholder="Customer" class="form-control col-md-7 col-xs-12">

                                      <option value = "Website">Website</option>
                                      <option value = "Facebook">Facebook</option>
                                      <option value = "Instagram">Instagram</option>
                                      <option value = "WhatsApp">WhatsApp</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shippingAddress">Shipping Address<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="shippingAddress_edit" required="required" placeholder="Shipping Address" class="form-control col-md-7 col-xs-12">

                                      <option value = "Website">Website</option>
                                      <option value = "Facebook">Facebook</option>
                                      <option value = "Instagram">Instagram</option>
                                      <option value = "WhatsApp">WhatsApp</option>
                                  </select>
                                </div>
                              </div>
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="billingAddress">Billing Address<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select id="billingAddress_edit" required="required" placeholder="Billing Address" class="form-control col-md-7 col-xs-12">

                                      <option value = "Website">Website</option>
                                      <option value = "Facebook">Facebook</option>
                                      <option value = "Instagram">Instagram</option>
                                      <option value = "WhatsApp">WhatsApp</option>
                                  </select>
                                </div>
                              </div>
                               <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="total">Total<span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="int" id="total_edit" required="required" placeholder="Total" class="form-control col-md-7 col-xs-12">
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
                            <h3 class="text-center">Are you sure you want to delete the following salesOrder?</h3>
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
                                        <input type="date" class="form-control" id="tanggal_delete" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="salesPerson">Sales:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="salesPerson_delete" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="total">Total:</label>
                                    <div class="col-sm-10">
                                        <input type="int" class="form-control" id="total_delete" disabled>
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
            $('#salesOrderTable').removeAttr('style');
        })
    </script>

    <!-- AJAX CRUD operations -->
    <script type="text/javascript">
        // add a new salesOrder
        $(document).on('click', '.add-modal', function() {
            $('.modal-title').text('Add');
            $('#addModal').modal('show');
        });
        $('.modal-footer').on('click', '.add', function() {
            $.ajax({
                type: 'POST',
                url: 'salesOrders',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'tanggal': $('#tanggal_add').val(),
                    'salesChannel': $('#salesChannel_add').val(),
                    'salesPerson': $('#salesPerson_add').val(),
                    'type': $('#type_add').val(),
                    'customer': $('#customer_add').val(),
                    'shippingAddress': $('#shippingAddress_add').val(),
                    'billingAddress': $('#billingAddress_add').val(),
                    'total': $('#total_add').val(),
                    'status' : $('input[name=status_option]:checked').val()
                },
                success: function(data) {
                    $('.errorTanggal').addClass('hidden');
                    $('.errorSalesChannel').addClass('hidden');
                    $('.errorSalesPerson').addClass('hidden');
                    $('.errorType').addClass('hidden');
                    $('.errorCustomer').addClass('hidden');
                    $('.errorShippingAddress').addClass('hidden');
                    $('.errorBillingAddress').addClass('hidden');
                    $('.errorTotal').addClass('hidden');
                    $('.errorStatus').addClass('hidden');

                     if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);
                        if (data.errors.tanggal) {
                            $('.errorTanggal').removeClass('hidden');
                            $('.errorTanggal').text(data.errors.tanggal);
                        }
                        if (data.errors.salesChannel) {
                            $('.errorSalesChannel').removeClass('hidden');
                            $('.errorSalesChannel').text(data.errors.salesChannel);
                        }
                        if (data.errors.salesPerson) {
                            $('.errorSalesPerson').removeClass('hidden');
                            $('.errorSalesPerson').text(data.errors.salesPerson);
                        }
                        if (data.errors.type) {
                            $('.errorType').removeClass('hidden');
                            $('.errorType').text(data.errors.type);
                        }
                        if (data.errors.customer) {
                            $('.errorCustomer').removeClass('hidden');
                            $('.errorCustomer').text(data.errors.customer);
                        }
                        if (data.errors.shippingAddress) {
                            $('.errorShippingAddress').removeClass('hidden');
                            $('.errorShippingAddress').text(data.errors.shippingAddress);
                        }
                        if (data.errors.billingAddress) {
                            $('.errorBillingAddress').removeClass('hidden');
                            $('.errorBillingAddress').text(data.errors.billingAddress);
                        }
                        if (data.errors.total) {
                            $('.errorTotal').removeClass('hidden');
                            $('.errorTotal').text(data.errors.total);
                        }
                        if (data.errors.status) {
                            $('.errorStatus').removeClass('hidden');
                            $('.errorStatus').text(data.errors.status);
                        }
                    } else {
                        toastr.success('Successfully added salesOrder!', 'Success Alert', {timeOut: 5000});
                        $('#salesOrderTable').append("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.tanggal + "</td><td>" + data.salesChannel + "</td><td>" + data.salesPerson + "</td><td>" + data.type + "</td><td>" + data.customer + "</td><td>" + data.shippingAddress + "</td><td>" + data.billingAddress + "</td><td>" + data.total + "</td><td>" + data.status + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-tanggal='" + data.tanggal + "' data-salesChannel='" + data.salesChannel + "' data-salesPerson='" + data.salesPerson + "' data-type='" + data.type + "' data-customer='" + data.customer + "' data-shippingAddress='" + data.shippingAddress + "' data-billingAddress='" + data.billingAddress + "' data-total='" + data.total + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-eye-open'></span>Show</button><button class='edit-modal btn btn-info' data-id='" + data.id + "' data-tanggal='" + data.tanggal + "' data-salesChannel='" + data.salesChannel + "' data-salesPerson='" + data.salesPerson + "' data-type='" + data.type + "' data-customer='" + data.customer + "' data-shippingAddress='" + data.shippingAddress + "' data-billingAddress='" + data.billingAddress + "' data-total='" + data.total + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                    }


                    $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                },
            });
        });

        // Show a salesOrder
        $(document).on('click', '.show-modal', function() 
        {
            $('.modal-title').text('Show');
            $('#id_show').val($(this).data('id'));
            $('#tanggal_show').val($(this).data('tanggal'));
            $('#salesChannel_show').val($(this).data('salesChannel'));
            $('#salesPerson_show').val($(this).data('salesPerson'));
            $('#type_show').val($(this).data("type"));
            $('#customer_show').val($(this).data("customer"));
            $('#shippingAddress_show').val($(this).data("shippingAddress"));
            $('#billingAddress_show').val($(this).data("billingAddress"));
            $('#total_show').val($(this).data('total'));
            $('#status_show').val($(this).data('status'));
            $('#showModal').modal('show');
        });


        //Edit a salesOrder
        $(document).on('click', '.edit-modal', function() {
            $('.modal-title').text('Edit');
            $('#id_edit').val($(this).data('id'));
            $('#tanggal_edit').val($(this).data('tanggal'));
            $('#salesChannel_edit').val($(this).data('salesChannel'));
            $('#salesPerson_edit').val($(this).data('salesPerson'));
            $('#type_edit').val($(this).data("type"));
            $('#customer_edit').val($(this).data("customer"));
            $('#shippingAddress_edit').val($(this).data("shippingAddress"));
            $('#billingAddress_edit').val($(this).data("billingAddress"));
            $('#total_edit').val($(this).data('total'));
            $('#status_edit').val($(this).data('status'));
            id = $('#id_edit').val();
            $('#editModal').modal('show');
        });
        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: 'salesOrders/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id' : $("#id_edit").val(),
                    'tanggal': $('#tanggal_edit').val(),
                    'salesChannel': $('#salesChannel_edit').val(),
                    'salesPerson': $('#salesPerson_edit').val(),
                    'type' : $('#type_edit').val(),
                    'customer' : $('#customer_edit').val(),
                    'shippingAddress': $('#shippingAddress_edit').val(),
                    'billingAddress': $('#billingAddress_edit').val(),
                    'total' : $('#total_edit').val(),
                    'status' : $('input[name=status_option]:checked').val()
                },
                success: function(data) {
                    $('.errorTanggal').addClass('hidden');
                    $('.errorSalesChannel').addClass('hidden');
                    $('.errorSalesPerson').addClass('hidden');
                    $('.errorType').addClass('hidden');
                    $('.errorCustomer').addClass('hidden');
                    $('.errorShippingAddress').addClass('hidden');
                    $('.errorBillingAddress').addClass('hidden');
                    $('.errorTotal').addClass('hidden');
                    $('.errorStatus').addClass('hidden');

                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);
                        if (data.errors.tanggal) {
                            $('.errorTanggal').removeClass('hidden');
                            $('.errorTanggal').text(data.errors.tanggal);
                        }
                        if (data.errors.salesChannel) {
                            $('.errorSalesChannel').removeClass('hidden');
                            $('.errorSalesChannel').text(data.errors.salesChannel);
                        }
                        if (data.errors.salesPerson) {
                            $('.errorSalesPerson').removeClass('hidden');
                            $('.errorSalesPerson').text(data.errors.salesPerson);
                        }
                        if (data.errors.type) {
                            $('.errorType').removeClass('hidden');
                            $('.errorType').text(data.errors.type);
                        }
                        if (data.errors.customer) {
                            $('.errorCustomer').removeClass('hidden');
                            $('.errorCustomer').text(data.errors.customer);
                        }
                        if (data.errors.shippingAddress) {
                            $('.errorShippingAddress').removeClass('hidden');
                            $('.errorShippingAddress').text(data.errors.shippingAddress);
                        }
                        if (data.errors.billingAddress) {
                            $('.errorBillingAddress').removeClass('hidden');
                            $('.errorBillingAddress').text(data.errors.billingAddress);
                        }
                        if (data.errors.total) {
                            $('.errorTotal').removeClass('hidden');
                            $('.errorTotal').text(data.errors.total);
                        }
                        if (data.errors.status) {
                            $('.errorStatus').removeClass('hidden');
                            $('.errorStatus').text(data.errors.status);
                        }
                    } else {
                        toastr.success('Successfully updated salesOrder!', 'Success Alert', {timeOut: 5000});
                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.tanggal + "</td><td>" + data.salesChannel + "</td><td>" + data.salesPerson + "</td><td>" + data.type + "</td><td>" + data.customer + "</td><td>" + data.shippingAddress + "</td><td>" + data.billingAddress + "</td><td>" + data.total + "</td><td>" + data.status + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-tanggal='" + data.tanggal + "' data-salesChannel='" + data.salesChannel + "' data-salesPerson='" + data.salesPerson + "' data-type='" + data.type + "' data-customer='" + data.customer + "' data-shippingAddress='" + data.shippingAddress + "' data-billingAddress='" + data.billingAddress + "' data-total='" + data.total + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-tanggal='" + data.tanggal + "' data-salesChannel='" + data.salesChannel + "' data-salesPerson='" + data.salesPerson + "' data-type='" + data.type + "' data-customer='" + data.customer + "' data-shippingAddress='" + data.shippingAddress + "' data-billingAddress='" + data.billingAddress + "' data-total='" + data.total + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");


                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                     }
                }
            });
        });        
                
                // delete a salesOrder
                $(document).on('click', '.delete-modal', function() {
                    $('.modal-title').text('Delete');
                    $('#id_delete').val($(this).data('id'));
                    $('#tanggal_delete').val($(this).data('tanggal'));
                    $('#salesPerson_delete').val($(this).data('salesPerson'));
                    $('#total_delete').val($(this).data('total'));
                    $('#deleteModal').modal('show');
                    id = $('#id_delete').val();
                });
                $('.modal-footer').on('click', '.delete', function() {
                    $.ajax({
                        type: 'DELETE',
                        url: 'salesOrders/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function(data) {
                            toastr.success('Successfully deleted salesOrder!', 'Success Alert', {timeOut: 5000});
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