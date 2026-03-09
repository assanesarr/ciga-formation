@if(count($toFormations) > 0)
<!--================ Start Popular Courses Area =================-->
<div class="popular_courses ">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="main_title">
                    <h2 class="mb-3">Nos cours populaires</h2>
                    <p>
                        Une formation de qualité au service des jeunes et des professionnels
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <!-- single course -->
            <div class="col-lg-12">
                <div class="owl-carousel active_course">
                    @foreach($toFormations as $formation)
                        <div class="single_course">
                        <div class="course_head">
                            <img class="img-fluid" src="{{ url($formation->img_read) }}" alt="" />
                        </div>
                        <div class="course_content">
                            <a href="{{ route('details', ['view'=> 'formation', 'slug'=> $formation->slug]) }}" class="tag mb-4 d-inline-block">Voir les détails</a>
                            <h4 class="mb-3">
                                <a href="{{ route('details', ['view'=> 'formation', 'slug'=> $formation->slug]) }}">{{ $formation->title }}</a>
                            </h4>
                            <p>
                                {!! Str::words($formation->body, 11) !!}
                            </p>
                            <div class="course_meta d-flex justify-content-lg-between align-items-lg-center flex-lg-row flex-column mt-4">
                                <ul class="_meta">
                                    <li class="d-inline-block mr-2">
                                        <i class="ti-calendar"></i> Duration: {{ $formation->duration }}
                                    </li>
                                    <li class="d-inline-block mr-2">
                                        <i class="ti-bar-chart"></i> Degree level: {{ $formation->level }}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<!--================ End Popular Courses Area =================-->
@endif
