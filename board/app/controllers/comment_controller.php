<?php
class CommentController extends AppController
{
    // Declare constants to avoid the use of "magic numbers"
    const PER_PAGE = 3;
    const DEFAULT_PAGE = 1;

    const WRITE_COMMENT = 'write';
    const WRITE_END_COMMENT = 'write_end';
    const EDIT_COMMENT = 'edit';
    const EDIT_END_COMMENT = 'edit_end';
    const DELETE_COMMENT = 'delete_end';

    public function view()
    {
        check_user_session(get_session_username());
        $thread = Thread::get(Param::get('thread_id'));
        $thread_id = Param::get('thread_id');
        $user_id = get_session_id();
        
        $page = Param::get('page', self::DEFAULT_PAGE);
        $pagination = new SimplePagination($page, self::PER_PAGE);

        $comments = Comment::getAll($pagination->start_index-1, $pagination->count+1, $thread_id, $user_id);
        $pagination->checkLastPage($comments);

        $total = Comment::countAll($thread->id);
        $pages = ceil($total / self::PER_PAGE);

        $this->set(get_defined_vars());
    }

    public function write()
    {
        check_user_session(get_session_username());
        $thread = Thread::get(Param::get('thread_id'));
        $comment = new Comment();
        $page = Param::get('page_next', self::WRITE_COMMENT);

        switch ($page) {
            case self::WRITE_COMMENT:
                break;

            case self::WRITE_END_COMMENT:
                $comment->username = get_session_username();
                $comment->body = Param::get('body');
                try {
                    $comment->write($thread->id);
                } catch (ValidationException $e) {
                    $page = self::WRITE_COMMENT;
                }
                break;
                
            default:
                throw new PageNotFoundException("{$page} is not found");
                break;
        }

        $this->set(get_defined_vars());
        $this->render($page);
    } 

    public function edit()
    {
        check_user_session(get_session_username());
        $user_id = get_session_id();

        $comment_id = Param::get('id');
        $params_comment = array('body' => Param::get('body'));
        $comment = new Comment($params_comment);
        $comment_edit = Comment::getById($comment_id);

        $thread_id = Param::get('thread_id');
        $params_thread = array('title' => Param::get('title'));
        $thread = new Thread($params_thread);
        $thread_edit = Thread::getById($thread_id);

        $page = Param::get('page_next', self::EDIT_COMMENT);

        switch ($page) {
            case self::EDIT_COMMENT:
                break;
                
            case self::EDIT_END_COMMENT:
                $comment->body = Param::get('body');
                $comment->id = $comment_id;
                $thread->title = Param::get('title');
                try {
                    $comment->edit();
                } catch (ValidationException $e) {
                    $page = self::EDIT_COMMENT;
                }
                break;

            default:
                throw new NotFoundException("{$page} is not found");                    
                break;
        }

        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function delete()
    {
        check_user_session(get_session_username());
        $comment = new Comment();
        $comment_id = Param::get('id');
        $page = Param::get('page_next', self::DELETE_COMMENT);

        $thread_id = Param::get('thread_id');

        switch ($page) {
            case self::DELETE_COMMENT:
                $comment->id = $comment_id;
                $comment->user_id = $thread_id;
                try {
                    $comment->delete($comment_id);
                } catch (ValidationException $e) {
                    $page = self::DELETE_COMMENT;
                }
                break;

            default:
                throw new NotFoundException("{$page} is not found");                    
                break;
        }
        
        $this->set(get_defined_vars());
        $this->render($page);
    }
}
