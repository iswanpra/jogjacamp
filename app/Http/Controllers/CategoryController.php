<?php

namespace App\Http\Controllers;
use App\Models\Category;
use DB;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        //
    }
    public function categori()
    {
        $listCategory = DB::table('category')->get();
        $data = [
            'title'     => 'List Category ',
            'dataTable' => $listCategory,
        ];

        return view('category.view', $data);
    }
    //category_insert 
    public function category_insert(Request $request)
    {
       $insert = DB::table('category')->insert(
            array(
                'name'       => $request->input('name'), 
                'is_publish' => $request->input('is_publish'),
                'created_at' => date('Y-m-d H:i:s'))
            );
        /*============Email ===================*/
          $user_id = DB::table('users')
          ->where('id', '1')
          ->first();
          $html = 'New Insert Category';
          $email = new \App\Helpers\Email;
          $email->to($user_id->email);
          if ($email->body($html)->send()) {
            //return redirect()->route('profile');
            return 'OK';
          }
        /*==========Check data ================*/
        try {
          if($insert){
             return response()->json([
                'success' => true
            ], 200);

          }else{
            return response()->json([
                'success' => false,
                'message' => 'insert Gagal!'
            ], 401);
          }
        } catch (ParseException $error) {
            return response()->json([
                'success' => false,
                'message' => 'insert Gagal!'
            ], 401);
        }     

    }
    public function category_update(Request $request)
    {
        $inSub = array(
                'name'       => $request->input('name'), 
                'is_publish' => $request->input('is_publish'),
                'updated_at' => date('Y-m-d H:i:s')
            );
        $update = DB::table('category')
                ->where('id', $request->input('idCategorty'))
                ->update($inSub);
        /*============Email ===================*/
          $user_id = DB::table('users')
          ->where('id', '1')
          ->first();
          $html = 'Update Category';
          $email = new \App\Helpers\Email;
          $email->to($user_id->email);
          if ($email->body($html)->send()) {
            //return redirect()->route('profile');
            return 'OK';
          }
        /*==========Check data ================*/
        try {
          if($update){
             return response()->json([
                'success' => true
            ], 200);
          }else{
            return response()->json([
                'success' => false,
                'message' => 'insert Gagal!'
            ], 401);
          }
        } catch (ParseException $error) {
            return response()->json([
                'success' => false,
                'message' => 'insert Gagal!'
            ], 401);
        }     

    }
    //hapus_list
    public function hapus_list($id)
    {
        $del = DB::table('category')->where('id', $id)->delete();
        /*============Email ===================*/
          $user_id = DB::table('users')
          ->where('id', '1')
          ->first();
          $html = 'Delete Category';
          $email = new \App\Helpers\Email;
          $email->to($user_id->email);
          if ($email->body($html)->send()) {
            //return redirect()->route('profile');
            return 'OK';
          }
        try {
          if($del){
             return response()->json([
                'success' => true
            ], 200);
          }else{
            return response()->json([
                'success' => false,
                'message' => 'Delete Gagal!'
            ], 401);
          }
        } catch (ParseException $error) {
            return response()->json([
                'success' => false,
                'message' => 'Delete Gagal!'
            ], 401);
        }
    }
}
