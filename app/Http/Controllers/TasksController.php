<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//モデルを使う宣言 これを書くことでAppの名前空間を書かなくてよくなる
use App\Models\Task;

class TasksController extends Controller
{
    // GETでtasks/にアクセスされたときの一覧表示処理
    public function index()
    {
        // GETでtasks/にアクセスされた場合の一覧表示処理
        // データベースからレコードをすべて取ってくる
        $tasks = Task::all();
        
        // タスク一覧ビューで表示
        //view(第1引数：表示したいいView，第２引数：Viewに渡したいデータの配列)
        return view('tasks.index', [
            'tasks' => $tasks,
        ]);
    }

    //GETでtasks/create/にアクセスされたときの新規登録画面表示処理
    public function create()
    {
        $task = new Task;
        
        //タスク作成ビューを表示
        return view('tasks.create', [
            'task' => $task,
        ]);
    }

    //POSTでtasks/にアクセスされたときの新規登録処理
    public function store(Request $request)
    {
        //バリデーション
        $request->validate([
            'status' => 'required | max:10',
            'content' => 'required | max:255',
        ]);
        
        // タスク作成と保存
        $task = new Task;
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        
        // トップページへリダイレクト
        return redirect('/');
    }

    //GETでtasks/（任意のid）にアクセスされたときの取得表示処理
    public function show($id)
    {
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        
        // メッセージ詳細ビューでそれを表示
        return view('tasks.show', [
            'task' => $task,
        ]);
    }

    //GETでtasks/（任意のid）/editにアクセスされた場合の「更新画面表示処理」
    public function edit($id)
    {
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        
        // メッセージ編集ビューでそれを表示
        return view('tasks.edit', [
            'task' => $task,
        ]);
    }

    //PUTまたはPATCHでtasks/（任意のid）にアクセスされた場合の「更新処理」
    public function update(Request $request, $id)
    {
        //バリデーション
        $request->validate([
            'status' => 'required | max:10',
            'content' => 'required | max:255',
        ]);
        
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        
        //メッセージを更新
        $task->status = $request->status;
        $task->content = $request->content;
        $task->save();
        
        //トップページへリダイレクト
        return redirect('/');
    }

    //DELETEでtasks/（任意のid）にアクセスされた場合の「削除処理」
    public function destroy($id)
    {
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        
        // メッセージを削除
        $task->delete();
        
        //トップページへリダイレクト
        return redirect('/');
    }
}
