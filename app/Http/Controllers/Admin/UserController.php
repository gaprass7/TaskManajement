<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\ApiResponder;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::all();
            if ($request->mode == "datatable") {
                return DataTables::of($users)
                    ->addColumn('action', function ($row) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1 d-inline-flex" onclick="getModal(), getModal(`createModal`, `/admin/users/' . $row->id . '`, [`id`, `role`, `name`, `email`, `photo`], [`password`, `password_confirmation`])"><i class="fa fa-pencil me-1"></i></button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger d-inline-flex" onclick="confirmDelete(`/admin/users/' . $row->id . '`, `tbl_list`)"><i class="fa fa-trash me-1"></i></button>';
                        return $editButton . $deleteButton;
                    })
                    ->addColumn('photo', function ($row) {
                        $imageUrl = $row->photo ? asset('storage/image/user/' . $row->photo) : asset('storage/image/user/noprofile.png');
                        return '<img src="' . $imageUrl . '" width="100px" alt="">';
                    })
                    ->addIndexColumn()
                    ->rawColumns(['action', 'photo'])
                    ->make(true);
            }
            return $this->successResponse($users, 'Data User Ditemukan');
        }
        return view('admin.user.index');
    }

    public function store (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
            'role' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',
        ],
        [
            'name.required' => 'Nama Tidak Boleh Kosong',
            'email.required' => 'Email Tidak Boleh Kosong',
            'email.unique' => 'Email Sudah Terdaftar',
            'password.required' => 'Password Tidak Boleh Kosong',
            'password.min' => 'Password Minimal 8 Karakter',
            'password.confirmed' => 'Password Tidak Sama',
            'role.required' => 'Role Tidak Boleh Kosong',
            'photo.image' => 'Format Foto Tidak Sesuai, Format yang diizinkan: jpg, jpeg, png, gif, svg, webp',
            'photo.max' => 'Ukuran Foto Maksimal 2MB',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        if (!empty($request->photo)) {
            $slugUser = Str::slug($request->name);
            $fileName = 'foto-' . $slugUser . '-' . time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('storage/image/user'), $fileName);
        } else {
            $fileName = '';
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request['password']),
            'role' => $request->role,
            'photo' => $fileName,
        ]);

        return $this->successResponse($user, 'Data User Berhasil Ditambahkan');
    }

    public function show (string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->errorResponse(null, 'Data User Tidak Ditemukan', 404);
        }
        return $this->successResponse($user, 'Data User Ditemukan');
    }

    public function update (Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg,webp|max:2048',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $user = User::find($id);
        if (!$user) {
            return $this->errorResponse(null, 'Data User Tidak Ditemukan', 404);
        }

        $updateUser = [
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
        ];

        if (!empty($request->photo)) {
            // Delete old photo if exists
            if (!empty($user->photo) && file_exists(public_path('storage/image/user/' . $user->photo))) {
                unlink(public_path('storage/image/user/' . $user->photo));
            }

            $slugPhoto = Str::slug($request->name);
            $fileName = 'foto-' . $slugPhoto . '-' . time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('storage/image/user'), $fileName);
            $updateUser['photo'] = $fileName;
        }

        $user->update($updateUser);
        return $this->successResponse($user, 'Data User Berhasil Diupdate');
    }

    public function destroy(string $id)
    {
        $user = User::find($id);
        if (!$user) {
            return $this->errorResponse(null, 'Data Pengguna tidak ditemukan.', 404);
        }
        $user->delete();
        return $this->successResponse(null, 'Data Pengguna Berhasil Dihapus', 200);
    }
}
