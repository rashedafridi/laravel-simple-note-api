<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\node;
use Validator;
class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $nodes = node::all();
        return response()->json($nodes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'detail' => 'required'
          ]);
  
          if($validator->fails()){
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
          } else {
            // Create node
            $node = new node;
            $node->title = $request->input('title');
            $node->detail = $request->input('detail');
            $node->save();
  
            return response()->json($node);
          }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $node = node::find($id);
        return response()->json($node);
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
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'detail' => 'required'
          ]);
    
          if($validator->fails()){
            $response = array('response' => $validator->messages(), 'success' => false);
            return $response;
          } else {
            // Find an node
            $node = node::find($id);
            $node->title = $request->input('title');
            $node->detail = $request->input('detail');
            $node->save();
    
            return response()->json($node);
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
        // Find an node
      $node = node::find($id);
      $node->delete();

      $response = array('response' => 'node deleted', 'success' => true);
      return $response;
    }
}
