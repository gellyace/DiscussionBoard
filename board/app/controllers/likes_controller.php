<?php
class LikesController extends AppController
{
    public function like() 
    {
		check_user_session(get_session_username());
		$thread_id = Param::get('thread_id');
		$comment_id = Param::get('comment_id');
		$user_id = get_session_id();

		Likes::like($user_id, $comment_id, $thread_id);
 		redirect('/comment/view?thread_id='.$thread_id);
	}

	public function unlike() 
	{
		check_user_session(get_session_username());
		$thread_id = Param::get('thread_id');
		$comment_id = Param::get('comment_id');
		$user_id = get_session_id();
		
		Likes::unlike($user_id, $comment_id, $thread_id);
		redirect('/comment/view?thread_id='.$thread_id);
	}
}
