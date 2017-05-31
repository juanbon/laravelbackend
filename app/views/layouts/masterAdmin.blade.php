<!DOCTYPE html>
<html>
	<head>
		<title>Admin</title>
        <meta charset="utf-8" />
        {{HTML::script(Request::root()."/public/adminjs/jquery-1.11.1.min.js")}}
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            {{HTML::script(Request::root()."/public/adminjs/html5shiv.js")}}
            {{HTML::script(Request::root()."/public/adminjs/respond.min.js")}}
        <![endif]-->
        @if(!empty($ckeditor))
        {{HTML::script(Request::root()."/public/ckeditor/ckeditor.js")}}
        @endif 
        {{HTML::script(Request::root()."/public/adminjs/main.js")}}
        {{HTML::script(Request::root()."/public/bootstrap/js/bootstrap.min.js")}}
        {{HTML::script(Request::root()."/public/js/script.js")}}

        {{HTML::style(Request::root()."/public/css/styles.css")}}
        {{HTML::style("http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css")}}
       
        {{HTML::script("http://code.jquery.com/ui/1.10.1/jquery-ui.js")}}
    
        {{HTML::style(Request::root()."/public/bootstrap/css/bootstrap.min.css")}}
        {{HTML::style(Request::root()."/public/bootstrap/css/bootstrap-theme.min.css")}}
        {{HTML::style(Request::root()."/public/bootstrap/css/login.css")}}
		@yield('head')
	</head>
    <body>
        @section('navbar')
            <div class="navbar navbar-default navbar-fixed-top" role="navigation">
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                      <a class="navbar-brand" href="javascript:void(0)">Osole Backend</a>
                    </div>
                       <?php if($file=='slider'){
                        $file=$section;
                       }?>
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                @if(!empty($adminData))
                                <li @if($file == 'welcome') {{'class="active"'}} @endif>{{ HTML::link( 'admin/welcome', 'Home') }}</li>
                                @endif   
                                @if(!empty($access->news->view))
                                    <li @if($file == 'usuarios') {{'class="active"'}} @endif>{{ HTML::link( 'admin/usuarios', 'Usuarios') }}</li>
                                @endif  
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{(!empty($adminData))?ucfirst($adminData->user):NULL}} <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                        <li>{{ HTML::link( 'admin/admins/list', 'Manage Admins') }}</li>
                                        <li class="divider"></li>
                                    <li>{{ HTML::link('admin/logout', 'Logout') }}</li>
                                </ul>
                                </li>
                                <li>&nbsp;&nbsp;</li>
                            </ul>
                            
                        </div><!--/.nav-collapse -->
                  
            </div>
        @show
        <div class="container-fluid">
            <div class="page-header">
                <h1 class="float-left">
                    @section('title') 
                        Admin 
                    @show
                </h1>
                @yield('search')
                <div class="clear"></div>
                @if (Session::has('message_error'))
                    <div class="alert alert-danger alert-block"><button type="button" class="close" data-dismiss="alert">&times;</button><h4>Warning!</h4>{{ Session::get('message_error'); }}
                        @if(!empty($errors))
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif
                    </div>
                @endif

                @if (Session::has('message_success'))
                    <div class="alert alert-success alert-block"><button type="button" class="close" data-dismiss="alert">&times;</button><h4>Success!</h4>{{ Session::get('message_success'); }}
                    </div>
                @endif

            </div>  
            @yield('content')
            <hr>
            <footer>
                <p>&copy; Juan Bonifacio <?php echo date('Y'); ?></p>
            </footer>
        </div>

        <div id="deleteModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Delete Item</h4>
                    </div>
                    <div class="modal-body">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger btnDelete">Delete</button>
                    </div>
            </div>
          </div>
        </div>
    </body>
</html>