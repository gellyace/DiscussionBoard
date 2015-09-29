<?php
class CommentController extends AppController
{
    // Declare constants to avoid the use of "magic numbers"
    const PER_PAGE = 3;
    const DEFAULT_PAGE = 1;

    const WRITE_COMMENT = 'write';
    const WRITE_END_COMMENT = 'write_end';

    public function view()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $thread_id = Param::get('thread_id');
        $page = Param::get('page', self::DEFAULT_PAGE);
        $pagination = new SimplePagination($page, self::PER_PAGE);

        $comments = Comment::getAll($pagination->start_index-1, $pagination->count+1, $thread_id);
        $pagination->checkLastPage($comments);

        $total = Comment::countAll($thread->id);
        $pages = ceil($total / self::PER_PAGE);

        $this->set(get_defined_vars());
    }

    public function write()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $comment = new Comment();
        $page = Param::get('page_next', self::WRITE_COMMENT);

        switch ($page) {
            case self::WRITE_COMMENT:
                break;

            case self::WRITE_END_COMMENT:
                session_start();
                $comment->username = $_SESSION['username'];
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
}
