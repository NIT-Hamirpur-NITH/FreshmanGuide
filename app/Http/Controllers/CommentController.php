<?php

namespace FreshmanGuide\Http\Controllers;

use Illuminate\Http\Request;

use FreshmanGuide\Http\Requests;
use FreshmanGuide\Comment;

class CommentController extends Controller
{
    public function hide(Request $request, $commentId) {
        $comment = Comment::where('id', $commentId)->first();
        if (!$comment) {
            return response()->json([
                'success' => false,
                'error' => 'Comment not found',
            ]);
        }

        $success = false;

        if ($comment->reply == '') {
            if ($comment->delete()) {
                $success = true;
            }
        } else {
            $comment->hide = true;
            if ($comment->save()) {
                $success = true;
            }
        }

        if ($success) {
            return response()->json([
                'success' => true,
                'message' => 'Comment is removed',
            ]);
        } else {
            return response()->json([
                'success' => false,
                'error' => 'Cannot remove the comment',
            ]);
        }

    }

}
