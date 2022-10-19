<?php

namespace App\FromSky\Admin\Decorators\AdminForm;

use App\Model\Media;
use Form;

/**
 * Class MediaComponent
 * @package App\FromSky\Admin\Decorators\AdminForm
 */
class FileManagerComponent extends ViewComponent
{

    /**
     * @return string
     */
    function resolveViewName()
    {
        return $this->viewName = 'admin.inputs.container_manager';
    }

    /**
     * @return array
     */
    function viewBag()
    {
        $this->viewBag = parent::viewBag();
        $media         = Media::where('id', $this->value)->first();
        $this->addItemToBag('media', $media);
        $this->addItemToBag('locale', $this->locale);
        return $this->viewBag;
    }
}