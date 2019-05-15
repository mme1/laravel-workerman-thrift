<?php

namespace App\Model;
use DB;
use Illuminate\Database\Eloquent\Model;
use Hprose\Http\Server;

class Test extends Model
{
    //
    protected $table = 'articles'; //添加数据库表名
    public $timestamps = false;  //关掉laravel内置时间戳
    public function test(){
//        $users = DB::connection('mysql')->talbe("");
//        print_r($users[0]);

        $users = DB::connection('mysql1')->table("comment")->where('id', '=', '1')->get();
        $users = DB::connection('mysql1')->select('select * from comment where id = ?',[1]);


        $bool=DB::connection('mysql1')->update('update comment set content= ? where id= ? ',['aaa',1]);

        return ($users);
        $this->init();

        //$a = new HproseSwooleClient();
        //echo phpinfo();
    }
    public function init(){
        $server=new Server();
        $server->addMethod('test1',$this);
        $server->start();
    }
    public function test1(){
        return 'hello';
    }

}
