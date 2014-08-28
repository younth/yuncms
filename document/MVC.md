Yuncms的MVC
===================
Yuncms是基于canphp，三层构架比较清晰。现以admin模块来说明：

 - 控制器：adminController 

```
adminController extends commonController
commonController extends baseController
baseController extends controller
```
controller是最底层的类，位于base/controller/controller.php  里面的函数基本都是protected  成员是private

 - 模型：adminModel
```
adminModel extends baseModel
baseModel extends model

```
模型就是数据库操作封装

**调用模型方法:**

> Model方法：调用模型方法  model(“admin”)  admin模型
> model('admin')->login($username,$password)：调用adminModel下面的login方法
