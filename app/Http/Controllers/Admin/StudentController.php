<?php
/**
 * Created by Gary.F.Dong.
 * Date: 2016/7/1
 * Time: 23:14
 * Desc：
 */

namespace App\Http\Controllers\Admin;


use App\Repository\UserRepository;
use Breadcrumbs, Toastr, Excel, DB;
use App\Http\Requests\Index\CreateUserRequest;
use App\Http\Requests\Index\UpdateUserRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;

class StudentController extends BaseController
{
    protected $student;

    public function __construct(UserRepository $student)
    {
        parent::__construct();
        $this->student = $student;

        Breadcrumbs::register('admin-student', function ($breadcrumbs) {
            $breadcrumbs->parent('控制台');
            $breadcrumbs->push('学生管理', route('admin.students.index'));
        });
    }

    public function index()
    {
        Breadcrumbs::register('admin-student-index', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-student');
            $breadcrumbs->push('学生列表', route('admin.students.index'));
        });

        $users = $this->student->paginate(10);

        return view('admin.students.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Breadcrumbs::register('admin-student-create', function ($breadcrumbs) {
            $breadcrumbs->parent('admin-student');
            $breadcrumbs->push('添加学生', route('admin.students.create'));
        });
        return view('admin.students.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $result = $this->student->create($request->all());
        if (!$result) {
            Toastr::error('新学生添加失败!');

            return redirect(route('admin.students.create'));
        }
        Toastr::success('新学生添加成功!');

        return redirect('admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        Breadcrumbs::register('admin-student-edit', function ($breadcrumbs) use ($id) {
            $breadcrumbs->parent('admin-student');
            $breadcrumbs->push('编辑学生', route('admin.students.edit', ['id' => $id]));
        });

        $user = $this->student->find($id);
        //$hasRoles = $user->roles()->lists('id');
        //dd($user);
        return view('admin.students.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = $this->student->findWithoutFail($id);

        if (empty($user)) {
            Toastr::error('学生未找到');

            return redirect(route('admin.students.index'));
        }
        $user = $this->student->update($request->all(), $id);

        Toastr::success('学生更新成功.');

        return redirect(route('admin.students.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = $this->student->findWithoutFail($id);
        if (empty($user)) {
            Toastr::error('学生未找到');

            return redirect(route('admin.students.index'));
        }
        $result = $this->student->delete($id);


        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    /**
     * Delete multi users
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroyAll(Request $request)
    {
        if (!($ids = $request->get('ids', []))) {
            return response()->json(['status' => 0, 'msg' => '请求参数错误']);
        }

        foreach ($ids as $id) {
            $result = $this->student->delete($id);
        }

        return response()->json($result ? ['status' => 1] : ['status' => 0]);
    }

    public function upload()
    {
        return view('admin.upload.import');
    }

    /**
     * @param Request $request
     */
    public function import(Request $request)
    {
        if($request->hasFile('files')){

            //取出所有的存在的学生
            $allStudents = $this->student->all(['student_id'])->toArray();
            $allStudents = array_column($allStudents,'student_id');

            $path = $request->file('files')->getRealPath();

            $data = Excel::load($path, function($reader) {
                //$data = $reader->get()->toArray();
            })->get()->toArray();
            //只循环第一个worksheet
            $data = current($data);

            if(!empty($data)){
                if($res = array_intersect(array_column($data,'ksh'),$allStudents)){
                    return response()->json(['status' => 0,'msg' => 'excel中部分数据已存在数据库中，请不要重复导入。']);
                }
                foreach ($data as $key => $value) {
                    if(empty($value)) continue;
                    $insert[] = ['idcard' => $value['sfzh'],'student_id' => $value['ksh'], 'name' => $value['xm'],'email' => $value['ksh'].'@usts.edu.com','password' => md5($value['idcard']),'created_at' => Carbon::now()];
                }
                if(!empty($insert)){
                    DB::table('users')->insert($insert);
                    return response()->json(['status' => 1]);
                }
            }
        }
        return response()->json(['status' => 0]);
    }
}