<?php

namespace App\Http\Controllers;

use App\Models\AttachPagePost;
use App\Models\AttachPost;
use App\Models\FollowPage;
use App\Models\FollowPerson;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function createPage(Request $request)
    {
        Page::create([
            'name' => $request->name
        ]);

        return response([
            'message' => 'Page creted successfully'
        ]);
    }


    public function followPerson($followPersonId)
    {
        FollowPerson::create([
            'user_id' => Auth::id(),
            'follow_person_id' => $followPersonId
        ]);

        return response([
            'message' => 'Follow People successfully Done'
        ]);
    }

    public function followPage($followPageId)
    {
        FollowPage::create([
            'user_id' => Auth::id(),
            'follow_page_id' => $followPageId
        ]);

        return response([
            'message' => 'Follow Page successfully Done'
        ]);
    }

    public function attachPost(Request $request)
    {
        AttachPost::create([
            'user_id' => Auth::id(),
            'post_content' => $request->post_content
        ]);

        return response([
            'message' => 'Post successfull'
        ]);
    }

    public function pageAttachPost(Request $request, $pageID)
    {
        AttachPagePost::create([
            'user_id' => Auth::id(),
            'page_id' => $pageID,
            'post_content' => $request->post_content
        ]);

        return response([
            'message' => 'Post successfull'
        ]);
    }

    public function feed()
    {
        $postData = AttachPost::with('follower_post')->where('user_id', Auth::id())->paginate();
        $pagePostData = AttachPagePost::where('user_id', Auth::id())->paginate();

        return response([
            'feedpost' =>  $postData,
            'pagePost' => $pagePostData
        ]);
    }
}
