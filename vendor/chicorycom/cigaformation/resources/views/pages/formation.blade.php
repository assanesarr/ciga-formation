@extends('chicorycom::layouts.app')

@section('content')

@section('header')
    @include('chicorycom::partials.header-page')
@stop

<section class="course_details_area section_gap">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 course_details_left">
                <div class="main_image">
                    <img class="img-fluid" src="{{ url($data->img_view) }}" alt="{{ $data->title }}">
                </div>
                <div class="content_wrapper">
                    <h4 class="title">{{ $data->title }}</h4>
                    <div class="content">
                       {!! $data->body !!}
                    </div>
<!--
                    <h4 class="title">Course Outline</h4>
                    <div class="content">
                        <ul class="course_list">
                            <li class="justify-content-between d-flex">
                                <p>Introduction Lesson</p>
                                <a class="primary-btn text-uppercase" href="#">View Details</a>
                            </li>
                            <li class="justify-content-between d-flex">
                                <p>Basics of HTML</p>
                                <a class="primary-btn text-uppercase" href="#">View Details</a>
                            </li>
                            <li class="justify-content-between d-flex">
                                <p>Getting Know about HTML</p>
                                <a class="primary-btn text-uppercase" href="#">View Details</a>
                            </li>
                            <li class="justify-content-between d-flex">
                                <p>Tags and Attributes</p>
                                <a class="primary-btn text-uppercase" href="#">View Details</a>
                            </li>
                            <li class="justify-content-between d-flex">
                                <p>Basics of CSS</p>
                                <a class="primary-btn text-uppercase" href="#">View Details</a>
                            </li>
                            <li class="justify-content-between d-flex">
                                <p>Getting Familiar with CSS</p>
                                <a class="primary-btn text-uppercase" href="#">View Details</a>
                            </li>
                            <li class="justify-content-between d-flex">
                                <p>Introduction to Bootstrap</p>
                                <a class="primary-btn text-uppercase" href="#">View Details</a>
                            </li>
                            <li class="justify-content-between d-flex">
                                <p>Responsive Design</p>
                                <a class="primary-btn text-uppercase" href="#">View Details</a>
                            </li>
                            <li class="justify-content-between d-flex">
                                <p>Canvas in HTML 5</p>
                                <a class="primary-btn text-uppercase" href="#">View Details</a>
                            </li>

                        </ul>
                    </div>
                    -->
                </div>
            </div>


            <div class="col-lg-4 right-contents">
                <ul>
                    <li>
                        <a class="justify-content-between d-flex" href="#">
                           <!-- <p>Trainer’s Name</p> -->
                            <span class="or">{{ $data->title }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="justify-content-between d-flex" href="#">
                            <p> <i class="ti-calendar"></i> Duration </p>
                            <span>{{ $data->duration }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="justify-content-between d-flex" href="#">
                            <p><i class="ti-bar-chart"></i> Degree level: </p>
                            <span>{{ $data->level }}</span>
                        </a>
                    </li>
                    <li>
                        <a class="justify-content-between d-flex" href="#">
                            <p><i class="ti-calendar"></i> Schedule </p>
                            <span>10.00 h to 12.00 h</span>
                        </a>
                    </li>
                    <li>
                        <a class="justify-content-between d-flex" href="#">
                            <p><i class="ti-credit-card"></i> Price </p>
                            <span>{{ $data->price }}</span>
                        </a>
                    </li>
                </ul>
                <a href="#" class="primary-btn2 text-uppercase enroll rounded-0 text-white">Inscrivez-vous au cours</a>

                <h4 class="title">Commentaires</h4>
                <div class="content">

                    <div class="feedeback">
                        <h6>Vos Feedback</h6>
                        <textarea name="feedback" class="form-control" cols="10" rows="10"></textarea>
                        <div class="mt-10 text-right">
                            <a href="#" class="primary-btn2 text-right rounded-0 text-white">Submit</a>
                        </div>
                    </div>
                    <!--
                    <div class="comments-area mb-30">
                        <div class="comment-list">
                            <div class="single-comment single-reviews justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="/img/blog/c1.jpg" alt="">
                                    </div>
                                    <div class="desc">
                                        <h5><a href="#">Emilly Blunt</a>
                                            <div class="star">
                                                <span class="ti-star checked"></span>
                                                <span class="ti-star checked"></span>
                                                <span class="ti-star checked"></span>
                                                <span class="ti-star"></span>
                                                <span class="ti-star"></span>
                                            </div>
                                        </h5>
                                        <p class="comment">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                            eiusmod tempor incididunt ut labore et dolore.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-list">
                            <div class="single-comment single-reviews justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="/img/blog/c2.jpg" alt="">
                                    </div>
                                    <div class="desc">
                                        <h5><a href="#">Elsie Cunningham</a>
                                            <div class="star">
                                                <span class="ti-star checked"></span>
                                                <span class="ti-star checked"></span>
                                                <span class="ti-star checked"></span>
                                                <span class="ti-star"></span>
                                                <span class="ti-star"></span>
                                            </div>
                                        </h5>
                                        <p class="comment">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                            eiusmod tempor incididunt ut labore et dolore.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="comment-list">
                            <div class="single-comment single-reviews justify-content-between d-flex">
                                <div class="user justify-content-between d-flex">
                                    <div class="thumb">
                                        <img src="/img/blog/c3.jpg" alt="">
                                    </div>
                                    <div class="desc">
                                        <h5><a href="#">Maria Luna</a>
                                            <div class="star">
                                                <span class="ti-star checked"></span>
                                                <span class="ti-star checked"></span>
                                                <span class="ti-star checked"></span>
                                                <span class="ti-star"></span>
                                                <span class="ti-star"></span>
                                            </div>
                                        </h5>
                                        <p class="comment">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                            eiusmod tempor incididunt ut labore et dolore.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    -->
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

