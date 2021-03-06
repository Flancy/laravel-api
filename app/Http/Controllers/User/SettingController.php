<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Validator;
use Image;
use Auth;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('user.setting.general');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function updateContactInfo(Request $request)
    {
        $validator = $this->validationContactInfo($request->all());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $user = $request->user();
        $name = $user->name = $request->name;
        $email = $user->email = $request->email;
        $user->save();

        return response()->json(['name' => $name, 'email' => $email], 200);
    }

    public function updatePhoto(Request $request)
    {
        $validator = $this->validationPhoto($request->all());

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $imgName = $this->getMimeTypeAndSetImgName($request->photo);

        Image::make($request->photo)->fit(220,220)->save(public_path() . $imgName);

        $user = $request->user();
        $user->userInfo->photo = $imgName;
        $user->userInfo->save();

        return response()->json(['image' => $imgName], 200);
    }

    public function validationPhoto(array $data)
    {
        return Validator::make($data, [
            'photo' => 'required|image',
        ]);
    }

    public function validationContactInfo(array $data)
    {
        if ($data['email'] == Auth::user()->email) {
            return Validator::make($data, [
                'name' => 'required|max:255',
            ]);
        }

        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
        ]);
    }

    public function getMimeTypeAndSetImgName($file)
    {
        $mime = Image::make($file)->mime();
        $str = str_random(10);

        switch ($mime) {
            case 'image/jpeg':
                return '/storage/profile/' . $str . '.jpeg';
                break;

            case 'image/png':
                return '/storage/profile/' . $str . '.png';
                break;
            
            default:
                return '/storage/profile/' . $str . '.jpeg';
                break;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
