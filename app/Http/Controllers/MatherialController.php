<?php

namespace App\Http\Controllers;

use App\Models\Matherial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MatherialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $model = new Matherial;
        $materials = $model->getMaterials()->toArray();
        return view('matherials.index', ['materials' => $materials]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Matherial;
        $courses = $model->create()->all();
        $teacher = $model->getTeacher(Auth()->user()->id);
        if (!$courses || !$teacher->id) {
            redirect()->back()->withErrors('Не найдены курсы. Невозможно добавить материал вне курса');
        }
        return view('matherials.form', [
            'id' => $teacher->id,
            'name' => Auth()->user()->name,
            'courses' => $courses
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'teacher_id' => 'required|integer',
            'course_id' => 'required|integer',
            'picture' => 'required',
        ]);
        $model = new Matherial;
        $id = +$model->store($request->all());
        if ($id == 0 || !is_int($id)) {
            return redirect()->back()->withErrors('Вставленный материал вернул неожиданный результат. Изображение не вставлено');
        }
        $name = $request->picture->getClientOriginalName();
        $res = $request->picture->move(Storage::path('../../public/img-courses/' . $request->course_id . '/') . $id, $name);

        return redirect()->back()->withSuccess('Материал добавлен');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Matherial  $matherial
     * @return \Illuminate\Http\Response
     */
    public function show(Matherial $matherial)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Matherial  $matherial
     * @return \Illuminate\Http\Response
     */
    public function edit(Matherial $matherial)
    {

        return view('matherials.edit', ['material'=>$matherial]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Matherial  $matherial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Matherial $matherial)
    {
        $request->validate([
            'name'=>'required|string|max:255',
            'description'=>'required|string|max:255'
        ]);
        if($request->picture){
            $name = $request->img;
            $res = $request->picture->move(Storage::path('../../public/img-courses/' . $request->course_id . '/') . $request->id, $name);
        }
        $matherial->name = $request->name;
        $matherial->description = $request->description;
        $res = $matherial->save();

        return redirect()->back()->withSuccess('Материал обновлен');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Matherial  $matherial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Matherial $matherial)
    {
        $res = $matherial->delete();
        $path = Storage::path('../../public/img-courses/' . $matherial->course_id . '/' . $matherial->id);
        $res = $this->removeFileAndDir($path);
        return redirect()->back()->withSuccess('Удалено');
    }
}
