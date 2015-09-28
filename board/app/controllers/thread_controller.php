<?php
class ThreadController extends AppController 
{
    const PER_PAGE = 5;

    public function index()
    {
        $page = Param::get('page', 1);
        $pagination = new SimplePagination($page, self::PER_PAGE);

        $threads = Thread::getAll($pagination->start_index-1, $pagination->count+1);
        $pagination->checkLastPage($threads);

        $total = Thread::countAll();
        $pages = ceil($total / self::PER_PAGE);

        $this->set(get_defined_vars());
    }
               
    public function create()
    {
        $thread = new Thread;
        $comment = new Comment;
        $page = Param::get('page_next', 'create');

        switch ($page) {
            case 'create':
                break;
                
            case 'create_end':
                session_start();
                    
                $thread->title = trim(Param::get('title'));
                $comment->username = $_SESSION['username'];
                $comment->body = trim(Param::get('body'));                
                try {
                    $thread->create($comment);
                } catch (ValidationException $e) {
                    $page='create';
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
