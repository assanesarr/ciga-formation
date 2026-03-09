<div class="col-lg-4">
    <div class="blog_right_sidebar">

            <aside class="single_sidebar_widget popular_post_widget">
                <h3 class="widget_title">Last Événements</h3>
                @foreach($events as $event)
                    <div class="media post_item">
                        <img src="{{ $event->thumbnail }}" style="width: 100px; height: 60px" alt="post">
                        <div class="media-body">
                            <a href="{{ route('details', ['view'=> 'event', 'slug'=> $event->slug]) }}">
                                <h3>{{ $event->title }}</h3>
                            </a>
                            <p>{{ $event->created_at }}</p>
                        </div>
                    </div>
                    <div class="br"></div>
                @endforeach
            </aside>

        <aside class="single_sidebar_widget ads_widget">
            <a href="#"><img class="img-fluid" src="/img/blog/add.jpg" alt=""></a>
            <div class="br"></div>
        </aside>


        <aside class="single-sidebar-widget tag_cloud_widget">
            <h4 class="widget_title">Top Courses</h4>
            <ul class="list">
                <li><a href="#">Technology</a></li>
                <li><a href="#">Fashion</a></li>
                <li><a href="#">Architecture</a></li>
                <li><a href="#">Fashion</a></li>
                <li><a href="#">Food</a></li>
                <li><a href="#">Technology</a></li>
                <li><a href="#">Lifestyle</a></li>
                <li><a href="#">Art</a></li>
                <li><a href="#">Adventure</a></li>
                <li><a href="#">Food</a></li>
                <li><a href="#">Lifestyle</a></li>
                <li><a href="#">Adventure</a></li>
            </ul>
        </aside>
    </div>
</div>
