<?php
namespace Api\v1;

use App\Models\Repositories\BroadcastingRepository as Broadcasting;
use App\Models\Repositories\PageRepository as Page;
use App\Models\Repositories\PostRepository as Posts;
use Cache;
use Controller;

class RadioController extends Controller
{

    public function __construct(Page $page,Posts $posts,Broadcasting $broadcasting)
    {
        $this->page = $page;
        $this->posts = $posts;
        $this->broadcasting = $broadcasting;
    }

    public function getPosition($sef=null)
    {
        return $this->posts->getPositionContents($sef);
    }

    public function getPage($id=0)
    {
        return $this->page->find($id);
    }

    public function getDetail($id=0)
    {
        return $this->posts->find($id);
    }

    public function broadcasting()
    {
        $myArray = array();
        $data = $this->broadcasting->getBroadCastingDay();
        foreach ($data as $row) {
            $myArray[] = $row;
        }
        return $myArray;

    }

    public function CategoryDetail($catId = 0 , $page = 'p1')
    {

        $per_page = 20;
        $page = substr($page, 1) * 1;
        $page = $page < 1 ? 1 : $page;
        $skip = $per_page * ($page - 1);

        return $this->posts->getCategoryContents($catId, $per_page, $skip);
    }

    public function currentSong()
    {
        return Cache::remember(
            'songer/' ,
            1 ,
            function () {

                $sc = new \App\Libraries\Shoutcast('46.20.3.250', 80);
                $sc = $sc->getSong();

                //return response()->json($sc)->header('ttl','1m');
                return response()->json($sc);
            }
        );
    }

}