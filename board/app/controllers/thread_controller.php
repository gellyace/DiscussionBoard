<?php
class ThreadController extends AppController 
{
    // Declare constants to avoid the use of "magic numbers"
    const PER_PAGE = 5;
    const DEFAULT_PAGE = 1;

    const CREATE_THREAD = 'create';
    const CREATE_END_THREAD = 'create_end';

    public function index()
    {
        $page = Param::get('page', self::DEFAULT_PAGE);
        $pagination = new SimplePagination($page, self::PER_PAGE);

        $threads = Thread::getAll($pagination->start_index-1, $pagination->count+1);
        $pagination->checkLastPage($threads);

        $total = Thread::countAll();
        $pages = ceil($total / self::PER_PAGE);

        $this->set(get_defined_vars());
    }
               
    public function create()
    {
        $thread = new Thread();
        $comment = new Comment();
        $page = Param::get('page_next', self::CREATE_THREAD);

        switch ($page) {
            case self::CREATE_THREAD:
                break;
                
            case self::CREATE_END_THREAD:
                $thread->title = Param::get('title');
                $comment->username = get_session_username();
                $comment->body = Param::get('body');                
                try {
                    $thread->create($comment);
                } catch (ValidationException $e) {
                    $page = self::CREATE_THREAD;
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
