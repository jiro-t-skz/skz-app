<?php

namespace App\Http\Controllers\Community;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NormalPost;
use App\Models\NormalPostComment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class NormalController extends Controller
{
    public function storeNormal(Request $request)
    {
        $validated = $request->validate([
            'body' => 'required|max:2000',
            'image' => ['nullable', 'image', 'mimes:jpeg,png,gif,webp', 'max:5120'],
        ],[
            'body.required' => '投稿内容を入力してください。',
            'image.image'   => '画像ファイルを選択してください。',
            'image.mimes'   => '画像はjpeg、png、jpg、gif、webp形式のみアップロード可能です。',
            'image.max'     => '画像サイズは5MB以下にしてください。',
        ]);

        $imagePath = null;

        if($request->hasFile('image')){
            try{
                $image = $request->file('image');
                $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                $imagePath = $image->storeAs('normal_posts', $filename, 'public');

            }catch(\Exception $e){
                return redirect()
                ->back()
                ->withInput()
                ->with('error', '画像のアップロードに失敗しました。');
        }
    }

        NormalPost::create([
            'user_id' => Auth::id(),
            'body' => $validated['body'],
            'image_url' => $imagePath,
        ]);

        return redirect()->route('community.index',['active_tab'=>$request->get('active_tab','normal')])
        ->with('success', '投稿しました!。');
        }

    public function updateNormal(Request $request, $id)
    {
        $normalPost = NormalPost::findOrFail($id);

        if($normalPost->user_id !== Auth::id()){
            abort(403,'この投稿を編集する権限がありません');
        }

        $validated = $request->validate([
            'body' => ['required', 'string', 'max:2000'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp', 'max:5120'],
            'remove_image' => ['nullable', 'boolean'],
        ], [
            'body.required' => '投稿内容を入力してください。',
            'body.max' => '投稿内容は2000文字以内で入力してください。',
            'image.image' => '画像ファイルを選択してください。',
            'image.mimes' => '画像はjpeg、png、jpg、gif、webp形式のみアップロード可能です。',
            'image.max' => '画像サイズは5MB以下にしてください。',
        ]);

        try{
            $imagePath = $normalPost->image_url;

            if ($request->input('remove_image') == '1') {
                if ($normalPost->image_url) {
                    Storage::disk('public')->delete($normalPost->image_url);
                    $imagePath = null;
                }
            }

            if($request->hasFile('image')){
                if($normalPost->image_url){
                    Storage::disk('public')->delete($normalPost->image_url);
                }
                $imageFile = $request->file('image');
                $filename = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imagePath = $imageFile->storeAs('normal_posts', $filename, 'public');
            }

            $normalPost->update([
                'body' => $validated['body'],
                'image_url' => $imagePath,
            ]);

            return redirect()->route('community.index',['active_tab'=>$request->get('active_tab','normal')])
            ->with('success', '投稿を更新しました。');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->withInput()
                ->with('error', '投稿の更新に失敗しました。');
        }
    }

    public function destroyNormal(Request $request,$id)
    {
        $normalPost = NormalPost::findOrFail($id);

        if ($normalPost->user_id !== Auth::id()) {
            abort(403, 'この投稿を削除する権限がありません');
        }

        try {
            if ($normalPost->image_url) {
                Storage::disk('public')->delete($normalPost->image_url);
            }

            $normalPost->delete();

            return redirect()->route('community.index',['active_tab'=>$request->get('active_tab','normal')])
            ->with('success', '投稿を削除しました。');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', '投稿の削除に失敗しました。');
        }
     }

     public function storeNormalComment(Request $request, $postId)
     {
        $post = NormalPost::findOrFail($postId);

        $validated = $request->validate([
            'body' => 'required|string|max:2000',
        ]);

        NormalPostComment::create([
            'user_id' => Auth::id(),
            'normal_post_id' => $post->id,
            'body' => $validated['body'],
        ]);

        return redirect()->route('community.index',['active_tab'=>$request->get('active_tab','normal')])
        ->with('success', 'コメントを投稿しました！');
     }

    public function updateNormalComment(Request $request, $commentId)
    {
        $comment = NormalPostComment::findOrFail($commentId);

        if($comment->user_id !== Auth::id()){
            abort(403, 'このコメントを編集する権限がありません');
        }

        $validated = $request->validate([
            'body'=> 'required|string|max:1000',
        ]);

        $comment->update($validated);

        return redirect()->route('community.index',['active_tab'=>$request->get('active_tab','normal')])
        ->with('success', 'コメントを更新しました！');
    }

    public function destroyNormalComment(Request $request,$commentId)
    {
        $comment = NormalPostComment::findOrFail($commentId);

        if($comment->user_id !== Auth::id())
        {
            abort(403,'このコメントを削除する権限がありません');
        }
        $comment->delete();

        return redirect()->route('community.index',['active_tab'=>$request->get('active_tab','normal')])
        ->with('success','コメントを削除しました。');
    }
}
