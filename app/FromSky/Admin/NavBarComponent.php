<?php namespace App\FromSky\Admin;


use Illuminate\Support\Collection;

class NavBarComponent extends NavigationBaseComponent
{

    function getData(): Collection
    {
        foreach ($this->getMenuItems('menu.top-bar.show') as $_code => $section) {
            $this->data->push([
                    'title'     => $this->getLabel($_code, $section),
                    'url'       => $this->resolveUrl($section),
                    'iconClass' => 'fas fa-' . $section['icon'],
                    'target'    => $this->getAttribute($section, 'target_url'),
                    'section'   => $_code,
                    'submenu'   => $this->getNavBarSubItems($section)
                ]
            );
        }
        return $this->data;
    }

    function getNavBarSubItems(array $section): Collection
    {
        $data = collect();

        if (isset($section['menu']['top-bar']['submodel'])) {
            foreach ($section['menu']['top-bar']['submodel'] as $_code => $item) {
                $_data = [
                    'title'     => $item['label']??$this->getLabel($_code, $section),
                    'url'       => ma_get_admin_list_url($_code),
                    'iconClass' => 'fas fa-' . $item['icon'],
                    'target'    => data_get($section, 'target_url'),
                    'section'   => $_code,
                ];
                if(isset($item['context'])){
                    $_data['context_model'] = class_basename($item['context']['model']);
                    $_data['context_field'] = $item['context']['field'];
                    $_data['url'] .= "?". http_build_query(['context_model'=>$_data['context_model'] ,"context_field"=>$_data['context_field']]);
                }

                $data->push($_data);
            }
        }
        return $data;
    }
}
