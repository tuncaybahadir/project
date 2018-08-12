<?php

use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Projects;
use App\Models\Values;
use App\Models\Versions;
use Redirect as Redirect;

class AdminProjectsController extends \BaseController
{

    public function index()
    {
        $projects = Projects::orderBy('id', 'DESC')->get();

        return View::make('admin.projects.index', compact(
            'projects'
        ));
    }

    public function create()
    {
        $data = array(
            'post_route' => URL::to('admin/projects/store')
        );

        return View::make('admin.projects.create_edit', $data
        );
    }

    public function store(CreateProjectRequest $request)
    {
        $data = $request->all();

        $usr = new Projects();
        $usr->project_name = $data['project_name'];
        $usr->save();

        \CacheRemove::key('all_values');
        return Redirect::to('admin/projects')->with(array('note' => 'Yeni Proje başarılı bir şekilde eklendi!'));
    }

    public function edit($id)
    {
        $projects = Projects::find($id);


        $data = array(
            'post_route' => URL::to('admin/projects/update'),
            'project' => $projects,
        );

        return View::make('admin.projects.create_edit', $data);
    }

    public function update(UpdateProjectRequest $request)
    {

        $data = $request->all();

        $id = $data['id'];
        $program = Projects::findOrFail($id);
        $program->update($data);

        \CacheRemove::key('all_values');

        return Redirect::to('admin/projects/edit'.'/'.$id)->with(array('note' => 'Proje başarılı bir şekilde güncellendi!'));
    }

    public function destroy($id)
    {
        Projects::destroy($id);
        Versions::whereProjectId($id)->delete();
        Values::whereProjectId($id)->delete();

        \CacheRemove::key('all_values');

        return Redirect::to('admin/projects')->with(array('note' => 'Proje başarılı bir şekilde silindi!'));
    }

}
