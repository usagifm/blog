<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Article;


class ArticleController extends Controller
{

    public function articles(){

        $articles = Article::all();

        return $articles->toJson();


    }

     public function create(Request $request){

        // Validate
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'photo' => 'required|image',
            'topic' => 'required',
        ]);
    
     
        $imageName = time().'.'.$request->photo->getClientOriginalExtension();
        $request->photo->move(public_path('images'), $imageName);

        Article::create([
            'title' => $request->title,
            'topic' => $request->topic,
            'content' => $request->content,
            'photo' => $imageName,
            'created_by' => Auth::user()->name,
        ]);


        return response()->json(['success'=>'You have successfully Add an Article.']);

        }


        public function show($id) // for edit and show
        {
            $article = Article::find($id);
    
            return $article->toJson();
        }

        public function update(Request $request, $id){

            // Validate
            $request->validate([
                'title' => 'required',
                'content' => 'required',
                'topic' => 'required',
            ]);
        

            if($request->photo != ''){
         
            $imageName = time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('images'), $imageName);
    


            $article = Article::find($id);
            $article->title = $request->title;
            $article->topic = $request->topic;
            $article->content = $request->content;
            $article->photo = $imageName;
            $article->save();

    
    
            return response()->json(['success'=>'You have successfully Update the Article.']);
    
            }



            if($request->photo == ''){
         
                $article = Article::find($id);
                $article->title = $request->title;
                $article->topic = $request->topic;
                $article->content = $request->content;
                $article->save();
    
        
                return response()->json(['success'=>'You have successfully Update the Article.']);
        
                }

        }

        public function delete($id)
        {
           $article =  Article::find($id);
            if(!empty($article)){
                $article->delete();
                $msg = [
                    'success' => true,
                    'message' => 'Article deleted successfully!'
                ];
                return response()->json($msg);
            } else {
                $msg = [
                    'success' => false,
                    'message' => 'Article delete failed!'
                ];
                return response()->json($msg);
            }
        }
}

