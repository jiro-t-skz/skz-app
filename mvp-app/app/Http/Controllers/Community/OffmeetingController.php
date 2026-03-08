<?php

namespace App\Http\Controllers\Community;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OffmeetingPost;
use App\Models\OffmeetingPostsComment;
use Illuminate\Support\Facades\Auth;



class OffmeetingController extends Controller
{
    public function storeOffmeeting(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'date' => 'nullable|date',
            'prefecture'=>'nullable|string|max:50',
            'place' => 'nullable|string|max:255',
            'capacity'=>'nullable|integer|min:1|max:1000|',
            'contact_info' => 'required|string|max:255',
        ]);

        OffmeetingPost::create([
            'user_id' => Auth::id(),
            'title' => $validated['title'],
            'body' => $validated['body'],
            'date' => $validated['date'],
            'prefecture' => $validated['prefecture'],
            'place' => $validated['place'],
            'capacity' => $validated['capacity'],
            'contact_info' => $validated['contact_info'],
        ]);

        return redirect()->route('community.index', ['active_tab' => $request->get('active_tab', 'offmeeting')])
        ->with('success', '投稿しました!');
    }

    public function updateOffmeeting(Request $request, $id)
    {
        $offmeetingPosts = OffmeetingPost::findOrFail($id);

        if($offmeetingPosts->user_id !== Auth::id()){
            abort(403,'この投稿を編集する権限がありません');
        }

        $validated = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'date' => 'nullable|date',
            'prefecture'=>'nullable|string|max:50',
            'place' => 'nullable|string|max:255',
            'capacity'=>'nullable|integer|min:1|max:1000|',
            'contact_info' => 'required|string|max:255',
        ]);

        $offmeetingPosts->update($validated);

        return redirect()->route('community.index',['active_tab' => $request->get('active_tab', 'offmeeting')])
        ->with('success','投稿を更新しました。');
    }



    public function destroyOffmeeting(Request $request, $id)
     {
        $offmeetingPosts = OffmeetingPost::findOrFail($id);

        if($offmeetingPosts->user_id !== Auth::id()){
            abort(403);
        }

        $offmeetingPosts->delete();

        return redirect()->route('community.index',['active_tab'=>$request->get('active_tab','offmeeting')])
        ->with('success', '投稿を削除しました。');
     }

     public function storeOffmeetingComment(Request $request, $postId)
     {
        $post = offmeetingPost::findOrFail($postId);

        $validated = $request->validate([
            'body' => 'required|string|max:1000',
        ]);

        OffmeetingPostsComment::create([
            'user_id' => Auth::id(),
            'offmeeting_posts_id' => $post->id,
            'body' => $validated['body'],
        ]);

        return redirect()->route('community.index',['active_tab' => $request->get('active_tab', 'offmeeting')])
        ->with('success', 'コメントを投稿しました！');
     }


     public function updateOffmeetingComment(Request $request, $commentId)
     {
         $comment = OffmeetingPostsComment::findOrFail($commentId);

         if($comment->user_id !== Auth::id()){
             abort(403, 'このコメントを編集する権限がありません');
         }

         $validated = $request->validate([
             'body'=> 'required|string|max:1000',
         ]);

         $comment->update($validated);

         return redirect()->route('community.index',['active_tab' => $request->get('active_tab', 'offmeeting')])
         ->with('success', 'コメントを更新しました！');
     }

     public function destroyOffmeetingComment(Request $request,$commentId)
     {
         $comment = OffmeetingPostsComment::findOrFail($commentId);

         if($comment->user_id !== Auth::id())
         {
             abort(403,'このコメントを削除する権限がありません');
         }
         $comment->delete();

         return redirect()->route('community.index',['active_tab' => $request->get('active_tab', 'offmeeting')])
         ->with('success','コメントを削除しました。');
     }


}
