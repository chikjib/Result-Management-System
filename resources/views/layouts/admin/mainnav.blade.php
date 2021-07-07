
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="/dist/img/avatar.png" class="img-circle" alt="Admin Image">
        </div>
        <div class="pull-left info">
          
          <p>{{Auth::user()->name}}</p>
          
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active">
          <a href="/admin">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
          </a>
        </li>
        @if(Auth::user()->role == 3)
        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Students Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/view-students"><i class="fa fa-circle-o"></i> View Students</a></li>
          </ul>
        </li>
        @elseif(Auth::user()->role == 2)
        <li class="treeview">
          <a href="#">
            <i class="fa fa-bank"></i>
            <span>School Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/school-setup"><i class="fa fa-circle-o"></i> School Setup</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Students Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/add-students"><i class="fa fa-circle-o"></i> Add Students</a></li>
            <li><a href="/admin/view-students"><i class="fa fa-circle-o"></i> View Students</a></li>
            <li><a href="/admin/mastersheet"><i class="fa fa-circle-o"></i> Master Sheet</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Teachers Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="/admin/add-teachers"><i class="fa fa-circle-o"></i> Add Teachers</a></li>
            <li><a href="/admin/view-teachers"><i class="fa fa-circle-o"></i> View Teachers</a></li>
            <li><a href="/admin/add-form-teachers"><i class="fa fa-circle-o"></i> Add Form Teachers</a></li>
            <li><a href="/admin/view-form-teachers"><i class="fa fa-circle-o"></i> View Form Teachers</a></li>
          </ul>
          
           <li><a href="/admin/upload_gallery"><i class="fa fa-circle-o"></i> Upload Gallery</a></li>
            <li><a href="/admin/admin_staff"><i class="fa fa-circle-o"></i> Admin Staff</a></li>
          
        </li>
        <li><a href="/admin/post"><i class="fa fa-edit"></i> Post</a></li>
      </ul>
      @elseif(Auth::user()->role == 1)
      <li class="treeview">
          <a href="#">
            <i class="fa fa-bank"></i>
            <span>School Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/school-setup"><i class="fa fa-circle-o"></i> School Setup</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-users"></i>
            <span>Students Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/admin/add-students"><i class="fa fa-circle-o"></i> Add Students</a></li>
            <li><a href="/admin/view-students"><i class="fa fa-circle-o"></i> View Students</a></li>
            <li><a href="/admin/mastersheet"><i class="fa fa-circle-o"></i> Master Sheet</a></li>
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-user"></i>
            <span>Teachers Management</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
           <li><a href="/admin/add-teachers"><i class="fa fa-circle-o"></i> Add Teachers</a></li>
            <li><a href="/admin/view-teachers"><i class="fa fa-circle-o"></i> View Teachers</a></li>
            <li><a href="/admin/add-form-teachers"><i class="fa fa-circle-o"></i> Add Form Teachers</a></li>
            <li><a href="/admin/view-form-teachers"><i class="fa fa-circle-o"></i> View Form Teachers</a></li>
          </ul>
        </li>
        
        <li><a href="/admin/upload_gallery"><i class="fa fa-circle-o"></i> Upload Gallery</a></li>
        <li><a href="/admin/admin_staff"><i class="fa fa-circle-o"></i> Admin Staff</a></li>
        <li><a href="/admin/post"><i class="fa fa-edit"></i> Post</a></li>
        <li><a href="/admin/card-generator"><i class="fa fa-edit"></i> Generate Cards</a></li>
      </ul>

      @endif
    </section>
    <!-- /.sidebar -->
  </aside>