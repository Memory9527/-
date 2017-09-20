window.onload=ini();
var clock;   //定时器操作语柄
var scores=0;//分数变量
var speed=2;//方块下降速率
				
				
//初始化
function ini(){
for(var i=0;i<4;i++){
	cRow();	
	scores=0;
	speed=2;
	}
}
		
//停止游戏
function stop(){
	clearInterval(clock);
	Id('main').onclick='';
}
//开始
function Start(){
	clearInterval(clock);
	clock = setInterval('move()',30);
	//创建点击事件，点击黑块改为白块，点击白块输
	Id('main').onclick = function (ev){
		if(ev.target.className.indexOf('black') == -1){
			fail();			
		}else{
			ev.target.className = "cell";
			ev.target.parentNode.pass = 1;
			score();
		}
	}
}

//暂停和继续
function pause(){
	if(Id('pause').value=='暂停'){
	stop();
	Id('start').value='继续';		
	}else{
		Start();
	}
}
		
//失败
function fail(){
	stop();
	Id('start').onclick='';
	alert('你失败了');
}
		
//重新开始
function restart(){
	stop();
	var myNode =Id('container');

	while (myNode.firstChild) {
 	myNode.removeChild(myNode.firstChild);
	}

	Id('start').onclick=Start;
	Id('start').value='开始';
	Id('score').innerHTML="得分：" +0;
	ini();
	myNode.style.top="-100px";
}

//使方块动起来
function move(){
	var con=Id("container");
	var top=parseInt(getComputedStyle(con,null)['top']);
	top += speed;
	con.style.top=top + "px";
	if(top>=0){
		cRow();
		dRow();
		con.style.top="-100px";
	}else if(top==speed-100){
		var rows=con.childNodes;
		if((rows.length==5) && (rows[rows.length-1].pass!==1)){
			fail();
		}
	}
}
		
//加速条件
function speedUp(){
	switch(scores){
		case 10:
			speed=4;
			break;
		case 20:
			speed=6;
			break;
		case 30:
			speed=8;
			break;
		case 40:
			speed=10;
			break;
		case 50:
			stop();
			Id('start').onclick='';
			alert('你赢了');
	}
}
		
//创建div，className是其类名。
function cDiv(className){
	var div=document.createElement('div');
	div.className = className;
	return div;
}
		
//按ID获取对象
function Id(id){
return document.getElementById(id);
}
		
//创建div.row
function cRow(){
	var row=cDiv('row');
	var classes=blackDiv();
	var con=Id("container");
		
	//循环创建4个子div
	for(var i=0;i<4;i++){
		row.appendChild(cDiv(classes[i]));
	}	
		
	//把row作为ID为container的div的子div
	if(con.firstChild == null){
		con.appendChild(row);
	}else{
		con.insertBefore(row,con.firstChild);
		}
}
		
//删除最后一行div;
function dRow(){
	var con =Id('container');
	if(con.childNodes.length==6){
		con.removeChild(con.lastChild);
	}
}
		
//返回一个数组，随机其中一个单元，值为"cell back",其余3个为cell
function blackDiv(){
	var arr =['cell','cell','cell','cell'];
	var m = Math.floor(Math.random()*4);
	arr[m] = 'cell black';
	return arr;
}
		
//计分函数
function score(){
	scores +=1;
	Id('score').innerHTML="得分：" +scores;
	speedUp();
}
		