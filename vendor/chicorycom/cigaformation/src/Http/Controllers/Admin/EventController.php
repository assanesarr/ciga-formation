<?php
/**
 * Created by PhpStorm.
 * User: assane
 * Date: 24/10/20
 * Time: 15:54
 */

namespace Chicorycom\Cigaformation\Http\Controllers\Admin;


use Chicorycom\Cigaformation\Http\Controllers\Controller;
use Chicorycom\Cigaformation\Models\Event;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        return new JsonResponse(Event::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'in:EVENT,INFO,DIRECTOR',
            'slug' => 'required|unique:events,slug',
            'body' => 'required|string',
            'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);
        $collection = collect($request->except(['id', 'img']));
        if($request->type != 'EVENT') $collection = $collection->except(['inDate']);
        if(is_null($request->location)) $collection = $collection->except(['location']);


        $img = $this->resize($request->file('img'), 555, 400, true);
        $img_view = $this->resize($request->file('img'), 555, 280, true);
        $thumbnail = $this->resize($request->file('img'), 100, 60, true);
        $collection = $collection->merge([
            'img' => $img,
            'img_view' => $img_view,
            'thumbnail' => $thumbnail
        ]);

        $event = Event::create($collection->all());
        return new JsonResponse($event , 201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Event $event
     * @return Event
     */
    public function edit(Event $event)
    {
        return $event;
    }


    public function statusEvent(Event $event){

        $status = !$event->status;
        $event->update(['status' => $status]);
        return new JsonResponse($event, 201, [], JSON_NUMERIC_CHECK);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Event $event
     * @return JsonResponse
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'type' => 'in:EVENT,INFO,DIRECTOR',
            'slug' => 'required|unique:events,slug',
            'body' => 'required|string',
            //'img' => 'nullable|sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:1024',
        ]);

            $collection = collect($request->except(['id', 'img']));

            if($request->type != 'EVENT') $collection = $collection->except(['inDate']);
            if(is_null($request->location)) $collection = $collection->except(['location']);

            if($request->hasFile('img')){
            $img = $this->resize($request->file('img'), 555, 400, true);
            $img_view = $this->resize($request->file('img'), 555, 280, true);
            $thumbnail = $this->resize($request->file('img'), 100, 60, true);
            $collection = $collection->merge([
                'img' => $img,
                'img_view' => $img_view,
                'thumbnail' => $thumbnail
            ]);
            File::delete(public_path($event->img));
            File::delete(public_path($event->img_view));
            File::delete(public_path($event->thumbnail));
        }

        $event->update($collection->all());

        return new JsonResponse($event , 201);
    }

    /**
     * @param Event $event
     * @return JsonResponse
     * @throws \Exception
     */
    public function destroy(Event $event)
    {

        File::delete(public_path($event->img));
        File::delete(public_path($event->img_view));
        File::delete(public_path($event->thumbnail));

        $event->delete();

        return new JsonResponse($event , 204);
    }
}
