<?php
class SearchController extends AppController
{
	const SEARCH = "search_end";

    public function search()
    {
    	check_user_session(get_session_username());
    	
    	$search = new Search();
        $page = Param::get('page_next', self::SEARCH);

        switch ($page) {
            case self::SEARCH:
                $keyword = Param::get('keyword');
                try {
                    Search::searchProfile($keyword);
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
