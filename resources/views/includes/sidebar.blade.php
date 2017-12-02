<div class="col-md-3 left_col">
    <div class="left_col scroll-view">
       

        <div class="navbar nav_title" style="border: 0;">
              <a href="{{ url('/') }}" class="site_title"><img src = "{{asset ('image/home.png')}}" height="25" width="40" href="{{ url('/') }}"></i> <span>GUDANGKITA</span></a>
            </div>
        
        <div class="clearfix"></div>
        
        <!-- menu profile quick info -->
          <div class="profile">
            <div class="profile_pic">
                <img src="{{ Gravatar::src(Auth::user()->email) }}" alt="Avatar of {{ Auth::user()->name }}" class="img-circle profile_img">
            </div>
            <div class="profile_info">
                <span>Welcome,</span>
                <h2>{{ Auth::user()->name }}</h2>
            </div>
        </div>
        <!-- /menu profile quick info -->
        
        <br />
        
        <!-- sidebar menu -->
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <h3>Admin</h3>
                @if(Auth::user()->jabatan == 'Super Admin' || Auth::user()->jabatan == 'Admin')
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ url('/') }}">
                            <i class="fa fa-home"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('products') }}"><i class="fa fa-barcode"></i> Product</a>
                    </li>
                    <li><a href="{{ url('user') }}"><i class="fa fa-user"></i> Users </a>
                    </li>
                    
                     <li>
                        <a><i class="fa fa-file-text"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ url('kotas')}}">Kota</a>
                            </li>
                            <li>
                                <a href="{{ url('brands')}}">Brand</a>
                            </li>
                            <li>
                                <a href="{{ url('customers')}}">Customer</a>
                            </li>
                            <li>
                                <a href="{{ url('gudang')}}">Gudang</a>
                            </li>
                            <li>
                                <a href="{{ url('kategoris')}}">Kategori</a>
                            </li>
                            <li>
                                <a href="{{ url('tipe/create')}}">Tipe</a>
                            </li>
                            <li>
                                <a href="{{ url('payments')}}">Payment Method</a>
                            </li>
                            <li>
                                <a href="{{ url('channels')}}">Sales Channel List</a>
                            </li>
                            <li>
                                <a href="{{ url('shippings')}}">Shipping Method</a>
                            </li>
                            <li>
                                <a href="{{ url('sizes')}}">Size</a>
                            </li>
                            <li>
                                <a href="{{ url('styles')}}">Style</a>
                            </li>
                            <li>
                                <a href="{{ url('suppliers')}}">Supplier</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('salesOrders')}}"><i class="fa fa-shopping-cart"></i>Sales Order</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="fa fa-truck"></i>
                            Delivery Order
                        </a>
                    </li>
                </ul>
                @elseif(Auth::user()->jabatan == 'Staf Sales')
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ url('/') }}">
                            <i class="fa fa-home"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('products') }}"><i class="fa fa-barcode"></i> Product</a>
                    </li>
                    <li><a href="{{ url('user') }}"><i class="fa fa-user"></i> Users </a>
                    </li>
                    
                     <li>
                        <a><i class="fa fa-file-text"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ url('kotas')}}">Kota</a>
                            </li>
                            <li>
                                <a href="{{ url('brands')}}">Brand</a>
                            </li>
                            <li>
                                <a href="{{ url('customers')}}">Customer</a>
                            </li>
                            <li>
                                <a href="{{ url('kategoris')}}">Kategori</a>
                            </li>
                            <li>
                                <a href="{{ url('tipe/create')}}">Tipe</a>
                            </li>
                            <li>
                                <a href="{{ url('payments')}}">Payment Method</a>
                            </li>
                            <li>
                                <a href="{{ url('channels')}}">Sales Channel List</a>
                            </li>
                            <li>
                                <a href="{{ url('shippings')}}">Shipping Method</a>
                            </li>
                            <li>
                                <a href="{{ url('sizes')}}">Size</a>
                            </li>
                            <li>
                                <a href="{{ url('styles')}}">Style</a>
                            </li>
                            <li>
                                <a href="{{ url('suppliers')}}">Supplier</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('salesOrders')}}"><i class="fa fa-shopping-cart"></i>Sales Order</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="fa fa-truck"></i>
                            Delivery Order
                        </a>
                    </li>
                </ul>
                @elseif(Auth::user()->jabatan == 'Staf Finance')
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ url('/') }}">
                            <i class="fa fa-home"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('products') }}"><i class="fa fa-barcode"></i> Product</a>
                    </li>
                    <li><a href="{{ url('user') }}"><i class="fa fa-user"></i> Users </a>
                    </li>
                    
                     <li>
                        <a><i class="fa fa-file-text"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ url('customers')}}">Customer</a>
                            </li>
                            <li>
                                <a href="{{ url('gudang')}}">Gudang</a>
                            </li>
                            <li>
                                <a href="{{ url('payments')}}">Payment Method</a>
                            </li>
                            <li>
                                <a href="{{ url('suppliers')}}">Supplier</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('salesOrders')}}"><i class="fa fa-shopping-cart"></i>Sales Order</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="fa fa-truck"></i>
                            Delivery Order
                        </a>
                    </li>
                </ul>
                @elseif(Auth::user()->jabatan == 'Staf Gudang')
                <ul class="nav side-menu">
                    <li>
                        <a href="{{ url('/') }}">
                            <i class="fa fa-home"></i>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('products') }}"><i class="fa fa-barcode"></i> Product</a>
                    </li>
                    <li><a href="{{ url('user') }}"><i class="fa fa-user"></i> Users </a>
                    </li>
                    
                     <li>
                        <a><i class="fa fa-file-text"></i> Master Data <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li>
                                <a href="{{ url('kotas')}}">Kota</a>
                            </li>
                            <li>
                                <a href="{{ url('brands')}}">Brand</a>
                            </li>
                           
                            <li>
                                <a href="{{ url('gudang')}}">Gudang</a>
                            </li>
                            <li>
                                <a href="{{ url('kategoris')}}">Kategori</a>
                            </li>
                            <li>
                                <a href="{{ url('tipe/create')}}">Tipe</a>
                            </li>
                           
                            <li>
                                <a href="{{ url('sizes')}}">Size</a>
                            </li>
                            <li>
                                <a href="{{ url('styles')}}">Style</a>
                            </li>
                            <li>
                                <a href="{{ url('suppliers')}}">Supplier</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ url('salesOrders')}}"><i class="fa fa-shopping-cart"></i>Sales Order</a>
                    </li>
                    <li>
                        <a href="javascript:void(0)">
                            <i class="fa fa-truck"></i>
                            Delivery Order
                        </a>
                    </li>
                </ul>
                @endif
            </div>
            <!--div class="menu_section">
                <h3>Group 2</h3>
                <ul class="nav side-menu">
                </ul>
            </div-->
        
        </div>
        <!-- /sidebar menu -->
        
        <!-- /menu footer buttons -->
       <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Settings">
                <span class="glyphicon glyphicon-cog" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="" data-original-title="FullScreen">
                <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="" data-original-title="Lock">
                <span class="glyphicon glyphicon-eye-close" aria-hidden="true"></span>
              </a>
              <a data-toggle="tooltip" data-placement="top" title="" href="{{url('/logout')}}" data-original-title="Logout">
                <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
        <!-- /menu footer buttons -->
    </div>
</div>

