<?php

namespace App\Http\Controllers;

use App\Comments;
use App\Mail\MailTrap;
use App\Publications;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $publication_id = $request->query('id');
        return view('comments.create', compact('publication_id'));

    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $publication_id = $request->get('publication_id');
        $user = auth()->user();
        //
        $messages = [
            'content.required' => 'Debe completar el contenido'
        ];


        $rules = [
            'content' => 'required'
        ];

        $result = Comments::where([['publication_id','=',$publication_id],['user_id','=',$user->id]])->get();


        if(count($result)>0){
            return redirect()->back()->with('message-error', 'No puede volver a comentar esta publicación');
        }

        $this->validate($request, $rules, $messages);




        $comment = new Comments([
            'content' => $request->get('content'),
            'publication_id' => $publication_id,
            'user_id' => $user->id,
            'status'=> 'APROBADO'

        ]);
        try {
            $comment->save();
            $this->sendEmail($comment);
        }catch(\Exception $e){
            dd($e);
            return redirect()->back()->with('message-error', 'Ocurrio une error al cargar el comentario');
        }
        return redirect('/publications')->with('Excelente', 'comentario  realizado!');
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

    private function sendEmail(Comments $comment)
    {
        $details = [
            'title' => 'Desafio 5 TwGroup',
            'body' => 'Nuevo comentario a tu publicacion '.$comment->content
        ];

        \Mail::to('your_receiver_email@gmail.com')->send(new MailTrap($details));


    }
}
