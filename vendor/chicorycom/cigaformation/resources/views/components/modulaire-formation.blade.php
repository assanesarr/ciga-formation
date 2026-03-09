@if(count($formations) > 0)
<!--================ Start Trainers Area =================-->
<section class="trainer_area section_gap_top">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="main_title">
                    <h2 class="mb-3">Formation modulaire</h2>
                    <p>
                        Une formation de qualité au service des jeunes et des professionnels
                    </p>
                </div>
            </div>
        </div>
        <div class="row justify-content-center d-flex align-items-center">
            @foreach($formations as $formation)
                <div class="col-lg-3 col-md-6 col-sm-12 single-trainer">
                <div class="thumb d-flex justify-content-sm-center">
                    <img class="img-fluid" src="{{ $formation->thumbnail }}" alt=""  style="width: 100%"/>
                </div>
                <div class="meta-text text-sm-center">
                    <h4>{{ $formation->title }}</h4>
                    <p class="designation">Formation en {{ $formation->duration }}</p>
                    <div class="mb-4">
                        {!! Str::words($formation->body, 10) !!}
                    </div>
                    <div class="align-items-center justify-content-center d-flex">
                        <a href="{{ route('details', ['view'=> 'course', 'slug'=> $formation->slug]) }}" class="btn ">Voir Détail</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!--================ End Trainers Area =================-->
@endif
