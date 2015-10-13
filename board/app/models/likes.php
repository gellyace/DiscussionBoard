<?php
class Likes extends AppModel
{
     public static function like($user_id,$comment_id,$thread_id)
	{
		$db = DB::conn();
		$db->begin();
		$params = array(
			'comment_id' => $comment_id,
			'user_id' => $user_id,
			'thread_id' => $thread_id,
		);

		$db->insert('liked', $params);
		$db->commit();
	}

	public static function isLiked($user_id,$comment_id)
	{
		$db = DB::conn();
		$db->begin();
		$row = $db->row('SELECT * FROM liked WHERE user_id = ? AND comment_id = ? ', array($user_id, $comment_id));
		$db->commit();
		return (bool) $row;
	}
	
	public static function unlike($user_id, $comment_id, $thread_id)
	{
		$db = DB::conn();
		$db->begin();
		$db->query('DELETE FROM liked WHERE user_id = ? AND comment_id = ? AND thread_id = ?', array($user_id, $comment_id, $thread_id));
		$db->commit();	
	}

	public static function deleteByCommentId($comment_id)
	{
		$db = DB::conn();
		$db->begin();
		$db->query('DELETE FROM liked WHERE comment_id = ?', array($comment_id));
		$db->commit();
	}
}
