<?php

namespace App\Http\Controllers;

use App\Http\Requests\NewsRequest;
use Illuminate\Http\Request;
use App\News;
use App\Attachments;
use App\Http\Requests\PostFormRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $news = News::paginate(5);

        return view('news', array('news' => $news));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('news_add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(NewsRequest $request)
    {
        $news = New News();

        $news->title = request('title');
        $news->body = request('body');
        $news->author_id = $request->user()->id;
        $image = $request->file('input_img');
        if ($image) {
            $news->img = self::handleNewsImage($image);
        }

        $news->save();

        self::saveNewsAttachments($request, $news->id);
        return redirect()->route('news.create')->with('success', 'The News has added');
    }

    private function handleNewsImage($image)
    {

        $name = time() . '.' . $image->getClientOriginalExtension();
        $destinationPath = public_path('/newsImages');
        $image->move($destinationPath, $name);
        return $name;
    }

    private function saveNewsAttachments($request, $newsId)
    {
        $files = $request->file('attachments');

        foreach ($files as $file) {
            $name = $newsId . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('/attachments');
            $file->move($destinationPath, $name);

            $att = New Attachments();
            $att->news_id = $newsId;
            $att->attachment = $name;
            $att->save();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $news = News::find($id);

        return view('news_show', array('news' => $news));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $news = News::find($id);

        return view('news_edit', array('news' => $news));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(NewsRequest $request, $id)
    {
        $news = News::find($id);

        $news->title = request('title');
        $news->body = request('body');
        $image = $request->file('input_img');
        if ($image) {
            $news->img = self::handleNewsImage($image);
        }


        $news->save();

        self::saveNewsAttachments($request, $news->id);
        return redirect()->back()->with('success', 'News was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();

        return redirect()->route('news.index');
    }

    public function archive($id)
    {
        $news = News::find($id);
        $news->active = (int)!$news->active;
        $news->save();

        return redirect()->back()->with('success', 'The News has Archived');
    }

    public function deleteAttachment(Request $request, $id)
    {
        $attachment = Attachments::find($id);
        $attachment->delete();
        Storage::delete($attachment->attachment);

        return redirect()->back()->with('success', 'The attachment has deleted');
    }
}
