<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use Validator;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Subject::all();
        return $data;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'thumbnail' => 'required',
            'title' => 'required',
            'content' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response([
                'messages' => $validator->messages()
            ],401);
        } else {
            $data = [
                'thumbnail' => $request->get('thumbnail'),
                'title' => $request->get('title'),
                'content' => $request->get('content')
            ];
            $store = Subject::create($data);
            if($store){
                return response()->json([
                    'message' => 'store berhasil'
                ],200);
            } else {
                return response()->json([
                    'message' => 'Failed to Store'
                ],400);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'thumbnail' => 'required',
            'title' => 'required',
            'content' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response([
                'messages' => $validator->messages()
            ], 401);
        } else {
            $subject = Subject::find($id);
            $data = [
                'thumbnail' => $request->get('thumbnail'),
                'title' => $request->get('title'),
                'content' => $request->get('content')
            ];
            $subject->update($data);
            if ($subject) {
                return response([
                    'messages' => 'update berhasil'
                ],200);
            } else {
                return response([
                    'messages' => 'gagal update'
                ],400);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(subject $subject, $id)
    {
        $subject = Subject::find($id);
        $subject->delete();

        return response([
            'messages' => 'berhasil delete'
        ]);
    }
}
