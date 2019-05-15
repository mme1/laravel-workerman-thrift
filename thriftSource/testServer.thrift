namespace php App.Library.Thrift.Server

enum Operation {
  ADD = 1,
  SUBTRACT = 2,
  MULTIPLY = 3,
  DIVIDE = 4
}

exception InvalidOperation {
  1: i32 whatOp,
  2: string why
}

service Calculator {
   double calculate(1:double num1, 2:double num2, 3:Operation op) throws (1:InvalidOperation ouch),
   string echoString(1: string str) ,
}

service Echo {
   string echo(1: string str) ,
}