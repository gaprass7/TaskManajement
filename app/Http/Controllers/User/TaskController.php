<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Traits\ApiResponder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Facades\DataTables;

class TaskController extends Controller
{
    public function __construct()
    {
        // Pastikan user sudah login
        $this->middleware('auth');
    }

    use ApiResponder;

    public function index(Request $request)
    {
        $user = Auth::user();

        // Ambil hanya task milik user login
        $tasks = Task::where('user_id', $user->id)->get();

        if ($request->ajax()) {
            if ($request->mode == "datatable") {
                return DataTables::of($tasks)
                    ->addColumn('action', function ($row) {
                        $editBtn = '<button class="btn btn-sm btn-warning me-1" onclick="getModal(), getModal(`createModal`, `/tasks/' . $row->id . '`, [`id`, `title`, `description`, `status`])">
                            <i class="fa fa-pencil me-1"></i></button>';
                        $deleteBtn = '<button class="btn btn-sm btn-danger" onclick="confirmDelete(`/tasks/' . $row->id . '`, `tbl_list`)">
                            <i class="fa fa-trash me-1"></i></button>';
                        return $editBtn . $deleteBtn;
                    })
                    ->addColumn('user', function () use ($user) {
                        // Menampilkan nama user login
                        return $user->name;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['action', 'user'])
                    ->make(true);
            }
            return $this->successResponse($tasks, 'Data Task Ditemukan');
        }

        return view('user.task.index');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required',
        ], [
            'title.required' => 'Judul tidak boleh kosong',
            'status.required' => 'Status tidak boleh kosong',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $task = Task::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
        ]);

        return $this->successResponse($task, 'Data Task Berhasil Ditambahkan');
    }

    public function show(string $id)
    {
        $task = Task::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$task) {
            return $this->errorResponse(null, 'Data Task Tidak Ditemukan', 404);
        }

        return $this->successResponse($task, 'Data Task Ditemukan');
    }

    public function update(Request $request, string $id)
    {
        $task = Task::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$task) {
            return $this->errorResponse(null, 'Data Task Tidak Ditemukan', 404);
        }

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $task->update($request->only(['title', 'description', 'status']));

        return $this->successResponse($task, 'Data Task Berhasil Diubah');
    }

    public function destroy(string $id)
    {
        $task = Task::where('id', $id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$task) {
            return $this->errorResponse(null, 'Data Task Tidak Ditemukan', 404);
        }

        $task->delete();
        return $this->successResponse(null, 'Data Task Berhasil Dihapus', 200);
    }
}
