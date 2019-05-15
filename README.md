# laravel-workerman-thrift
基于laravel框架，融合workerman和thrift实现rpc通信

## 详细说明
用composer安装最新版的workerman，不再赘述。

app即laravel文件夹。thriftSource 里面放的是IDL文件

App\Library\Rpc\Regist 文件夹下是服务注册

启动服务：
php artisan server:rpc start --d

关闭
php artisan server:rpc stop

重新加载
php artisan server:rpc reload


