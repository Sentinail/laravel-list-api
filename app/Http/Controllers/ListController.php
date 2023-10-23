<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User_list;

class ListController extends Controller
{
    public function index() {

        $list = User_list::all();

        return view("hello_world", [
            "lists" => $list
        ]);
    }

    public function get_lists(Request $request) {
        return User_list::all();
    }

    public function get_user_lists(Request $request) {
        $lists = User_list::where('user_id', $request->user()->id)->get(); 

        return response()->json(['lists' => $lists], 200); 
    }

    public function create_list(Request $request) {
        if ($request->isJson()) {
            $data = $request->json()->all();
            
            $content = $data['content'];
            $user_id = $request->user()->id;
            $title = $data['title'];

            $listItem = new User_list;
            $listItem->content = $content;
            $listItem->user_id = $user_id;
            $listItem->title = $title;
            $listItem->save();

            return $listItem;
        }
    }

    public function update_list_title(Request $request) {
        if ($request->isJson()) {
            $data = $request->json()->all();

            $new_title = $data['title'];
            $user_id = $request->user()->id;
            $list_id = $data['list_id'];

            $listItem = User_list::where('user_id', $user_id)->find($list_id);

            if ($listItem) {
                $listItem->title = $new_title;
                $listItem->save();

                return response()->json(['message' => 'Title updated successfully']);
            } else {
                return response()->json(['message' => 'List item not found or update failed'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid request format'], 400);
        }
    }

    public function update_list_content(Request $request) {
        if ($request->isJson()) {
            $data = $request->json()->all();

            $new_content = $data['content'];
            $user_id = $request->user()->id;
            $list_id = $data['list_id'];

            $listItem = User_list::where('user_id', $user_id)->find($list_id);

            if ($listItem) {
                $listItem->content = $new_content;
                $listItem->save();

                return response()->json(['message' => 'Content updated successfully']);
            } else {
                return response()->json(['message' => 'List item not found or update failed'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid request format'], 400);
        }
    }

    public function delete_list(Request $request) {
        if ($request->isJson()) {
            $data = $request->json()->all();

            $user_id = $request->user()->id;
            $list_id = $data['list_id'];

            $listItem = User_list::where('user_id', $user_id)->where('id', $list_id)->first();

            if ($listItem) {
                $listItem->delete();
                return response()->json(['message' => 'List item deleted successfully']);
            } else {
                return response()->json(['message' => 'List item not found or deletion failed'], 404);
            }
        } else {
            return response()->json(['message' => 'Invalid request format'], 400);
        }
    }
}
