@extends('chicorycom::layouts.app')

@section('content')

    <!--================ Start Feature Area =================-->
    <section class="about_area section_gap">
        <div class="container">
            <div class="row h_blog_item">
                <div class="col-lg-6">
                    <div class="h_blog_img slide carousel-fade " id="actuality" data-ride="carousel">
                        <div class="_actuality"> <i class="ti-rss"></i> ACTUALITÉS</div>
                        <div class="carousel-inner shadow p-3">
                            @foreach($events as $event)
                                <div class="carousel-item @if ($loop->first) active @endif">
                                    <div class="single_event position-relative">
                                        <div class="event_thumb">
                                            <img src="{{ $event->img }}" alt="" style="width: 555px; height: 400px;" />
                                        </div>
                                        <div class="event_details">

                                            @if($event->type == 'EVENT')

                                                <div class="d-flex mb-4" >
                                                    <div class="date"><span>{{ date('d', strtotime($event->inDate))  }} </span> {{ date('M', strtotime($event->inDate))  }}</div>

                                                    <div class="time-location">
                                                        <p>
                                                            <span class="ti-time mr-2"></span> {{ $event->start .'-'. $event->end  }}
                                                        </p>
                                                        <p>
                                                            <span class="ti-location-pin mr-2"></span> {{ $event->location }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            {!! Str::words($event->body, 12) !!}
                                            <a href="{{ route('details', ['view'=> 'event', 'slug'=> $event->slug]) }}" class="primary-btn rounded-0 mt-3"> @if($event->type == 'DIRECTOR') Mot du Directeur @else  Voir les détails @endif</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="h_blog_text">
                        <div class="h_blog_text_inner left right">
                            <h4>Bienvenue dans Ciga Formation</h4>
                            <p>
                                Devenez expert·e sur un métier passionnant et décrochez un emploi. Garanti. Avec les parcours diplômants de CIGA-FORMATION, vous accédez aux métiers les plus recherchés sur le marché du travail. Votre succès, c'est bien plus qu'un diplôme, c'est un emploi fait pour vous. Cette réussite professionnelle, nous vous la garantissons tout simplement.
                            </p>
                            <p>
                                Nous vous proposons des cours ouverts pour vous former autrement, pour devenir acteur de votre vie. Nous vous aidons à prendre votre envol, mais ça ne s'arrête pas là. Notre volonté est de vous accompagner tout au long de...
                            </p>
                            <a class="primary-btn" href="/about">
                                Apprendre encore plus <i class="ti-arrow-right ml-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--================ End Feature Area =================-->

    <x-chicorycom-top-courses />


    <!--================ Start Registration Area =================-->
    <div class=" registration_area" id="pre-registration" style="background-image: url('/img/banner/4.jpeg');">
        <div class="section_gap cover-gap">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-7">
                        <div class="row clock_sec clockdiv" id="clockdiv">
                            <div class="col-lg-12">
                                <h1 class="mb-3">S'inscrire maintenant</h1>
                                <p>
                                    Devenez expert·e sur un métier passionnant et décrochez un emploi. Garanti.
                                    Avec les parcours diplômants de CIGA-FORMATION, vous accédez aux métiers les plus recherchés sur le marché du travail. Votre succès, c'est bien plus qu'un diplôme, c'est un emploi fait pour vous. Cette réussite professionnelle, nous vous la garantissons  tout simplement.
                                </p>
                            </div>
                            @if($countdown->status)
                            <div class="countdown countdown-container container">
                                <div class="clock row">
                                    <div class="clock-item clock-days countdown-time-value col-sm-6 col-md-3">
                                        <div class="wrap">
                                            <div class="inner">
                                                <div id="canvas-days" class="clock-canvas"></div>

                                                <div class="text">
                                                    <p class="val">0</p>
                                                    <p class="type-days type-time">JOURS</p>
                                                </div><!-- /.text -->
                                            </div><!-- /.inner -->
                                        </div><!-- /.wrap -->
                                    </div><!-- /.clock-item -->

                                    <div class="clock-item clock-hours countdown-time-value col-sm-6 col-md-3">
                                        <div class="wrap">
                                            <div class="inner">
                                                <div id="canvas-hours" class="clock-canvas"></div>

                                                <div class="text">
                                                    <p class="val">0</p>
                                                    <p class="type-hours type-time">HEURES</p>
                                                </div><!-- /.text -->
                                            </div><!-- /.inner -->
                                        </div><!-- /.wrap -->
                                    </div><!-- /.clock-item -->

                                    <div class="clock-item clock-minutes countdown-time-value col-sm-6 col-md-3">
                                        <div class="wrap">
                                            <div class="inner">
                                                <div id="canvas-minutes" class="clock-canvas"></div>

                                                <div class="text">
                                                    <p class="val">0</p>
                                                    <p class="type-minutes type-time">MINUTES</p>
                                                </div><!-- /.text -->
                                            </div><!-- /.inner -->
                                        </div><!-- /.wrap -->
                                    </div><!-- /.clock-item -->

                                    <div class="clock-item clock-seconds countdown-time-value col-sm-6 col-md-3">
                                        <div class="wrap">
                                            <div class="inner">
                                                <div id="canvas-seconds" class="clock-canvas"></div>

                                                <div class="text">
                                                    <p class="val">0</p>
                                                    <p class="type-seconds type-time">SECONDS</p>
                                                </div><!-- /.text -->
                                            </div><!-- /.inner -->
                                        </div><!-- /.wrap -->
                                    </div><!-- /.clock-item -->
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-4 offset-lg-1">
                        <div class="register_form">
                            <h3>Demande Pré-inscription</h3>
                            <p>Il est grand temps d'apprendre</p>
                            <pre-register-form></pre-register-form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--================ End Registration Area =================-->

    <x-chicorycom-modulaire-formation />



   @include('chicorycom::components.event', ['events'=> $events])

@endsection
@push('scripts')
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script src="{{ asset('js/kinetic.js') }}"></script>
    <script src="{{ asset('js/countdown.min.js') }}"></script>
    <script type="text/javascript">
        (function ($) {
            var now = Math.round(new Date().getTime()/1000);
            var start = new Date('{{ $countdown->start }}');
            var end = new Date('{{ $countdown->end }}');
            start = Math.round(start.getTime()/1000);
            end = Math.round(end.getTime()/1000);

            $('.countdown').final_countdown({
                'start': start,
                'end': end,
                'now': now
            });
        })(jQuery)
    </script>
@endpush
