<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;    // 追加
use Auth;


class TasksController extends Controller
{ 
   

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $data = [];

            // 認証済みユーザを取得
         if (\Auth::check()) { // 認証済みの場合
            $user = \Auth::user();
            // ユーザの投稿の一覧を作成日時の降順で取得
            $tasks= $user->tasks()->orderBy('created_at', 'desc')->paginate(10);
            $data = [
                'user' => $user,
                'tasks' => $tasks,
                ];   
    
         }
        // Welcomeビューでそれらを表示
        
          return view('tasks.welcome',$data);
  

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     function create()
    {
         $task = new Task;
        // タスク作成ビューを表示
        return view('tasks.create', [
            'task' => $task,
        ]);
      
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     function store(Request $request)
    
        
    {
           // バリデーション
        $request->validate([
            'status' => 'required|max:10',
            'content'=>'required|max:255',
        ]);
         // タスクを作成
        $task = new Task;
        $task->content = $request->content;
        $task->status = $request->status; 
        $task->user_id= Auth::id();  // 追加
        $task->save();
       
        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     function show($id)
    
        
    {
         // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
         if( Auth::id()!==$task->user_id){
            return redirect('/');
         }

        // タスク詳細ビューでそれを表示
        return view('tasks.show', [
            'task' => $task,
        
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     function edit($id)
    
        
    {
        // idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
         if( Auth::id()!==$task->user_id){
            return redirect('/');
         }
        
        // タスク編集ビューでそれを表示
        return view('tasks.edit', [
            'task' => $task,

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     function update(Request $request, $id)
   
        
    {
         // バリデーション
        $request->validate([
            'status' => 'required|max:10',
            'content'=>'required|max:255',
        ]);
        // idの値でタスクを検索して取得
        $task = Task::findOrFail($id);
        // タスクを更新
        $task->status = $request->status;    // 追加
        $task->content = $request->content;
        $task->save();
    


        // トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     function destroy($id)
     
        
    {
        // idの値でタスクを検索して取得
        $task =Task::findOrFail($id);
        // タスクを削除
         if( Auth::id()!==$task->user_id){
            return redirect('/');
         }
        $task->delete();
        
    

        // トップページへリダイレクトさせる
        
        
        
         return redirect('/');
        
    }
    
}

