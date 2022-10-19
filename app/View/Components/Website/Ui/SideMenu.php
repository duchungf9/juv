<?php

namespace App\View\Components\Website\Ui;

use Illuminate\Support\Str;
use Illuminate\View\Component;

class SideMenu extends Component
{
    public  $content;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $menu = $this->buildMenuFromContent();
        return view('components.website.ui.side-menu', compact('menu'));
    }

    private function buildMenuFromContent(){
        $string  =  $this->content;
//        $regex_string = "/<h([0-9])>((.*)+)<\/h[0-9]>+/";
        $regex_string = "<h([0-9]) (.*)>((.*)+)<\/h[0-9]>+";
        $matched = preg_match_all($regex_string, $string,$out, PREG_PATTERN_ORDER);
        $headings = $out[1];
        $menu = collect([]);
        if(count($out[1]) == 0){
            return $menu;
        }

        $min_heading = min($headings);
        $max_heading = max($headings);

        foreach($headings as $key=>$heading){
            if(!empty(trim($out[3][$key]))){
                $menuObj = (object)['level'=>$heading, 'title'=> $out[3][$key] , 'display_heading'=>1,'id'=>$key ,'parent_id'=> null];

                if($menuObj->level == $min_heading){
                    $menu->push($menuObj);
                }else{
                    $prev_menuObj = $menu->where("id", $key - 1)->first();


                    if($menuObj->level == ($prev_menuObj->level + 1)){
                        $menuObj->parent_id = $prev_menuObj->id;
                        $menu->push($menuObj);
                    }
                    if($menuObj->level == $prev_menuObj->level){ // trường hợp bằng thằng level trên
                        $menuObj->parent_id = $prev_menuObj->parent_id;
                        $menu->push($menuObj);
                    }
                }
            }

        }
        return $menu;
    }

}
