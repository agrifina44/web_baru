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

    <title>Payment Method</title>
    
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
                <h2 class="text-center">Manage Payment Method</h2>
                <br />
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <ul>
                            <li><i class="fa fa-file-text-o"></i> All Payment Method</li>
                            <a href="#" class="add-modal"><li>Add Payment Method</li></a>
                        </ul>
                    </div>
                
                    <div class="panel-body">
                            <table class="table table-striped table-bordered table-hover" id="paymentTable" style="visibility: hidden;">
                                <thead>
                                    <tr>
                                        <th valign="middle">Nomor</th>
                                        <th>Payment Method</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    {{ csrf_field() }}
                                </thead>
                                <tbody>
                                    @foreach($payments as $indexKey => $payment)
                                        <tr class="item{{$payment->id}} @if($payment->enabled) warning @endif">
                                            <td class="col1">{{ $indexKey+1 }}</td>
                                            <td>{{$payment->payment_method}}</td>
                                            <td>{{$payment->status}}</td>
                                            <td>
                                                <button class="show-modal btn btn-success" data-id="{{$payment->id}}" data-payment_method="{{$payment->payment_method}}" data-status="{{$payment->status}}">
                                                <span class="glyphicon glyphicon-eye-open"></span> Show</button>
                                                <button class="edit-modal btn btn-info" data-id="{{$payment->id}}" data-payment_method="{{$payment->payment_method}}" data-status="{{$payment->status}}">
                                                <span class="glyphicon glyphicon-edit"></span> Edit</button>
                                                <button class="delete-modal btn btn-danger" data-id="{{$payment->id}}" data-payment_method="{{$payment->payment_method}}" data-status="{{$payment->status}}">
                                                <span class="glyphicon glyphicon-trash"></span> Delete</button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="/shippings"><u>Go to Shipping</u></a></button>
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
                            <form action="{{ url('payments') }}" class="form-horizontal form-label-left" role="form">
                              <div class="item form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="payment_method">Payment Method <span class="required"></span>
                                </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                  <input type="text" id="payment_method_add" class="form-control col-md-7 col-xs-12" data-validate-length-range="6" data-validate-words="2" placeholder="Payment Method" required="required">
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
                                    <label class="control-label col-sm-2" for="payment_method">Payment Method:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="payment_method_show" disabled>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="status">Status:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="status_show" cols="40" rows="5" disabled>
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
                                    <label class="control-label col-sm-2" for="payment_method">Payment Method:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="payment_method_edit" autofocus>
                                        <p class="errorTitle text-center alert alert-danger hidden"></p>
                                    </div>
                                </div>
                                <div class="item form-group">
                                  <label class="control-label col-sm-2" for="status">Status<span class="required"></span>
                                  </label>
                                  <div class="col-sm-10">
                                      <label class="radio-inline " for="enable_add">
                                        <input type="radio" name="status" id="status_add" value="Enabled"> Enabled
                                      </label>
                                      <label class="radio-inline" for="disabled_add">
                                      <input type="radio" name="status" id="status_add" value="Disable"d> Disabled
                                    </label>
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
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="id">ID:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="id_delete" disabled>
                                    </div>
                                </div>
                                    <label class="control-label col-sm-2" for="payment_method">Payment Method</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="payment_method_delete" disabled>
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
            $('#paymentTable').removeAttr('style');
        })
    </script>

    <!-- AJAX CRUD operations -->
    <script type="text/javascript">
        // add a new payment
        $(document).on('click', '.add-modal', function() {
            $('.modal-title').text('Add Payment Method');
            $('#addModal').modal('show');
        });
        $('.modal-footer').on('click', '.add', function() {
            $.ajax({
                type: 'POST',
                url: 'payments',
                data: {
                    '_token': $('input[name=_token]').val(),
                    'payment_method': $('#payment_method_add').val(),
                    'status' : $('input[name=status_option]:checked').val()
                },
                success: function(data) {
                    $('.errorPaymentMethod').addClass('hidden');
                    $('.errorStatus').addClass('hidden');
                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#addModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.payment_method) {
                            $('.errorPayment_method').removeClass('hidden');
                            $('.errorPayment_method').text(data.errors.payment_method);
                        }

                        if (data.errors.status) {
                            $('.errorStatus').removeClass('hidden');
                            $('.errorStatus').text(data.errors.status);
                        }
                    } else {
                        toastr.success('Successfully added Payment Method!', 'Success Alert', {timeOut: 5000});
                        $('#paymentTable').append("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.payment_method + "</td><td>" + data.status + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-payment_method='" + data.payment_method + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-payment_method='" + data.payment_method + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-payment_method='" + data.payment_method + "' data-status='" + data.status +"'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }

                    
                },
            });
        });

                // Show a payment method
                $(document).on('click', '.show-modal', function() {
                    $('.modal-title').text('Show');
                    $('#id_show').val($(this).data('id'));
                    $('#payment_method_show').val($(this).data('payment_method'));
                    $('#status_show').val($(this).data('status'));
                    $('#showModal').modal('show');
                });


                 // Edit a payment method
        $(document).on('click', '.edit-modal', function() {
            $('.modal-title').text('Edit');
            $('#id_edit').val($(this).data('id'));
            $('#payment_method_edit').val($(this).data('payment_method'));
            $('#status_edit').val($(this).data('status'));
            id = $('#id_edit').val();
            $('#editModal').modal('show');
        });
        $('.modal-footer').on('click', '.edit', function() {
            $.ajax({
                type: 'PUT',
                url: 'payments/' + id,
                data: {
                    '_token': $('input[name=_token]').val(),
                    'id': $("#id_edit").val(),
                    'payment_method': $('#payment_method_edit').val(),
                    'status' : $('input[name=status_option]:checked').val()
                },
                success: function(data) {
                    $('.errorPayment_method').addClass('hidden');
                    $('.errorStatus').addClass('hidden');
                    
                    if ((data.errors)) {
                        setTimeout(function () {
                            $('#editModal').modal('show');
                            toastr.error('Validation error!', 'Error Alert', {timeOut: 5000});
                        }, 500);

                        if (data.errors.payment_method) {
                            $('.errorPayment_method').removeClass('hidden');
                            $('.errorPayment_method').text(data.errors.payment_method);
                        }
                        if (data.errors.status) {
                            $('.errorStatus').removeClass('hidden');
                            $('.errorStatus').text(data.errors.status);
                        }
                    } else {
                        toastr.success('Successfully updated Post!', 'Success Alert', {timeOut: 5000});
                        $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='col1'>" + data.id + "</td><td>" + data.payment_method + "</td><td>" + data.status + "</td><td><button class='show-modal btn btn-success' data-id='" + data.id + "' data-payment_method='" + data.payment_method + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-eye-open'></span> Show</button> <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-payment_method='" + data.payment_method + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-payment_method='" + data.payment_method + "' data-status='" + data.status + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");

                        $('.col1').each(function (index) {
                            $(this).html(index+1);
                        });
                    }
                }
            });
        });
                
                // delete a payment method
                $(document).on('click', '.delete-modal', function() {
                    $('.modal-title').text('Delete');
                    $('#id_delete').val($(this).data('id'));
                    $('#payment_method_delete').val($(this).data('payment_method'));
                    $('#deleteModal').modal('show');
                    id = $('#id_delete').val();
                });
                $('.modal-footer').on('click', '.delete', function() {
                    $.ajax({
                        type: 'DELETE',
                        url: 'payments/' + id,
                        data: {
                            '_token': $('input[name=_token]').val(),
                        },
                        success: function(data) {
                            toastr.success('Successfully deleted Payment Method!', 'Success Alert', {timeOut: 5000});
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