<?php

namespace App\Http\Controllers;

use App\Models\TradePost;
use App\Models\OffmeetingPost;
use App\Models\NormalPost;
use Illuminate\Http\Request;


class CommunityController extends Controller
{

 //index・
    public function index(Request $request)
    {
    $tradeSearch = $request->get('trade_search');


    $tradePosts = TradePost::with(['user', 'comments.user'])
    ->when($tradeSearch, function ($query) use ($tradeSearch){
        $query->where('title', 'ILIKE', "%{$tradeSearch}%")
        ->orWhere('body', 'ILIKE', "%{$tradeSearch}%")
        ->orWhere('type', 'ILIKE', "%{$tradeSearch}%")
        ->orWhere('date', 'ILIKE', "%{$tradeSearch}%")
        ->orWhere('place', 'ILIKE', "%{$tradeSearch}%")
        ->orWhere('target', 'ILIKE', "%{$tradeSearch}%")
        ->orWhere('contact_info', 'ILIKE', "%{$tradeSearch}%");
    })
    ->latest()
    ->paginate(5,['*'], 'trade_page');

    $prefectures = [
        '北海道', '青森県', '岩手県', '宮城県', '秋田県', '山形県', '福島県',
        '茨城県', '栃木県', '群馬県', '埼玉県', '千葉県', '東京都', '神奈川県',
        '新潟県', '富山県', '石川県', '福井県', '山梨県', '長野県',
        '岐阜県', '静岡県', '愛知県', '三重県',
        '滋賀県', '京都府', '大阪府', '兵庫県', '奈良県', '和歌山県',
        '鳥取県', '島根県', '岡山県', '広島県', '山口県',
        '徳島県', '香川県', '愛媛県', '高知県',
        '福岡県', '佐賀県', '長崎県', '熊本県', '大分県', '宮崎県', '鹿児島県', '沖縄県'
    ];

    $offmeetingSearch = $request->get('offmeeting_search');
     $selectedPrefecture = $request->get('prefecture');

     $offmeetingPosts = OffmeetingPost::with(['user', 'comments.user'])
     ->when($offmeetingSearch, function ($query) use ($offmeetingSearch){
         $query->where(function($q) use ($offmeetingSearch) {
             $q->where('title', 'ILIKE', "%{$offmeetingSearch}%")
               ->orWhere('body', 'ILIKE', "%{$offmeetingSearch}%")
               ->orWhere('prefecture', 'ILIKE', "%{$offmeetingSearch}%")
               ->orWhere('date', 'ILIKE', "%{$offmeetingSearch}%")
               ->orWhere('place', 'ILIKE', "%{$offmeetingSearch}%")
               ->orWhere('capacity', 'ILIKE', "%{$offmeetingSearch}%")
               ->orWhere('contact_info', 'ILIKE', "%{$offmeetingSearch}%");
         });
     })
     ->when($selectedPrefecture, function ($query) use ($selectedPrefecture){
         $query->where('prefecture', $selectedPrefecture);
     })
     ->latest()
     ->paginate(5,['*'], 'offmeeting_page');

    $normalSearch = $request->get('normal_search');

    $normalPosts = NormalPost::with(['user', 'comments.user'])
    ->when($normalSearch, function ($query) use ($normalSearch){
        $query->where('body', 'ILIKE', "%{$normalSearch}%");
    })
    ->latest()
    ->paginate(5,['*'], 'normal_page');

    $activeTab = $request->get('active_tab', 'trade');

    if(!$request->has('active_tab')){
        if($offmeetingSearch||$selectedPrefecture){
            $activeTab = 'offmeeting';
        }elseif($normalSearch){
            $activeTab = 'normal';
        }elseif($tradeSearch){
            $activeTab = 'trade';
        }
    }

    return view('community.index', compact(
        'tradePosts',
        'tradeSearch',
         'prefectures',
         'offmeetingPosts',
         'offmeetingSearch',
         'selectedPrefecture',
         'normalPosts',
         'normalSearch',
         'activeTab'
        ));
}


}