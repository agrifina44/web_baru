@extends('layouts.blank')

@push('stylesheets')
    <!-- Example -->
    <!--<link href=" <link href="{{ asset("css/myFile.min.css") }}" rel="stylesheet">" rel="stylesheet">-->
@endpush

@section('main_container')

    <!-- page content -->

   

    <div class="right_col" role="main" style="min-height: 1387px;" >
    <div class="row">
    <p>
    <br/><br/>
    </p>
    </div>
   
    <div class="row"> <image src="image/Logo.png" class="row" id="logo" alt=""/> </image>
    <div class="row">
    <br/>
     </div>
           
            <div class="row top_tiles">
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-check-circle-o"></i></div>
                  <div class="count">3</div>
                  <a href="{{ url('/salesOrders') }}"><h3>To be Confirmed</h3></a>          
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-archive"></i></div>
                  <div class="count">204</div>
                  <a href="{{ url('/products') }}"><h3>Products</h3></a>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-truck"></i></div>
                  <div class="count">4</div>
                  <a href="{{ url('/do') }}"><h3>To be Delivered</h3></a>
                </div>
              </div>
              <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="tile-stats">
                  <div class="icon"><i class="fa fa-users"></i></div>
                  <div class="count">1</div>
                  <a href="{{ url('/user') }}"><h3>Users</h3></a>
                </div>
              </div>
        </div>

        <div class="col-md-12">
                <div class="x_panel">
                 <div class="x_title">
                    <h2>Transaction Summary <small>Weekly progress</small></h2>
                    
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                      <div class="demo-container" style="height:280px">
                        <div id="chart_plot_02" class="demo-placeholder" style="padding: 0px; position: relative;"><canvas class="flot-base" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 693px; height: 280px;" width="693" height="280"></canvas><div class="flot-text" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; font-size: smaller; color: rgb(84, 84, 84);"><div class="flot-x-axis flot-x1-axis xAxis x1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div style="position: absolute; max-width: 62px; top: 265px; left: 177px; text-align: center;" class="flot-tick-label tickLabel">09/08/17</div><div style="position: absolute; max-width: 62px; top: 265px; left: 371px; text-align: center;" class="flot-tick-label tickLabel">15/08/17</div><div style="position: absolute; max-width: 62px; top: 265px; left: 564px; text-align: center;" class="flot-tick-label tickLabel">21/08/17</div><div style="position: absolute; max-width: 86px; top: 265px; left: 81px; text-align: center;" class="flot-tick-label tickLabel">06/08/17</div><div style="position: absolute; max-width: 86px; top: 265px; left: 274px; text-align: center;" class="flot-tick-label tickLabel">12/08/17</div><div style="position: absolute; max-width: 86px; top: 265px; left: 467px; text-align: center;" class="flot-tick-label tickLabel">18/08/17</div></div><div class="flot-y-axis flot-y1-axis yAxis y1Axis" style="position: absolute; top: 0px; left: 0px; bottom: 0px; right: 0px; display: block;"><div style="position: absolute; top: 247px; left: 12px; text-align: right;" class="flot-tick-label tickLabel">0</div><div style="position: absolute; top: 206px; left: 6px; text-align: right;" class="flot-tick-label tickLabel">20</div><div style="position: absolute; top: 165px; left: 6px; text-align: right;" class="flot-tick-label tickLabel">40</div><div style="position: absolute; top: 124px; left: 6px; text-align: right;" class="flot-tick-label tickLabel">60</div><div style="position: absolute; top: 83px; left: 6px; text-align: right;" class="flot-tick-label tickLabel">80</div><div style="position: absolute; top: 42px; left: 0px; text-align: right;" class="flot-tick-label tickLabel">100</div><div style="position: absolute; top: 1px; left: 0px; text-align: right;" class="flot-tick-label tickLabel">120</div></div></div><canvas class="flot-overlay" style="direction: ltr; position: absolute; left: 0px; top: 0px; width: 693px; height: 280px;" width="693" height="280"></canvas><div class="legend"><div style="position: absolute; width: 71px; height: 15px; top: -17px; right: 21px; background-color: rgb(255, 255, 255); opacity: 0.85;"> </div><table style="position:absolute;top:-17px;right:21px;;font-size:smaller;color:#3f3f3f"><tbody><tr><td class="legendColorBox"><div style="border:1px solid null;padding:1px"><div style="width:4px;height:0;border:5px solid rgb(150,202,89);overflow:hidden"></div></div></td><td class="legendLabel">Email Sent&nbsp;&nbsp;</td></tr></tbody></table></div></div>
                      </div>
                      <div class="tiles">
                        <div class="col-md-4 tile">
                          <span>Total Sessions</span>
                          <h2>231,809</h2>
                          <span class="sparkline11 graph" style="height: 160px;"><canvas style="display: inline-block; width: 198px; height: 40px; vertical-align: top;" width="198" height="40"></canvas></span>
                        </div>
                        <div class="col-md-4 tile">
                          <span>Total Revenue</span>
                          <h2>$231,809</h2>
                          <span class="sparkline22 graph" style="height: 160px;"><canvas style="display: inline-block; width: 200px; height: 40px; vertical-align: top;" width="200" height="40"></canvas></span>
                        </div>
                        <div class="col-md-4 tile">
                          <span>Total Sessions</span>
                          <h2>231,809</h2>
                          <span class="sparkline11 graph" style="height: 160px;"><canvas style="display: inline-block; width: 198px; height: 40px; vertical-align: top;" width="198" height="40"></canvas></span>
                        </div>
                      </div>

                    </div>

                    <div class="col-md-3 col-sm-12 col-xs-12">
                      <div>
                        <div class="x_title">
                          <h2>Top Products</h2>                         
                          <div class="clearfix"></div>
                        </div>
                        <ul class="list-unstyled top_profiles scroll-view">
                          <li class="media event">
                            <a class="pull-left border-aero profile_thumb">
                              <i class="fa fa-user aero"></i>
                            </a>
                            <div class="media-body">
                              <a class="title" href="#">Printer Cannon IP300</a>
                              <p><strong>$2300. </strong> Agent Avarage Sales </p>
                              <p> <small>12 Sales Today</small>
                              </p>
                            </div>
                          </li>
                          <li class="media event">
                            <a class="pull-left border-green profile_thumb">
                              <i class="fa fa-user green"></i>
                            </a>
                            <div class="media-body">
                              <a class="title" href="#">Wireless Mouse</a>
                              <p><strong>$2300. </strong> Agent Avarage Sales </p>
                              <p> <small>12 Sales Today</small>
                              </p>
                            </div>
                          </li>
                          <li class="media event">
                            <a class="pull-left border-blue profile_thumb">
                              <i class="fa fa-user blue"></i>
                            </a>
                            <div class="media-body">
                              <a class="title" href="#">USB Cable</a>
                              <p><strong>$2300. </strong> Agent Avarage Sales </p>
                              <p> <small>12 Sales Today</small>
                              </p>
                            </div>
                          </li>
                          <li class="media event">
                            <a class="pull-left border-aero profile_thumb">
                              <i class="fa fa-user aero"></i>
                            </a>
                            <div class="media-body">
                              <a class="title" href="#">Harddisk</a>
                              <p><strong>$2300. </strong> Agent Avarage Sales </p>
                              <p> <small>12 Sales Today</small>
                              </p>
                            </div>
                          </li>
                          <li class="media event">
                            <a class="pull-left border-green profile_thumb">
                              <i class="fa fa-user green"></i>
                            </a>
                            <div class="media-body">
                              <a class="title" href="#">USB Connector</a>
                              <p><strong>$2300. </strong> Agent Avarage Sales </p>
                              <p> <small>12 Sales Today</small>
                              </p>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
     
    </div>


    </div>




                        
       <!-- /page content -->

    <!-- footer content -->
  <footer>
          <div class="pull-right">
            KP 504A - Sistem Informasi Manajemen Gudang <a href="https://infision.id">Infision</a>
          </div>
          <div class="clearfix"></div>
        </footer>
    <!--/footer content -->
@endsection