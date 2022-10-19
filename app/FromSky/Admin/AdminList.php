<?php

namespace App\FromSky\Admin;


use App\FromSky\Admin\Decorators\AdminListComponentTrait;
use App\FromSky\Admin\Decorators\AdminListExtraComponentTrait;
use App\FromSky\Admin\Helpers\AdminListAction;
use Carbon\Carbon;
use Form;
use App;
use Illuminate\Support\Str;


use App\FromSky\Admin\Decorators\AdminListSeparator;
use App\FromSky\Admin\Decorators\AdminListSortableHeader;

/**
 * Class AdminList
 * @package App\FromSky\Admin
 */
class AdminList implements AdminListInterface
{

    use AdminListAction,
        AdminListSeparator,
        AdminListSortableHeader,
        AdminListComponentTrait,
        AdminListExtraComponentTrait;

    /**
     * @var
     */
    private $authorized_fields;
    /**
     * @var
     */
    protected string $html;
    /**
     * @var
     */
    protected $property;

    /**
     * @param $property
     * @return $this
     */
    public function initList($property)
    {

        $this->html     = "";
        $this->property = $property;
        $this->groupBySeparator();
        $this->authorizedFields();
        $this->counterSpan();
        return $this;
    }

    /**
     *
     */
    public function getListHeader()
    {
        $html = $this->getSelectAbleHeader();
        $nF   = 0; //  field number

        foreach ($this->authorized_fields as $_code => $_item) {
            if (!$this->isGroupBySeparator($_item)) {
                $html .= "<th class=\"middle-vertical-align " . data_get($_item, 'class', '') . "\">\n";
                $html .= $this->getHeaderItemLabel($_item, $_code);
                $html .= $this->getOrderableField($_code);
                $html .= "</th>\n";
                $nF++;
            }
        }
        echo $html;
    }

    /**
     * Quản lý nhãn cho tiêu đề danh sách nếu không có trong bản dịch thì nó sẽ lấy giá trị của cấu hình
     * @param $_item
     * @param $_code
     * @return array|\Illuminate\Contracts\Translation\Translator|string|null
     */
    function getHeaderItemLabel($_item, $_code)
    {
        $itemProperty    = is_array($_item) ? $_code : $_item;
        $full_label_path = 'admin.label.' . $itemProperty;
        return (\Lang::has($full_label_path)) ? trans($full_label_path) : ucwords(str_replace('_', ' ', $itemProperty));
    }

    /**
     * @return string
     */
    protected function getSelectAbleHeader(): string
    {
        return (auth_user('admin')->action('selectable', $this->property))
            ? "<th class=\"selectable-column\"></th>\n"
            : '';
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    function authorizedFields()
    {
        return $this->authorized_fields = cmsUserValidateActionRoles($this->property['field']);
    }
}

