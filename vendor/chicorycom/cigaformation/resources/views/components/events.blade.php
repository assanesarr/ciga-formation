<!--================Blog Area ================= -->
<section class="blog_area section_gap">
    <div class="container">

        <div class="row">
            <div class="col-lg-8">
                <div class="blog_left_sidebar">
                    @foreach($events as $event)
                        <article class="row blog_item">
                            <div class="col-md-3">
                                <div class="blog_info text-right">
                                    <div class="post_tag">
                                        <span >{{ $event->type }}</span>

                                    </div>
                                    <ul class="blog_meta list">
                                        <li><a href="#">{{ $event->location }}<i class="ti-user"></i></a></li>
                                        <li><a href="#">{{ $event->created_at->format("F jS, Y") }}<i class="ti-calendar"></i></a></li>
                                        <li><a href="#">{{ views($event)->unique()->count() }} Vues<i class="ti-eye"></i></a></li>
                                        <li><a href="#">0 Comments<i class="ti-comment"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="blog_post">
                                    <img src="{{ url($event->img_view) }}" alt="">
                                    <div class="blog_details">
                                        <a href="{{ route('details', ['view'=> 'event', 'slug'=> $event->slug]) }}">
                                            <h2>{{ $event->title }}</h2>
                                        </a>

                                        <!--<a href="single-blog.html" class="blog_btn">View More</a> -->
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach


                   <!--
                    <nav class="blog-pagination justify-content-center d-flex">
                        <ul class="pagination">
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Previous">
                                        <span aria-hidden="true">
                                            <i class="ti-angle-left"></i>
                                        </span>
                                </a>
                            </li>
                            <li class="page-item"><a href="#" class="page-link">01</a></li>
                            <li class="page-item active"><a href="#" class="page-link">02</a></li>
                            <li class="page-item"><a href="#" class="page-link">03</a></li>
                            <li class="page-item"><a href="#" class="page-link">04</a></li>
                            <li class="page-item"><a href="#" class="page-link">09</a></li>
                            <li class="page-item">
                                <a href="#" class="page-link" aria-label="Next">
                                        <span aria-hidden="true">
                                            <i class="ti-angle-right"></i>
                                        </span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    -->
                </div>
            </div>
            @include('chicorycom::components.left-sidebar-event')
        </div>

    </div>
</section>
<!--================Blog Area =================-->
