<?php

use App\Http\Requests\CreateVersionRequest;
use App\Http\Requests\UpdateVersionRequest;
use App\Models\Projects;
use App\Models\Values;
use App\Models\Versions;
use Redirect as Redirect;

class AdminVersionsController extends \BaseController
{

    public function index()
    {
        $versions = Versions::with('project')->orderBy('id', 'DESC')->get();

        return View::make('admin.versions.index', compact(
            'versions'
        ));
    }

    public function create()
    {
        $data = array(
            'post_route' => URL::to('admin/versions/store'),
            'projects' => Projects::orderBy('id', 'DESC')->get()
        );

        return View::make('admin.versions.create_edit', $data
        );
    }

    public function store(CreateVersionRequest $request)
    {
        $data = $request->all();

        $usr = new Versions();
        $usr->project_id = $data['project_id'];
        $usr->version = $data['version'];
        $usr->save();

        \CacheRemove::key('all_values');

        return Redirect::to('admin/versions')->with(array('note' => 'Yeni Sürüm başarılı bir şekilde eklendi!'));
    }

    public function edit($id)
    {
        $versions = Versions::find($id);

        $data = array(
            'post_route' => URL::to('admin/versions/update'),
            'versions' => $versions,
            'projects' => Projects::orderBy('id', 'DESC')->get()
        );

        return View::make('admin.versions.create_edit', $data);
    }

    public function update(UpdateVersionRequest $request)
    {

        $data = $request->all();

        $id = $data['id'];
        $program = Versions::findOrFail($id);
        $program->update($data);

        \CacheRemove::key('all_values');

        return Redirect::to('admin/versions/edit'.'/'.$id)->with(array('note' => 'Sürüm başarılı bir şekilde güncellendi!'));
    }

    public function destroy($id)
    {
        Versions::destroy($id);
        Values::whereVersionId($id)->delete();
        \CacheRemove::key('all_values');

        return Redirect::to('admin/versions')->with(array('note' => 'Sürüm başarılı bir şekilde silindi!'));
    }

    public function check()
    {
        $project_id = Input::get('project_id');
        return Versions::whereProjectId($project_id)->orderBy('id', 'DESC')->get();
    }

}
