<?php

namespace App\Http\Controllers;

use App\Tags;
use App\Articles;
use App\ArticleTags;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        if(Auth::check())
        {
            return view('/createArticles')->with('tags',Tags::all());
        }
        else
            return redirect()->route('/');
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request , [
            'title'=> 'required| max:100',
            'content' => 'required',
            'user_id' => 'required',
            'image' => 'image|mimes:jpg,png,jpeg'
        ]);
        

        $article = new Articles;
        $article->title = $request->title;
        $article->content = $request->content;
        $article->user_id = $request->user_id;
        $article->tag_id = $request->tag_id;


        if($request->image){
            $image = $request->image;
            $newName = time().$image->getClientOriginalName();
            $image->move('upload/articleImage', $newName);
            $article->imagePath = 'upload/articleImage/'.$newName;
        }
        else
            
        $article->imagePath = 'upload/articleImage/default.jpg';
        $article->save();

        
        $article_tag = new ArticleTags;
        $article_tag->tag_id = $request->tag_id;
        $article_tag->article_id = $article->id;
        $article_tag->save();

       
        //return redirect()->back();
        return redirect()->route("home");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $article = Articles::find($id);

        $user = User::find($article->user_id);

        $userArticle = Articles::where('user_id', $user->id)->get();

        return view('/article')->with('article', $article)->with('user', $user)->with('userArticle',$userArticle);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $article = Articles::find($id);

        if(Auth::id() == $article->user_id)
            return view('/editArticle')->with('article', $article);
        else
            return redirect()->route('home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $article = Articles::find($id);
        if($request->title != null)
            $article->title = $request->title;
        if($request->content != null)
            $article->content = $request->content;
        if($request->imagePath != null)
            $article->imagePath = $request->imagePath;
        if($request->tag != null)
            $article->tag = $request->tag;

        $article->save();

        return redirect()->route('home');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $article = Articles::find($id);

        $article->delete();

        return redirect()->route('home');
    }

    public function query($id)
    {
        $article = Articles::where('tag_id', $id)->get();
        
        return view('home')->with('articles', $article);
    }

    
}
