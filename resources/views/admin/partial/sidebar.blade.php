   <aside class="main-sidebar sidebar-dark-primary elevation-4">
       <!-- Brand Logo -->
       <a href="index3.html" class="brand-link">
           <img src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo"
               class="brand-image img-circle elevation-3" style="opacity: .8">
           <span class="brand-text font-weight-light">AdminLTE 3</span>
       </a>

       <!-- Sidebar -->
       <div class="sidebar">
           <!-- Sidebar user panel (optional) -->
           <div class="user-panel mt-3 pb-3 mb-3 d-flex">
               <div class="image">
                   <img src="{{ asset('dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
               </div>
               <div class="info">
                   <a href="#" class="d-block">Alexander Pierce</a>
               </div>
           </div>

           <!-- Sidebar Menu -->
           <nav class="mt-2">
               <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                   data-accordion="false">
                   <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
                   <li class="nav-item">
                       <a href="{{ url('admin/dashboard') }}" class="nav-link">
                           <i class="nav-icon fas fa-tachometer-alt"></i>
                           <p>
                               Dashboard
                           </p>
                       </a>
                   </li>

                   <li class="nav-item">
                       <a href="{{ url('admin/referee') }}" class="nav-link">
                           <i class="nav-icon fas fa-users"></i>
                           <p>
                               Referee
                           </p>
                       </a>
                   </li>

                   <li class="nav-item">
                       <a href="{{ url('admin/users') }}" class="nav-link">
                           <i class="nav-icon fas fa-users"></i>
                           <p>
                               Users
                           </p>
                       </a>
                   </li>
                   <li class="nav-item">
                       <a href="{{ url('admin/category') }}" class="nav-link">
                           <i class="nav-icon fas fa-tags"></i>
                           <p>
                               Cateogory
                           </p>
                       </a>
                   </li>
                   <li class="nav-item">
                       <a  href="{{url('admin/referral_web_site')}}" class="nav-link">
                       <i style="font-size: 18px; padding: 0 5px;" class="fas fa-podcast"></i>
                           <p>
                               Referral Website
                           </p>
                       </a>
                   </li>
                   <li class="nav-item">
                       <a href="{{url('admin/referral_links')}}" class="nav-link">
                           <i class="nav-icon fas fa-link"></i>
                           <p>
                               Referral Links
                           </p>
                       </a>
                   </li>
                   <li class="nav-item">
                       <a href="{{ url('logout') }}" class="nav-link" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                           
                           <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                               @csrf
                           </form>
                           <i class="nav-icon fas fa-sign-out-alt"></i>
                           <p>
                               Logout
                           </p>
                       </a>
                   </li>
               </ul>
           </nav>
           <!-- /.sidebar-menu -->
       </div>
       <!-- /.sidebar -->
   </aside>
   <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
   <script>
       $(document).ready(function() {
           // Get the current URL path
           var path = window.location.pathname;

           // Find the corresponding nav-link and add the active class
           $('.nav-link').each(function() {
               var href = $(this).attr('href');
               if (href === path || window.location.href.indexOf(href) !== -1) {
                   $(this).addClass('active');
               }
           });
       });
   </script>
