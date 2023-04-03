<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public static function form_categori()
      {
        $data = [
            'title' => 'Form Category ',            
        ];
        return view('form.category',$data);
    }
    //form_edit_categori
    public static function form_edit_categori($id)
      {
        $category_id = $id;
        $findData    =  DB::table('category')->where('id', $category_id)->first();
        $data = [
            'title' => 'Form Category ',
            'id'    => $category_id,
            'list'  => $findData             
        ];
        return view('form.edit_category',$data);
    }
}
