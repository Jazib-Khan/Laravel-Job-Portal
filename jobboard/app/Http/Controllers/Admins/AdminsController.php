<?php

namespace App\Http\Controllers\Admins;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\Admin;
use App\Models\Job\Job;
use App\Models\Category\Category;
use App\Models\Job\Application;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
    
    public function viewLogin() {


        return view('admins.view-login');
    }

    public function checkLogin(Request $request) {

        $remember_me = $request->has('remember_me') ? true : false;

        if (auth()->guard('admin')->attempt(['email' => $request->input("email"), 'password' => $request->input("password")], $remember_me)) {
            
            return redirect() -> route('admins.dashboard');
        }
        return redirect()->back()->with(['error' => 'error logging in']);

    }

    public function index() {

            $jobs = Job::select()->count();

            $categories = Category::select()->count();

            $admins = Admin::select()->count();

            $applications = Application::select()->count();
            
            return view('admins.index', compact('jobs', 'categories', 'admins', 'applications'));
    }

    public function admins() {

        $admins = Admin::all();

        return view('admins.all-admins', compact('admins'));

    }

    public function createAdmins() {
            
        return view('admins.create-admins');
    }

    public function storeAdmins(Request $request) {

        Request()->validate([
            'name' => 'required|max:40',
            'email' => 'required|max:40',
            'password' => 'required',
        ]);

        $createAdmin = Admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        if ($createAdmin) {
            return redirect('admin/all-admins/')->with('create', 'Admin Created Successfully');
            
        }

    }

    public function displayCategories() {

        $categories = Category::all();

        return view('admins.display-categories', compact('categories'));
    }

    public function createCategories() {

        return view('admins.create-categories');
    }

    public function storeCategories(Request $request){

        Request()->validate([
            'name' => 'required|max:40',
            
        ]);

        $createCategory = Category::create([
            'name' => $request->name,
            
        ]);

        if ($createCategory) {
            return redirect('admin/display-categories/')->with('create', 'Category Created Successfully');
            
        }

    }

    public function editCategories($id) {

        $category = Category::find($id);

        return view("admins.edit-categories", compact('category'));
    }

    public function updateCategories(Request $request, $id) {

        Request()->validate([
            'name' => 'required|max:40',
            
        ]);

        $updateCategory = Category::where('id', $id)->update([
            'name' => $request->name,
            
        ]);

        if ($updateCategory) {
            return redirect('admin/display-categories/')->with('update', 'Category Updated Successfully');
            
        }
    }

    public function deleteCategories($id) {

        $deleteCategory = Category::where('id', $id)->delete();

        if ($deleteCategory) {
            return redirect('admin/display-categories/')->with('delete', 'Category Deleted Successfully');
            
        }
    }

    public function allJobs() {

        $jobs = Job::all();

        return view('admins.display-jobs', compact('jobs'));
    }

}
