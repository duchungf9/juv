<?php

namespace App\FromSky\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Model\ReviewCoin;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Validator;
use Auth;


use App\FromSky\Admin\AdminFormFieldsProcessor as AdminFormFieldsProcessor;
use App\FromSky\Admin\Helpers\ModelReplicatorTrait;
use App\FromSky\Admin\Requests\AdminFormRequest;
use App\FromSky\Searchable\SearchableTrait;
use App\FromSky\Sluggable\SluggableTrait;

/**
 * Class AdminPagesController
 * @package App\FromSky\Admin\Controllers
 */
class AdminPagesController extends Controller
{
    use SluggableTrait;
    use SearchableTrait;
    use ModelReplicatorTrait;

    protected $model;
    protected $models;
    protected $modelClass;
    protected $curObject;
    protected $request;
    protected $config;
    protected $fieldSpecs;
    protected $id;


    /**
     * @param $model
     */
    public function init($model)
    {
        $this->model  = $model;
        $this->config = config('fromSky.admin.list.section.' . $this->model);
//        $this->models     = strtolower(Str::plural($this->config['model']));
        $this->models     = strtolower($this->config['model']);
        $this->modelClass = 'App\\Model\\' . $this->config['model'];
    }

    /**
     * ADMIN HOME PAGE
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function home()
    {
        return view('admin.home');
    }

    /**
     * Show the index list of a model.
     * @param Request $request
     * @param         $model
     * @param string  $sub
     * @return View
     */
    public function lista(Request $request, $model, $sub = ''): mixed
    {
        $class          = $this;
        $classNameModel = class_basename($model);
        $key            = md5(__METHOD__ . $classNameModel . $sub);
        $content        = reGetAdmin($key, function () use ($class, $request, $model, $sub) {
            $class->request = $request;
            $class->init($model);
            $models     = new $class->modelClass;
            $objBuilder = $models::query();
            $class->setCurModel($models);
            $class->addSelect($objBuilder);
            $class->selectSub($objBuilder);
            $class->joinable($objBuilder);
            $class->whereFilter($objBuilder);
            $class->searchFilter($objBuilder);
            $class->orderFilter($objBuilder);
            $class->withRelation($objBuilder);
            $class->withContext($objBuilder);

            if ($class->isTranslatableField($class->sort)) {
                $objBuilder->select($class->model->getTable() . '.*');
            }

            if ($class->modelClass == 'App\Model\AdminUser' && !cmsUserHasRole('su')) {
                $objBuilder->whereHas('roles', function ($query) {
                    $query->where('name', '!=', 'su');
                });

            }
            $item_per_page = (request('per_page')) ?? config('fromSky.admin.list.item_per_pages');
            $pages         = $objBuilder->paginate($item_per_page);
            $pages->appends($request->all())->links(); // paginazione con parametri di ricerca
            $fieldspec      = $models->getFieldspec();
            $admin_can_edit = cmsUserHasRole(['su', 'admin']);
            return view('admin.list', [
                'pages'          => $pages,
                'pageConfig'     => collect($class->config),
                'fieldspec'      => $fieldspec,
                'model'          => $class->models,
                'admin_can_edit' => $admin_can_edit
            ])->render();
        }, now()->addDays(2));

        return response($content);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $model
     *
     *
     */
    public function create($model)
    {
        $this->init($model);
        $page         = new $this->modelClass;
        $locales      = collect(config('app.locales'))->toJson();
        $pageTemplate = data_get($this->config, 'editTemplate', 'admin.edit');
        return view($pageTemplate, ['page' => $page, 'pageConfig' => collect($this->config), 'locales' => $locales]);
    }

    /**
     * Show the form for editing
     * the specified resource.
     * @param $model
     * @param $id
     */

    public function edit($model, $id)
    {
        $this->id = $id;
        $this->init($model);
        $page = $this->modelClass::whereId($this->id)->firstOrFail();
        /*TODO da  cancellare ?? */
        if ($this->modelClass == 'App\Model\AdminUser') {
            if (!cmsUserHasRole('su') && $page->hasRole('su')) {
                return redirect(action('\App\FromSky\Admin\Controllers\AdminPagesController@lista', $this->models));
            }
        }
        $locales      = collect(config('app.locales'))->toJson();
        $pageTemplate = data_get($this->config, 'editTemplate', 'admin.edit');
        return view($pageTemplate, ['page' => $page, 'pageConfig' => collect($this->config), 'locales' => $locales]);
    }

    /**
     * View model resource
     *
     * @param $model
     * @param $id
     * @return View
     */
    public function view($model, $id): View
    {
        $this->id = $id;
        $this->init($model);
        $page         = $this->modelClass::whereId($this->id)->firstOrFail();
        $pageTemplate = data_get($this->config, 'viewTemplate', 'admin.view');
        return view($pageTemplate, ['page' => $page, 'pageConfig' => collect($this->config)]);
    }

    /**
     *
     * Show the form for editing
     * in modal window
     *
     * @param $model
     * @param $id
     *
     *
     */
    public function editmodal($model, $id)
    {
        $this->id = $id;
        $this->init($model);
        $page = $this->modelClass::whereId($this->id)->firstOrFail();
        if ($this->modelClass == 'App\Model\AdminUser') {
            if (!cmsUserHasRole('su') && $page->hasRole('su')) {
                return redirect(action('\App\FromSky\Admin\Controllers\AdminPagesController@lista', $this->models));
            }
        }
        return view('admin.editmodal', ['page' => $page, 'pageConfig' => collect($this->config)]);
    }

    /**
     * Store a newly created  resource in storage.
     *
     * @param string           $section
     * @param AdminFormRequest $request
     * @return RedirectResponse
     */
    public function store(string $section, AdminFormRequest $request): RedirectResponse
    {
        $this->init($section);
        $model = new  $this->modelClass;
        $page  = new $model;
        (new AdminFormFieldsProcessor($request))->requestFieldHandler($page);
        activity()->performedOn($page)->causedBy(auth()->guard("admin")->user())->withProperties(['model_id' => $page->id])->log("Đã tạo ");
        reFlushAdmin();
        session()->flash('success', 'The item <strong>' . $page->title . '</strong> has been created!');
        return redirect()->route('admin_edit', ['section' => $this->models, 'id' => $page->id]);
    }


    /**
     * Update resource in storage
     *
     * @param                  $section
     * @param int              $id
     * @param AdminFormRequest $request
     * @return RedirectResponse
     */
    public function update($section, int $id, AdminFormRequest $request): RedirectResponse
    {
        $this->init($section);
        $page = $this->modelClass::whereId($id)->firstOrFail();
        (new AdminFormFieldsProcessor($request))->requestFieldHandler($page);
        session()->flash('success', 'The item <strong>' . $page->title . '</strong> has been saved!');
        return redirect()->route('admin_edit', ['section' => $this->models, 'id' => $page->id]);
    }

    /**
     * Update resource in storage
     * in modal window
     *
     * @param                  $model
     * @param                  $id
     * @param AdminFormRequest $request
     */
    public function updatemodal($model, $id, AdminFormRequest $request)
    {
        $this->init($model);
        $page = $this->modelClass::whereId($id)->firstOrFail();
        (new AdminFormFieldsProcessor($request))->requestFieldHandler($page);
        activity()->performedOn($page)->causedBy(auth()->guard("admin")->user())->withProperties(['model_id' => $page->id])->log("Đã cập nhật ");
        reFlushAdmin();

        echo json_encode(array('status' => $this->config['model'] . ' Has been update'));
    }


    /**
     *
     * Simple model duplicate function
     *
     * @param $section
     * @param $id
     *
     */

    public function duplicate($section, $id)
    {
        $this->init($section);
        $page = $this->duplicateModel($id);
        activity()->performedOn($page)->causedBy(auth()->guard("admin")->user())->withProperties(['model_id' => $page->id])->log("Đã nhân bản ");
        reFlushAdmin();

        return redirect(route('admin_edit', ['section' => $this->models, 'id' => $page->id]));
    }


    /**
     * Delete resource in storage
     *
     * @param $model
     * @param $id
     * @return RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($model, $id)
    {
        $this->init($model);
        $page = $this->modelClass::whereId($id)->firstOrFail();
        $page->delete();
        session()->flash('success', 'The items ' . $page->title . ' has been deleted!');
        activity()->performedOn($page)->causedBy(auth()->guard("admin")->user())->withProperties(['model_id' => $page->id])->log("Đã xóa " . $page->title);
        reFlushAdmin();

        return redirect(action('\App\FromSky\Admin\Controllers\AdminPagesController@lista', $this->models));
    }


    /**
     *  view / download file
     *
     * @param $model
     * @param $id
     * @param $key
     * @return \Illuminate\Http\Response
     */
    public function file_view($model, $id, $key)
    {
        $this->id = $id;
        $this->init($model);
        $page = $this->modelClass::whereId($this->id)->firstOrFail();

        if ($page) {
            $file = $this->get_file($page, $key);
            if ($file['file']) {
                return response()->make($file['file'], 200, [
                    'Content-Type'        => $file['mime'],
                    'Content-Disposition' => 'inline; filename="' . $page->$key . '"'
                ]);
            }
        }
    }

    /*
     * get file from storage
     */
    public function get_file($object, $key)
    {
        $fields = $object->getFieldSpec();

        $disk   = (isset($fields[$key]['disk'])) ? $fields[$key]['disk'] : 'media';
        $folder = (isset($fields[$key]['folder'])) ? $fields[$key]['folder'] : 'docs';

        $storage = \Storage::disk($disk);

        if ($storage->exists($folder . '/' . $object->$key)) {
            return [
                'file' => $storage->get($folder . '/' . $object->$key),
                'mime' => $storage->mimeType($folder . '/' . $object->$key)
            ];
        }
        return false;

    }
}
