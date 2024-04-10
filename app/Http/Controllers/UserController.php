<?php

namespace App\Http\Controllers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.UserManager', ['users' => $users]);
    }
    public function create()
    {
        return view('admin.UserCreate');
    }
    public function store(Request $request)
    {
        $existingUser = User::where('email', $request->email)->first();


        if ($existingUser) {
            return redirect()->route('user.usermanager')->with('error', 'Email already exists. Please choose a different email.');
        }

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));
        return redirect()->route('user.usermanager')->with('success', 'Thêm user thành công!');
    }
    public function edit(string $id)
    {
        $user =User::findOrFail($id);
        return view('user.edit',compact('user'));
    }
    public function update(Request $request, string $id)
    {
        $user =User::findOrFail($id);
        $user ->update($request->all());
        return redirect()->route('user.index')->with('success','user update successfully');
    }
    public function destroy(string $id)
    {
        $product = User::findOrFail($id);

        if ($product->role === 'admin') {
            return redirect()->route('user.usermanager')->with('error', 'Không thể xóa người dùng có vai trò là admin!');
        }
        $product->delete();

        return redirect()->route('user.usermanager')->with('success', 'Xoá user thành công!');
    }
}
