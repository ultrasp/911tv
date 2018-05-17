<!-- Preloader -->
  <div class="leftpanel">
    <div class="logopanel">
        <h1><span>Live</span> TV<span></span></h1>
    </div><!-- logopanel -->
    <div class="leftpanelinner">
      <!-- This is only visible to small devices -->
      <div class="visible-xs hidden-sm hidden-md hidden-lg">
          <h5 class="sidebartitle actitle">Account</h5>
          <ul class="nav nav-pills nav-stacked nav-bracket mb30">
            <li><a href="{{route('admin.change_pass')}}"><i class="fa fa-cog"></i> <span>Change Password</span></a></li>
            <li><a href="{{route('admin.logout')}}"><i class="fa fa-sign-out"></i> <span>Sign Out</span></a></li>
          </ul>
      </div>
      <h5 class="sidebartitle">Navigation</h5>
      <ul class="nav nav-pills nav-stacked nav-bracket">
        <li>
          <a href="{{route('admin.dashboard')}}">
            <i class="fa fa-home"></i> <span>Dashboard</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.client.index')}}">
            <i class="fa fa-users"></i> <span>Clients</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.channel.add')}}">
            <i class="fa fa-desktop"></i> <span>Add Channel</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.channel.index')}}">
            <i class="fa fa-table"></i> <span>Channel list</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.platform.index')}}">
            <i class="fa fa-table"></i> <span>Platforms</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.payment.index')}}">
            <i class="fa fa-dollar"></i> <span>Payment log</span>
          </a>
        </li>
        <li>
          <a href="{{route('admin.tarif.index')}}">
            <i class="fa fa-cogs"></i> Pricing Plan 
          </a>
        </li>
        <li>
          <a href="{{route('admin.feedback')}}">
            <i class="fa fa-cogs"></i> Feedback 
          </a>
        </li>
        <li>
          <a href="{{route('admin.setting.index')}}">
            <i class="fa fa-cogs"></i> <span>General Setting</span>
          </a>
        </li>
      </ul>
    </div><!-- leftpanelinner -->
  </div><!-- leftpanel -->
  <div class="mainpanel">
    <div class="headerbar">
      <a class="menutoggle"><i class="fa fa-bars"></i></a>
      <div class="header-right">
        <ul class="headermenu">
          <li>
            <div class="btn-group">
              <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <img src="{{asset('images/front/uid.png')}}">
                <span class="caret"></span>
              </button>
              <ul class="dropdown-menu dropdown-menu-usermenu pull-right">
                <li>
                  <a href="{{route('admin.change_pass')}}">
                    <i class="fa fa-cog"></i> 
                    <span>Change Password</span>
                  </a>
                </li>
                <li>
                  <a href="{{route('admin.logout')}}">
                    <i class="fa fa-sign-out"></i>
                    <span>Sign Out</span>
                  </a>
                </li>
              </ul>
            </div>
          </li>
        </ul>
      </div><!-- header-right -->
    </div><!-- headerbar -->