
@extends('layouts.app')
@section('title') Lector de QR @endsection
@section('page_active') Lector de QR @endsection 
@section('subpage_active') Lector @endsection 


@section('styles')
    <style>
        .card-reader{
           
            padding: 10px;
            border-radius: 20px; 
        }
        .card-reader img{
            border-radius: 15px;
        }
    
    </style>
@endsection

 
@section('content')
<!-- Start Content-->
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-8">
            <div class="card">
                <div class="bg-picture card-body">
                    <div class="d-flex align-items-top">
                        <img src="../assets/images/users/profile.jpg"
                                class="flex-shrink-0 rounded-circle avatar-xl img-thumbnail float-start me-3" alt="profile-image">

                        <div class="flex-grow-1 overflow-hidden">
                            <h4 class="m-0">Alexandra Clarkson</h4>
                            <p class="text-muted"><i>Web Designer</i></p>
                            <p class="font-13">Hi I'm Alexandra Clarkson,has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature it over 2000 years to popular belief Ipsum is not simplyrandom text.</p>

                            <ul class="social-list list-inline mt-3 mb-0">
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-purple text-purple"><i
                                            class="mdi mdi-facebook"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-danger text-danger"><i
                                            class="mdi mdi-google"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-info text-info"><i
                                            class="mdi mdi-twitter"></i></a>
                                </li>
                                <li class="list-inline-item">
                                    <a href="javascript: void(0);" class="social-list-item border-secondary text-secondary"><i
                                            class="mdi mdi-github"></i></a>
                                </li>
                            </ul>

                        </div>

                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <!--/ meta -->

            <div class="card">
            <form method="post" class="card-body">
                <span class="input-icon icon-end">
                    <textarea rows="3" class="form-control" placeholder="Post a new message"></textarea>
                </span>
                <div class="pt-1 float-end">
                    <a href="" class="btn btn-primary btn-sm waves-effect waves-light">Send</a>
                </div>
                <ul class="nav nav-pills profile-pills mt-1">
                    <li>
                        <a href="#"><i class="fa fa-user"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-location-arrow"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class=" fa fa-camera"></i></a>
                    </li>
                    <li>
                        <a href="#"><i class="far fa-smile"></i></a>
                    </li>
                </ul>

            </form>
            </div>

            <div class="card">
            <div class="card-body">
                <div class="d-flex align-items-top mb-2">
                    <img src="../assets/images/users/user-1.jpg" alt="" class="flex-shrink-0 comment-avatar avatar-sm rounded me-2">
                    <div class="flex-grow-1">
                        <h5 class="mt-0"><a href="#" class="text-dark">Adam Jansen</a><small class="ms-1 text-muted">about 2 minuts ago</small></h5>
                        <p>Story based around the idea of time lapse, animation to post soon!</p>
                        <div>
                            <a href="">
                                <img src="../assets/images/small/img-1.jpg" class="avatar-md rounded">
                            </a>
                            <a href="">
                                <img src="../assets/images/small/img-2.jpg" class="avatar-md rounded">
                            </a>
                            <a href="">
                                <img src="../assets/images/small/img-3.jpg" class="avatar-md rounded">
                            </a>
                        </div>
                        <div class="comment-footer pt-2 mb-3">
                            <a href="#"><i class="far fa-thumbs-up"></i></a>
                            <a href="#"><i class="far fa-thumbs-down"></i></a>
                            <a href="#">Reply</a>
                        </div>
                        
                        <div class="d-flex align-items-top mb-2">
                            <img src="../assets/images/users/user-3.jpg" alt="" class="flex-shrink-0 comment-avatar avatar-sm rounded me-2">
                            <div class="flex-grow-1">
                                <h5 class="mt-0"><a href="#" class="text-dark">John Smith</a><small class="ms-1 text-muted">about 1 hour ago</small></h5>
                                <p>Wow impressive!</p>

                                <div class="comment-footer">
                                    <a href="#"><i class="far fa-thumbs-up"></i></a>
                                    <a href="#"><i class="far fa-thumbs-down"></i></a>
                                    <a href="#">Reply</a>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex align-items-top">
                            <img src="../assets/images/users/user-4.jpg" alt="" class="flex-shrink-0 comment-avatar avatar-sm rounded me-2">
                            <div class="flex-grow-1">
                                <h5 class="mt-0"><a href="#" class="text-dark">Matt Cheuvront</a><small class="ms-1 text-muted">about 2 hour ago</small></h5>
                                <p>Wow, that is really nice.</p>

                                <div class="comment-footer mb-3">
                                    <a href="#"><i class="far fa-thumbs-up"></i></a>
                                    <a href="#"><i class="far fa-thumbs-down"></i></a>
                                    <a href="#">Reply</a>
                                </div>

                                <div class="d-flex align-items-top mb-2">
                                    <img src="../assets/images/users/user-5.jpg" alt="" class="flex-shrink-0 comment-avatar avatar-sm rounded me-2">
                                    <div class="flex-grow-1">
                                        <h5 class="mt-0"><a href="#" class="text-dark">Stephanie Walter</a><small class="ms-1 text-muted">about 3 hour ago</small></h5>
                                        <p>Nice work, makes me think of The Money Pit.</p>

                                        <div class="comment-footer">
                                            <a href="#"><i class="far fa-thumbs-up"></i></a>
                                            <a href="#"><i class="far fa-thumbs-down"></i></a>
                                            <a href="#">Reply</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  media -->

                <div class="d-flex align-items-top mb-3">
                    <img src="../assets/images/users/user-6.jpg" alt="" class="flex-shrink-0 comment-avatar avatar-sm rounded me-2">
                    <div class="flex-grow-1">
                        <h5 class="mt-0"><a href="#" class="text-dark">John Smith</a><small class="ms-1 text-muted">about 4 hour ago</small></h5>
                        <p>i'm in the middle of a timelapse animation myself! (Very different though.) Awesome stuff.</p>

                        <div class="comment-footer">
                            <a href="#"><i class="far fa-thumbs-up"></i></a>
                            <a href="#"><i class="far fa-thumbs-down"></i></a>
                            <a href="#">Reply</a>
                        </div>
                    </div>
                </div>

                <div class="d-flex align-items-top mb-3">
                    <img src="../assets/images/users/user-7.jpg" alt="" class="flex-shrink-0 comment-avatar avatar-sm rounded me-2">
                    <div class="flex-grow-1">
                        <h5 class="mt-0"><a href="#" class="text-dark">Nicolai Larson</a><small class="ms-1 text-muted">about 10 hour ago</small></h5>
                        <p>The parallax is a little odd but O.o that house build is awesome!!</p>

                        <div class="comment-footer">
                            <a href="#"><i class="far fa-thumbs-up"></i></a>
                            <a href="#"><i class="far fa-thumbs-down"></i></a>
                            <a href="#">Reply</a>
                        </div>
                    </div>
                </div>

                <div class="text-center">
                    <a href="" class="text-danger"><i class="mdi mdi-spin mdi-loading me-1"></i> Load more </a>
                </div>
            </div>
            </div>
        </div>

        <div class="col-sm-4">
            <div class="card card-reader">
                <div class="card-body">
                    <h4 class="header-title mt-0 mb-3">Apunta tu código al lector</h4>

                    <video class="preview" style="width: 100%;height: 500px;background: #000;border-radius: 45px;"></video> 
                    <div class="card-content">
                        <h2 class="site-backdrop"></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>    
</div><!-- container-fluid -->

@endsection 


@section('scripts')
<script type="text/javascript" src="{{ asset('resources/js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('resources/js/instascan.min.js') }}"></script>

<script type="text/javascript">
    var sound = new Audio("barcode.wav");
    let scanner = new Instascan.Scanner({video:document.getElementById("preview")});

    scanner.addListener("scan", function(content) {
        sound.play();

        $(".site-backdrop").html(response);
    });

    Instascan.Camera.getCameras().then(function(cameras) {
        if(cameras.length > 0) {
            scanner.start(cameras[0]);
        }else {
            console.log("La camara no funciona");
        }
    });
</script>
@endsection 