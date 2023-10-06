<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Profile; //書き忘れ

use App\Models\ProfileHistory;

use Carbon\Carbon;

class ProfileController extends Controller
{
    //
    public function add()
    {
        return view('admin.profile.create');
    }

    public function create(Request $request)
    {
        
        $this->validate($request, Profile::$rules);

        $profiles = new Profile;
        $form = $request->all();
        
        $profiles->fill($form);
        $profiles->save();
        
        return redirect('admin/profile/create');
    }

    public function edit(Request $request)
    {
        
        $profiles = Profile::find($request -> id);
        if (empty($profiles)){
            abort(404);
        }
        return view('admin.profile.edit',['profile_form'=>$profiles]);
    }

    public function update(Request $request)
    {
         // Validationをかける
        $this -> validate ($request, Profile::$rules);
        
        $profiles = Profile::find($request -> id);
        
        $profile_form=$request->all();
        unset($profile_form['_token']);
        
        $profiles->fill($profile_form);
        $profiles->save();
        
        $profilehistory =new ProfileHistory();
        $profilehistory -> profile_id =$profiles->id;
        $profilehistory ->edited_at=Carbon::now();
        $profilehistory -> save();
        
        return redirect('admin/profile');
    }
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != '') {
            // 検索されたら検索結果を取得する
            $posts = Profile::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = Profile::all();
        }
        return view('admin.profile.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }
    
    public function delete(Request $request)
    {
        // 該当するNews Modelを取得
        $profiles = Profile::find($request->id);

        // 削除する
        $profiles->delete();

        return redirect('admin/profile');
    }

}
