<?php

namespace App\Http\Controllers;

use App\Models\TradePost;
use App\Models\TradePostComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommunityController extends Controller
{
    //
public function index(Request $request)
{
    $search = $request->get('search');

    $posts = TradePost::with(['user', 'comments.user'])
    ->when($search, function ($query) use ($search){
        $query->where('title', 'ILIKE', "%{$search}%")
        ->orWhere('body', 'ILIKE', "%{$search}%")
        ->orWhere('type', 'ILIKE', "%{$search}%")
        ->orWhere('date', 'ILIKE', "%{$search}%")
        ->orWhere('place', 'ILIKE', "%{$search}%")
        ->orWhere('target', 'ILIKE', "%{$search}%")
        ->orWhere('contact_info', 'ILIKE', "%{$search}%");
    })
    ->latest()
    ->paginate(10);

    return view('community.index', compact('posts','search'));
}

public function store(Request $request)
{

    $validated = $request->validate([
        'title' => 'required|max:255',
        'body' => 'required',
        'type' =>  ['required', 'in:companion,trade'],
        'date' => 'nullable|date',
        'place' => 'nullable|string|max:255',
        'target' => 'required|string|max:255',
        'contact_info' => 'required|string|max:255',
    ]);

    TradePost::create([
        'user_id' => Auth::id(),
        'title' => $validated['title'],
        'body' => $validated['body'],
        'date' => $validated['date'],
        'type' => $validated['type']??'trade',
        'place' => $validated['place'],
        'target' => $validated['target'],
        'contact_info' => $validated['contact_info'],
    ]);

    return redirect()->route('community.index')->with('success', '投稿しました!。');
}

public function update(Request $request, $id)
{
    $post = TradePost::findOrFail($id);

    if($post->user_id !== Auth::id()){
        abort(403,'この投稿を編集する権限がありません');
    }

    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'body' => 'required|string',
        'type' => ['required', 'in:companion,trade'],
        'date' => 'nullable|date',
        'place' => 'nullable|string|max:255',
        'target' => 'required|string|max:255',
        'contact_info' => 'required|string|max:255',
    ]);

    $post->update($validated);

    return redirect()->route('community.index')->with('success','投稿を更新しました。');
}


public function destroy($id)
 {
    $post = TradePost::findOrFail($id);

    if($post->user_id !== Auth::id()){
        abort(403);
    }

    $post->delete();

    return redirect()->route('community.index')->with('success', '投稿を削除しました。');
 }

 public function storeComment(Request $request, $postId)
 {
    $post = TradePost::findOrFail($postId);

    $validated = $request->validate([
        'body' => 'required|string|max:1000',
    ]);

    TradePostComment::create([
        'user_id' => Auth::id(),
        'trade_post_id' => $post->id,
        'body' => $validated['body'],
    ]);

    return redirect()->route('community.index')->with('success', 'コメントを投稿しました！');
 }

public function updateComment(Request $request, $commentId)
{
    $comment = TradePostComment::findOrFail($commentId);

    if($comment->user_id !== Auth::id()){
        abort(403, 'このコメントを編集する権限がありません');
    }

    $validated = $request->validate([
        'body'=> 'required|string|max:1000',
    ]);

    $comment->update($validated);

    return redirect()->route('community.index')->with('success', 'コメントを更新しました！');
}

public function destroyComment($commentId)
{
    $comment = TradePostComment::findOrFail($commentId);

    if($comment->user_id !== Auth::id())
    {
        abort(403,'このコメントを削除する権限がありません');
    }
    $comment->delete();

    return redirect()->route('community.index')->with('success','コメントを削除しました。');
}

}