<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\KnowledgeCategory;
use App\KnowledgeMaterial;
use App\LearningModule;
use App\LearningCase;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects =  Project::where('status','=',1)->get();
        $menu_slot = 'main';
        $u_p = Auth::user()->projects()->get()->count();
        $m_p = Auth::user()->my_projects()->get()->count();
        $p = Project::all()->count();
        
        return view('main',compact('projects','menu_slot','u_p','p','m_p'));
    }
    public function knbase()
    {
        $menu_slot = 'knbase';
        $all_materials_count =  KnowledgeMaterial::count();  
        $latest_materials = KnowledgeMaterial::with('category')->with('tags')->latest()->take(10)->get();
        $categories = KnowledgeCategory::withCount('materials')->orderBy('name')->get();
        return view('kn_base',compact('menu_slot','categories','all_materials_count','latest_materials'));
    }

    public function knbase_category ($category)
    {
        $menu_slot = 'knbase';
        $all_materials_count =  KnowledgeMaterial::count();  
        if ($category=='all') {$materials = KnowledgeMaterial::latest()->get(); $category_name="Все материалы базы знаний"; $category_id = 'all'; }
        else{ $category = KnowledgeCategory::findOrFail($category); $materials = $category->materials; $category_name = $category->name; $category_id = $category->id;}
        $categories = KnowledgeCategory::withCount('materials')->orderBy('name')->get();
        return view('kn_base_category',compact('menu_slot','categories','category_name','materials','all_materials_count','category_id'));
    }

    public function knbase_material (KnowledgeMaterial $material)
    {
        return view('kn_base_material',compact('material'));
    }

    public function welcome()
    {
        $menu_slot = 'welcome';
        return view('welcome');
    }

    public function contacts()
    {
        return view('contacts');
    }

    function recommended_cases()
    {
        $cases = LearningCase::where('is_recommend','=',true)->get(); 
        return view('recommended_cases',compact('cases'));
    }

    function show_case(LearningCase $case)
    {
        return view('show_case',compact('case'));
    }

    function recommended_modules()
    {
        $modules = LearningModule::where('is_recommend','=',true)->get(); 
        return view('recommended_modules',compact('modules'));
    }
}
