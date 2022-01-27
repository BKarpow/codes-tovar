<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCodeRequest;
use App\Http\Resources\CodeResource;
use App\Models\Code;
use Illuminate\Http\Request;


class CodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('code', [
            'allCount' => Code::all()->count(),
            'codes' => Code::orderBy('name', 'asc')->whereEnable(true)->paginate(75)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCodeRequest $request)
    {
        $code = new Code();
        $code->name = $request->name;
        $code->search_mask = str_replace(' ', '_', trim(mb_strtoupper($request->name)));
        $code->code = (int) $request->code;
        $code->code_n = (int) $request->code_n;
        $code->price = (float) $request->price;
        $code->comment = $request->comment;
        $code->save();
        return redirect()->route('code.index')->withStatus("Код создан.");
    }

    /**
     * Display the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $request->validate([
            's' => 'required|string|max:20',
        ]);
        $s = $request->s;
        $s = mb_strtoupper($s);
        $s = trim($s);
        $s = str_replace(' ', '_', $s);
        $s = "$s%";
        $codes = Code::where('search_mask', 'LIKE', $s)
            ->orderBy('name', 'ASC')
            ->get();
        return CodeResource::collection($codes);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function edit(Code $code)
    {
        return view('update', [
            'code' => $code
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function update(StoreCodeRequest $request, Code $code)
    {
        $code->name = $request->name;
        $code->search_mask = str_replace(' ', '_', trim(mb_strtoupper($request->name)));
        $code->code = (int) $request->code;
        $code->code_n = (int) $request->code_n;
        $code->price = (float) $request->price;
        $code->comment = $request->comment;
        $code->save();
        return redirect()->route('code.index')->withStatus("Код создан.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Code  $code
     * @return \Illuminate\Http\Response
     */
    public function destroy(Code $code)
    {
        $nm = $code->name;
        $code->delete();
        return response()->json(['Deleted' => $nm]);
    }

    public function getDataDumpAsJson()
    {
        $c = Code::select('id', 'name', 'code', 'code_n', 'comment', 'search_mask')
            ->orderBy('name', 'asc')
            ->get();
        return CodeResource::collection($c);
    }
}
