<?php

use App\Http\Requests\CreateValueRequest;
use App\Http\Requests\UpdateValueRequest;
use App\Models\Projects;
use App\Models\Values;
use App\Models\Versions;
use Redirect as Redirect;

class AdminValuesController extends \BaseController
{

    public function index()
    {
        $values = Values::with('project','version')->orderBy('id', 'DESC')->get();
        $value_langs = Values::valueLang();

        return View::make('admin.values.index', compact(
            'values',
            'value_langs'
        ));
    }

    public function create()
    {
        $data = array(
            'post_route' => URL::to('admin/values/store'),
            'projects' => Projects::orderBy('id', 'DESC')->get(),
            'langs' => Values::valueLang()
        );

        return View::make('admin.values.create_edit', $data
        );
    }

    public function store(CreateValueRequest $request)
    {
        $data = $request->all();

        $usr = new Values();
        $usr->project_id = $data['project_id'];
        $usr->version_id = $data['version_id'];
        $usr->lang = $data['lang'];
        $usr->key = $data['key'];
        $usr->value = $data['value'];
        $usr->save();

        \CacheRemove::tags('values/'.$data['lang']);
        \CacheRemove::key('all_values');

        return Redirect::to('admin/values')->with(array('note' => 'Yeni Veri başarılı bir şekilde eklendi!'));
    }

    public function edit($id)
    {
        $values = Values::find($id);

        $data = array(
            'post_route' => URL::to('admin/values/update'),
            'values' => $values,
            'projects' => Projects::orderBy('id', 'DESC')->get(),
            'versions' => Versions::whereProjectId($values->project_id)->orderBy('id', 'DESC')->get(),
            'langs' => Values::valueLang()
        );

        return View::make('admin.values.create_edit', $data);
    }

    public function update(UpdateValueRequest $request)
    {

        $data = $request->all();

        $id = $data['id'];
        $value = Values::findOrFail($id);

        $value->update($data);

        \CacheRemove::tags('values/'.$value->lang);
        \CacheRemove::key('all_values');

        return Redirect::to('admin/values/edit'.'/'.$id)->with(array('note' => 'Veri başarılı bir şekilde güncellendi!'));
    }

    public function destroy($id)
    {

        $data = Values::find($id);

        \CacheRemove::tags('values/'.$data->lang);
        \CacheRemove::key('all_values');

        $data->delete();



        return Redirect::to('admin/values')->with(array('note' => 'Veri başarılı bir şekilde silindi!'));
    }

}
