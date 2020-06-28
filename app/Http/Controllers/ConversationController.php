<?php

namespace App\Http\Controllers;

use App\Model\Conversation;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ConversationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $conversations = Conversation::get();
        return response()->json($conversations, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try
        {
            $this->validate($request, [
                'user_id' => 'required|required',
                'to' => 'required|integer'
            ]);

            $conversation = new Conversation();

            $conversation->user_id = $request->user_id;
            $conversation->to = $request->to;

            $conversation->save();

            return response()->json([
                'message' => 'Conversation created'
                ]);
        } catch(ValidationException $v)
        {
            return response()->json([
                'error_message' => $v->validator->errors()->first()
            ], 422);
        } catch(\Exception $e)
        {
            return response()->json([
                'error_message' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function show(Conversation $conversation)
    {
        return response()->json($conversation, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conversation $conversation)
    {
        // $conversation->to = $request->to;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Conversation  $conversation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Conversation $conversation)
    {
        $conversation->delete();
    }
}
