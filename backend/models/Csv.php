<?php
namespace backend\models;
/**
 * CSV 文件处理类
 */
class Csv{
  public $csv_array; //csv数组数据
  public $csv_str; //csv文件数据
  public function __construct($param_arr=NULL, $column=NULL, $path=NULL){
    $this->csv_array = $param_arr;
    $this->path = $path;
    $this->column = $column;
  }
  /**
   * 导出
   * */
  public function export(){
    if(empty($this->csv_array) || empty($this->column)){
      return false;
    }
    $param_arr = $this->csv_array;
    unset($this->csv_array);
    
    foreach ($param_arr['nav'] as &$item) {
    	$item = iconv('utf-8','gb2312',$item); //中文转码
    }
    
    $export_str = '"'.implode('","',$param_arr['nav']).'"'."\n";
    unset($param_arr['nav']);
    //组装数据
    foreach($param_arr as $k=>$v){
      foreach($v as $k1=>$v1){
      	foreach ($v1 as &$item) {
      		$item = iconv('utf-8','gb2312',$item); //中文转码
      	}
        $export_str .= '"'.implode('","',$v1).'"'."\n";
      }
    }
    //将$export_str导出
    header( "Cache-Control: public" );
    header( "Pragma: public" );
    header("Content-type:application/vnd.ms-excel");
    header("Content-Disposition:attachment;filename=$this->path");
    header('Content-Type:APPLICATION/OCTET-STREAM');
    ob_start();   
   // $file_str= iconv("utf-8",'gbk',$export_str);
    ob_end_clean();
    echo $export_str;
  }
  /**
   * 导入
   * */
  public function import($path,$column = 3){
    $flag = false;
    $code = 0;
    $msg = '未处理';
    $filesize = 1; //1MB
    $maxsize = $filesize * 1024 * 1024;
    $max_column = 1000;
  
    //检测文件是否存在
    if($flag === false){
      if(!file_exists($path)){
        $msg = '文件不存在';
        $flag = true;
      }
    }
    //检测文件格式
    if($flag === false){
      $info = pathinfo($path);
      $ext = $info['extension'];
      if($ext != 'csv'){
        $msg = '只能导入CSV格式文件';
        $flag = true;
      }
    }
    //检测文件大小
    if($flag === false){
      if(filesize($path)>$maxsize){
        $msg = '导入的文件不得超过'.$maxsize.'B文件';
        $flag = true;
      }
    }
    //读取文件
    if($flag === false){
      $row = 0;
      $handle = fopen($path,'r');
      $dataArray = array();
      while($data = fgetcsv($handle,$max_column,",")){
        $num = count($data);
        if($num < $column){
          $msg = '文件不符合规格真实有：'.$num.'列数据';
          $flag = true;
          break;
        }
        if($flag === false){
          for($i=0;$i<$column;$i++){
//             if($row == 0){
//               break;
//             }
            //组建数据
            $data[$i] = iconv('GBK', 'UTF-8', $data[$i]);
            //iconv('utf-8','gb2312',$data[$i]); //中文转码
            $dataArray[$row][$i] = $data[$i];
          }
        }
        $row++;
      }
    }
    if ($flag === true) {
    	return $msg;
    } else {
    	return $dataArray;
    }

  }
}

?>