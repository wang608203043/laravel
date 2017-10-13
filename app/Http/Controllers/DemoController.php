<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/10/12
 * Time: 22:44
 */

namespace App\Http\Controllers;


use App\Demo;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;


class DemoController extends Controller
{
    protected  $rules=[//验证规则
        'name'    => 'required|between:6,18|unique:demo,name',
        'password'    => 'required|min:6|same:repassword',
        'repassword'  =>'required',
        'age'  =>'required|integer|min:18',
        'birthday'  =>'dateFormat:Y-m-d',
        'email'=>'email|required'
    ];
    //新增,验证:name唯一,长度验证;password长度验证,两次密码是否唯一;age年龄验证;生日日期验证
    //错误信息在validation.php
    public function save(Request $request){
       $validate=Validator::make($request->all(),$this->rules);
       if($validate->fails()){
           return $validate->errors();
       }
       $data=$request->all();
        $demo=new Demo();
        $demo->name=$data['name'];
        $demo->password=$data['password'];
        $demo->age=$data['age'];
        $demo->birthday=$data['birthday'];
        if($demo->save()){
            return 'ok';
        }else{
            return 'error';
        }
    }

    //更新表中记录
    public function update(Request $request){
        $demo=Demo::find($request->get('id'));
        if($demo){
            $demo->name='qqqqqqqqq';
            $demo->save();
        }
    }

    //删除表中记录
    public function del(Request $request){
        $data=Demo::destroy($request->get('id'));//删除记录,可传入数组批量删除
        if($data){
            return $data;
        }else{
            return $data;
        }
    }

    //查找数据
    public  function query(){
        //$demos=Demo::all();//查询所有数据
        //$demo=Demo::find(2);//查询一条数据
        //$demos=Demo::find([2,3]);//取回多条数据
        //$demo=Demo::findOrFail(2); //找不到抛出异常
        //$demo=Demo::count();
        //$demo = Demo::max('age');
        //$demo = Demo::sum('age');
        //$demo=Demo::avg('age');
        //$demo=Demo::where('name','like','%%')->limit(2)->orderBy('name','desc')->get();//条件查询
        //dd($demo);
    }

}