<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use App\Attachments;
use App\Http\Requests\PostFormRequest;
use Illuminate\Support\Facades\DB;



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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $news = New News();
        //validation
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);

        $news->title = request('title');
        $news->body = request('body');
        $news->author_id = $request->user()->id;

        self::setNewsImage($request, $news);

        $news->save();

        self::saveNewsAttachments($request, $news->id);
        return redirect()->route('news.create')->with('success', 'The News has added');
    }

    private function setNewsImage($request, $news)
    {
        //validation
        $this->validate($request, [
            'input_img' => 'required',
        ]);
        $image = $request->file('input_img');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/newsImages');
        $image->move($destinationPath, $name);
        $news->img = $name;
    }

    private function saveNewsAttachments($request, $newsId)
    {
        //validation
        $this->validate($request, [
            'attachments' => 'required',
        ]);
        $files = $request->file('attachments');

        if ($files) {
            foreach($files as $file){
                $name = $newsId . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('/attachments');
                $file->move($destinationPath, $name);

                $att = New Attachments();
                $att->news_id = $newsId;
                $att->attachment = $name;
                $att->save();
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $news = News::find($id);
        $news->views = $news->views+1;
        $news->save();
        return view('news_show', array('news'=>$news));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $news = News::find($id);
       $news->attachments = Attachments::where('news_id', '=', $id)->get();
       return view('news_edit',array('news'=> $news));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($request, $id)
    {
        $news = News::find($id);
        //validation
        $this->validate($request, [
            'title' => 'required',
            'body' => 'required',
        ]);
        $news->title = request('title');
        $news->body = request('body');

        self::setNewsImage($request, $news);

        $news->save();

        self::saveNewsAttachments($request, $news->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    public function destroy($id)
    {
        $news = News::find($id);
        $news->delete();

        return redirect()->route('news.index');
    }

    public function archive(Request $request, $id){
        $news = News::find($id);
        $news->active = (int) !$news->active;
        $news->save();

        return redirect()->back();
    }

    public function deleteAttachment(Request $request, $id){
        $attachment = Attachments::find($id);
        $attachment->delete();

        return redirect()->back()->with('success', 'The attachment has deleted');
    }
}
