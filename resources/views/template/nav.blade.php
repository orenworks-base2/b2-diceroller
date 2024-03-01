
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href=" {{ route( 'admin.home' ) }} ">Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href=" {{ route( 'admin.admin' ) }} ">Setting</a>
            </li>
        </ul>
      
        <span class="navbar-text">
          <a class="nav-link logout-a" href=" {{ route( 'admin._logout' ) }} ">logout</a>
        </span>
    </div>
</nav>