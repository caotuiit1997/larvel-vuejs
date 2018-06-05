<?php

namespace App\Http\Controllers\Api\v1;
use App\Company;
use App\Http\Requests\CompaniesRequest as Request;
use App\Http\Controllers\Controller;

class CompaniesController extends Controller
{
    public function index()
    {
        return Company::all();
    }

    public function show($id)
    {
        return Company::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $company = Company::findOrFail($id);
        $company->update($request->all());

        return $company;
    }

    public function store(Request $request)
    {
        $company = new Company;
        if ($request->file('avatar') != NULL){
            $image = $request->file('avatar');
            $image_name = $image->getClientOriginalName();
            $is_stored_img = $image->move(public_path().'/uploads/img/', $image_name);
            $company->avatar = '/uploads/img/'.$image_name;
        }else {
            return response('Avatar not found', 500);
        }

        $company->name = $request->name;
        $company->email = $request->email;
        $company->address = $request->address;
        $company->website = $request->website;

        if ($is_stored_img){
            $company->save();
        }
        return $company;
    }

    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return '';
    }
}
