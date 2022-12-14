<?php

namespace App\Http\Controllers;
use App\Models\Supir;
use Illuminate\Http\Request;

class SupirController extends Controller
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
        $supir = Supir::all();
        return view('supir.index', compact('supir'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('supir.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validasi
        $validated = $request->validate([
            'nama' => 'required',
            'foto' => 'required|image|max:2048',
            'status' => 'required',
            'notlp' => 'required',
            'alamat' => 'required'
        ]);

        $supir = new Supir();
        $supir->nama = $request->nama;
        $supir->foto = $request->foto;
        $supir->status = $request->status;
        $supir->notlp = $request->notlp;
        $supir->alamat = $request->alamat;
        $supir->save();
        return redirect()->route('supir.index')
            ->with('success', 'Data berhasil dibuat!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supir = Supir::findOrFail($id);
        return view('supir.show', compact('supir'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supir = Supir::findOrFail($id);
        return view('supir.edit', compact('supir'));
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
        //validasi
        $validated = $request->validate([
            'nama' => 'required',
            'foto' => 'required|image|max:2048',
            'status' => 'required',
            'notlp' => 'required',
            'alamat' => 'required',
        ]);

        $supir = Supir::findOrFail($id);
        $supir->nama = $request->nama;
        $supir->foto = $request->foto;
        $supir->status = $request->status;
        $supir->notlp = $request->notlp;
        $supir->alamat = $request->alamat;
        $supir->save();
        return redirect()->route('supir.index')
            ->with('success', 'Data berhasil diedit!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supir = Supir::findOrFail($id);
        $supir->delete();
        return redirect()->route('supir.index')
            ->with('success', 'Data berhasil dihapus!');
    }
}
