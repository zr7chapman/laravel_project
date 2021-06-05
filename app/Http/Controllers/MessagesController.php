<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessagesController extends Controller
{
    public function index(){
        $title = 'シンプルな掲示板';

        // Messageモデルを利用してmessageの一覧を取得
        $messages = \App\Message::all();

        // views/messages/index.blade.phpを指定
        return view('messages.index',[
            'title' => $title,
            'messages' => $messages,
        ]);
    } 
    public function create(Request $request){

        // requestオブジェクトのvalidateメソッドを利用。
        $request->validate([
            // nameのバリデーションを外す
            //'name' => 'required|max:20', 
            'body' => 'required|max:100', // bodyは必須、100文字以内
            'image' => [
                'file',
                'image',
                'mimes:jpeg,png',
                'dimensions:min_width=100,min_height=100,max_width=600,max_height=600',
            ], // imageは必須、ファイルアップロードが行われ、画像ファイルでjpeg,pngのいずれか、100x100~600x600まで
        ]);

        $filename = '';
        $image = $request->file('image');
        if( isset($image) === true ){
            // 拡張子を取得
            $ext = $image->guessExtension();
            // アップロードファイル名は [ランダム文字列20文字].[拡張子]
            $filename = str_random(20) . ".{$ext}";
            // publicディスク(storage/app/public/)のphotosディレクトリに保存
            $path = $image->storeAs('photos', $filename, 'public');
        }


        // Messageモデルを利用して空のMessageオブジェクトを作成
        $message = new \App\Message;

        // nameはログインユーザー名を利用
        //$message->name = $request->name;
        $message->name = \Auth::user()->name;
        $message->body = $request->body;
        // ファイル名を保存
        $message->image = $filename;

        // messagesテーブルにINSERT
        $message->save();

        // メッセージ一覧ページにリダイレクト
        return redirect('/messages');
    }
    public function __construct()
    {
        // authというミドルウェアを設定
        $this->middleware('auth');
    }
}
