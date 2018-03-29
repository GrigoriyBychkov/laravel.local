<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\News;
use Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostFormRequest;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\Attachments;


class NewsController extends Controller
{
    public function index(){
        $news = News::all();

        foreach ($news as $record){
            $attachments = Attachments::where('news_id', '=', $record->id)->get();
            $record->attachments =$attachments;
//          var_dump(Attachments::where('news_id', '=', $record->id)->get());
        }
//        die();
        return view('news', array('news' => $news));



    }

    public function addNews(Request $request){
        $news = New News();

        if(request('title')){
            $news->title = request('title');
            $news->body = request('body');
            $news->author_id = $request->user()->id;


            if ($request->hasFile('input_img')) {
                $image = $request->file('input_img');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/newsImages');
                $image->move($destinationPath, $name);
                $news->img = $name;
            }
            $news->save();

            $files = $request->file('attachments');

            if ($files) {
                foreach($files as $file){
                    $name = $news->id . '_' . $file->getClientOriginalName();
                    $destinationPath = public_path('/attachments');
                    $file->move($destinationPath, $name);

                    $att = New Attachments();
                    $att->news_id = $news->id;
                    $att->attachment = $name;
                    $att->save();
                }
            }
            //return redirect()->route('news_create')->with('success', 'The News has added');
        }


        return view('news_add')->withInput('');
    }

    public function archive(Request $request, $id){
        $news = News::find($id);
        $news->active = (int) !$news->active;
        $news->save();

        return redirect()->back();

    }

    public function deleteNews(Request $request, $id)
    {
        $news = News::find($id);
        $news->delete();

        return redirect()->back()->with('success', 'The New Has Deleted');
    }

    public function editNews(Request $request, $id)
    {
        $news = News::find($id);

        if (request('title')) {
            $news->title = request('title');
            $news->body = request('body');
//            var_dump($request->hasFile('input_img'));
//            die();

            if ($request->hasFile('input_img')) {
                $image = $request->file('input_img');
                $name = time().'.'.$image->getClientOriginalExtension();
                $destinationPath = public_path('/newsImages');
                $image->move($destinationPath, $name);
                $news->img = $name;
            }

            $news->save();

            $files = $request->file('attachments');

            if ($files) {
                foreach ($files as $file) {
                    $name = $id . '_' . $file->getClientOriginalName();
                    $destinationPath = public_path('/attachments');
                    $file->move($destinationPath, $name);

                    $att = New Attachments();
                    $att->news_id = $id;
                    $att->attachment = $name;
                    $att->save();
                }
            }
            return redirect()->back()->with('success', 'The News has updated');
        }
        $news->attachments = Attachments::where('news_id', '=', $id)->get();
        return view('news_edit', array('news' => $news));
    }

    public function saveImg(Request $request, $id){
        $news = News::find($id);
        foreach ($request->file() as $file) {
            foreach ($file as $f) {
                $f->move(storage_path('images'), time().'_'.$f->getClientOriginalName());
            }
        }
        $news->img = request('img');
        return "Успех";
    }



    public function deleteAttachment(Request $request, $id){
        $attachment = Attachments::find($id);
        $attachment->delete();

        return redirect()->back()->with('success', 'The attachment has deleted');
    }





}
