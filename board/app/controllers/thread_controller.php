<?php
class ThreadController extends AppController 
{
    // Declare constants to avoid the use of "magic numbers"
    const PER_PAGE = 10;
    const DEFAULT_PAGE = 1;

    const CREATE_THREAD = 'create';
    const CREATE_END_THREAD = 'create_end';
    const EDIT_THREAD = 'edit';
    const EDIT_END_THREAD = 'edit_end';
    const DELETE_THREAD = 'delete_end';
    const SEARCH = "search";
    const SEARCH_END = "search_end";

    public function index()
    {
        check_user_session(get_session_username());
        $checkStatus = Users::checkStatus();

        $page = Param::get('page', self::DEFAULT_PAGE);
        $pagination = new SimplePagination($page, self::PER_PAGE);

        $threads = Thread::getAll($pagination->start_index-1, $pagination->count+1);
        $trending = Thread::trending();
        $pagination->checkLastPage($threads);

        $total = Thread::countAll();
        $pages = ceil($total / self::PER_PAGE);

        $this->set(get_defined_vars());
    }
               
    public function create()
    {
        check_user_session(get_session_username());
        $user_id = get_session_id();
        $thread = new Thread();
        $comment = new Comment();
        $page = Param::get('page_next', self::CREATE_THREAD);

        switch ($page) {
            case self::CREATE_THREAD:
                break;
                
            case self::CREATE_END_THREAD:
                $thread->title = Param::get('title');
                $comment->body = Param::get('body'); 
                $thread->category = Param::get('category');
                $thread->user_id = $user_id;
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

    public function edit()
    {
        check_user_session(get_session_username());
        $thread_id = Param::get('thread_id');

        $params = array(
            'title' => Param::get('title'),
            'category' => Param::get('category'),
            'id' => $thread_id,
        );

        $thread = new Thread($params);
        $thread_edit = Thread::getById($thread_id);

        $page = Param::get('page_next', self::EDIT_THREAD);

        switch ($page) {
            case self::EDIT_THREAD:
                break;
                
            case self::EDIT_END_THREAD:
                try {
                    $thread->edit();
                } catch (ValidationException $e) {
                    $page = self::EDIT_THREAD;
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
        $thread = new Thread();
        $thread_id = Param::get('thread_id');
        $page = Param::get('page_next', self::DELETE_THREAD);

        switch ($page) {
            case self::DELETE_THREAD:
                $thread->id = $thread_id;
                try {
                    $thread->delete($thread_id);
                } catch (ValidationException $e) {
                    $page = self::DELETE_THREAD;
                }
                break;

            default:
                throw new NotFoundException("{$page} is not found");                    
                break;
        }
        $this->set(get_defined_vars());
        $this->render($page);
    }

    public function search()
    {
        check_user_session(get_session_username());
        
        $keyword = Param::get('keyword');
        $searchProfile = Users::searchProfile($keyword);
        $searchThread = Thread::searchThread($keyword);
        $searchComment = Comment::searchComment($keyword);
        $page = Param::get('page_next', self::SEARCH);

        switch ($page) {
            case self::SEARCH:
                break;
                
            case self::SEARCH_END:
                $keyword = Param::get('keyword');
                try {
                } catch (ValidationException $e) {
                    $page = self::SEARCH;
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
