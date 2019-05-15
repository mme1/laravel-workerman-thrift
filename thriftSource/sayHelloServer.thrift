namespace php App.Library.Thrift.Server # 指定生成语言，已经生成文件存放目录(也就是命名空间)

  // 定义接口
  service sayHelloService {
      string helloWorld(1:string params)
  }