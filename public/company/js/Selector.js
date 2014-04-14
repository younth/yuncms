//父类
function Class(cId, cName) {
    this.classId = cId;
    this.className = cName;
}
//子类
function Item(iId, iName, cId) {
    this.itemId = iId;
    this.itemName = iName;
    this.classId = cId;
} 

//城市下属类
function Sub(sId, sName, iId, cId) {
	this.subId = sId;
	this.subName = sName;
	this.itemId = iId;
	this.classId = cId;
}

//设定具有下属地区的城市集合
var subDis = new Array();
//广州市附属地区集合
subDis[0] = new Sub(1, "越秀", 724, 1);
subDis[1] = new Sub(2, "海珠", 724, 1);
subDis[2] = new Sub(3, "荔湾", 724, 1);
subDis[3] = new Sub(4, "天河", 724, 1);
subDis[4] = new Sub(5, "白云", 724, 1);
subDis[5] = new Sub(6, "黄埔", 724, 1);
subDis[6] = new Sub(7, "罗岗", 724, 1);
subDis[7] = new Sub(8, "番禺", 724, 1);
subDis[8] = new Sub(9, "南沙", 724, 1);
subDis[9] = new Sub(10, "花都", 724, 1);
subDis[10] = new Sub(11, "从化", 724, 1);
subDis[11] = new Sub(12, "增城", 724, 1);
//佛山市附属地区集合
subDis[12] = new Sub(13, "禅城", 725, 1);
subDis[13] = new Sub(14, "顺德", 725, 1);
subDis[14] = new Sub(15, "南海", 725, 1);
subDis[15] = new Sub(16, "三水", 725, 1);
subDis[16] = new Sub(17, "高明", 725, 1);
//清远市附属地区集合
subDis[17] = new Sub(18, "清城", 10, 1);
subDis[18] = new Sub(19, "清新", 10, 1);
subDis[19] = new Sub(20, "佛冈", 10, 1);
subDis[20] = new Sub(21, "英德", 10, 1);
subDis[21] = new Sub(22, "阳山", 10, 1);
subDis[22] = new Sub(23, "连南", 10, 1);
subDis[23] = new Sub(24, "连山", 10, 1);
subDis[24] = new Sub(25, "连州", 10, 1);
