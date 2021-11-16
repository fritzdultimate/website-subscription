<?php

namespace App\Http\Controllers;

use App\Models\Subscribers;
use App\Models\User;
use App\Models\Websites;
use Illuminate\Http\Request;

class SubscriberController extends Controller
{
    public function index() {
        return Subscribers::all();
    }
 
    public function show($id) {
        return Subscribers::find($id);
    }

    public function store(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'website' => ['required']
        ]);

        $user_id = NULL;

        $website_existed = Websites::where(['id' => $request->website])->first();
        $email_existed = User::where(['email' => $request->email])->first();

        if($email_existed) {
            $user_id = $email_existed->id;
        } else {
            $user = User::create(['email' => $request->email]);
            $user_id = $user->id;
        }

        $subscribers = Subscribers::where(['user_id' => $user_id, 'website_id' => $request->website])->first();

        if($subscribers) {
            return response()->json(
                [
                'errors' => [
                    'message' => ["User already subscribed"],
                    ]
                ], 403
            );
        }
        
        if(!$website_existed) {
            return response()->json(
                [
                'errors' => [
                    'message' => ["Website does not exist"],
                    ]
                ], 403
            );
        }

        // $request->website_id = $request->website;
        // $request->user_id = $user_id;
        // unset($request->website);

        Websites::where('id', $request->website)->increment('total_subscribers', 1);

        return Subscribers::create([
            'website_id' => $request->website,
            'user_id' => $user_id
        ]);
    }

    public function update(Request $request, $id) {
        $credentials = $request->validate([
            'name' => ['required', 'unique:table,name,except,id'],
        ]);

        $subscribers = Subscribers::findOrFail($id);
        $subscribers->update($request->all());

        return $subscribers;
    }

    public function delete(Request $request, $id) {
        $subscribers = Subscribers::findOrFail($id);
        $subscribers->delete();

        return 204;
    }
}
