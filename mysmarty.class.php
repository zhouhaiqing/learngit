<?php
//自定义smarty
class mysmarty{
    public $left_delimiter;
    public $right_delimiter;
    public $template_dir;
    public $compile_dir;
    public $caching;
    public $cache_dir;
    public $templates_vars = array(); //存放模板变量
    
    public function __construct(){
	$this->left_delimiter = "{";
	$this->right_delimiter = "}";
	$this->template_dir = "./templates";
	$this->compile_dir = "./templates_c";
	$this->caching = FALSE;
	$this->cache_dir = "./cache";
    }
    
    public function assign($name ,$value){
	$this->template_vars[$name] = $value;
    }
    
    public function display($tpl){
	//从模板中提取变量值
	extract($this->template_vars);
	
	$filename = $this->template_dir."/".$tpl;  //./tpl.2.html
	//强模板文件编译成php文件 存储下来
	$src = file_get_contents($filename);
	$dst = str_replace(array("{","}"),array("<?php echo "," ; ?>"),$src);
	//生成php文件
	file_put_contents($this->compile_dir."/".md5(basename($filename,".html")).".php",$dst);
	//由编译文件生成缓存
	if($this->caching == TRUE){
	    //开启输出缓冲控制
	    ob_start();
	    //引入时 会解析php 将结果存放到缓冲控制区
	    include $this->compile_dir."/".md5(basename($filename, ".html")).".php";
	    //获取缓冲其内容
	    $cont = ob_get_contents();
	    //关闭并清理缓冲区
	    ob_end_clean();
	    //生成缓存文件
	    file_put_contents($this->cache_dir."/".md5(basename($filename, ".html")).".html", $cont);
	    //加载缓存文件
	    include  $this->cache_dir."/".md5(basename($filename, ".html")).".html";
	}else{
	    include $this->compile_dir."/".md5(basename($filename, ".html")).".php";
	}
    }
}
//实例化对象
$mysmarty = new mysmarty();
//设置配置项
$mysmarty->template_dir = "./tpl";
$mysmarty->compile_dir = "./tmp";
$mysmarty->caching = TRUE;
//发送数据
$mysmarty->assign("name","tom");
$mysmarty->assign("sex","male");
//驱动显示模板
$mysmarty->display("2.html");