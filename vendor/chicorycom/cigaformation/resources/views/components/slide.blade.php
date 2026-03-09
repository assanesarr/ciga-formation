@php($slidecount = count($slides))
@if($slidecount > 0)
<!--================ Start Home Banner Area =================-->
<section id="myCarousel"  class="carousel slide" data-ride="carousel" >
    <ol class="carousel-indicators">
        @for($i = 0; $i < $slidecount; $i++)
            <li data-target="#myCarousel" data-slide-to="{{ $i }}" class="{{ $i == 0 ? 'active' : '' }}"></li>
        @endfor
    </ol>
    @foreach($slides as $slide)
        <div class="carousel-item  @if ($loop->first) active @endif h-100" style='background: rgba(0, 0, 0, 0) url({{ $slide->src }}) no-repeat scroll center center / cover;'>
            <div class="container">
                <div class="caption ">
                    <h1 class="title wow fadeInUp" data-wow-delay=".25s">{{ $slide->title }}</h1>
                    <a class="btn btn-primary wow fadeInUp" href="#pre-registration" data-scroll data-wow-delay=".85s">Pré-inscription</a>
                </div>
            </div>
        </div>
    @endforeach


    <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>

</section>
<!--================ End Home Banner Area =================-->
@endif
