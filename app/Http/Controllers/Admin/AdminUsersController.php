<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUsersController extends Controller
{
    // Hiển thị danh sách user
    public function index()
    {
        $users = User::all();
        return view('admin.UserManegement.user')->with('users', $users);
    }

    // Form thêm user mới
    public function create()
    {
        return view('admin.UserManegement.create');
    }

    // Lưu user mới
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'balance' => 'nullable|numeric',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'balance' => $request->balance ?? 0,
            'status' => 'active',
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User created successfully!');
    }

    // Form chỉnh sửa user
    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.UserManegement.edit', compact('user'));
    }

    // Cập nhật user
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|max:255',
            'email' => "required|email|unique:users,email,{$user->id}",
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
        ]);

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully!');
    }

    // Xóa user
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'User deleted successfully!');
    }

    // Cập nhật trạng thái user (active/inactive)
    public function userStatus($id)
    {
        $user = User::findOrFail($id);
        $user->status = $user->status === 'active' ? 'inactive' : 'active';
        $user->save();
        return redirect()->route('admin.users.index')->with('success', 'User status updated!');
    }
}
