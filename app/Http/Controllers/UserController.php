<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\WilayahService;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class UserController extends Controller
{
    protected $wilayahService;

    public function __construct(WilayahService $wilayahService)
    {
        $this->wilayahService = $wilayahService;
    }

    public function show()
    {
        $users = User::all();
        $provinsi = $this->wilayahService->getProvinces();
        $kabupaten = [];
        $kecamatan = [];
        foreach ($users as $user) {
            if ($user->provinsi) {
                $kabupaten[$user->provinsi] = $this->wilayahService->getRegencies($user->provinsi);
            }
            if ($user->kabupaten) {
                $kecamatan[$user->kabupaten] = $this->wilayahService->getDistricts($user->kabupaten);
            }
        }

        return view('adduser', compact('users', 'provinsi', 'kabupaten', 'kecamatan'));
    }

    public function add(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|max:255',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan
        ]);

        return redirect()->route('adduser.show')->with('User Berhasil ditambahkan');
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'required|string|min:8|max:255',
            'provinsi' => 'required',
            'kabupaten' => 'required',
            'kecamatan' => 'required',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'provinsi' => $request->provinsi,
            'kabupaten' => $request->kabupaten,
            'kecamatan' => $request->kecamatan
        ]);

        return redirect()->route('adduser.show')->with('User Berhasil di Update');
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('adduser.show')->with('User Berhasil di Delete');
    }
}
