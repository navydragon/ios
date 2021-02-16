<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\KnowledgeCategory;
use App\KnowledgeMaterial;
use App\KnowledgeMaterialTag;
use App\KnowledgeMaterialComment;
use App\File;
use Illuminate\Support\Facades\Auth;

class KnbaseController extends Controller
{
    public function index()
    {
        $categories = KnowledgeCategory::all();
        $materials = KnowledgeMaterial::where('category_id','=',NULL)->get();
        $category = (object) array('id' => 'all');;
        return view('admin.knbase.index',compact('categories','materials','category'));
    }

    public function show_category(KnowledgeCategory $category)
    {
        //$category = KnowledgeCategory::find($category);
        $materials = $category->materials;
        $categories = KnowledgeCategory::all();
        return view('admin.knbase.show_category',compact('category','categories','materials'));
    }

    public function add_category(Request $request)
    {
        $cat = new KnowledgeCategory;
        $cat->name = $request->name;
        $cat->parent_id = $request->parent_id;
        $cat->save();
        return redirect('/adm/kn_base/'.$cat->id);
    }

    public function delete_category(KnowledgeCategory $category, Request $request)
    {
        $category->delete();
        return redirect('/adm/kn_base/');
    }

    public function add_material($category, Request $request)
    {
        if ($category == 'all')
        {
            $category = null;
        }else{
            $category = KnowledgeCategory::findOrFail($category);
            $category = $category->id;
        }
        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $file_t = new File;
        $file_t->user_id = Auth::user()->id;
        $file_t->title = $request->name;
        $file_t->path = "/";
        $file_t->type = $file->getClientOriginalExtension();
        $file_t->save();
        $file_t->path = 'knbase/'.$file_t->id.'/'.$name;
        $file_t->save();
        $file->move(public_path().'/knbase/'.$file_t->id.'/',$name);
        $mat_file = new KnowledgeMaterial;
        $mat_file->name = $request->name;
        $mat_file->description = $request->description;
        $mat_file->category_id = $category;
        $mat_file->file_id = $file_t->id;
        $mat_file->save();
        if (isset($request->tags))
        {
            foreach($request->tags as $tag)
            {
                $t = new KnowledgeMaterialTag;
                $t->material_id = $mat_file->id;
                $t->tag = $tag;
                $t->save();
            }
        }
        return back();
    }

    public function show_material(KnowledgeMaterial $material)
    {
        $categories = KnowledgeCategory::all();
        return view('admin.knbase.show_material',compact('categories','material',));
    }

    public function edit_material(KnowledgeMaterial $material)
    {
        $categories = KnowledgeCategory::all();
        return view('admin.knbase.edit_material',compact('material','categories'));
    }

    public function update_material(KnowledgeMaterial $material, Request $request)
    {
        $material->name = $request->name;
        $material->tags()->delete();
        if (isset($request->tags))
        {
            foreach($request->tags as $tag)
            {
                $t = new KnowledgeMaterialTag;
                $t->material_id = $material->id;
                $t->tag = $tag;
                $t->save();
            }
        }
        $material->category_id = $request->category_id;
        $material->description = $request->description;

        if ($request->file)
        {
            $file = $request->file('file');
            $name = $file->getClientOriginalName();
            $file->move(public_path().'/knbase/'.$request->category_id.'/',$name);
            $file_t = new File;
            $file_t->user_id = Auth::user()->id;
            $file_t->title = $request->name;
            $file_t->path = 'knbase/'.$request->category_id.'/'.$name;
            $file_t->type = $file->getClientOriginalExtension();
            $file_t->save();
            $material->file_id = $file_t->id;
        }
        $material->save();
        return redirect('/adm/kn_base/materials/'.$material->id);
    }

    public function delete_material(KnowledgeMaterial $material, Request $request)
    {
        $category = $material->category_id;
        $material->delete();
        return redirect('/adm/kn_base/'.$category);
    }

    public function add_comment(KnowledgeMaterial $material, Request $request)
    {
        $comment = new KnowledgeMaterialComment;
        $comment->material_id = $material->id;
        $comment->author_id = Auth::user()->id;
        $comment->message = $request->message;
        $comment->save();
        return back()->with('success','Комментарий добавлен');
    }
}
