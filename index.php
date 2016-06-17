<?php
header("Content-type:text/html;charset=utf-8");
//初始化连接数据库
function __autoload($classname){
    require_once "./db/{$classname}.class.php";
}
$lamp = new Lamp("localhost", "root", "", "test");

//获取GPC输入变量的值
function I ($name,$default = null){
    if(isset($_GET[$name])){
	return $_GET[$name];
    }else if(isset($_POST[$name])){
	return $_POST[$name];
    }else if(isset($_COOKIE[$name])){
	return $_COOKIE[$name];
    }else{
	return $default;
    }
}
$action = I("action","index");
if($action == "add"){
    //显示添加的表单
    include "./tpl/add.html";
}else if($action == "insert"){
    $id = $lamp->data()->add();
    //输出提示信息
    echo "添加数据成功，编号：{$id},<a href='index.php'>查看</a>";
}else if($action == "delete"){
    $affected_rows = $lamp->delete($_GET['id']);
    echo "成功删除了{$affected_rows}条记录，<a href='index.php'>查看</a>";
}else if($action == "edit"){
    //查询该条记录
    $row = $lamp->find(array("id"=>$_GET['id']));
    //引入模板显示
    include "./tpl/edit.html";
}else if($action == "update"){
    //执行修改 使用post表单数据 经过create方法产生有效的数据 存入模型类中
    if(FALSE == $lamp->create()){
	exit($lamp->getError());
    }
    //将已经保存在模型类中的有效数据 添加入库
    $affected_rows = $lamp->where(array("id"=>$_POST['id']))->data()->save();
    //输出提示信息
    echo "修改成功，影响了{$affected_rows}条记录，<a href='index.php'>查看</a>";
}else if($action == "index"){
    //使用findAll查询所有的结果 返回的是二维数组形式
    $rows = $lamp->where()->order()->order("id DESC")->limit(10)->select();
    include "./tpl/index.html";
}