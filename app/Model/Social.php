<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

use App\FromSky\Builders\SocialBuilder;

class Social extends Model
{
    protected $table = 'socials';
    protected $fillable = ['title', 'description', 'link', 'icon', 'sort', 'pub'];
    protected array $fieldspec = [];

    /*
    |--------------------------------------------------------------------------
    |  Builder & Repo
    |--------------------------------------------------------------------------
    */
    function newEloquentBuilder($query): SocialBuilder
    {
        return new SocialBuilder($query);
    }
    /*
    |--------------------------------------------------------------------------
    |  Fieldspec for admin form
    |--------------------------------------------------------------------------
    */
    function getFieldSpec (): array
    {
        $this->fieldspec['id'] = [
            'type'     => 'integer',
            'minvalue' => 0,
            'pkey'     => 'y',
            'required' => 1,
            'label'    => 'id',
            'hidden'   => 1,
            'display'  => 0,
        ];
        $this->fieldspec['title']    = [
            'type'      => 'string',
            'required'  => 1,
            'hidden'    => 0,
            'label'     => 'Social',
            'display'   => 1,
        ];
        $this->fieldspec['icon'] = [
            'type'     => 'string',
            'required' => true,
            'hidden'   => 0,
            'label'    => 'Font-Awesome class ',
            'display'  => 1,
        ];
        $this->fieldspec['link'] = [
            'type'      => 'string',
            'required'  => 1,
            'hidden'    => 0,
            'label'     => 'Social link',
            'display'   => 1,

        ];
        $this->fieldspec['image'] = [
            'type'      => 'media',
            'required'  => 1,
            'hidden'    => 0,
            'label'     => 'Image',
            'lang'      => 0,
            'mediaType' => 'Img',
            'display'   => 1,
        ];
        $this->fieldspec['description'] = [
            'type'      => 'text',
            'required'  => 0,
            'hidden'    => 0,
            'label'     => 'Description',
            'cssClass'  => 'wysiwyg',
            'display'   => 0,
        ];
        $this->fieldspec['sort'] = [
            'type'     => 'integer',
            'required' => 0,
            'label'    => 'Order',
            'hidden'   => 0,
            'display'  => 1,
        ];
        $this->fieldspec['pub'] = [
            'type'     => 'boolean',
            'required' => 0,
            'hidden'   => 0,
            'label'    => trans('admin.label.publish'),
            'display'  => 1
        ];
      return $this->fieldspec;
    }

    public static function renderSocialFooter($title){
        $socialObject = reGet(md5("socials_".$title),function() use($title){
            return  \App\Model\Social::where("title",$title)->first();
        });
        if($socialObject!=null){
            return $socialObject;
        }
    }

    public static function renderAllSocialFooter(){
        $socials = reGet(md5("socials_list"),function() {
            return \App\Model\Social::wherePub(1)->get();
        });
        return $socials;
    }
}
