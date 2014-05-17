<?php
class person {
	public $name;
	public $gender;
	public function say()
	{
		echo $this->name,' is  ',$this->gender;
	}
}

$student=new person();
$student->name='tom';
$student->gender='male';
//$student->say();
//print_r((array)$student);
$str=serialize($student);
file_put_contents('cs.txt', $str);
$data=file_get_contents('cs.txt');
$student=unserialize($data);//反序列化为对象
$student->say();
