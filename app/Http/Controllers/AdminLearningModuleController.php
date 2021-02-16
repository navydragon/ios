<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\LearningModule;
use App\Event;
use Illuminate\Support\Facades\Auth;
use VIPSoft\Unzip\Unzip;
class AdminLearningModuleController extends Controller
{
    public function index()
    {
        $learning_modules = LearningModule::all();
        
    	return view('admin.learning_modules.index',compact('learning_modules'));
    }

    public function edit(LearningModule $lm)
    {
        $lm = LearningModule::findOrFail($lm->id);
    	return view('admin.learning_modules.edit',compact('lm'));
    }
    public function store(Request $request)
    {
    	$module = new LearningModule;
    	$module->name = $request->name;
    	$module->author_id = Auth::user()->id;
    	$module->description = $request->description;	
    	$module->path = $request->path;
        $module->save();
        if(isset($request->zipfile)){
            $unzipper  = new Unzip();
            $file = $request->zipfile->store('public'); //store file in storage/app/zip
            //$filenames = $unzipper->extract(storage_path('app/kek'),storage_path('app/public'));
            $filenames = $unzipper->extract(storage_path('app/'.$file),storage_path('app/public/modules/'.$module->id));
            //extract the files in storage/app/public 
            unlink(storage_path('app/'.$file));
         }
        return back()->with('success','Материал успешно добавлен!');
    	//return redirect('/adm/learning_modules/'.$module->id);
    }

    function update(LearningModule $lm,Request $request)
    {
        $lm = LearningModule::findOrFail($lm->id);
        $lm->name = $request->name;
        $lm->description = $request->description;	
        $lm->path = $request->path;
        if ($request->is_recommend) 
        {   
            if ($request->is_recommend == 'on')
            {
                $lm->is_recommend = true;
            }else { $lm->is_recommend = false; }
        }
        $lm->save();
        return back()->with('success','Материал успешно обновлен!');
    }

    public function delete_files($dir) {
        // if(is_dir($target)){
        //     $files = glob( $target . '*', GLOB_MARK ); //GLOB_MARK adds a slash to directories returned
    
        //     foreach( $files as $file ){
        //         $this->delete_files( $file );      
        //     }
        //     try {
        //     rmdir( $target );
        //     }catch(Exception $e){}
        // } elseif(is_file($target)) {
        //     unlink( $target );  
        // }
        $files = array_diff(scandir($dir), array('.','..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->delete_files("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    public function delete(LearningModule $lm)
    {
        $events = Event::where('event_type_id','=',2)->where('source_id','=',$lm->id)->get();
        foreach ($events as $event) { $event->delete();}
        $path = storage_path('app/public/modules/'.$lm->id);
        $this->delete_files($path);
        $lm->delete();
        return back()->with('success','Материал успещно был удален!');
    }

   
}
