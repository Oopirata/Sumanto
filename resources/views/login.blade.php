@extends('main')

@section('title', 'Login')

@section('page')  
<div class="page-container">    
    <div class="mother-grid-inner">
		<div class="login-container">
        <!--inner block start here-->
            <div class="inbox">
                <h2>Inbox</h2>
                <div class="col-md-4 compose">           
                    <div class="mail-profile">
                        <div class="mail-pic">
                            <a href="#"><img src="images/b3.png" alt=""></a>
                        </div>
                        <div class="mailer-name">             
                            <h5><a href="#">Malorum</a></h5>                 
                            <h6><a href="mailto:info@example.com">malorum@gmail.com</a></h6>   
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="compose-block">
                        <a href="inbox-details.html">Compose</a>
                    </div>
                    <div class="compose-bottom">
                        <nav class="nav-sidebar">
                            <ul class="nav tabs">
                                <li class="active">
                                    <a href="#tab1" data-toggle="tab">
                                        <i class="fa fa-inbox"></i>Inbox 
                                        <span>9</span>
                                        <div class="clearfix"></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab2" data-toggle="tab">
                                        <i class="fa fa-envelope-o"></i>Sent
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab3" data-toggle="tab">
                                        <i class="fa fa-star-o"></i>Important
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab4" data-toggle="tab">
                                        <i class="fa fa-pencil-square-o"></i>Draft 
                                        <span>6</span>
                                        <div class="clearfix"></div>
                                    </a>
                                </li>
                                <li>
                                    <a href="#tab5" data-toggle="tab">
                                        <i class="fa fa-trash-o"></i>Delete
                                    </a>
                                </li>                              
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="clearfix"></div>     
            </div>
		</div>
    </div>

    <!--slider menu-->
</div>
<!--slide bar menu end here-->

<!--scrolling js-->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<!--//scrolling js-->
<script src="js/bootstrap.js"></script>
@endsection