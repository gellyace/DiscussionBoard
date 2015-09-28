<?php
class CommentController extends AppController
{
    const PER_PAGE = 3;

    public function view()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $thread_id = Param::get('thread_id');
        $page = Param::get('page', 1);
        $pagination = new SimplePagination($page, self::PER_PAGE);

        $comments = Comment::getAll($pagination->start_index-1, $pagination->count+1, $thread->id);
        $pagination->checkLastPage($comments);

        $total = Comment::countAll($thread->id);
        $pages = ceil($total / self::PER_PAGE);

        $this->set(get_defined_vars());
    }

    public function write()
    {
        $thread = Thread::get(Param::get('thread_id'));
        $comment = new Comment();
        $page = Param::get('page_next', 'write');

        switch ($page) {
            case 'write':
                break;

            case 'write_end':
                session_start();
                $comment->username = $_SESSION['username'];
                $comment->body = trim(Param::get('body'));
                try {
                    $comment->write($thread->id);
                } catch (ValidationException $e) {
                    $page = 'write';
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