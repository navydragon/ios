<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    public function upload($file)
    {
    		  // getting all of the post data
	  //$file = array('image' => Input::file('image'));
	  // setting up rules
	  //$rules = array('file' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
	  // doing the validation, passing post data, rules and the messages
	  //$validator = Validator::make($file, $rules);
	  //if ($validator->fails()) {
	    // send back to the page with the input data and errors
	  //  return back()->withInput()->withErrors($validator);
	  //}
	  //else {
	    // checking file is valid.
	    if ($file->isValid()) {
	      $destinationPath = 'uploads'; // upload path
	      $extension = $file->getClientOriginalExtension(); // getting image extension
	      $fileName = rand(11111,99999).'.'.$extension; // renameing image
	      $file->move($destinationPath, $fileName); // uploading file to given path
	      // sending back with message
	      //Session::flash('success', 'Upload successfully'); 
	      return  $destinationPath.'/'.$fileName;
	    }
	    else {
	      // sending back with error message.
	      //Session::flash('error', 'uploaded file is not valid');
	      flash()->error('Ошибка валидации');
	      return back();
	    }
	//  }
    }

    public function author()
    {
    	return $this->belongsTo('App\User','user_id');
    }
}
