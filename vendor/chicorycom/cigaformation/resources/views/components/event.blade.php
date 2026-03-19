<!--================ Start Events Area =================-->
<div class="events_area">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5">
                <div class="main_title">
                    <h2 class="mb-3 text-white">Evènements </h2>
                   <!-- <p>
                        Replenish man have thing gathering lights yielding shall you
                    </p> -->
                </div>
            </div>
        </div>
        <div class="row">
        @php($count =0)
            @foreach($events as $event)
                @if($event->type == 'EVENT')
                    <?php if($count == 2) break ?>
                    <div class="col-lg-6 col-md-6">
                    <div class="single_event position-relative">
                        <div class="event_thumb">
                            <img src="{{ $event->img }}" alt="" style="width: 555px; height: 400px"/>
                        </div>
                        <div class="event_details">
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

                                {!! Str::words($event->body, 12) !!}
                                <a href="{{ route('details', ['view'=> 'event', 'slug'=> $event->slug]) }}" class="primary-btn rounded-0 mt-3"> @if($event->type == 'DIRECTOR') Mot du Directeur @else  Voir les détails @endif</a>
                        </div>
                    </div>
                </div>
                    @php($count++)
                @endif
            @endforeach
            <div class="col-lg-12">
                <div class="text-center pt-lg-5 pt-3">
                    <a href="{{ route('page', 'events') }}" class="event-link">
                        Afficher tout l'événement <img src="/img/next.png" alt="" />
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--================ End Events Area =================-->
