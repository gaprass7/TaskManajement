<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Task;
use App\Traits\ApiResponder;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    use ApiResponder;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $tasks = Task::with(['user'])->get();
            if ($request->mode == "datatable") {
                return DataTables::of($tasks)
                    ->addColumn('action', function ($row) {
                        $editButton = '<button class="btn btn-sm btn-warning me-1 d-inline-flex" onclick="getModalEdit(), getModal(`createModal`, `/admin/tasks/' . $row->id . '`, [`id`, `user_id`, `title`, `description`, `status`])"><i class="fa fa-pencil me-1"></i></button>';
                        $deleteButton = '<button class="btn btn-sm btn-danger d-inline-flex" onclick="confirmDelete(`/admin/tasks/' . $row->id . '`, `tbl_list`)"><i class="fa fa-trash me-1"></i></button>';
                        return $editButton . $deleteButton;
                    })
                    ->addColumn('user', function ($row) {
                        return $row->user->name;
                    })
                    ->addIndexColumn()
                    ->rawColumns(['action', 'user'])
                    ->make(true);
            }
            return $this->successResponse($tasks, 'Data Task Ditemukan');
        }
        return view('admin.task.index');
    }

    public function store (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required',
        ],
        [
            'user_id.required' => 'User Tidak Boleh Kosong',
            'title.required' => 'Judul Tidak Boleh Kosong',
            'status.required' => 'Status Tidak Boleh Kosong',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $task = Task::create($request->all());
        return $this->successResponse($task, 'Data Task Berhasil Ditambahkan');
    }

    public function show (string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return $this->errorResponse(null, 'Data Task Tidak Ditemukan', 404);
        }
        return $this->successResponse($task, 'Data Task Ditemukan');
    }

    public function update (Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'title' => 'required',
            'description' => 'nullable',
            'status' => 'required',
        ],
        [
            'user_id.required' => 'User Tidak Boleh Kosong',
            'title.required' => 'Judul Tidak Boleh Kosong',
            'status.required' => 'Status Tidak Boleh Kosong',
        ]);

        if ($validator->fails()) {
            return $this->errorResponse($validator->errors(), 'Data tidak valid.', 422);
        }

        $task = Task::find($id);
        if (!$task) {
            return $this->errorResponse(null, 'Data Task Tidak Ditemukan', 404);
        }
        $task->update($request->all());
        return $this->successResponse($task, 'Data Task Berhasil Diubah');
    }

    public function destroy(string $id)
    {
        $task = Task::find($id);
        if (!$task) {
            return $this->errorResponse(null, 'Data Task Tidak Ditemukan', 404);
        }
        $task->delete();
        return $this->successResponse(null, 'Data Task Berhasil Dihapus', 200);
    }
}
